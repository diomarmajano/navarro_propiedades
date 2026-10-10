<?php
namespace App\Filament\Widgets;
use App\Models\Clientes;
use Filament\Widgets\Widget;
class DistribucionProcesos extends Widget
{
    protected static string $view = 'filament.widgets.distribucion-procesos';
    protected int|string|array $columnSpan = 'full';
    protected static ?string $pollingInterval = '60s';
    public function getEstadisticas(): array
    {
        $etapas = [
            'Evaluación',
            'Aprobación',
            'Tasación',
            'Estudio de Título',
            'Aprobación de seguro',
            'Borrador de escritura',
            'Firma de escritura',
            'Conservador',
            'Término',
        ];
        $conteos = array_fill_keys($etapas, 0);
        Clientes::with('procedures')
            ->chunkById(200, function ($clientes) use (&$conteos) {
                foreach ($clientes as $cliente) {
                    $procesos = $cliente->procedures
                        ->sortBy('orden');
                    // Buscar etapa activa
                    $actual = $procesos->first(
                        fn ($p) => $p->estado === 'en_proceso'
                    );
                    // Si no hay activa, buscar primera pendiente
                    $actual ??= $procesos->first(
                        fn ($p) => $p->estado === 'pendiente'
                    );
                    $titulo = $actual?->titulo;
                    // Si completó todas las etapas
                    if (! $actual) {
                        $termino = $procesos->first(
                            fn ($p) => $p->titulo === 'Término'
                                && $p->estado === 'Completado'
                        );
                        $titulo = $termino ? 'Término' : null;
                    }
                    if (
                        $titulo !== null &&
                        array_key_exists($titulo, $conteos)
                    ) {
                        $conteos[$titulo]++;
                    }
                }
            });
        $total = array_sum($conteos);
        $maximo = max(1, ...array_values($conteos));
        $estadisticas = [];
        foreach ($conteos as $etapa => $cantidad) {
            $estadisticas[] = [
                'etapa' => $etapa,
                'cantidad' => $cantidad,
                'ancho' => ($cantidad / $maximo) * 100,
            ];
        }
        return [
            'etapas' => $estadisticas,
            'total' => $total,
        ];
    }
}
