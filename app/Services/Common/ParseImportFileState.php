<?php

declare(strict_types=1);

namespace App\Services\Common;


interface ParseImportFileState
{
    public const SUCCESS = 1;
    public const ERROR = 2;
    public const NOT_VALID_FILE = 3;
    public function status() : int;
}