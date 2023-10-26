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
                                <th>Actual Price(Per Unit)</th>
                                <th>Bid Price(Per Unit)</th>
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
                <div class="mobVew">
                    <div class="searchBx">
                        <form action="">
                            <div class="flxB">
                                <input type="text" class="form-control product-list-mob-search" name="mob_listing_search" id="mob_listing_search"
                                    placeholder="Search for Products">
                                <button type="button" class="product-list-mob-search-btn">
                                    <svg viewBox="0 0 19.993 20">
                                        <g id="layer1" transform="translate(0 0)">
                                            <path id="circle2017"
                                                d="M9.481,291.161a8.971,8.971,0,1,0,5.586,15.974l3.735,3.733a1,1,0,0,0,1.413-1.411l-3.735-3.735a8.957,8.957,0,0,0-7-14.561Zm0,1.993a6.978,6.978,0,1,1-6.974,6.974,6.958,6.958,0,0,1,6.974-6.974Z"
                                                transform="translate(-0.514 -291.161)" />
                                        </g>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="accordion productListMobDiv" id="Productaccordion">
                        @include('frontend::includes.product-list-mob')
                    </div>
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

            var productMobSearchDebounceTimer;
            $('.product-list-mob-search, .product-list-mob-search-btn').on('keypress keyup paste click', function() {
                clearTimeout(productSearchDebounceTimer);
                var search_value = $('.product-list-mob-search').val();

                productSearchDebounceTimer = setTimeout(function() {
                    $.ajax({
                        type: 'POST',
                        url: '/product-list-mob-search',
                        data: {
                            'search_value': search_value,
                        },
                        dataType: 'html',
                        success: function(response) {
                            if (response) {
                                $('.productListMobDiv').empty().html(response);
                            }
                        }
                    });
                }, 300);
            });
        });
    </script>
@endpush
