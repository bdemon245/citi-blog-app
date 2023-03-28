<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasTags, HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function replies()
    {
        return $this->hasManyThrough(Reply::class, Comment::class);
    }



    protected $fillable = [
        'user_id',
        'category_id',
        'sub_category_id',
        'slug',
        'view_count',
        'title',
        'content',
        'type',
        'featured_img',
        'is_banner',
    ];
}
