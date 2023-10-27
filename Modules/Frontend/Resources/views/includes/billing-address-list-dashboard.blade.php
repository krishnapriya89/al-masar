@forelse ($billing_addresses as $billing_address)
    <div class="item" id="address-{{ $billing_address->id }}">
        <div class="adresBox">
            <input type="radio" id="add{{ $billing_address->id }}"
                class="address-{{ $billing_address->id }} billing-address-radio-btn" name="address"
                {{ $billing_address->is_default ? 'checked' : '' }}>
            <label for="add{{ $billing_address->id }}">
                <div class="topBFlx">
                    <div class="setDefault billingAddress" data-id="{{ $billing_address->id }}"
                        data-type="{{ $billing_address->type }}">
                        @if ($billing_address->is_default)
                            <div class="dfault">
                                <img src="{{ asset('frontend/images/dflt.svg') }}" alt="">
                                <div class="txt">Default</div>
                            </div>
                        @else
                            <div class="txt">Set as Default</div>
                        @endif
                    </div>
                    <div class="rtB">
                        <a href="{{ route('edit-billing-address', encrypt($billing_address->id)) }}" class="edit">
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
                    <div class="addres">
                        {{ $billing_address->full_address }}<br>{{ $billing_address->state->title }},{{ $billing_address->country->title }}
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
@empty
    No address found..
@endforelse
