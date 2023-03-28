<?php

namespace App\Helpers;

use App\Models\Post;
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
    public static function randomPosts( array $relatedItems = [], array $queries = [], int $qty = 5)
    {
        $records = Post::with($relatedItems)->where($queries)->inRandomOrder()->paginate($qty);
        return $records;
    }
    /**
     * Queries random records an returns them
     */
    public static function popular(string $tableName, string $order = 'view_count', int $qty = 5)
    {
        $records = DB::table($tableName)->orderBy($order, 'desc')->paginate($qty);
        return $records;
    }
}
