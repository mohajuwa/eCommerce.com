<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSettingModel extends Model
{
    use HasFactory;
    protected $table = 'system_setting';

    protected $fillable = [
        'website_name',
        'logo',
        'fevicon',
        'footer_payment_icon',
        'address',
        'footer_description',
        'phone',
        'phone_two',
        'submit_email',
        'email',
        'email_two',
        'working_hours',
        'facebook_link',
        'twitter_link',
        'instagram_link',
        'youtube_link',
        'paintrest_link',

    ];

    public static function getRecord()
    {
        return self::select('system_setting.*')->get();
    }
    public static function getSingle()
    {
        return self::find(1);
    }

    public function getLogo()
    {
        if (!empty($this->logo) && file_exists('upload/setting/' . $this->logo)) {
            return url('upload/setting/' . $this->logo);
        } else {
            return "";
        }
    }
    public function getFevIcon()
    {
        if (!empty($this->fevicon) && file_exists('upload/setting/' . $this->fevicon)) {
            return url('upload/setting/' . $this->fevicon);
        } else {
            return "";
        }
    }
    public function getFooterPaymenIcon()
    {
        if (!empty($this->footer_payment_icon) && file_exists('upload/setting/' . $this->footer_payment_icon)) {
            return url('upload/setting/' . $this->footer_payment_icon);
        } else {
            return "";
        }
    }
}
