@extends('frontend::layouts.app')
@section('title', 'Quote')

@section('content')
    @if ($quotes->isNotEmpty())
        <div id="pageWrapper" class="DashBoard InnerPage quote-div">
            <section id="proListing">
                <div class="breadCrumb">
                    <div class="container">
                        <ul>
                            <li>
                                <a href="{{ route('home') }}">Home </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">Quote</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="container">
                    <div class="all_products">
                        <div class="bdfgBx">
                            <div class="Stitle">My Quote
                                <span>(<span class="quote-count">@checkQuote()</span> Items)</span>
                            </div>
                        </div>
                    </div>

                    <div class="TableBx table-responsive DskTop">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Specifications</th>
                                    <th>SKU</th>
                                    <th>Model Number</th>
                                    <th>Requested Quantity</th>
                                    <th>Bid Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quotes as $quote)
                                    <tr class="quote-tr-{{ $quote->id }}">
                                        <td>
                                            <div class="txt">{{ $quote->product->product_code }}</div>
                                        </td>
                                        <td>
                                            <div class="proFlx {{ $quote->product->stock_class }}">
                                                <div class="PimgB">
                                                    <img src="{{ $quote->product->listing_image_value }}"
                                                        alt="{{ $quote->product->title }}">
                                                </div>
                                                <a href="{{ route('product-detail', $quote->product->slug) }}"
                                                    target="_blank" class="name">{{ $quote->product->title }}</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="txt">{!! $quote->product->specification ?? '--' !!}</div>
                                        </td>
                                        <td>
                                            <div class="txt ">{{ $quote->product->sku }}</div>
                                        </td>
                                        <td>
                                            <div class="txt ">{{ $quote->product->model_number }}</div>
                                        </td>
                                        <td>
                                            <div class="txt ">
                                                <div class="quantity buttons_added">
                                                    <input type="button" value="-"
                                                        class="minus quote-update-quantity-btn" data-operation="minus">
                                                    <input type="number" step="1"
                                                        min="{{ $quote->product->min_quantity_to_buy }}" name="quantity"
                                                        value="{{ $quote->quantity }}" title="Qty"
                                                        class="input-text qty text quote-update-quantity-input quantityField"
                                                        size="4" pattern="" data-quote-id="{{ $quote->id }}"
                                                        inputmode="">
                                                    <input type="button" value="+"
                                                        class="plus quote-update-quantity-btn" data-operation="plus">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="tmns">@currencySymbolWithConvertedPrice($quote->bid_price)</div>
                                            <div class="txt">Total <span
                                                    class="product-price-{{ $quote->id }} tmns">@currencySymbolWithConvertedPrice($quote->product_total_price)</span>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="delete quote-delete-btn"
                                                data-quote-id="{{ $quote->id }}"
                                                data-title="{{ $quote->product->title }}">
                                                <img src="{{ asset('frontend/images/delete.svg') }}" alt="">
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button class="sbmt hoveranim DskTop" type="">
                        <span>Submit Quotation</span>
                    </button>

                    <div class="mobVew">
                        <div class="accordion" id="Productaccordion">
                            @foreach ($quotes as $quote)
                                <div class="accordion-item quote-tr-{{ $quote->id }}">
                                    <h2 class="accordion-header" id="heading{{ $loop->iteration }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="false"
                                            aria-controls="collapse{{ $loop->iteration }}">
                                            <div class="flxBx">
                                                <div class="ltBx">
                                                    <div class="icon">
                                                        <img src="{{ $quote->product->listing_image_value }}" alt="{{ $quote->product->title }}">
                                                    </div>
                                                    <div class="txtBx">
                                                        <div class="txt">Product Name</div>
                                                        <a href="{{ route('product-detail', $quote->product->slug) }}"
                                                            target="_blank" class="name">{{ $quote->product->title }}</a>
                                                    </div>
                                                </div>
                                                <div class="rtBx">
                                                    <div class="txt">Bid Price</div>
                                                    <div class="price"><span>{{ $quote->bid_price }}</span></div>
                                                </div>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse " aria-labelledby="heading{{ $loop->iteration }}"
                                        data-bs-parent="#Productaccordion">
                                        <div class="accordion-body">
                                            <div class="dBlock">
                                                <div class="flxBx">
                                                    <div class="ltbx">
                                                        <div class="lbl">Product Code</div>
                                                        <div class="txt">{{ $quote->product->product_code }}</div>
                                                    </div>
                                                    <div class="rtbx">
                                                        <div class="lbl">SKU</div>
                                                        <div class="txt">{{ $quote->product->sku }}</div>
                                                    </div>
                                                </div>
                                                <div class="flxBx">
                                                    <div class="ltbx">
                                                        <div class="lbl">Model No.</div>
                                                        <div class="txt">{{ $quote->product->model_number }}</div>
                                                    </div>
                                                    <div class="rtbx">
                                                        <div class="lbl">Required Qty</div>
                                                        <div class="quantity buttons_added">
                                                            <input type="button" value="-" class="minus quote-update-quantity-btn" data-operation="minus">
                                                            <input type="number" step="1" min="{{ $quote->product->min_quantity_to_buy }}"
                                                                name="quantity" value="{{ $quote->quantity }}"
                                                                title="Qty" class="input-text qty text quote-update-quantity-input quantityField" size="4"
                                                                pattern="" inputmode=""  data-quote-id="{{ $quote->id }}">
                                                            <input type="button" value="+" class="plus quote-update-quantity-btn" data-operation="plus">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flxBx">Total <span
                                                    class="product-price-{{ $quote->id }} tmns">@currencySymbolWithConvertedPrice($quote->product_total_price)</span>
                                                </div>
                                                <div class="spec">
                                                    <div class="ttle">Specifications</div>
                                                    <p>{{ $quote->product->specification ?? '--' }}</p>
                                                </div>
                                                <div class="btnBx">
                                                    <button type="button" class="dlte quote-delete-btn" data-quote-id="{{ $quote->id }}"
                                                        data-title="{{ $quote->product->title }}">
                                                        <svg viewBox="0 0 13.401 16.5">
                                                            <g id="delete_1_" data-name="delete (1)"
                                                                transform="translate(0.003 0.001)">
                                                                <path id="Path_102050" data-name="Path 102050"
                                                                    d="M222.784,154.7a.386.386,0,0,0-.386.386v7.3a.386.386,0,1,0,.773,0v-7.3A.386.386,0,0,0,222.784,154.7Zm0,0"
                                                                    transform="translate(-213.808 -148.727)" />
                                                                <path id="Path_102051" data-name="Path 102051"
                                                                    d="M104.784,154.7a.386.386,0,0,0-.386.386v7.3a.386.386,0,1,0,.773,0v-7.3A.386.386,0,0,0,104.784,154.7Zm0,0"
                                                                    transform="translate(-100.367 -148.727)" />
                                                                <path id="Path_102052" data-name="Path 102052"
                                                                    d="M1.094,4.911v9.52a2.132,2.132,0,0,0,.567,1.47,1.9,1.9,0,0,0,1.381.6h7.311a1.9,1.9,0,0,0,1.381-.6,2.132,2.132,0,0,0,.567-1.47V4.911a1.476,1.476,0,0,0-.379-2.9H9.943V1.525A1.518,1.518,0,0,0,8.413,0H4.981a1.518,1.518,0,0,0-1.53,1.526v.483H1.473a1.476,1.476,0,0,0-.379,2.9Zm9.258,10.815H3.042a1.224,1.224,0,0,1-1.175-1.294V4.945h9.66v9.486a1.224,1.224,0,0,1-1.175,1.294ZM4.224,1.525A.744.744,0,0,1,4.981.771H8.413a.744.744,0,0,1,.757.753v.483H4.224ZM1.473,2.781H11.921a.7.7,0,1,1,0,1.391H1.473a.7.7,0,1,1,0-1.391Zm0,0"
                                                                    transform="translate(0)" />
                                                                <path id="Path_102053" data-name="Path 102053"
                                                                    d="M163.784,154.7a.386.386,0,0,0-.386.386v7.3a.386.386,0,1,0,.773,0v-7.3A.386.386,0,0,0,163.784,154.7Zm0,0"
                                                                    transform="translate(-157.087 -148.727)" />
                                                            </g>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="btnBx">
                                <a href="javascript:void(0)" class="vdtails hoveranim"><span>Submit
                                    Quotation</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @else
        <div id="pageWrapper" class="orderInfoPage InnerPage empty-quote-div">
            <section id="infoB">
                <div class="container">
                    <div class="row">
                        <div class="allBx etyBx">
                            <div class="emptyBx">
                                <div class="icon">
                                    <img src="{{ asset('frontend/images/empty.svg') }}" alt="">
                                </div>
                                <div class="emptytitle">Your Quote is <span>Empty</span></div>
                                <div class="subT">Add items to get Started</div>
                                <a href="{{ route('product') }}" class="back hoveranim"><span>Back to Products</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @endif
    <div id="pageWrapper" class="orderInfoPage InnerPage empty-quote-div d-none">
        <section id="infoB">
            <div class="container">
                <div class="row">
                    <div class="allBx etyBx">
                        <div class="emptyBx">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/empty.svg') }}" alt="">
                            </div>
                            <div class="emptytitle">Your Quote is <span>Empty</span></div>
                            <div class="subT">Add items to get Started</div>
                            <a href="{{ route('product') }}" class="back hoveranim"><span>Back to Products</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
