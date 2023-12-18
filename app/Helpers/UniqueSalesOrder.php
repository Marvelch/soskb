<?php

use App\Models\position;
use App\Models\salesOrder;

if (!function_exists('UniqueSalesOrder')) {
    function UniqueSalesOrder()
    {
        $year = date('y');
        $month = date('m');

        $attempt = 1;
        do {
            $lastPosition = salesOrder::orderBy('id_transaction', 'desc')->first();
            if ($lastPosition) {
                $lastCode = explode('-', $lastPosition->id_transaction);
                $lastNumber = (int)end($lastCode);
                $nextNumber = str_pad($lastNumber + 1 + $attempt - 1, 4, '0', STR_PAD_LEFT);
                $newCode = "SO-$year$month-$nextNumber";
            } else {
                $newCode = "SO-$year$month-" . str_pad($attempt, 4, '0', STR_PAD_LEFT);
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
