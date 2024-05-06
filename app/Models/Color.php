<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $table = 'color';

    protected $fillable = [
        'name',
        'slug',
        'status',
        'is_delete',
        'created_by',
        'code',
    ];

    public static function getRecord()
    {
        return self::select('color.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'color.created_by')
            ->where('color.is_delete', '=', 0)
            ->orderBy('color.id', 'desc')
            ->paginate(15);
    }
    public static function getRecordActive()
    {
        return self::select('color.*')
            ->join('users', 'users.id', '=', 'color.created_by')
            ->where('color.is_delete', '=', 0)
            ->where('color.status', '=', 0)
            ->orderBy('color.name', 'asc')
            ->get();
    }

    public static function getSingle($id)
    {
        return self::find($id);
    }
    public static function getAllColors($colorId)
    {
        return self::where('id', '=', $colorId)->get($colorId);
    }
}
