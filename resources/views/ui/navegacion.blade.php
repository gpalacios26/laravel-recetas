<div style="float:right">
    <a href="{{ route('recetas.create') }}" class="btn btn-primary text-white p-2 m-2">Crear Receta</a>
    <a href="{{ route('perfiles.edit', [Auth::user()->id]) }}" class="btn btn-dark text-white p-2 m-2">Editar Perfil</a>
    <a href="{{ route('perfiles.show', [Auth::user()->id]) }}" class="btn btn-success text-white p-2 m-2">Ver Perfil</a>
</div>
