<?php

namespace App\Filament\Resources\ConsultaClienteResource\Pages;

use App\Filament\Resources\ConsultaClienteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConsultaClientes extends ListRecords
{
    protected static string $resource = ConsultaClienteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
