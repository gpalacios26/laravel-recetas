<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaReceta;
use App\Models\Receta;

class CategoriaController extends Controller
{
    public function show($id)
    {
        $categoria = CategoriaReceta::findOrFail($id);
        $recetas = Receta::where('categoria_id', $categoria->id)->paginate(3);
        return view("categorias.show")->with('categoria', $categoria)->with('recetas', $recetas);
    }
}
