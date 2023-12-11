<?php

use App\Models\position;

if (!function_exists('UniquePosition')) {
    function UniquePosition($key)
{
    $year = date('y');
    $month = date('m');

    $attempt = 1;
    do {
        $lastPosition = position::orderBy('created_at', 'desc')->first();
        if ($lastPosition) {
            $lastCode = explode('-', $lastPosition->unique);
            $lastNumber = (int)end($lastCode);
            $nextNumber = str_pad($lastNumber + $key + $attempt - 1, 4, '0', STR_PAD_LEFT);
            $newCode = "P-$year$month-$nextNumber";
        } else {
            $newCode = "P-$year$month-" . str_pad($attempt, 4, '0', STR_PAD_LEFT);
        }

        $codeExists = position::where('unique', $newCode)->exists();
        if ($codeExists) {
            $attempt++;
        } else {
            return $newCode;
        }
    } while ($attempt <= 9999); // Adjust the maximum attempts if needed

    return 'Unable to generate a unique code.';
}

}
