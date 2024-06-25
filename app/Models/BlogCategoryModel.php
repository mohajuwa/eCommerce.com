<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategoryModel extends Model
{
    use HasFactory;

    protected $table = 'blog_category';
    protected $fillable = [
        'name',
        'title',
        'slug',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'status',
        'is_delete',

    ];

    public static function getRecord()
    {
        return self::select('blog_category.*')
            ->where('blog_category.is_delete', '=', 0)
            ->orderBy('blog_category.id', 'desc')
            ->paginate(15);
    }
    public static function getRecordActive()
    {
        return self::select('blog_category.*')
            ->where('blog_category.is_delete', '=', 0)
            ->where('blog_category.status', '=', 0)
            ->orderBy('blog_category.name', 'asc')
            ->paginate(15);
    }


    public static function getSingle($id)
    {
        return self::find($id);
    }
    public static function getSingleSlug($slug)
    {
        return self::where('slug', '=', $slug)
            ->where('blog_category.is_delete', "=", 0)
            ->where('blog_category.status', "=", 0)
            ->first();
    }

    public  function getCountBlog()
    {
        return $this->hasMany(BlogModel::class, 'blog_category_id')
            ->where('blog.is_delete', "=", 0)
            ->where('blog.status', '=', 0)
            ->count();
    }
}
