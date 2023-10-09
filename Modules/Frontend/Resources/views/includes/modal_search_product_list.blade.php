
        @if(@$searched_products)
        @foreach($searched_products as $searched_product)
        <li>
            <a href="{{ route('product-detail', @$searched_product->slug) }}" class="flxBx">
                <div class="imgBx">
                    <img src="{{ @$searched_product->listing_image_value }}" alt="">
                </div>
                <div class="txtBx">
                    <div class="name">{{ @$searched_product->title }}</div>
                </div>
            </a>
        </li>
        @endforeach
        @else
        <li>No Product Found</li>
        @endif




