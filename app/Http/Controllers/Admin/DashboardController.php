<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $data['TotalOrders'] = OrderModel::getTotalOrders();
        $data['TodayTotalOrders'] = OrderModel::getTodayTotalOrders();

        $data['TotalAmount'] = OrderModel::getTotalAmount();
        $data['TodayTotalAmount'] = OrderModel::getTodayTotalAmount();

        $data['TotalCustomers'] = User::getTotalCustomers();
        $data['TodayTotalCustomers'] = User::getTodayTotalCustomers();

        $data['LatestOrders'] = OrderModel::getLatestOrders();
        if (!empty($request->year)) {
            $year = $request->year;

        } else {
            $year = date('Y');

        }

        $getTotalCustomersMonth = '';
        $getTotalOrdersMonth = '';
        $getTotalAmountMonth = '';
        $totalAmount = 0;

        for ($month = 1; $month <= 12; $month++) {
            $startDate = new \DateTime("$year-$month-01");
            $endDate = new \DateTime("$year-$month-01");
            $endDate->modify('last day of this month');

            $start_date = $startDate->format('Y-m-d');
            $end_date = $endDate->format('Y-m-d');

            $customer = User::getTotalCustomersMonth($start_date, $end_date);
            $getTotalCustomersMonth .= $customer . ',';

            $order = OrderModel::getTotalOrdersMonth($start_date, $end_date);
            $getTotalOrdersMonth .= $order . ',';

            $orderAmount = OrderModel::getTotalAmountMonth($start_date, $end_date);
            $getTotalAmountMonth .= $orderAmount . ',';

            $totalAmount = $totalAmount + $orderAmount;

        }
        $data['getTotalCustomersMonth'] = rtrim($getTotalCustomersMonth, ",");
        $data['getTotalOrdersMonth'] = rtrim($getTotalOrdersMonth, ",");
        $data['getTotalAmountMonth'] = rtrim($getTotalAmountMonth, ",");
        $data['totalAmount'] = $totalAmount;

        $data['year'] = $year;

        $data['header_title'] = 'Dashboard';
        return view('admin.dashboard', $data);
    }
}
