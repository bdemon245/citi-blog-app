<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

/**
 * Generate a seo friendly "slug" from a given string.
 *
 * @param  string  $tableName
 * @param  string $title
 * @return string
 */
trait MakeSlug
{
    private function makeSlug(string $tableName, string $title): string
    {
        $slug = str()->slug($title);
        $count  = DB::table($tableName)->where('slug', 'LIKE',  "%$slug%")->count();
        if ($count > 0) {
            $slug = $slug . '-' . $count++;
        }

        return $slug;
    }
}
