<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class BlogModel extends Model
{
    use HasFactory;

    protected $table = 'blog';
    protected $fillable = [
        'title',
        'slug',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'blog_category_id',
        'status',
        'is_delete',

    ];

    public static function getRecord()
    {
        return self::select('blog.*')
            ->where('blog.is_delete', '=', 0)
            ->orderBy('blog.id', 'desc')
            ->paginate(15);
    }
    public static function getRecordActive()
    {
        return self::select('blog.*')
            ->where('blog.is_delete', '=', 0)
            ->where('blog.status', '=', 0)
            ->orderBy('blog.id', 'desc')
            ->limit(3)
            ->get();
    }


    public static function getSingle($id)
    {
        return self::find($id);
    }
    public static function getSingleSlug($slug)
    {
        return self::where('slug', '=', $slug)
            ->where('blog.is_delete', "=", 0)
            ->where('blog.status', "=", 0)
            ->first();
    }
    public static function getBlog($blogCategoryId = '')
    {
        $return = self::select('blog.*');
        if (!empty(Request::get('search'))) {
            $return = $return->where('blog.title', 'like', '%' . Request::get('search') . '%');
        }
        if (!empty($blogCategoryId)) {
            $return = $return->where('blog.blog_category_id', '=', $blogCategoryId);
        }

        $return =   $return->where('blog.is_delete', '=', 0)
            ->where('blog.status', '=', 0)
            ->orderBy('blog.id', 'asc')
            ->paginate(20);

        return $return;
    }
    public static function getPopular()
    {
        $return = self::select('blog.*');
        $return =   $return->where('blog.is_delete', '=', 0)
            ->where('blog.status', '=', 0)
            ->orderBy('blog.total_view', 'desc')
            ->limit(6)
            ->get();

        return $return;
    }
    public static function getRelatedPost($blogCategoryId, $blogId)
    {
        $return = self::select('blog.*');
        $return =   $return->where('blog.is_delete', '=', 0)
            ->where('blog.status', '=', 0)
            ->where('blog.blog_category_id', '=', $blogCategoryId)
            ->where('blog.id', '!=', $blogId)
            ->orderBy('blog.total_view', 'desc')
            ->limit(6)
            ->get();

        return $return;
    }


    public function getBlogCategory()
    {
        return $this->belongsTo(BlogCategoryModel::class, 'blog_category_id');
    }

    public function getBlogComment()
    {
        return $this->hasMany(BlogCommentModel::class, 'blog_id')
            ->select('blog_comment.*')
            ->join('users', 'users.id', '=', 'blog_comment.user_id')
            ->orderBy('blog_comment.id', 'desc');
    }
    public function getBlogCommentCount()
    {
        return $this->hasMany(BlogCommentModel::class, 'blog_id')
            ->select('blog_comment.id')
            ->join('users', 'users.id', '=', 'blog_comment.user_id')
            ->count();
    }

    public function getImage()
    {
        if (!empty($this->image_name) && file_exists('upload/blog/' . $this->image_name)) {
            return url('upload/blog/' . $this->image_name);
        } else {
            return "";
        }
    }
}
