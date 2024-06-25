<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Request;

class OrderModel extends Model
{

    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'id',
        'user_id',
        'first_name',
        'last_name',
        'company_name',
        'country',
        'address_one',
        'address_two',
        'city',
        'state',
        'post_code',
        'phone',
        'email',
        'note',
        'shipping_id',
        'shipping_amount',
        'discount_code',
        'discount_amount',
        'total_amount',
        'payment_method',
        'status',
        'is_delete',
        'is_payment',
        'payment_data',

    ];

    // user part
    public static function getTotalOrdersUser($userId)
    {
        return self::select('id')
            ->where('is_payment', '=', 1)
            ->where('user_id', '=', $userId)
            ->where('is_delete', '=', 0)
            ->count();
    }
    public static function getTodayTotalOrdersUser($userId)
    {
        return self::select('id')
            ->where('is_payment', '=', 1)
            ->where('user_id', '=', $userId)
            ->where('is_delete', '=', 0)
            ->whereDate('created_at', '=', date('Y-m-d'))
            ->count();
    }
    public static function getTotalAmountUser($userId)
    {
        return self::select('id')
            ->where('is_payment', '=', 1)
            ->where('user_id', '=', $userId)
            ->where('is_delete', '=', 0)
            ->sum('total_amount');
    }
    public static function getTodayTotalAmountUser($userId)
    {
        return self::select('id')
            ->where('is_payment', '=', 1)
            ->where('user_id', '=', $userId)
            ->where('is_delete', '=', 0)
            ->whereDate('created_at', '=', date('Y-m-d'))
            ->sum('total_amount');
    }
    public static function getTotalStatusUser($userId, $status)
    {
        return self::select('id')
            ->where('is_payment', '=', 1)
            ->where('user_id', '=', $userId)
            ->where('status', '=', $status)
            ->where('is_delete', '=', 0)
            ->count();
    }

    public static function getRecordUser($userId)
    {
        return self::select('orders.*')
            ->where('is_delete', '=', 0)
            ->where('is_payment', '=', 1)
            ->where('user_id', '=', $userId)
            ->orderBy('orders.id', 'desc')
            ->paginate(5);

    }
    public static function getSinglelUser($userId, $orderId)
    {
        return OrderModel::select('orders.*')
            ->where('user_id', '=', $userId)
            ->where('id', '=', $orderId)
            ->where('is_delete', '=', 0)
            ->where('is_payment', '=', 1)
            ->first();

    }

    // end user

    public static function getLatestOrders()
    {
        return self::select('orders.*')
            ->where('is_delete', '=', 0)
            ->where('is_payment', '=', 1)
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

    }
    public static function getTotalOrdersMonth($start_date, $end_date)
    {
        return self::select('id')
            ->where('is_payment', '=', 1)
            ->where('is_delete', '=', 0)
            ->whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->count();
    }
    public static function getTotalAmountMonth($start_date, $end_date)
    {
        return self::select('id')
            ->where('is_payment', '=', 1)
            ->where('is_delete', '=', 0)
            ->whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->sum('total_amount');
    }
    public static function getTotalOrders()
    {
        return self::select('id')
            ->where('is_payment', '=', 1)
            ->where('is_delete', '=', 0)
            ->count();
    }
    public static function getTodayTotalOrders()
    {
        return self::select('id')
            ->where('is_payment', '=', 1)
            ->where('is_delete', '=', 0)
            ->whereDate('created_at', '=', date('Y-m-d'))
            ->count();
    }
    public static function getTotalAmount()
    {
        return self::select('id')
            ->where('is_payment', '=', 1)
            ->where('is_delete', '=', 0)
            ->sum('total_amount');
    }
    public static function getTodayTotalAmount()
    {
        return self::select('id')
            ->where('is_payment', '=', 1)
            ->where('is_delete', '=', 0)
            ->whereDate('created_at', '=', date('Y-m-d'))
            ->sum('total_amount');
    }
    public static function getRecord()
    {
        $return = OrderModel::select('orders.*');
        if (!empty(Request::get('id'))) {
            $return = $return->where('id', '=', Request::get('id'));
        }
        if (!empty(Request::get('order_number'))) {
            $return = $return->where('order_number', '=', Request::get('order_number'));
        }
        if (!empty(Request::get('first_name'))) {
            $return = $return->where('first_name', 'like', '%' . Request::get('first_name') . '%');
        }
        if (!empty(Request::get('company_name'))) {
            $return = $return->where('company_name', 'like', '%' . Request::get('company_name') . '%');
        }

        if (!empty(Request::get('phone'))) {
            $return = $return->where('phone', 'like', '%' . Request::get('phone') . '%');
        }

        if (!empty(Request::get('last_name'))) {
            $return = $return->where('last_name', 'like', '%' . Request::get('last_name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('email', 'like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('country'))) {
            $return = $return->where('country', 'like', '%' . Request::get('country') . '%');
        }
        if (!empty(Request::get('state'))) {
            $return = $return->where('state', 'like', '%' . Request::get('state') . '%');
        }
        if (!empty(Request::get('city'))) {
            $return = $return->where('city', 'like', '%' . Request::get('city') . '%');
        }
        if (!empty(Request::get('from_date'))) {
            $return = $return->whereDate('created_at', '>=', Request::get('from_date'));
        }
        if (!empty(Request::get('to_date'))) {
            $return = $return->whereDate('created_at', '<=', Request::get('to_date'));
        }
        $return = $return->where('orders.is_delete', '=', 0)
            ->where('orders.is_payment', '=', 1)
            ->orderBy('orders.id', 'desc')
            ->paginate(20);

        return $return;
    }

    // Corrected relationship for shipping
    public function getShipping(): BelongsTo
    {
        return $this->belongsTo(ShippingChargeModel::class, 'shipping_id');
    }

    // Relationship for order items
    public function getItem(): HasMany
    {
        return $this->hasMany(OrderItemModel::class, 'order_id');
    }

    // Static method to get a single record
    public static function getSingle($id)
    {
        return self::find($id);
    }

    // Additional relationships
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItemModel::class, 'order_id', 'id');
    }

    public function websiteInfo(): HasOne
    {
        return $this->hasOne(WebsiteInfoOrder::class, 'order_id', 'id');
    }
}
