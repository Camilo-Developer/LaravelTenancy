<?php

namespace App\Http\Controllers\Redirect;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller
{
    public function dashboard(){

        if (auth()->user()->can('admin.dashboard')){

            return redirect()->route('admin.dashboard');

        }elseif (auth()->user()->can('dashboard')){

            return redirect()->route('dashboard');

        }else{
            Auth::logout();
            return redirect()->route('login')->with('info', 'No tiene los permisos requeridos para ingresar al sistema comuniquese con la mesa de ayuda.');
        }
    }

    public function dashboardApp(){
        $user = auth()->user();

        // Obtén los permisos del usuario
        $userPermissions = $user->getPermissionsViaRoles();

        // Verifica si el usuario tiene el permiso específico
        $hasPermission = $userPermissions->contains('name', 'app.admin.dashboard');

        // Puedes imprimir la colección de permisos para depuración
        //dd($userPermissions);

        if ($hasPermission) {
            return redirect()->route('app.admin.dashboard');
        } else {
            Auth::logout();
            return redirect()->route('app.login')->with('info', 'No tiene los permisos requeridos para ingresar al sistema, comuníquese con la mesa de ayuda.');
        }
    }

}
