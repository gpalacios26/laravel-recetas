<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\CategoriaReceta;
use App\Models\Receta;

class RecetaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'search']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = auth()->user();
        // Recetas con paginación
        $recetas = Receta::where('user_id', $usuario->id)->paginate(10);
        return view("recetas.index")->with('recetas', $recetas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = CategoriaReceta::all(['id', 'nombre']);
        return view("recetas.create")->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación de los campos
        $data = $request->validate([
            'categoria' => 'required',
            'titulo' => 'required|min:4',
            'ingredientes' => 'required',
            'preparacion' => 'required',
            'imagen' => 'required|image'
        ]);

        // Obtener la ruta de la imagen
        $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

        // Resize de la imagen
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
        $img->save();

        // Almacenar en la base de datos
        $usuario = auth()->user();
        Receta::create([
            'titulo' => $data['titulo'],
            'ingredientes' => $data['ingredientes'],
            'preparacion' => $data['preparacion'],
            'imagen' => $ruta_imagen,
            'user_id' => $usuario->id,
            'categoria_id' => $data['categoria']
        ]);

        return redirect()->action([RecetaController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $receta = Receta::findOrFail($id);
        return view("recetas.show")->with('receta', $receta);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $receta = Receta::findOrFail($id);
        // Revisar el policy
        $this->authorize('view', $receta);

        $categorias = CategoriaReceta::all(['id', 'nombre']);
        return view("recetas.edit")->with('categorias', $categorias)->with('receta', $receta);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $receta = Receta::findOrFail($id);
        // Revisar el policy
        $this->authorize('update', $receta);

        // Validación de los campos
        $data = $request->validate([
            'categoria' => 'required',
            'titulo' => 'required|min:4',
            'ingredientes' => 'required',
            'preparacion' => 'required'
        ]);

        // Asignar los valores
        $receta->titulo = $data['titulo'];
        $receta->ingredientes = $data['ingredientes'];
        $receta->preparacion = $data['preparacion'];
        $receta->categoria_id = $data['categoria'];

        // Si el usuario sube una nueva imagen
        if (request('imagen')) {
            // obtener la ruta de la imagen
            $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

            // Resize de la imagen
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
            $img->save();

            // Asignar al objeto
            $receta->imagen = $ruta_imagen;
        }

        // Almacenar en la base de datos
        $receta->save();

        return redirect()->action([RecetaController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $receta = Receta::findOrFail($id);
        // Revisar el policy
        $this->authorize('delete', $receta);

        // Eliminar la receta
        $receta->delete();

        return redirect()->action([RecetaController::class, 'index']);
    }

    public function search(Request $request)
    {
        $busqueda = $request->get('buscar');
        // Consultar por like
        $recetas = Receta::where('titulo', 'like', '%' . $busqueda . '%')->paginate(10);
        $recetas->appends(['buscar' => $busqueda]);

        return view('busquedas.show', compact('recetas', 'busqueda'));
    }
}
