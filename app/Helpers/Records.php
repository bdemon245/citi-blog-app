<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Records
{
    /**
     * Counts the specified records and returns the value
     */

    public static function count(string $tableName, array $queries = [])
    {
        $count = DB::table($tableName)->where($queries)->count();
        return $count;
    }

    /**
     * Queries random records an returns them
     */
    public static function random(string $tableName, array $relatedItems = [], array $queries = [], int $qty = 5)
    {
        $records = DB::table($tableName)->with($relatedItems)->where($queries)->inRandomOrder()->paginate($qty);
        return $records;
    }
}
