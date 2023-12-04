<?php

if (!function_exists('uniqueGroup')) {
    function uniqueGroup()
    {
        // Get the last generated code from the database or any other storage
        $lastCode = getLastGeneratedCode();

        // Extract the number part of the last code
        $lastNumber = intval(substr($lastCode, -5));

        // Increment the number part
        $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);

        // Get the current year (last two digits)
        $currentYear = date('y');

        // Generate the new unique code
        $newCode = "GP-$currentYear-$newNumber";

        return $newCode;
    }
}

// Function to simulate getting the last generated code from the database
function getLastGeneratedCode()
{
    // Replace this with your logic to retrieve the last generated code from the database or storage
    // For example, querying a database table where codes are stored
    // Return a default value if no code exists yet
    return 'GP-23-00000'; // Default value if no code exists
}
