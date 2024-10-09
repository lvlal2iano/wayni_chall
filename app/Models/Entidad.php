<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Entidad extends Model
{

    protected $table = 'entidades';

    protected $fillable = ['entidad', 'suma_prestamos'];
}
