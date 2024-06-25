<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistModel extends Model
{
    use HasFactory;
    protected $table = 'product_wishlist';

    public static function DeleteRecord($productId, $userId)
    {
        return self::where('product_id', "=", $productId)->where('user_id', '=', $userId)->delete();
    }

    public static function checkAlready($productId, $userId)
    {
        return self::where('product_id', "=", $productId)->where('user_id', '=', $userId)->count();
    }
    public static function getSingle($id)
    {
        return self::find($id);
    }
}
