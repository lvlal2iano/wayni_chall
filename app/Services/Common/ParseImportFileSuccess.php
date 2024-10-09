<?php

declare(strict_types=1);

namespace App\Services\Common;

use Illuminate\Support\Collection;

class ParseImportFileSuccess implements ParseImportFileState
{
    public function __construct(
        public Collection $lines
    ) {}
    
    public function status() : int
    {
        return self::SUCCESS;
    }
}