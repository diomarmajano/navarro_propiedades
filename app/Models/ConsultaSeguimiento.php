<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class ConsultaSeguimiento extends Model
{
    protected $table = 'consultas_seguimiento';
    protected $fillable = [
        'cliente_id',
    ];
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Clientes::class, 'cliente_id');
    }
}
