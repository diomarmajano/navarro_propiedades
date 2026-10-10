<?php

namespace App\Filament\Resources\ConsultaClienteResource\Pages;

use App\Filament\Resources\ConsultaClienteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConsultaCliente extends EditRecord
{
    protected static string $resource = ConsultaClienteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
