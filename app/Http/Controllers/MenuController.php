<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(){
        return view ('MenuRestaurante/menuIndex');
    }

    //buscar clientes
    public function search(Request $request){
        $text =trim($request->get('busqueda'));
        $menu = Menu::where('nombre', 'like', '%'.$text.'%')
        ->orWhere('precio', 'like', '%'.$text.'%')->paginate(10);
        return view('menuIndex', compact('menu', 'text'));
    }

    public function show(){
        return view ('MenuRestaurante/detalleComidasBebidas');
    }
}
