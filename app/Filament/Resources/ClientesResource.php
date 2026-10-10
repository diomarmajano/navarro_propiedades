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
use Filament\Tables\Columns\Layout\Stack;
use Filament\Forms\Components\Split;
use Filament\Tables\Columns\Layout\Split as LayoutSplit;

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
                        Grid::make(3)
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
                fn($query) => $query->withCount('consultasSeguimiento')
            )
            ->columns([

                LayoutSplit::make([

                    // NOMBRE Y RUT
                    Stack::make([

                        TextColumn::make('nombre')
                            ->label('Cliente')
                            ->formatStateUsing(
                                fn($record) => "{$record->nombre} {$record->apellido}"
                            )
                            ->weight('bold')
                            ->searchable()
                            ->sortable(),

                        TextColumn::make('rut')
                            ->label('RUT')
                            ->icon('heroicon-o-identification')
                            ->color('gray')
                            ->size('sm')
                            ->searchable()
                            ->sortable(),

                    ])->space(1),

                    // CONTACTO
                    Stack::make([

                        TextColumn::make('email')
                            ->label('Correo')
                            ->icon('heroicon-o-envelope')
                            ->color('gray')
                            ->size('sm')
                            ->copyable()
                            ->searchable()
                            ->wrap(),

                        TextColumn::make('telefono')
                            ->label('Teléfono')
                            ->icon('heroicon-o-phone')
                            ->color('gray')
                            ->size('sm')
                            ->copyable(),

                    ])
                        ->space(1)
                        ->visibleFrom('md'),

                    // CONTADOR DE CONSULTAS
                    TextColumn::make('consultas_seguimiento_count')
                        ->label('Consultas')
                        ->badge()
                        ->formatStateUsing(
                            fn($state) => $state == 0
                                ? 'Sin consultas'
                                : "{$state} consultas"
                        )
                        ->color(
                            fn($state) => $state > 0
                                ? 'warning'
                                : 'gray'
                        )
                        ->icon('heroicon-o-chat-bubble-left-right')
                        ->sortable()
                        ->grow(false),

                ])->from('lg'),

            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50])
            ->filters([
                //
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
