$(document).ready(function () {
    //dark theme
    $('.themeChange').on('click', function() {
        const currentTheme = $('body').hasClass('NightMode') ? 'light' : 'NightMode';
        $('body').toggleClass('NightMode');
        // Send an Ajax request to set the theme in the session
        $.ajax({
            url: '/set-theme',
            type: 'POST',
            data: { theme: currentTheme },
            success: function (response) {
            }
        });
    });

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

    //check the phone and number and office phone number not equal
    jQuery.validator.addMethod("notEqual", function (value, element, param) {
        return this.optional(element) || value != $(param).val();
    }, "This has to be different from the phone number");

    //check max file size is greater then of 2MB then return error
    $.validator.addMethod('maxFileSize', function (value, element, param) {
        var maxSize = param * 1024 * 1024; // Convert MB to bytes
        if(element.files.length > 0) {
            var fileSize = element.files[0].size;
            return fileSize <= maxSize;
        }
        else {
            return true;
        }
    }, 'File size must be less than {0} MB.');

    //prevent the entry of non-integer values
    $(".quantityField").on('keypress', function (e) {
        var key = e.keyCode;
        if (!((key >= 48 && key <= 57))) {
            e.preventDefault();
        }
    });

    //prevent the entry of non-floating or non-integer values
    $(".amountField").on("input", function (evt) {
        this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
    });

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

    //change quantity using button function in the product list showing the price
    var changeQuantityDebounceTimer;
    $('body').on("click", ".change-quantity", function () {
        var _this = $(this);
        var bid_price = null;

        var min_quantity_to_buy = _this.siblings('input[name="quantity"]').attr("min");
        var quantity = _this.siblings('input[name="quantity"]');
        var currentValue = parseInt(quantity.val());
        var operation = _this.data("operation");
        bid_price = _this.closest('tr').find('input[name="bid_price"]').val();

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
            calculatePrice(quantityValue, product, bid_price, _this);
        }
    });

    //change quantity using input field function in the product list showing the price
    $('body').on('focusout paste', '.change-quantity-input', function () {
        var _this = $(this);
        var bid_price = null;

        var min_quantity_to_buy = parseInt(_this.attr("min"));
        var quantity = parseInt(_this.val());
        var product = _this.data("product");
        bid_price = _this.closest('tr').find('input[name="bid_price"]').val();

        if (min_quantity_to_buy <= quantity) {
            clearTimeout(changeQuantityDebounceTimer);
            calculatePrice(quantity, product, bid_price, _this);
        }
        else {
            toastr.error('Please enter the value greater than of min quantity');
            _this.val(min_quantity_to_buy);
            calculatePrice(min_quantity_to_buy, product, bid_price, _this);
        }
    });

    //bid price in the product list showing the price
    $('body').on('keyup paste', '.bid-price', function () {
        var _this = $(this);
        var bid_price = null;

        var quantity = _this.closest('tr').find('input[name="quantity"]').val();
        var product = _this.data("product");
        bid_price = _this.val();

        if (bid_price && bid_price < 1) {
            toastr.error('Please enter the bid price value min 1');
            _this.val(1);
            clearTimeout(changeQuantityDebounceTimer);
            calculatePrice(quantity, product, 1, _this);
        }
        else {
            clearTimeout(changeQuantityDebounceTimer);
            calculatePrice(quantity, product, bid_price, _this);
        }
    });

    //change quantity using button in the product detail page showing the price
    $('body').on("click", ".change-quantity-detail-page", function () {
        var _this = $(this);
        var bid_price = null;

        var min_quantity_to_buy = _this.siblings('input[name="quantity"]').attr("min");
        var quantity = _this.siblings('input[name="quantity"]');
        var currentValue = parseInt(quantity.val());

        var operation = _this.data("operation");
        bid_price = $('input[name="bid_price"]').val();

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
            calculatePrice(quantityValue, product, bid_price, _this);
        }
    });

    //change quantity using input field function in the product detail showing the price
    $('body').on('focusout paste', '.change-quantity-input-detail-page', function () {
        var _this = $(this);
        var bid_price = null;

        var min_quantity_to_buy = parseInt(_this.attr("min"));
        var quantity = parseInt(_this.val());
        var product = _this.data("product");
        bid_price = $('input[name="bid_price"]').val();

        if (min_quantity_to_buy <= quantity) {
            clearTimeout(changeQuantityDebounceTimer);
            calculatePrice(quantity, product, bid_price, _this);
        }
        else {
            toastr.error('Please enter the value greater than of min quantity');
            _this.val(min_quantity_to_buy);
            calculatePrice(min_quantity_to_buy, product, bid_price, _this);
        }
    });

    //bid price in the product detail showing the price
    $('body').on('keyup paste', '.bid-price-detail-page', function () {
        var _this = $(this);
        var bid_price = null;

        var quantity = $('input[name="quantity"]').val();
        var product = _this.data("product");
        bid_price = _this.val();

        if (bid_price && bid_price < 1) {
            toastr.error('Please enter the bid price value min 1');
            _this.val(1);
            clearTimeout(changeQuantityDebounceTimer);
            calculatePrice(quantity, product, 1, _this);
        }
        else {
            clearTimeout(changeQuantityDebounceTimer);
            calculatePrice(quantity, product, bid_price, _this);
        }
    });

    //add to quote in product list
    $('body').on("click", ".list-add-to-quote", function () {
        var _this = $(this);

        var quantity = _this.closest('tr').find("input[name='quantity'").val();
        var bid_price = _this.closest('tr').find("input[name='bid_price'").val();
        var product = _this.data('product');

        $.ajax({
            url: '/add-to-quote',
            data: {
                quantity: quantity,
                slug: product,
                bid_price: bid_price
            },
            type: "post",
            dataType: 'json',
            success: function (response) {
                $('.quote-count').html(response.count);
                if (response.status) {
                    toastr.success(response.message);
                }
                else {
                    toastr.error(response.message);
                }
            }
        });
    });

    //add to quote in product detail page
    $('body').on("click", '.add-to-quote-product-detail', function () {
        var _this = $(this);

        var quantity = $('input[name="quantity"]').val();
        var product = _this.data("product");
        var bid_price = $('input[name="bid_price"]').val();

        $.ajax({
            url: '/add-to-quote',
            data: {
                quantity: quantity,
                slug: product,
                bid_price: bid_price
            },
            type: "post",
            dataType: 'json',
            success: function (response) {
                $('.quote-count').html(response.count);
                if (response.status) {
                    toastr.success(response.message);
                }
                else {
                    toastr.error(response.message);
                }
            }
        });
    });

    // change quote item count
    var quoteDebounceTimer;
    $('body').on("click", ".quote-update-quantity-btn", function () {
        clearTimeout(quoteDebounceTimer);
        var _this = $(this);

        var quote_id = _this
            .siblings('input[name="quantity"]')
            .data("quote-id");
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

        if (quote_id && quantityStatus) {
            updateQuoteQuantity(quantityValue, quote_id);
        }
    });

    $('body').on("focusout paste", ".quote-update-quantity-input", function () {
        clearTimeout(quoteDebounceTimer);
        var _this = $(this);

        var quote_id = _this.data("quote-id");
        var min_quantity_to_buy = _this.attr("min");
        var quantity = parseInt(_this.val());

        if (min_quantity_to_buy <= quantity) {
            updateQuoteQuantity(quantity, quote_id);
        }
        else {
            toastr.error('Please enter the value greater than of min quantity');
            _this.val(min_quantity_to_buy);
            updateQuoteQuantity(min_quantity_to_buy, quote_id);
        }
    });

    // Delete quote
    $('body').on("click", ".quote-delete-btn", function (e) {
        const quote_id = $(this).data("quote-id");
        const title = $(this).data("title");
        const uc_title = capitalizeWords(title);
        Swal.fire({
            title: `Remove ${uc_title}`,
            text: `Are you sure you want to remove ${title} from your quote?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "$success",
            cancelButtonColor: "$danger",
            cancelButtonText: "Cancel",
            confirmButtonText: "Remove",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/remove-from-quote",
                    type: "POST",
                    data: {
                        quote_id: quote_id,
                    },
                    success: function (response) {
                        if (response.status) {
                            $('.quote-count').html(response.count);
                            if (response.count > 0) {
                                $('.quote-tr-' + quote_id).remove();
                            }
                            else {
                                $('.empty-quote-div').removeClass('d-none');
                                $('.quote-div').addClass('d-none');
                            }
                            toastr.success(response.message);
                        } else
                            toastr.error(response.message);
                    },
                    error: function (xhr, status, error) {
                        toastr.error(`An error occurred while deleting the ${title}`);
                    },
                });
            }
        });
    });
});

// capitalize Words
function capitalizeWords(str) {
    return str.replace(/\b\w/g, (match) => match.toUpperCase());
}

//check the currency data changed in drop down select and every page load
function currencyRateChange(type) {
    var code = '';
    code = $('#currency_change').val();
    $.ajax({
        url: "/change-currency/" + code,
        dataType: 'json',
        success: function (result) {
            if (type === 'change')
                location.reload();
        }
    });
}
/**notify me */
$('.notify-me').on('click', function () {
    var data = $(this).data('id');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "post",
        url: "/notify-me",
        data: {
            product_slug: data
        },
        success: function (response) {
            if (response.status) {
                toastr.success(response.message);
            }
            else {
                toastr.error(response.message);
            }
        }
    });
});

//showing the bid price in both list and detail page
function calculatePrice(quantity, product, bid_price, _this) {

    changeQuantityDebounceTimer = setTimeout(function () {
        $.ajax({
            url: '/calculate-price',
            data: {
                quantity: quantity,
                product: product,
                bid_price: bid_price
            },
            type: "post",
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    //product list
                    if (_this.closest('tr').find('.product-total-price-div').length > 0)
                        _this.closest('tr').find('.product-total-price-div').text(response.price);
                    else {
                        //product detail page
                        if (bid_price != null && bid_price != '' && bid_price != undefined) {
                            $('.bid-payable-amount-div').removeClass('d-none');
                            $('.payable-amount-div').addClass('d-none');
                        } else {
                            $('.bid-payable-amount-div').addClass('d-none');
                            $('.payable-amount-div').removeClass('d-none');
                        }
                        $('.ProInfoSecWrp .product-total-price-div').text(response.price);
                    }
                }
            }
        });
    }, 300);
}

//update the quote quantity each button click and direct field change
function updateQuoteQuantity(quantity, quote_id) {
    quoteDebounceTimer = setTimeout(function () {
        $.ajax({
            url: '/update-quote',
            data: {
                quote_id: quote_id,
                quantity: quantity,
            },
            type: "post",
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    $('.product-price-' + quote_id).empty().html(response.product_total);
                } else
                    toastr.error(response.message);
            }
        });
    }, 300);
}
//update isDefault in billing and shipping address

$(".setDefault").click(function () {
    var _this = $(this);
    var id = $(this).data("id");
    var type = $(this).data("type");

    console.log($(this));

    $.ajax({
        type: "post",
        url: "/update-default",
        data: {
            id: id,
            type: type,
        },
        success: function (response) {
            console.log(response);
            if (response.status) {

                toastr.success(response.message);
                if (type == 1) {
                    $('.billingAddress').html(`
                    <div class="txt" >Set as Default</div>
                `);

                    $('.billing-address-radio-btn').prop('checked', false);
                    $('.address-' + id).prop('checked', true);
                    _this.closest('.billingAddress').html(`<div class="dfault">
                    <img src="frontend/images/dflt.svg" alt="">
                    <div class="txt">Default</div>
                </div>`);
                }
                if (type == 2) {
                    $('.shippingAddress').html(`
                    <div class="txt" >Set as Default</div>
                `);

                    $('.shipping-address-radio-btn').prop('checked', false);
                    $('.address-' + id).prop('checked', true);
                    _this.closest('.shippingAddress').html(`<div class="dfault">
                    <img src="frontend/images/dflt.svg" alt="">
                    <div class="txt">Default</div>
                </div>`);
                }

            }
            else {
                toastr.error(response.message);
            }
        }
    });
});

// delete address
$(document).on("click", ".address-delete-btn", function (e) {
    var address_id = $(this).data("id");


    Swal.fire({
        title: `Remove Address`,
        text: `Are you sure you want to remove this Address from your address book?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "$success",
        cancelButtonColor: "$danger",
        cancelButtonText: "Cancel",
        confirmButtonText: "Remove",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: base_path + "/address-destroy",
                type: "POST",
                data: {
                    id: address_id,
                },
                success: function (response) {
                    const { success, flag, message, defaultId } = response;
                    if (success) {
                        Swal.fire({
                            icon: "success",
                            title: message,
                            showConfirmButton: false,
                            timer: 3000,
                            willClose: function () {
                                if (flag === 1) {
                                    if (defaultId) {
                                        $("#address-" + address_id).remove();
                                        $(
                                            "#selectAddress" + defaultId
                                        ).prop("checked", true);
                                    } else {
                                        $("#address-" + address_id).remove();
                                    }
                                } else if (flag === 2) {
                                    location.reload();
                                }
                            },
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: message,
                            showConfirmButton: false,
                            timer: 3000,
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: `An error occurred while deleting the Address.`,
                        showConfirmButton: false,
                        timer: 3000,
                    });
                },
            });
        }
    });
});
//Change the button url according to the tab


$('.btnLink').click(function(){
    var currentURL = $(this).data('url');
    $('#addressBtn').attr('href', currentURL);
});
//search products
$('.main-search-input').on('keyup keypress paste', function(){
    var search_val = $(this).val();
    $.ajax({
        url : "/product-search",
        type : "GET",
        data : {
            keyword: search_val
        },
        dataType: 'html',
        success:function(response)
        {
           $('.focusBx .results').html(response);
        }
    });
});

//logout
$('.logout-form-btn').click(function() {
    $(this).prop('disabled', true);
    $('#LogoutFom').submit();
    $(this).prop('disabled', false);
});


