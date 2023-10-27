@forelse ($shipping_addresses as $shipping_address)
    <div class="item" id="address-{{ $shipping_address->id }}">
        <div class="adresBox">
            <input type="radio" id="shipping-add{{ $shipping_address->id }}"
                class="shipping-address-{{ $shipping_address->id }} shipping-address-radio-btn" name="shipping-address"
                {{ $shipping_address->is_default ? 'checked' : '' }}>
            <label for="add{{ $shipping_address->id }}">
                <div class="topBFlx">
                    <div class="setDefault shippingAddress" data-id="{{ $shipping_address->id }}"
                        data-type="{{ $shipping_address->type }}">
                        @if ($shipping_address->is_default)
                            <div class="dfault">
                                <img src="{{ asset('frontend/images/dflt.svg') }}" alt="">
                                <div class="txt">Default</div>
                            </div>
                        @else
                            <div class="txt">Set as Default</div>
                        @endif
                    </div>
                    <div class="rtB">
                        <a href="{{ route('edit-shipping-address', encrypt($shipping_address->id)) }}" class="edit">
                            <img src="{{ asset('frontend/images/edit.svg') }}" alt="">
                        </a>
                        <a href="javascript:void(0)" class="dlt address-delete-btn"
                            data-id="{{ $shipping_address->id }}">
                            <img src="{{ asset('frontend/images/delete.svg') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="txtBx">
                    <div class="name">{{ $shipping_address->full_name }}
                    </div>
                    <div class="addres">
                        {{ $shipping_address->full_address }}<br>{{ $shipping_address->state->title }},{{ $shipping_address->country->title }}
                    </div>
                    <div class="tele">Mobile:
                        <span>{{ $shipping_address->phone_number }}</span>
                    </div>
                    <div class="tele">Email:
                        <span>{{ $shipping_address->email }}</span>
                    </div>
                </div>
            </label>
        </div>
    </div>
@empty
    No address found..
@endforelse
