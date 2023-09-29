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

    jQuery.validator.addMethod("notEqual", function(value, element, param) {
        return this.optional(element) || value != $(param).val();
       }, "This has to be different from the phone number");


    $('.resend-otp-btn').on('click', function() {
        $.ajax({
            type: 'POST',
            url: '/resend-otp',
            dataType: 'json',
            success: function (response) {
                if(response.status) {
                    if(response.message && response.message != '') {
                        toastr.success(response.message);
                    }
                    if(response.otp && response.otp != '') {
                        $('.otp-cls').html(response.otp);
                    }
                }
                else {
                    if(response.message && response.message != '') {
                        toastr.error(response.message);
                    }
                    if(response.url != '') {
                        window.location.href = response.url;
                    }
                }
            }
        });
    });

    $("#contactForm").validate({
        rules: {
            name: "required",
            phone:{
                required: true,
                phoneDigitsOnly: true
            },
            email: {
                required:true,
                email:true
            },
            message:"required",
            subject: "required",
        }
    });

});
