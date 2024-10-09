<?php

declare(strict_types=1);

namespace App\Services\Common;


class ImportNotValidFile implements ImportState
{   
    public function status() : int
    {
        return self::STATUS_NOT_VALID_FILE;
    }
}