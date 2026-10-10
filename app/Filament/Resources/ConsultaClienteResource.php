<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConsultaClienteResource\Pages;
use App\Models\ConsultaCliente;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Filters\SelectFilter;

class ConsultaClienteResource extends Resource
{
    protected static ?string $model = ConsultaCliente::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    public static function getNavigationBadge(): ?string
    {
        $total = static::getModel()::query()
            ->whereDate('created_at', today())
            ->count();
        return $total > 0 ? (string) $total : null;
    }
    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Información de la consulta')
                    ->description('Datos del cliente y proceso asociado a la consulta.')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->schema([

                        Grid::make(2)
                            ->schema([

                                Select::make('cliente_id')
                                    ->label('Cliente')
                                    ->relationship('cliente', 'nombre')
                                    ->disabled()
                                    ->dehydrated(false),

                                Select::make('proceso_id')
                                    ->label('Proceso asociado')
                                    ->relationship('proceso', 'titulo')
                                    ->searchable()
                                    ->preload()
                                    ->nullable(),

                            ]),

                    ])
                    ->collapsible(),

                Section::make('Mensaje recibido')
                    ->description('Consulta enviada por el cliente.')
                    ->icon('heroicon-o-envelope-open')
                    ->schema([

                        Textarea::make('mensaje')
                            ->label('Consulta del cliente')
                            ->disabled()
                            ->dehydrated(false)
                            ->rows(5)
                            ->columnSpanFull(),

                    ]),

                // RESPUESTA
                Section::make('Gestión de la respuesta')
                    ->description('Redacta una respuesta y actualiza el estado de la consulta.')
                    ->icon('heroicon-o-pencil-square')
                    ->schema([

                        Textarea::make('respuesta')
                            ->label('Respuesta para el cliente')
                            ->placeholder('Escribe aquí tu respuesta...')
                            ->rows(6)
                            ->maxLength(5000)
                            ->nullable()
                            ->columnSpanFull(),

                        Radio::make('estado')
                            ->label('Estado de la consulta')
                            ->options([
                                'nueva' => 'Nueva',
                                'en_revision' => 'En revisión',
                                'respondida' => 'Respondida',
                            ])
                            ->required()
                            ->inline(true),

                    ])
                    ->columns(2)
                    ->collapsible(),
            ])
            ->columns(1);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Split::make([

                    // CLIENTE Y CONSULTA
                    Stack::make([

                        TextColumn::make('cliente.nombre')
                            ->label('Cliente')
                            ->icon('heroicon-o-user-circle')
                            ->iconColor('primary')
                            ->weight('bold')
                            ->searchable(),

                        TextColumn::make('mensaje')
                            ->label('Consulta')
                            ->icon('heroicon-o-chat-bubble-left-right')
                            ->iconColor('gray')
                            ->color('gray')
                            ->limit(65)
                            ->tooltip(fn($record) => $record->mensaje)
                            ->wrap(),

                        TextColumn::make('created_at')
                            ->label('Recibida')
                            ->icon('heroicon-o-calendar-days')
                            ->color('gray')
                            ->size('sm')
                            ->dateTime('d/m/Y H:i')
                            ->sortable(),

                    ])->space(2),

                    // ESTADO DE LA CONSULTA
                    Stack::make([

                        TextColumn::make('id')
                            ->label('N.º')
                            ->formatStateUsing(
                                fn($state) => "Consulta #{$state}"
                            )
                            ->color('gray')
                            ->size('sm')
                            ->sortable(),

                        TextColumn::make('estado')
                            ->label('Estado')
                            ->badge()
                            ->formatStateUsing(
                                fn(string $state): string => match ($state) {
                                    'nueva' => 'Nueva',
                                    'en_revision' => 'En revisión',
                                    'respondida' => 'Respondida',
                                    'cerrada' => 'Cerrada',
                                    default => $state,
                                }
                            )
                            ->color(fn(string $state): string => match ($state) {
                                'nueva' => 'warning',
                                'en_revision' => 'info',
                                'respondida' => 'success',
                                'cerrada' => 'gray',
                                default => 'gray',
                            })
                            ->sortable(),

                    ])->space(2)->grow(false),

                ])->from('md'),

            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Revisar y responder'),
            ])
            ->filters([
                SelectFilter::make('estado')
                    ->label('Estado de consulta')
                    ->options([
                        'nueva' => 'Nueva',
                        'en_revision' => 'En revisión',
                        'respondida' => 'Respondida',
                    ])
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
            //
        ];
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConsultaClientes::route('/'),
            'create' => Pages\CreateConsultaCliente::route('/create'),
            'edit' => Pages\EditConsultaCliente::route('/{record}/edit'),
        ];
    }
}
