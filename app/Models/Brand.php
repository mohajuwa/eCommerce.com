<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;


    protected $table = 'brand';
    protected $fillable = [
        'name',
        'slug',
        'status',
        'is_delete',
        'created_by',

    ];
    static public function getRecord()
    {
        return self::select('brand.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'brand.created_by')
            ->where('brand.is_delete', '=', 0)
            ->orderBy('brand.id', 'desc')
            ->paginate(15);
    }
    static public function checkSlug($slug)
    {
        return self::where('slug', $slug)->count();
    }
    static public function getSingle($id)
    {
        return self::find($id);
    }
    // public function category()
    // {
    //     return $this->belongsTo(Category::class, 'category_id', 'id');
    // }
}
