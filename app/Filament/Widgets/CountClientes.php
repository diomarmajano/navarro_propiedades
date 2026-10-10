<?php
namespace App\Filament\Widgets;
use App\Models\Clientes;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
class CountClientes extends BaseWidget
{
    protected function getStats(): array
    {
        $clientesCount = Clientes::count();
        $clientesUpdatedCount = Clientes::where('updated_at', '>=', now()->subDays(7))->count();
        $clientsWithoutUpdateCount = Clientes::where('updated_at', '<', now()->subDays(7))->count();
        return [
            Stat::make('Clientes', $clientesCount)
                ->description('Total de clientes')
                ->descriptionIcon('heroicon-o-users')
                ->icon('heroicon-o-user-group')
                ->color('primary'),
            Stat::make('Clientes Actualizados', $clientesUpdatedCount)
                ->description('Clientes actualizados en la última semana')
                ->descriptionIcon('heroicon-o-arrow-path')
                ->icon('heroicon-o-user')
                ->color('success'),
            Stat::make('Clientes sin Actualizar', $clientsWithoutUpdateCount)
                ->description('Clientes sin actualizar en la última semana')
                ->descriptionIcon('heroicon-o-clock')
                ->icon('heroicon-o-user')
                ->color('danger'),
        ];
    }
}
