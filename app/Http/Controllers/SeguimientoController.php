<?php
namespace App\Http\Controllers;
use App\Models\Clientes;
use Illuminate\Http\Request;
class SeguimientoController extends Controller
{
    public function index()
    {
        $rut = session('seguimiento_rut');
        $cliente = $rut
            ? Clientes::with('procedures')->where('rut', $rut)->first()
            : null;
        return view('seguimiento', compact('cliente'));
    }
    public function buscar(Request $request)
{
    // Limpiar cualquier consulta anterior.
    session()->forget('seguimiento_rut');

    $request->validate([
        'rut' => [
            'required',
            'string',
            'max:20',
        ],
    ]);

    // Normalizar el RUT ingresado.
    $rut = strtoupper(trim($request->rut));

    $rut = str_replace(['.', '-'], '', $rut);

    // Buscar al cliente.
    $cliente = Clientes::query()
        ->where('rut', $rut)
        ->with([
            'procedures' => function ($query) {
                $query->latest();
            },
        ])
        ->first();

    if (! $cliente) {
        return back()
            ->withInput()
            ->with('error', 'No encontramos un cliente asociado a ese RUT.');
    }

    // Registrar la consulta.
    $cliente->consultasSeguimiento()->create([]);

    // Guardar únicamente el RUT consultado correctamente.
    session(['seguimiento_rut' => $cliente->rut]);

    return view('seguimiento', [
        'cliente' => $cliente,
    ]);
}
}
