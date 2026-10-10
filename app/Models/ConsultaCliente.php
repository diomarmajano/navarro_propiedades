<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class ConsultaCliente extends Model
{
    protected $table = 'consultas_clientes';
    protected $fillable = [
        'cliente_id',
        'proceso_id',
        'mensaje',
        'respuesta',
        'estado',
        'respondida_at',
        'cerrada_at',
    ];
    protected function casts(): array
    {
        return [
            'respondida_at' => 'datetime',
            'cerrada_at' => 'datetime',
        ];
    }
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Clientes::class, 'cliente_id');
    }
    public function proceso(): BelongsTo
    {
        return $this->belongsTo(Procesos::class, 'proceso_id');
    }
    protected static function booted(): void
    {
        static::saving(function (ConsultaCliente $consulta) {
            if (filled($consulta->respuesta)) {
                if (blank($consulta->respondida_at)) {
                    $consulta->respondida_at = now();
                }
                if ($consulta->estado === 'nueva') {
                    $consulta->estado = 'respondida';
                }
            }
            if ($consulta->estado === 'cerrada' && blank($consulta->cerrada_at)) {
                $consulta->cerrada_at = now();
            }
            if ($consulta->estado !== 'cerrada') {
                $consulta->cerrada_at = null;
            }
        });
    }
}
