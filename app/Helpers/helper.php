<?php

use App\Helpers\Records;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

/**
 * Counts the specified records and returns the value
 */

function recordsCount(string $tableName, array $queries = [])
{
    return Records::count($tableName, $queries);
}

/**
 * Queries random records an returns them
 */
function recordsRandom(string $tableName, array $relatedItems = [], array $queries = [], int $qty = 5)
{
    return Records::random($tableName, $relatedItems, $queries, $qty);
}

/**
 * takes an image url and checks weather 
 * it is available in local storage or 
 */

function setImage(string $imgUrl)
{
    if (Str::contains($imgUrl, 'uploads/')) {
        $imgUrl = asset('storage/' . $imgUrl);
    }
    return $imgUrl;
}
