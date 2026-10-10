<?php
namespace App\Http\Controllers;
use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
class ConsultaClienteController extends Controller
{
    public function store(Request $request)
    {
        $datos = $request->validate([
            'rut' => ['required', 'string', 'max:20'],
            'mensaje' => ['required', 'string', 'min:5', 'max:2000'],
        ]);
        // Buscar cliente por RUT
        $rut = strtoupper(trim($datos['rut']));
        $rut = str_replace(['.', '-'], '', $rut);
        $cliente = Clientes::where('rut', $rut)->first();
        if (! $cliente) {
            return back()->with(
                'error',
                'No fue posible registrar la consulta.'
            );
        }
        // Limitar consultas por IP y cliente
        $key = 'consulta:'.sha1($request->ip().'|'.$cliente->id);
        if (RateLimiter::tooManyAttempts($key, 3)) {
            return back()->with(
                'error',
                'Has enviado varias consultas. Inténtalo más tarde.'
            );
        }
        $cliente->consultas()->create([
            'mensaje' => $datos['mensaje'],
            'estado' => 'nueva',
        ]);
        RateLimiter::hit($key, 3600);
        session(['seguimiento_rut' => $cliente->rut]);
        return back()->with(
            'consulta_success',
            'Tu consulta fue enviada correctamente.'
        );
    }
}
