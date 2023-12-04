<?php

if (!function_exists('uniqueGroup')) {
    function uniqueGroup()
    {
        // Get the current year (last two digits)
        $currentYear = date('y');

        // Set a key for the cache (you can adjust it as needed)
        $cacheKey = "last_generated_code_$currentYear";

        // Get the last generated code from the cache or set a default value
        $lastNumber = cache()->rememberForever($cacheKey, function () {
            return 0;
        });

        // Increment the number part
        $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);

        // Generate the new unique code
        $newCode = "GP-$currentYear-$newNumber";

        // Store the updated number back into the cache
        cache()->forever($cacheKey, $lastNumber + 1);

        return $newCode;
    }
}
