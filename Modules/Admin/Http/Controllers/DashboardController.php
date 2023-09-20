<?php

namespace Modules\Admin\Http\Controllers;

// use App\Models\Order;
// use App\Models\OrderDetail;
// use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Displays dashboard.
     *
     * @author Sooryajith
     */
    public function index()
    {
        return view('admin::dashboard');

    }

  
}
