<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }



    protected $fillable = [
        'user_id',
        'category_id',
        'sub_category_id',
        'slug',
        'view_count',
        'content',
        'type',
        'featured_image',
        'is_banner',
    ];
}
