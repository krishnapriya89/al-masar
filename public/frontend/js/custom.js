$(document).ready(function () {
    // CSRF token
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // Custom validation method for phone number
    $.validator.addMethod("phoneDigitsOnly", function (value, element) {
        var digitsOnly = /^\+?[0-9]{1,4}[-\s]?[0-9]{6,14}$/;
        return digitsOnly.test(value);
    }, "Please enter a valid phone number");

    jQuery.validator.addMethod("notEqual", function (value, element, param) {
        return this.optional(element) || value != $(param).val();
    }, "This has to be different from the phone number");

    //currency rate changing
    $('#currency_change').on('change', function () {
        currencyRateChange('change');
    });
    //change rate in every page load
    currencyRateChange('page_load');

    //resend otp button in register and login
    var otpDebounceTimer;
    $('.resend-otp-btn').on('click', function () {
        clearTimeout(otpDebounceTimer);

        otpDebounceTimer = setTimeout(function () {
            $.ajax({
                type: 'POST',
                url: '/resend-otp',
                dataType: 'json',
                success: function (response) {
                    if (response.status) {
                        if (response.message && response.message != '') {
                            toastr.success(response.message);
                        }
                        if (response.otp && response.otp != '') {
                            $('.otp-cls').html(response.otp);
                        }
                    }
                    else {
                        if (response.message && response.message != '') {
                            toastr.error(response.message);
                        }
                        if (response.url != '') {
                            window.location.href = response.url;
                        }
                    }
                }
            });
        }, 300);
    });

    //contact form validation
    $("#contactForm").validate({
        rules: {
            name: "required",
            phone: {
                required: true,
                phoneDigitsOnly: true
            },
            email: {
                required: true,
                email: true
            },
            message: "required",
            subject: "required",
        }
    });

    //button change quantity function in the product list showing the price
    var changeQuantityDebounceTimer;
    $('body').on("click", ".change-quantity", function () {
        var _this = $(this);

        var min_quantity_to_buy = _this.siblings('input[name="quantity"]').attr("min");
        var quantity = _this.siblings('input[name="quantity"]');
        var currentValue = parseInt(quantity.val());
        var operation = _this.data("operation");

        var quantityStatus = true;
        
        if (operation === "minus") {
            if (currentValue > min_quantity_to_buy) {
                quantity.val(currentValue - 1);
            }
            else {
                quantityStatus = false;
            }
        }

        if (operation === "plus") {
            quantity.val(currentValue + 1);
        }

        var quantityValue = parseInt(quantity.val());

        var product = _this.data("product");
        if (product && quantityValue && quantityStatus) {
            clearTimeout(changeQuantityDebounceTimer);
            calculatePrice(quantityValue, product, _this)
        }
    });

    //input change quantity function in the product list showing the price
    $('body').on('keyup paste', '.change-quantity-input', function() {
        var _this = $(this);

        var min_quantity_to_buy = parseInt(_this.attr("min"));
        var quantity = parseInt(_this.val());
        var product = _this.data("product");
        
        if(min_quantity_to_buy <= quantity) {
            clearTimeout(changeQuantityDebounceTimer);
            calculatePrice(quantity, product, _this);
        }
        else{
            toastr.error('Please enter the value greater than of min quantity');
            _this.val(min_quantity_to_buy);
        }
    });

    $('.list-add-to-quotation').on('click', function() {
        var _this = $(this);

        var quantity = _this.closest('tr').find("input[name='quantity'").val();
        var bid_price = _this.closest('tr').find("input[name='bid_price'").val();
        var product = _this.data('product');

        $.ajax({
            url: '/add-to-quotation',
            data: {
                quantity: quantity,
                product: product,
                bid_price: bid_price
            },
            type: "post",
            dataType: 'json',
            success: function (response) {
                if(response.status) {
                    _this.closest('tr').find('.product-total-price-div').text(response.price);
                }
            }
        });
    });
});

//check the currency data changes in drop down select and every page load
function currencyRateChange(type) {
    var code = '';
    code = $('#currency_change').val();
    $.ajax({
        url: "/change-currency/" + code,
        dataType: 'json',
        success: function (result) {
            if(type === 'change')
                location.reload();
        }
    });
}

//change quantity function in the product list showing the price
function calculatePrice(quantity, product, _this) {
    changeQuantityDebounceTimer = setTimeout(function () {
        $.ajax({
            url: '/calculate-price',
            data: {
                quantity: quantity,
                product: product,
            },
            type: "post",
            dataType: 'json',
            success: function (response) {
                if(response.status) {
                    _this.closest('tr').find('.product-total-price-div').text(response.price);
                }
            }
        });
    }, 300);
}
