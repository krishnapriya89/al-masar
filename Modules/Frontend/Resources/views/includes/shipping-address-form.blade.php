<form action="{{ route('store-shipping-address') }}" id="ShippingForm" method="post">
    @csrf
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" id="shipping_first_name" value="{{ @$address->first_name }}" class="form-control" placeholder="First Name*" name="first_name">
            </div>
            @error('first_name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" id="shipping_last_name" value="{{ @$address->last_name }}" class="form-control" placeholder="Last Name*" name="last_name">
            </div>
            @error('last_name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <input type="text" id="shipping_address_one" value="{{ @$address->address_one }}" class="form-control" placeholder="Address Line*"
                    name="address_one">
            </div>
            @error('address_one')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <input type="text" id="shipping_address_two" value="{{ @$address->address_two }}" class="form-control" placeholder="Address Line Two"
                    name="address_two">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <input type="email" id="shipping_email" value="{{ @$address->email }}" class="form-control" placeholder="Email*" name="email">
            </div>
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" id="shipping_phone_number" value="{{ @$address->phone_number }}" class="form-control" placeholder="Phone Number*"
                    name="phone_number">
            </div>
            @error('phone_number')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" id="shipping_city" value="{{ @$address->city }}" class="form-control" placeholder="City*" name="city">
            </div>
            @error('city')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <select class="select shipping-country" data-select2-id="select2-Due1"
                    aria-label="Default select example" name="country" id="shipping_country">
                    <option selected value="" disabled>Country*</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}" @selected(@$address->country_id == $country->id)>
                            {{ $country->title }}</option>
                    @endforeach
                </select>
            </div>
            @error('country')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" id="shipping_zip_code" value="{{ @$address->zip_code }}" class="form-control" placeholder="Zip Code*" name="zip_code">
            </div>
            @error('zip_code')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <select class="select shipping_state" data-select2-id="select2-Due2" aria-label="Default select example"
                    name="state" id="shipping_state">
                    <option selected value="" disabled>State*</option>
                    @if(@$address && $address->country)
                        @foreach ($address->country->states as $state)
                            <option value="{{ $state->id }}" @selected(@$address->state_id == $state->id)>
                            {{ $state->title }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            @error('state')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <input type="hidden" value="2" name="type" id="type">
    <button type="button" class="btn-submit hoveranim shipping-address-submit">
        <span>Save address</span>
    </button>
</form>
