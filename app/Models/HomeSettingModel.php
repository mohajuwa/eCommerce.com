<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSettingModel extends Model
{
    use HasFactory;
    protected $table = 'home_setting';

    protected $fillable = [
        'trendy_product_title',
        'shop_category_title',
        'recent_arrival_title',
        'blog_title',
        'payment_delivery_title',
        'payment_delivery_description',
        'payment_delivery_image',
        'refund_title',
        'refund_description',
        'refund_image',
        'support_title',
        'support_description',
        'support_image',
        'signup_title',
        'signup_description',
        'signup_image',
        'created_at',
        'updated_at',

    ];

    public static function getRecord()
    {
        return self::select('home_setting.*')->get();
    }
    public static function getSingle()
    {
        return self::find(1);
    }





    public function paymentDeliveryImage()
    {
        if (!empty($this->payment_delivery_image) && file_exists('upload/setting/' . $this->payment_delivery_image)) {
            return url('upload/setting/' . $this->payment_delivery_image);
        } else {
            return "";
        }
    }
    public function refundImage()
    {
        if (!empty($this->refund_image) && file_exists('upload/setting/' . $this->refund_image)) {
            return url('upload/setting/' . $this->refund_image);
        } else {
            return "";
        }
    }
    public function supportImage()
    {
        if (!empty($this->support_image) && file_exists('upload/setting/' . $this->support_image)) {
            return url('upload/setting/' . $this->support_image);
        } else {
            return "";
        }
    }
    public function signupImage()
    {
        if (!empty($this->signup_image) && file_exists('upload/setting/' . $this->signup_image)) {
            return url('upload/setting/' . $this->signup_image);
        } else {
            return "";
        }
    }
}
