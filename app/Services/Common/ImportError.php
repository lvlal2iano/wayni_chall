<?php

declare(strict_types=1);

namespace App\Services\Common;


class ImportError implements ImportState
{   
    public function status() : int
    {
        return self::STATUS_ERROR;
    }
}