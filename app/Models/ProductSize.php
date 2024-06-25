<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;
    protected $table = 'product_size';
    protected $fillable = [
        'product_id',
        'name',
        'price',

    ];

    public static function DeleteRecord($productId)
    {
        return self::where('product_id', "=", $productId)->delete();
    }
    public static function getSingle($id)
    {
        return self::find($id);
    }
}
