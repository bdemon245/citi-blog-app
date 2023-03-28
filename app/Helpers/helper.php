<?php

use App\Helpers\Records;
use Illuminate\Support\Str;

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
function randomPosts(array $relatedItems = [], array $queries = [], int $qty = 5)
{
    return Records::randomPosts($relatedItems, $queries, $qty);
}

/**
 * Queries random records an returns them
 */
function popular(string $tableName, string $order = 'view_count', int $qty = 5)
{

    return Records::popular($tableName, $order, $qty);
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


function countReplies($comments)
{
    $replies = 0;
    foreach ($comments as $comment) {
        $replies += count($comment->replies);
    }
    return $replies;
}
