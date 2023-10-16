@extends('admin::layouts.app')
@section('title', 'Dashboard')
@push('css')
    <style>
        .status {
            padding: 3px 6px;
            min-height: 19px;
            width: fit-content;
            width: -moz-fit-content;
            margin: auto;
            display: flex;
            line-height: normal;
            font-size: 12px;
            font-weight: 500;
            color: #000
        }

        .clr1 {
            background: #ffd5d7;
        }

        .clr2 {
            background: #ceddff
        }

        .clr3 {
            background: rgba(104, 255, 195, .38)
        }

        .clr4 {
            background: #ffe7d6;
        }

        .clr5 {
            background: #ffe7d6;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $new_orders }}</h3>

                    <p>New Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('order.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $products }}</h3>

                    <p>Products</p>
                </div>
                <div class="icon">
                    <i class="ion ion-cube"></i>
                </div>
                <a href="{{ route('product.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $users }}</h3>

                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('user-management.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>$@formattedPrice($revenue)</h3>

                    <p>Revenue</p>
                </div>
                <div class="icon">
                    <i class="ion ion-cash"></i>
                </div>
                <a href="{{ route('order.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <section class="col-lg-8 connectedSortable">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Sales
                    </h3>
                </div>
                <div class="card-body">
                    <div class="tab-content p-0">
                        <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                            <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Latest Orders</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Order#</th>
                                    <th>Date</th>
                                    <th>User</th>
                                    <th>Subtotal</th>
                                    <th>Grand Total</th>
                                    <th>Payment Mode</th>
                                    <th>Order Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latest_orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->uid }}</td>
                                        <td>{{ date('d/m/Y', strtotime($order->created_at)) }}</td>
                                        <td>{{ $order->user ? $order->user->full_name : 'No User Found!' }}</td>
                                        <td>$@formattedPrice($order->bid_sub_total)</td>
                                        <td>$@formattedPrice($order->grand_total)</td>
                                        <td>
                                            {{ $order->payment->title }}
                                        </td>
                                        <td>
                                            <span class="status {{ $order->status_class }}">{{ $order->orderStatus->title }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('order.details', $order->uid) }}"
                                                class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top"
                                                data-original-title="Order Details">
                                                <i class="far fa-list-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No data found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    <a href="{{ route('order.index') }}" class="btn btn-sm btn-secondary float-right">View All Orders</a>
                </div>
            </div>
        </section>
        <section class="col-lg-4 connectedSortable">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Best Selling Products</h3>
                    <div class="card-tools">
                        <a href="{{ route('product.index') }}" class="btn btn-sm btn-secondary float-right">View All
                            Products</a>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Sales</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($best_selling_products as $best_selling_product)
                                    <tr>
                                        <td>
                                            <img src="{{ $best_selling_product->product->detail_page_image_value }}"
                                                alt="{{ $best_selling_product->product->title }}" class="rounded mr-2"
                                                width="40">
                                            {{ $best_selling_product->product->title }}
                                        </td>
                                        <td>$@formattedPrice($best_selling_product->product->price)</td>
                                        <td>
                                            {{ $best_selling_product->total_sales }} Sold
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No data found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="info-box mb-3 bg-warning">
                        <span class="info-box-icon"><i class="fab fa-dropbox"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">In Progress</span>
                            <span class="info-box-number">{{ $in_progress }}</span>
                        </div>
                    </div>
                    <div class="info-box mb-3 bg-success">
                        <span class="info-box-icon"><i class="fas fa-box"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Completed</span>
                            <span class="info-box-number">{{ $completed }}</span>
                        </div>
                    </div>
                    <div class="info-box mb-3 bg-danger">
                        <span class="info-box-icon"><i class="far fa-window-close"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Rejected</span>
                            <span class="info-box-number">{{ $rejected }}</span>
                        </div>
                    </div>
                    <div class="info-box mb-3 bg-info">
                        <span class="info-box-icon"><i class="fas fa-shopping-bag"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Orders</span>
                            <span class="info-box-number">{{ $total_orders }}</span>
                        </div>
                    </div>
                    <div class="info-box mb-3 bg-secondary">
                        <span class="info-box-icon"><i class="fas fa-ban"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Failed Orders</span>
                            <span class="info-box-number">{{ $failed_orders }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('js')
    <script>
        var sales_chart_label = {!! json_encode($sales_chart['labels']) !!};
        var sales_chart_data = {!! json_encode($sales_chart['data']) !!};
        console.log(sales_chart_data);
    </script>
    <script src="{{ asset('backend/js/pages/dashboard.js') }}"></script>
@endpush
