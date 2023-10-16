<?php

namespace Modules\Admin\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Exports\OrderReportExport;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Contracts\Support\Renderable;

class ReportController extends Controller
{
    /**
     * Display a listing of the order reports.
     * @return Renderable
     */
    public function orderReport(Request $request)
    {
        $query = Order::where('status', 3)
        ->when($request->filled('user_id'), function ($query) use ($request) {
            $query->where('user_id', base64_decode($request->input('user_id')));
        })
        ->when($request->filled('from_date'), function ($query) use ($request) {
            $from_date = Carbon::createFromFormat('m/d/Y', $request->input('from_date'))->format('Y-m-d');
            $query->where('created_at', '>=', $from_date . ' 00:00:00');
        })
        ->when($request->filled('to_date'), function ($query) use ($request) {
            $to_date = Carbon::createFromFormat('m/d/Y', $request->input('to_date'))->format('Y-m-d');
            $query->where('created_at', '<=', $to_date . ' 23:59:59');
        })
        ->when($request->filled('payment_mode'), function ($query) use ($request) {
            $query->where('payment_id', base64_decode($request->input('payment_mode')));
        })
        ->when($request->filled('order_status_id'), function ($query) use ($request) {
            $query->where('order_status_id', $request->input('order_status_id'));
        });

        $orders = $query->latest()->get();

        $users          = User::where('user_type','=','User')->get();
        $payment_methods          = Payment::active()->get();
        $order_statuses = OrderStatus::all();
        return view('admin::report.order_report',compact('orders', 'users', 'order_statuses', 'payment_methods'));
    }

    public function orderReportExport(Request $request)
    {
        $user_id            = $request->input('user_id', null);
        $from_date          = $request->input('from_date', null);
        $to_date            = $request->input('to_date', null);
        $payment_mode       = $request->input('payment_mode', null);
        $order_status_id    = $request->input('order_status_id', null);

        return Excel::download(new OrderReportExport($user_id, $from_date, $to_date, $payment_mode, $order_status_id), 'order-report.csv');
    }
}
