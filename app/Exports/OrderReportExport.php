<?php

namespace App\Exports;

use App\Models\Order;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderReportExport implements FromCollection, WithHeadings
{
    protected $user_id;
    protected $from_date;
    protected $to_date;
    protected $payment_mode;
    protected $order_status_id;

    public function __construct($user_id, $from_date, $to_date, $payment_mode, $order_status_id)
    {
        $this->user_id          = $user_id;
        $this->from_date        = $from_date;
        $this->to_date          = $to_date;
        $this->payment_mode     = $payment_mode;
        $this->order_status_id  = $order_status_id;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Order::where('status', 3)
            ->when($this->user_id, function ($query) {
                $query->where('user_id', base64_decode($this->user_id));
            })
            ->when($this->from_date, function ($query) {
                $from_date = Carbon::createFromFormat('m/d/Y', $this->from_date)->format('Y-m-d');
                $query->where('created_at', '>=', $from_date . ' 00:00:00');
            })
            ->when($this->to_date, function ($query) {
                $to_date = Carbon::createFromFormat('m/d/Y', $this->to_date)->format('Y-m-d');
                $query->where('created_at', '<=', $to_date . ' 23:59:59');
            })
            ->when($this->payment_mode, function ($query) {
                $query->where('payment_id', base64_decode($this->payment_mode));
            })
            ->when($this->order_status_id, function ($query) {
                $query->where('order_status_id', $this->order_status_id);
            });

        $query->select('uid', 'created_at', 'user_id', 'sub_total', 'grand_total', 'payment_id', 'order_status_id');

        $orders = $query->latest()->get();

        return $orders->map(function ($order, $index) {
            return [
                $index + 1,
                $order->uid,
                $order->created_at->format('d/m/Y'),
                $order->user ? $order->user->name : 'No User Found!',
                $order->sub_total,
                $order->grand_total,
                $order->payment->title,
                $order->orderStatus ? $order->orderStatus->title : 'No Status Found!',
            ];
        });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'SN',
            'Order#',
            'Date',
            'User',
            'Subtotal',
            'Grand Total',
            'Payment Mode',
            'Order Status'
        ];
    }
}
