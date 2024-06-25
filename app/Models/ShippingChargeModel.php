<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingChargeModel extends Model
{
    use HasFactory;
    protected $table = 'shipping_charge';

    protected $fillable = [
        'name',
        'status',
        'is_delete',
        'price',
    ];

    public static function getRecord()
    {
        return self::select('shipping_charge.*')
            ->where('shipping_charge.is_delete', '=', 0)
            ->orderBy('shipping_charge.id', 'desc')
            ->paginate(20);
    }
    public static function getRecordActive()
    {
        return self::select('shipping_charge.*')
            ->where('shipping_charge.is_delete', '=', 0)
            ->where('shipping_charge.status', '=', 0)
            ->orderBy('shipping_charge.name', 'asc')
            ->paginate(20);
    }
    public static function getSingle($id)
    {
        return self::find($id);
    }
    public static function checkDiscount($shipping_charge)
    {
        return self::select('shipping_charge.*')
            ->where('shipping_charge.is_delete', '=', 0)
            ->where('shipping_charge.status', '=', 0)
            ->where('shipping_charge.name', $shipping_charge)
            ->where('shipping_charge.expare_date', '>=', date('Y-m-d '))
            ->first();
    }
}
