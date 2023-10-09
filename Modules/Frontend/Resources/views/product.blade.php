@extends('frontend::layouts.app')
@section('title', 'Products')

@section('content')
    <div id="pageWrapper" class="DashBoard InnerPage">
        <section id="proListing">
            <div class="breadCrumb">
                <div class="container">
                    <ul>
                        <li>
                            <a href="{{ route('home') }}">Home </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">{{ $breadcrumb }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="all_products">
                    <div class="bdfgBx">
                        <div class="Stitle">{{ $page_title }}</div>
                    </div>
                </div>
                <div class="TableBx table-responsive DskTop">
                    <table class="listTable" id="productListTable">
                        <thead>
                            <tr>
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Specifications</th>
                                <th>Model Number</th>
                                <th>Required Quantity</th>
                                <th>Actual Price</th>
                                <th>Bid Price</th>
                                <th>Details</th>
                                <th>Add To Quote</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" name="product_code" placeholder="" value="{{ @$product_code}}"
                                        class="form-control product-list-search" autocomplete="off">
                                </td>
                                <td>
                                    <input type="text" name="product_name" placeholder="" value="{{ @$product_name}}"
                                        class="form-control product-list-search" autocomplete="off">
                                </td>
                                <td>

                                </td>
                                <td>
                                    <input type="text" name="model_number" placeholder="" value="{{ @$model_number}}"
                                        class="form-control product-list-search" autocomplete="off">
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @include('frontend::includes.product-list')
                        </tbody>
                    </table>
                    {{-- @if($products)
                        <ul class="pagination">
                            {{ $products->render() }}
                        </ul>
                    @endif --}}
                </div>
            </div>
        </section>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {

            var productSearchDebounceTimer;
            $('.product-list-search').on('keypress keyup paste', function() {
                clearTimeout(productSearchDebounceTimer);
                var product_code = $("input[name='product_code']").val();
                var product_name = $("input[name='product_name']").val();
                var model_number = $("input[name='model_number']").val();

                productSearchDebounceTimer = setTimeout(function() {
                    $.ajax({
                        type: 'POST',
                        url: '/product-list-search',
                        data: {
                            'product_code': product_code,
                            'product_name': product_name,
                            'model_number': model_number,
                        },
                        dataType: 'html',
                        success: function(response) {
                            if (response) {
                                $('#productListTable tbody tr:not(:first)').empty();
                                $('#productListTable tbody').append(response);
                            }
                        }
                    });
                }, 300);
            });
        });
    </script>
@endpush
