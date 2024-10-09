<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Deudor extends Model
{

    protected $table = 'deudores';

    protected $fillable = ['identificador', 'situacion', 'suma_prestamos'];

}
