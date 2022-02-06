<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'ingredientes',
        'preparacion',
        'imagen',
        'user_id',
        'categoria_id',
    ];

    /* Relación via FK de la Receta con su Categoria */
    public function categoria()
    {
        return $this->belongsTo(CategoriaReceta::class);
    }

    /* Relación via FK de la Receta con el Usuario */
    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
