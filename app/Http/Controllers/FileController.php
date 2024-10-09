<?php

namespace App\Http\Controllers;

use App\Services\Common\ImportError;
use App\Services\Common\ImportSuccess;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\AddFileRequest;
use App\Services\Common\ImportNotValidFile;
use App\Services\DebtorsImporter\ImporterService;

class FileController extends Controller
{
    /**
     * @param AddFileRequest $request
     * @return JsonResponse
     */
    public function addfile(ImporterService $importerService, AddFileRequest $request) : JsonResponse
    {
        $file = $request->file('file');

        $importedFile = $importerService->import($file);

        if ($importedFile instanceof ImportSuccess) 
        {
            $deudores = $importedFile->deudores;
            $entidades = $importedFile->entidades;
            return response()->json(['info' => ["entidades" => $entidades->count(), 'deudores' => $deudores->count()], 'message' => 'File uploaded successfully']);
        }

        if ($importedFile instanceof ImportError) 
        {
            return response()->json(['error' => 'Ha ocurrido un error desconocido'],402);
        }

        if ($importedFile instanceof ImportNotValidFile) 
        {
            return response()->json(['error' => 'El archivo no no puede leerse'],402);
        }

        return response()->json(['error' => 'Ha ocurrido un error desconocido'],402);
    }
}
