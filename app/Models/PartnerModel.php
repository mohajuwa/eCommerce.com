<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerModel extends Model
{
    use HasFactory;
    protected $table = 'partner';

    protected $fillable = [
        'title',
        'status',
        'is_delete',
        'button_name',
        'button_link',
    ];

    public static function getRecord()
    {
        return self::select('partner.*')
            ->where('partner.is_delete', '=', 0)
            ->orderBy('partner.id', 'desc')
            ->paginate(20);
    }
    public static function getRecordActive()
    {
        return self::select('partner.*')
            ->where('partner.is_delete', '=', 0)
            ->where('partner.status', '=', 0)
            ->orderBy('partner.id', 'asc')
            ->get();
    }
    public static function getSingle($id)
    {
        return self::find($id);
    }
    public function getImage()
    {
        if (!empty($this->image_name) && file_exists('upload/partner/' . $this->image_name)) {
            return url('upload/partner/' . $this->image_name);
        } else {
            return "";
        }
    }
}
