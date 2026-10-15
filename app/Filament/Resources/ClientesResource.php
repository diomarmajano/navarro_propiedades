<?php

namespace App\Filament\Resources;

use App\Enums\Documentacion;
use App\Filament\Resources\ClientesResource\Pages;
use App\Filament\Resources\ProcesosRelationManagerResource\RelationManagers\ProcesosRelationManager;
use App\Models\Clientes;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class ClientesResource extends Resource
{
    protected static ?string $model = Clientes::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Información personal')
                    ->description('Datos de identificación y contacto del cliente.')
                    ->icon('heroicon-o-user-circle')
                    ->schema([
                        Grid::make(4)
                            ->schema([
                                TextInput::make('rut')
                                    ->label('RUT')
                                    ->placeholder('12.345.678-9')
                                    ->maxLength(255),
                                TextInput::make('nombre')
                                    ->label('Nombre')
                                    ->placeholder('Nombre del cliente')
                                    ->maxLength(255),
                                TextInput::make('apellido')
                                    ->label('Apellido')
                                    ->placeholder('Apellido del cliente')
                                    ->maxLength(255),
                                TextInput::make('regimen_matrimonial')
                                    ->label('Régimen matrimonial')
                                    ->placeholder('Régimen matrimonial del cliente')
                                    ->maxLength(255),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('email')
                                    ->label('Correo electrónico')
                                    ->email()
                                    ->prefixIcon('heroicon-o-envelope')
                                    ->placeholder('correo@ejemplo.cl')
                                    ->maxLength(255),
                                TextInput::make('telefono')
                                    ->label('Teléfono')
                                    ->tel()
                                    ->prefixIcon('heroicon-o-phone')
                                    ->placeholder('+56 9 1234 5678')
                                    ->maxLength(255),
                            ]),
                        TextInput::make('direccion')
                            ->label('Dirección')
                            ->prefixIcon('heroicon-o-map-pin')
                            ->placeholder('Dirección del cliente')
                            ->maxLength(255),
                    ])
                    ->columns(1)
                    ->collapsible(),
                Section::make('Documentación requerida')
                    ->description('Selecciona los documentos que deberá presentar el cliente.')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        CheckboxList::make('documentos')
                            ->label('Listado de documentos')
                            ->options(Documentacion::class)
                            ->columns([
                                'default' => 1,
                                'md' => 2,
                            ])
                            ->bulkToggleable()
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ])
            ->columns(1);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(
                fn($query) => $query
                    ->withCount('consultasSeguimiento')
                    ->with([
                        'procedures' => fn($q) => $q->orderBy('orden')
                    ])
            )
            ->columns([
                TextColumn::make('nombre')
                    ->label('Cliente')
                    ->formatStateUsing(
                        fn($record) => "{$record->nombre} {$record->apellido}"
                    )
                    ->weight('bold')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-user'),
                TextColumn::make('rut')
                    ->label('RUT')
                    ->icon('heroicon-o-identification')
                    ->color('gray')
                    ->size('sm')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('etapa_actual')
                    ->label('Etapa actual')
                    ->state(
                        fn($record) =>
                        $record->etapa_actual ?? 'Sin etapa'
                    )
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-o-map-pin'),
                TextColumn::make('consultas_seguimiento_count')
                    ->label('Consultas')
                    ->formatStateUsing(
                        fn($state) => $state == 0
                            ? 'Sin consultas'
                            : "{$state} consultas"
                    )
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('gray')
                    ->size('sm')
                    ->sortable(),


            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50])
            
->filters([
    SelectFilter::make('etapa_actual')
        ->label('Etapa del cliente')
        ->placeholder('Todas las etapas')
        ->options([
            'Evaluación' => 'Evaluación',
            'Aprobación' => 'Aprobación',
            'Tasación' => 'Tasación',
            'Estudio de Título' => 'Estudio de Título',
            'Aprobación de seguro' => 'Aprobación de seguro',
            'Borrador de escritura' => 'Borrador de escritura',
            'Firma de escritura' => 'Firma de escritura',
            'Conservador' => 'Conservador',
            'Término' => 'Término',
        ])
        ->query(function (Builder $query, array $data): Builder {
            $etapa = $data['value'] ?? null;

            if (blank($etapa)) {
                return $query;
            }

            return $query->where(function (Builder $q) use ($etapa) {

                // Cliente con esta etapa activa.
                $q->whereHas('procedures', fn (Builder $p) =>
                    $p->where('titulo', $etapa)
                      ->where('estado', 'en_proceso')
                );

                // Sin etapa activa: primera pendiente.
                $q->orWhere(function (Builder $sub) use ($etapa) {
                    $sub->whereDoesntHave('procedures', fn (Builder $p) =>
                        $p->where('estado', 'en_proceso')
                    )
                    ->whereHas('procedures', fn (Builder $p) =>
                        $p->where('titulo', $etapa)
                          ->where('estado', 'pendiente')
                          ->whereNotExists(function ($previas) {
                              $previas->selectRaw('1')
                                  ->from('procesos as anteriores')
                                  ->whereColumn(
                                      'anteriores.cliente_id',
                                      'procesos.cliente_id'
                                  )
                                  ->whereColumn(
                                      'anteriores.orden',
                                      '<',
                                      'procesos.orden'
                                  )
                                  ->where('anteriores.estado', 'pendiente');
                          })
                    );
                });

                // Todas las etapas completadas.
                if ($etapa === 'Término') {
                    $q->orWhere(function (Builder $sub) {
                        $sub->whereDoesntHave('procedures', fn (Builder $p) =>
                            $p->whereIn('estado', ['en_proceso', 'pendiente'])
                        )
                        ->whereHas('procedures', fn (Builder $p) =>
                            $p->where('titulo', 'Término')
                              ->where('estado', 'completado')
                        );
                    });
                }
            });
        }),
])

            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    public static function getRelations(): array
    {
        return [
            ProcesosRelationManager::class,
        ];
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClientes::route('/'),
            'create' => Pages\CreateClientes::route('/create'),
            'edit' => Pages\EditClientes::route('/{record}/edit'),
        ];
    }
}
