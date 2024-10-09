<?php

declare(strict_types=1);

namespace App\Services\Common;


class ParseImportFileNotValid implements ParseImportFileState
{
    public function status() : int
    {
        return self::NOT_VALID_FILE;
    }
}