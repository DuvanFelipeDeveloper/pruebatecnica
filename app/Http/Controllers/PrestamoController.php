<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Prestamo;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PrestamoController extends Controller
{
    public function prestamo()
    {
        $libros = Libro::select('libros.id', 'libros.nombre', 'libros.codigo', 'libros.estado', 'generos.nombre as genero')
            ->join('generos', 'libros.genero_id', '=', 'generos.id')
            ->get();
        return Inertia::render('libreria/Prestamos', [
            'libros' => $libros
        ]);
    }

    public function solicitar(Request $request)
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);


        $libro =  Libro::findOrFail($request->id);

        $prestamosActivos = Prestamo::where('user_id', $userId)
            ->join('libros', 'prestamos.libro_id', '=', 'libros.id')
            ->where('libros.estado', 'prestado')
            ->count();

        $mensaje = 'Prestamos exitoso';
        if ($libro->estado == 'disponible') {

            $prestamos = Prestamo::where('user_id', $userId)->get();

            if ($prestamos->isEmpty() || $prestamosActivos < 3) {
                $prestamo = Prestamo::create([
                    'libro_id' => $request->id,
                    'user_id'  => $userId,
                    'entrega'  => now()->addMonth(),
                ]);
                if ($prestamo) {
                    Libro::where('id', $request->id)->update(['estado' => 'prestado']);
                }
            } else {
                $mensaje = 'tiene demasiados prestamos';
            }
        } else {
            $mensaje = 'El libro no esta disponible';
        }
    }
}
