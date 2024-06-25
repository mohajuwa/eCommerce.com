<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderStatusMail;
use App\Models\NotificationModel;
use App\Models\OrderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function list()
    {
        $data['header_title'] = 'Order';
        $data['getRecord'] = OrderModel::getRecord();
        // dd($data);

        return view('admin.order.list', $data);
    }
    public function orderDetail($orderId, Request $request)
    {

        if (!empty($request->noti_id)) {
            NotificationModel::updateReadNoti($request->noti_id);
            // dd($request->noti_id);

        }
        $data['header_title'] = 'Order Details';

        $data['getRecord'] = OrderModel::getSingle($orderId);
        // dd($data);

        return view('admin.order.detail', $data);
    }
    public function orderStatus(Request $request)
    {
        $getOrder = OrderModel::getSingle($request->order_id);
        $getOrder->status = $request->status;

        $getOrder->save();

        Mail::to($getOrder->email)->send(new OrderStatusMail($getOrder));
        $user_id = $getOrder->user_id;
        $url = url('user/orders');
        $message = "Your Order Status Updated #" . $getOrder->order_number;

        NotificationModel::insertRecord($user_id, $url, $message);

        $json['message'] = 'Status successfully updated';
        echo json_encode($json);
    }
}
