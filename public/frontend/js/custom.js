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
