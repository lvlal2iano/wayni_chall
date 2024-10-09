<?php

use Illuminate\Database\Migrations\Migration;
use MongoDB\Laravel\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'mongodb';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('deudores', function (Blueprint $collection) {
            $collection->integer('identificador');
            $collection->integer('situacion');
            $collection->integer('suma_prestamos');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('deudores');
    }
};
