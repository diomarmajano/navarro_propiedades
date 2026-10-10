<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Procesos extends Model
{
    protected $table = 'procesos';
    protected $fillable = [
        'cliente_id',
        'titulo',
        'orden',
        'estado',
        'descripcion',
        'fecha_inicio',
        'fecha_completado',
    ];
    public function client(): BelongsTo
    {
        return $this->belongsTo(Clientes::class, 'cliente_id');
    }
    public function consultas(): HasMany
    {
        return $this->hasMany(ConsultaCliente::class, 'proceso_id');
    }
}
