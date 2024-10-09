<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Entidad;
use Illuminate\Support\Collection;
use App\Services\Common\ParseImportFileSuccess;

class EntidadRepository{
    /**
     * Summary of import
     * @param \App\Services\Common\ParseImportFileSuccess $parsedData
     * @return Collection|null
     */
    public function import(ParseImportFileSuccess $parsedData) : ?Collection
    {
        try {
            $rows = $parsedData->lines->groupBy('entidad');
            $entidades = $rows->map(function(Collection $row){ 
                return ['entidad'=>$row->first()->entidad,
                        'suma_prestamos' => $row->sum('deuda')];
            })->reduce(function(Collection $c, array $entidadData){
                return $c->push(Entidad::create($entidadData));
            }, collect([]));
            return $entidades;
        } catch (\Throwable $th) {
            throw $th;
            return null;
        }
    }
}