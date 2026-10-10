<?php
namespace App\Filament\Resources\ProcesosRelationManagerResource\RelationManagers;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
class ProcesosRelationManager extends RelationManager
{
    protected static string $relationship = 'procedures';
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('titulo')
                    ->required()
                    ->maxLength(255),
                Select::make('estado')
                    ->label('Estado actual')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'en_proceso' => 'En proceso',
                        'completado' => 'Completado',
                    ])
                    ->required()
                    ->native(false),
                TextInput::make('descripcion')
                    ->required()
                    ->maxLength(255),
            ]);
    }
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Procesos')
            ->columns([
                TextColumn::make('titulo')
                    ->label('Título')
                    ->icon('heroicon-o-document-text')
                    ->iconColor('primary')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('estado')
                    ->label('Estado')
                    ->icon('heroicon-o-clipboard-document-check')
                    ->iconColor('primary')
                    ->badge()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('descripcion')
                    ->label('Descripción')
                    ->icon('heroicon-o-list-bullet')
                    ->iconColor('primary')
                    ->sortable()
                    ->searchable()
                    ->limit(50),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
