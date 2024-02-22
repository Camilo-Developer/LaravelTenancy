<?php

namespace App\Http\Controllers\App\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\AppUser;

class DashboardController extends Controller
{
    public function index(){
        return view('app.dashboard.index');
    }

    public function login(){
        return view('app.auth.login');
    }

    public  function store(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password'],
        ];
        if(Auth::guard('appuser')->attempt($data)){
            return redirect()->route('app.admin.dashboard')->with('success','Se logio correctamente');
        }else{
            return redirect()->route('app.admin.login')->with('success','Se logio correctamente');
        }
    }

    public function logout(){
        Auth::guard('appuser')->logout();
        return redirect()->route('app.admin.login')->with('success','La sesion se cerro corractamente');
    }
}
