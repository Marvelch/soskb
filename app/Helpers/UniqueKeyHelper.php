<?php

// app/Helpers/UniqueKeyHelper.php

use Illuminate\Support\Str;

if (!function_exists('generateUniqueKey')) {
    function generateUniqueKey($length = 10) {
        return Str::random($length);
    }
}
