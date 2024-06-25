<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCodeModel extends Model
{
    use HasFactory;
    protected $table = 'discount_code';

    protected $fillable = [
        'name',
        'type',
        'status',
        'is_delete',
        'precent_amount',
        'expare_date',
    ];

    public static function getRecord()
    {
        return self::select('discount_code.*')
            ->where('discount_code.is_delete', '=', 0)
            ->orderBy('discount_code.id', 'desc')
            ->paginate(20);
    }
    public static function getSingle($id)
    {
        return self::find($id);
    }
    public static function checkDiscount($discount_code)
    {
        return self::select('discount_code.*')
            ->where('discount_code.is_delete', '=', 0)
            ->where('discount_code.status', '=', 0)
            ->where('discount_code.name', $discount_code)
            ->where('discount_code.expare_date', '>=', date('Y-m-d '))
            ->first();
    }

}
