<?php

namespace App\Services\DebtorsImporter;

use App\Repositories\DeudorRepository;
use App\Repositories\EntidadRepository;
use App\Services\Common\ParseImportFileNotValid;
use Illuminate\Http\UploadedFile;
use App\Services\Common\ParseImportFileState;
use App\Services\Common\ImportState;
use App\Services\Common\ImportNotValidFile;
use App\Services\Common\ParseImportFileError;
use App\Services\DebtorsImporter\LineParsed;
use Illuminate\Support\Collection;
use App\Services\Common\ParseImportFileSuccess;
use App\Services\Common\ImportError;
use App\Services\Common\ImportSuccess;
use App\Models\Deudor;
use App\Models\Entidad;

class ImporterService
{
    /**
     * Summary of __construct
     * @param DeudorRepository $deudorRepository
     * @param EntidadRepository $entidadRepository
     */
    public function __construct(
        public DeudorRepository $deudorRepository, 
        public EntidadRepository $entidadRepository){
    }

    /**
     * Summary of import
     * @param UploadedFile $file
     * @return ImportState
     */
    public function import(UploadedFile $file) : ImportState
    {
        $parsedFile = $this->parseFile($file);

        if ($parsedFile instanceof ParseImportFileNotValid) 
        {
            return new ImportNotValidFile();
        }

        if ($parsedFile instanceof ParseImportFileError) 
        {
            return new ImportError();
        }

        if ($parsedFile instanceof ParseImportFileSuccess){
            
            $deudores = $this->saveDeudoresData($parsedFile);
            $entidades = $this->saveEntidadesData($parsedFile);

            return new ImportSuccess($deudores, $entidades);
        }

        return new ImportError();
    }


    /**
     * Summary of saveDeudoresData
     * @param ParseImportFileSuccess $parsedFile
     * @return ?Deudor[]
     */
    public function saveDeudoresData(ParseImportFileSuccess $parsedData) : ?Collection
    {
        return $this->deudorRepository->import($parsedData);
    }

    /**
     * Summary of saveEntidadesData
     * @param ParseImportFileSuccess $parsedFile
     * @return ?Entidad[]
     */
    public function saveEntidadesData(ParseImportFileSuccess $parsedData) : ?Collection
    {
        return $this->entidadRepository->import($parsedData);
    }

    /**
     * Summary of parseFile
     * @param UploadedFile $file
     * @return ParseImportFileState
     */
    public function parseFile(UploadedFile $file) : ParseImportFileState
    {
        try {
            if (!$this->isValidFile($file)) 
            {
                return new ParseImportFileNotValid();
            }

            $content = $file->get();

            $lines = collect(explode("\n", $content))->reduce(function(Collection $lines, string $line) {
                try {
                    $lines->push(LineParsed::makeLineParsed($line));
                } catch (\Throwable $th) {
                }

                return $lines;
            }, collect([]));
            
            return new ParseImportFileSuccess($lines);
        } catch (\Throwable $th) {
            return new ParseImportFileError();
        }
    }

    public function isValidFile(UploadedFile $file) : bool
    {
        // No profundizare en el challenge, pero aca vendria la logica de validacion del archivo
        return true;
    }

}