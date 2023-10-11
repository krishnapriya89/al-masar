@foreach ($billing_addresses as $billing_address)
    <div class="item" id="address-{{ $billing_address->id }}">
        <div class="adresBox">
            <input type="radio" id="add{{ base64_encode($billing_address->id) }}" name="billing_address"
                {{ $billing_address->is_default ? 'checked' : '' }}  data-id="{{ $billing_address->id }}" value="{{ $billing_address->id }}">
            <label for="add{{ base64_encode($billing_address->id) }}">
                <div class="topBFlx">
                    <div class="dfault">
                        <img src="{{ asset('frontend/images/dflt.svg') }}" alt="">
                    </div>
                    <div class="rtB">
                        <a href="javascript:void(0)" data-id="{{ $billing_address->id }}"
                            class="edit checkout-edit-billing-address">
                            <img src="{{ asset('frontend/images/edit.svg') }}" alt="">
                        </a>
                        <a href="javascript:void(0)" class="dlt address-delete-btn"
                            data-id="{{ $billing_address->id }}">
                            <img src="{{ asset('frontend/images/delete.svg') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="txtBx">
                    <div class="name">{{ $billing_address->full_name }}</div>
                    <div class="addres">{{ $billing_address->full_address }},
                        <br>{{ $billing_address->state->title }},
                        {{ $billing_address->country->title }}
                    </div>
                    <div class="tele">Mobile:
                        <span>{{ $billing_address->phone_number }}</span>
                    </div>
                    <div class="tele">Email:
                        <span>{{ $billing_address->email }}</span>
                    </div>
                </div>
            </label>
        </div>
    </div>
@endforeach
