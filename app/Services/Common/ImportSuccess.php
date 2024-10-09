<?php

declare(strict_types=1);

namespace App\Services\Common;

use Illuminate\Support\Collection;


class ImportSuccess implements ImportState
{   
    public function __construct(
        public ?Collection $deudores,
        public ?Collection $entidades
    ){}
    public function status() : int
    {
        return self::STATUS_SUCCESS;
    }
}