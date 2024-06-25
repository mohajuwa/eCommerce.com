<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;

    protected $table = 'product_color';

    protected $fillable = [
        'product_id',
        'color_id',

    ];

    public static function DeleteRecord($productId)
    {
        return self::where('product_id', "=", $productId)->delete();
    }
    public static function getSingle($id)
    {
        return self::find($id);
    }
    public function getColor()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
}
