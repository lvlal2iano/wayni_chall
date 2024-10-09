<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Deudor;
use App\Services\DebtorsImporter\LineParsed;
use Illuminate\Support\Collection;
use App\Services\Common\ParseImportFileSuccess;
use MongoDB\Driver\Manager;

class DeudorRepository{

    /**
     * Summary of import
     * @param \App\Services\Common\ParseImportFileSuccess $parsedData
     * @return Collection|null
     */
    public function import(ParseImportFileSuccess $parsedData) : ?Collection
    {
        new (new Deudor());
        try {
            $rows = $parsedData->lines->groupBy('deudor');
            $deudores = $rows->map(function(Collection $row){ 
                return ['identificador'=>$row->first()->deudor,
                        'situacion'=>$row->max('situacion'),
                        'suma_prestamo' => $row->sum('deuda')];
            })->reduce(function(Collection $c, array $deudorData){
                return $c->push(Deudor::create($deudorData));
            }, collect([]));
            return $deudores;
        } catch (\Throwable $th) {
            return null;
        }


    }
}