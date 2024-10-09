<?php

declare(strict_types=1);

namespace App\Services\Common;


interface ImportState
{
    public const STATUS_SUCCESS = 1;
    public const STATUS_ERROR = 2;
    public const STATUS_NOT_VALID_FILE = 3;
    public function status() : int;
}