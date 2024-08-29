<?php

namespace App\Traits;

use App\Enum\StatusTab;
use App\Models\Task;

/**
 * Task trait
 */
trait NumberFormatTrait
{
    protected function getFormattedNumber(int $number)
    {
        return str_pad($number, 2, 0, STR_PAD_LEFT);
    }
}
