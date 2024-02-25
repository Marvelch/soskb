<?php

use App\Models\Position;
use App\Models\SalesOrder;

if (!function_exists('UniqueSalesOrder')) {
    function UniqueSalesOrder()
    {
        $year = date('y');
        $month = date('m');

        $attempt = 1;
        do {
            $lastPosition = SalesOrder::orderBy('id_transaction', 'desc')->first();
            if ($lastPosition) {
                $lastCode = explode('-', $lastPosition->id_transaction);
                $lastYearMonth = $lastCode[1];
                $lastNumber = (int)end($lastCode);
                if ($lastYearMonth == "$year$month") {
                    // Same month, increment the sequence
                    $nextNumber = str_pad($lastNumber + 1 + $attempt - 1, 4, '0', STR_PAD_LEFT);
                } else {
                    // Different month, start a new sequence
                    $nextNumber = str_pad($attempt, 4, '0', STR_PAD_LEFT);
                }
                $newCode = "SO-$year$month-$nextNumber";
            } else {
                // No existing records, start a new sequence
                $newCode = "SO-$year$month-" . str_pad($attempt, 4, '0', STR_PAD_LEFT);
            }

            $codeExists = Position::where('unique', $newCode)->exists();
            if ($codeExists) {
                $attempt++;
            } else {
                return $newCode;
            }
        } while ($attempt <= 9999); // Adjust the maximum attempts if needed

        return 'Unable to generate a unique code.';
    }
}

