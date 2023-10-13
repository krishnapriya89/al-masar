@forelse ($orders as $order)
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading{{ $loop->iteration }}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="false"
                aria-controls="collapse{{ $loop->iteration }}">
                <div class="item">{{ $order->uid }}</div>
                <div class="item">{{ $order->order_received_date }}</div>
                <div class="item">{{ $order->orderDetails->count() }}</div>
                <div class="item">{{ $order->priceWithSymbol($order->converted_grand_total) }}
                </div>
                <div class="item">
                    <div class="status {{ $order->status_class }}">
                        {{ $order->orderStatus->title }}</div>
                </div>
                <div class="item">
                    {{ $order->priceWithSymbol($order->converted_received_amount) }}</div>
                <div class="item">
                    {{ $order->priceWithSymbol($order->converted_amount_to_be_paid) }}</div>
                <div class="item">{{ $order->payment->title }}</div>
            </button>
        </h2>
        <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse "
            aria-labelledby="heading{{ $loop->iteration }}" data-bs-parent="#Quatationaccordion">
            <div class="accordion-body">
                <div class="title">Order ID: {{ $order->uid }}</div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <th>Product Name</th>
                            <th>Product Code</th>
                            <th>SKU</th>
                            <th>Specifications</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </thead>
                        <tbody>
                            @foreach ($order->orderDetails as $order_detail)
                                <tr>
                                    <td>{{ $order_detail->orderProduct->title }}</td>
                                    <td>{{ $order_detail->orderProduct->product_code }}</td>
                                    <td>{{ $order_detail->orderProduct->sku }}</td>
                                    <td>{{ $order_detail->orderProduct->specification }}</td>
                                    <td>{{ $order_detail->quantity }}</td>
                                    <td>{{ $order_detail->priceWithSymbol($order_detail->converted_product_total_bid_price) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@empty
    No Orders Found...
@endforelse
