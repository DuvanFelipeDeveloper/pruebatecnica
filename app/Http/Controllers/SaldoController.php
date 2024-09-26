<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Saldo;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

use function Pest\Laravel\put;

class SaldoController extends Controller
{
    public function cajero()
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        // $categories = Categorie::all();
        return Inertia::render('cajero/cajero', [
            'user' => $user
        ]);
    }

    public function retiro(Request $request)
    {
        $valores = array(50000, 20000, 10000, 5000, 2000, 1000);
        $numero = array();



        $valorretiro = $request->retiro;
        foreach ($valores as $valor) {
            if ($valorretiro != 0) {
                $divisible = $valorretiro / $valor;
                $mensaje = 'son ' . floor($divisible) . ' billetes de ' . $valor;
                $numero[] = $mensaje;
                $valorretiro = $valorretiro - ($valor * floor($divisible));
            }
        }

        $user = User::findOrFail($request->usuario['id']);
        $fondos = $user->saldo > $request->retiro;
        $retiromin = $request->retiro > 1000;
        $retiromax =  $request->retiro < 2000000;

        $estadoAprobado = Estado::firstOrCreate(
            ['estado' => 'aprobado']
        );
        $estadoRechazado = Estado::firstOrCreate(
            ['estado' => 'rechazado']
        );

        if ($fondos && $retiromax && $retiromin) {
            $saldo = Saldo::create([
                'cantidad_retiro' => $request->retiro,
                'user_id' => Auth::id(),
                'estado_id' => $estadoAprobado->id
            ]);
            $user->saldo = $user->saldo - $request->retiro;
        } else {
            $saldo = Saldo::create([
                'cantidad_retiro' => $request->retiro,
                'user_id' => Auth::id(),
                'estado_id' => $estadoRechazado->id
            ]);
        }
        $user->save();


        return Inertia::render('cajero/cajero', [
            'user' => $user,
            'valorretiro' => $numero,
            'fondos' => $fondos,
            'retiromin' => $retiromin,
            'retiromax' => $retiromax,
      
        ]);
    }
}
