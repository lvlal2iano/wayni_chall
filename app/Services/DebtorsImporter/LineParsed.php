<?php

declare(strict_types=1);

namespace App\Services\DebtorsImporter;

class LineParsed
{
    public function __construct(
        public int $deudor,
        public int $entidad,
        public int $situacion,
        public float $deuda)
    {}

    public static function makeLineParsed(string $line): self
    {
        if(strlen($line) < 171) {
            throw new \Exception("linea no valida");
        }

        $deudor = intval(substr($line, 13, 11));
        $entidad = intval(substr($line,0,5));
        $situacion = intval(trim(substr($line, 27, 2)));
        $deuda = floatval(str_replace(',','.',substr($line, 29, 12)));
        return new self($deudor,$entidad,$situacion,$deuda);
    }
}