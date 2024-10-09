<?php

declare(strict_types=1);

namespace App\Services\Common;


class ParseImportFileError implements ParseImportFileState
{
    public function status() : int
    {
        return self::ERROR;
    }
}