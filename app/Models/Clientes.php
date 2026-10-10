<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Clientes extends Model
{
    //
    protected $table = 'clientes';
    protected $fillable = [
        'rut',
        'nombre',
        'apellido',
        'email',
        'telefono',
        'direccion',
        'documentos',
    ];
    protected function casts(): array
    {
        return [
            'documentos' => 'array',
        ];
    }
    public function procedures(): HasMany
    {
        return $this->hasMany(Procesos::class, 'cliente_id');
    }
    public function consultas(): HasMany
    {
        return $this->hasMany(ConsultaCliente::class, 'cliente_id');
    }
    public function consultasSeguimiento(): HasMany
    {
        return $this->hasMany(
            ConsultaSeguimiento::class,
            'cliente_id'
        );
    }
    protected static function booted(): void
    {
        static::created(function (Clientes $cliente) {
            $procesos = [
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
            foreach ($procesos as $indice => $titulo) {
                $esPrimeraEtapa = $indice === 0;
                $cliente->procedures()->create([
                    'titulo' => $titulo,
                    'orden' => $indice + 1,
                    'estado' => $esPrimeraEtapa
                        ? 'en_proceso'
                        : 'pendiente',
                    'descripcion' => $esPrimeraEtapa
                        ? 'Estamos revisando los antecedentes de tu solicitud.'
                        : 'Esta etapa está pendiente de inicio.',
                    'fecha_inicio' => $esPrimeraEtapa
                        ? now()
                        : null,
                ]);
            }
        });
    }
    public function getEtapaActualAttribute(): ?string
    {
        $procesos = $this->procedures()
            ->orderBy('orden')
            ->get();
        if ($procesos->isEmpty()) {
            return null;
        }
        $actual = $procesos->first(
            fn ($proceso) => $proceso->estado === 'en_proceso'
        );
        if ($actual) {
            return $actual->titulo;
        }
        $pendiente = $procesos->first(
            fn ($proceso) => $proceso->estado === 'pendiente'
        );
        if ($pendiente) {
            return $pendiente->titulo;
        }
        $termino = $procesos->first(
            fn ($proceso) => $proceso->titulo === 'Término'
                && $proceso->estado === 'Completado'
        );
        return $termino ? 'Término' : null;
    }
}
