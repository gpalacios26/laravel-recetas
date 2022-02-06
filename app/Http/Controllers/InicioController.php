<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\CategoriaReceta;
use App\Models\Receta;

class InicioController extends Controller
{
    public function index()
    {
        // Obtener las recetas mas nuevas
        $nuevas = Receta::latest()->take(6)->get();

        // Obtener todas las categorias
        $categorias = CategoriaReceta::all();

        // Agrupar las recetas por categoria
        $recetas = [];
        foreach ($categorias as $categoria) {
            $recetas[Str::slug($categoria->nombre)] = Receta::where('categoria_id', $categoria->id)->take(3)->get();
        }

        return view('inicio.index', compact('nuevas', 'recetas'));
    }
}
