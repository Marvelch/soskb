<?php

use App\Models\group;
use App\Models\position;

if (!function_exists('UniqueGroup')) {
    function UniqueGroup($prefix = 'GP', $yearsDigits = 2, $startFrom = 1, $length = 5)
    {
        $lastCode = group::latest()->value('unique');

        $lastNumber = $lastCode ? intval(substr($lastCode, -($length + 1))) : 0;

        $newNumber = str_pad($startFrom + $lastNumber, $length, '0', STR_PAD_LEFT);

        $currentYear = date('y');
        $code = $prefix . '-' . $currentYear . '-' . $newNumber;

        return $code;
    }
}
