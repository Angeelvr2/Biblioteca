<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $table = 'libros';

    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'id_categoria');
    }
}
