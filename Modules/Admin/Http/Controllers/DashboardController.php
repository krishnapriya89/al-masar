<?php
namespace Modules\Admin\Http\Controllers;
// use App\Models\Order;
// use App\Models\OrderDetail;
// use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Renderable;
class DashboardController extends Controller
{
    /**
     * Displays dashboard.
     *
     * @author Suchith
     */
    public function index()
    {
        // new orders
        $new_orders               = Order::where('order_status_id', 1)->count();
        // products
        $products                 = Product::count();
        // users
        $users                    = User::count();
        // revenue
        $revenue                  = Order::whereNotIn('order_status_id', [1, 5])
            ->where('payment_received_amount', '!=', 0)
            ->sum('grand_total');
        // sales
        $sales_chart              = $this->getSalesChart();
        $best_selling_products    = $this->getBestSellingProducts();
        $in_progress              = Order::where('order_status_id', 2)->count();
        $completed                = Order::where('order_status_id', 4)->count();
        $rejected                 = Order::where('order_status_id', 5)->count();
        $total_orders             = Order::where('order_status_id', '!=', 5)->count();
        $failed_orders            = Order::where('status', 4)
                                    ->where('payment_gateway_status', 2)
                                    ->count();
        // latest orders
        $latest_orders               = Order::whereNotIn('order_status_id', [1, 5])->latest()->limit(8)->get();
        return view('admin::dashboard', compact('new_orders', 'users', 'revenue', 'products', 'sales_chart', 'best_selling_products', 'in_progress', 'completed', 'rejected', 'total_orders', 'failed_orders', 'latest_orders'));
    }
    /**
     * sales chart
     *
     * @author Suchith
     */
    private function getSalesChart()
    {
        $labels = [];
        $months = 7;
        for ($i = $months; $i > 0; $i--) {
            $labels[] = Carbon::now()->subMonths($i)->format('F');
        }
        $currentMonth   = Carbon::now()->format('F');
        $labels[]       = $currentMonth;
        $data           = [];
        foreach ($labels as $month) {
            $monthNumber    = Carbon::parse("{$month} 1")->format('m');
            $orderCount     = Order::whereNotIn('order_status_id', [1, 5])
                ->whereMonth('created_at', $monthNumber)
                ->count();
            $data[] = $orderCount;
        }
        return compact('labels', 'data');
    }
    /**
     * best selling products
     *
     * @author Suchith
     */
    private function getBestSellingProducts($limit = 5)
    {
        $best_selling_products = OrderDetail::select('product_id', DB::raw('SUM(quantity) as total_sales'))
            ->groupBy('product_id')
            ->orderByDesc('total_sales')
            ->limit($limit)
            ->get();
        return $best_selling_products;
    }
}
