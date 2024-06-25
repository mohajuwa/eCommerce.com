<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationModel extends Model
{
    use HasFactory;

    protected $table = 'notification';

    public static function getUnreadNotifications()
    {
        return NotificationModel::where('is_read', '=', 0)
            ->where('user_id', '!=', 0)
            ->orderBy('id', 'desc')
            ->get();

    }
    public static function getRecord()
    {
        return NotificationModel::where('user_id', '!=', 0)
            ->orderBy('id', 'desc')
            ->paginate(40);

    }

    public static function insertRecord($user_id, $url, $message)
    {
        $save = new NotificationModel;
        $save->user_id = $user_id;
        $save->url = $url;
        $save->message = $message;
        $save->save();
    }

    public static function getSingle($id)
    {
        return self::find($id);
    }
    public static function updateReadNoti($notiId)
    {
        $getRecord = NotificationModel::getSingle($notiId);
        if (!empty($getRecord)) {
            $getRecord->is_read = 1;
            $getRecord->save();
        }
    }
}
