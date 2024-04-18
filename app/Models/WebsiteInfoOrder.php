<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteInfoOrder extends Model
{
    use HasFactory;

    protected $table = 'website_info_orders';

    protected $fillable = [
        'order_id',
        'url',
        'comments',
    ];
}
