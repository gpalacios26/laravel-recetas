<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Perfil;
use App\Models\Receta;
use App\Models\User;

class PerfilController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        // Recetas con paginación
        $recetas = Receta::where('user_id', $perfil->user_id)->paginate(3);
        return view('perfiles.show')->with('perfil', $perfil)->with('recetas', $recetas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        // Revisar el policy
        $this->authorize('view', $perfil);
        return view('perfiles.edit')->with('perfil', $perfil);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        // Revisar el policy
        $this->authorize('update', $perfil);

        // Validación de los campos
        $data = request()->validate([
            'nombre' => 'required',
            'url' => 'required',
            'biografia' => 'required'
        ]);

        // Si el usuario sube una imagen
        if ($request['imagen']) {
            // Obtener la ruta de la imagen
            $ruta_imagen = $request['imagen']->store('upload-perfiles', 'public');

            // Resize de la imagen
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(600, 600);
            $img->save();

            // Crear un arreglo de imagen
            $array_imagen = ['imagen' => $ruta_imagen];
        }

        // Asignar nombre y url - Guardar información
        $usuario = auth()->user();
        $user = User::find($usuario->id);
        $user->name = $data['nombre'];
        $user->url = $data['url'];
        $user->save();

        // Eliminar nombre y url de $data
        unset($data['nombre']);
        unset($data['url']);

        // Asignar biografia e imagen - Guardar información
        $user->perfil()->update(array_merge(
            $data,
            $array_imagen ?? []
        ));

        return redirect()->action([RecetaController::class, 'index']);
    }
}
