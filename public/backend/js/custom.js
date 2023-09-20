$(function () {
    // tooltip
    $('[data-toggle="tooltip"]').tooltip();
    // Toast
    var Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
    });
    // Custom File Input
    bsCustomFileInput.init();
    // CSRF token
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // select2
    if ($('.select2').length > 0) {
        $('.select2').select2({});
    }

    //select2 with image
    if ($('.select2-with-image').length > 0) {
        $(".select2-with-image").select2({
            templateResult: formatImage,
        });
    }

    function formatImage(opt) {
        if (!opt.id) {
            return opt.text.toUpperCase();
        }

        let image = $(opt.element).attr('data-img');

        if (!image) {
            return opt.text.toUpperCase();
        } else {
            let image_path = fc_path + image;
            var img_span = $(
                '<span><img src="' + image_path + '" width="80px" /> ' + opt.text.toUpperCase() + '</span>'
            );
            return img_span;
        }
    }
});
// Disable submit button during form submission
$("#submitBtn").on("click", function () {
    var button = $(this);
    var buttonBeforeText = button.text().toLowerCase();
    var buttonAfterText = "";

    switch (buttonBeforeText) {
        case "create":
            buttonAfterText = "Creating...";
            break;
        case "update":
            buttonAfterText = "Updating...";
            break;
        case "submit":
            buttonAfterText = "Submitting...";
            break;
        case "sign in":
            buttonAfterText = "Signing In...";
            break;
        default:
            buttonAfterText = "Processing...";
            break;
    }

    button.html('<i class="fa fa-spinner fa-spin"></i> ' + buttonAfterText);
    button.prop("disabled", true);
    button.closest("form").submit();
});
// Delete using SweetAlert2
$('body').on("click", ".delete-btn", function (event) {
    event.preventDefault();
    const deleteForm = $(this).closest("form");
    Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this item!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: primary_color,
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            deleteForm.submit();
        }
    });
});

// Data Table
function initializeDataTable(options) {
    $("#dataTable")
        .DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            paging: true,
            stateSave: true,
            lengthMenu: [10, 25, 50, 100],
            buttons: options.buttons, // Pass the buttons option
            "drawCallback": function (settings) {
                $('body .kv-toggle-btn').bootstrapToggle();
            },
        })
        .buttons()
        .container()
        .appendTo("#dataTable_wrapper .col-md-6:eq(0)");
}

// delete function of multiple images
function removeMultipleImages(instance, url) {
    var deleteButton = $(instance);
    var imageItem = deleteButton.closest(".image-item");
    var imagePath = deleteButton.data("image");
    var id = deleteButton.data("id");

    $.ajax({
        url: url,
        method: "POST",
        data: {
            image: imagePath,
            id: id,
        },
        success: function (response) {
            var success = response.success;
            var message = response.message;

            if (success) {
                if (message) {
                    imageItem.remove();
                    toastr.success(message);
                }
            } else {
                toastr.error(message);
            }
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
}

//image,video preview
$(".file-preview").on('change', function (event) {

    if (typeof (FileReader) != "undefined") {

        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/gif", "image/jpeg", "image/png", "image/jpg", "image/webp", "image/svg+xml"];
        var validVideoTypes = ["video/flv", "video/avi", "video/mov", "video/mpg", "video/wmv", "video/m4v", "video/3gp", "video/mp4"];
        let is_image = is_video = 1;
        if ($.inArray(fileType, validImageTypes) < 0) {
            is_image = 0;
        }

        if ($.inArray(fileType, validVideoTypes) < 0) {
            is_video = 0;
        }

        var file_holder = $(this).parent('div').find('.file-holder');
        file_holder.empty();

        var reader = new FileReader();

        if (is_image) {
            reader.onload = function (e) {
                $("<img />", {
                    "src": e.target.result,
                    "class": 'thumb-image',
                    "height": '80'
                }).appendTo(file_holder);
            }
        } else if (is_video) {
            reader.onload = function (e) {
                $("<video />", {
                    "src": e.target.result,
                    "class": '',
                    "height": '100',
                    "controls": '',
                    "preloads": 'none'
                }).appendTo(file_holder);
            }
        }

        file_holder.show();
        reader.readAsDataURL($(this)[0].files[0]);
    } else {
        alert("This browser does not support file preview.");
    }
});

//Delete Image
$(document).ready(function () {
    $('.deleteImg').on('click', function () {
        var _this = $(this);
        var model = $(this).data('model');
        var column = $(this).data('column');
        var id = $(this).data('id');

        Swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this item!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: primary_color,
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_path + '/dfd-admin-auth/delete-image',
                    type: "post",
                    data: {
                        id: id,
                        column: column,
                        model: model,
                    },
                    success: function (response) {
                        if (response) {
                            _this.closest('.image-container-div').remove();
                            toastr.success("Image Deleted Successfully!");

                        } else {
                            toastr.error("Error while deleting image");
                        }
                    }
                });
            }
        });

    });
});

$(".uniqueCheck").on('keypress keyup paste', function (e) {
    var _this = $(this);
    var model = _this.data('model');
    var column = _this.data('column');
    var id = _this.data('id');
    var parent_id = _this.data('parent-id');
    var value = _this.val();

    if (_this.val() != null && _this.val() != '' && _this.val() != undefined) {
        $.ajax({
            url: base_path + '/vt-admin-auth/unique-validation',
            type: "post",
            data: {
                column: column,
                model: model,
                id: id,
                parent_id: parent_id,
                value: value,
            },
            success: function (response) {
                _this.parent('div').find('.error-span').remove();
                _this.parent('div').find('.unique-error-span').remove();
                if (response) {
                    _this.parent('div').append('<span class="text-danger unique-error-span">This value already exist</span>');
                }
            }
        });
    } else {
        _this.parent('div').find('.error-span').remove();
        _this.parent('div').find('.unique-error-span').remove();
    }
});

//image extension and dimension validation
var _URL = window.URL || window.webkitURL;
$('.file-input-change').change(function () {
    var ext = $(this).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['jpg', 'jpeg', 'png', 'webp']) == -1) {
        $(this).parent('div').find('.error-span').remove();
        $(this).parent('div').find('.image-error-span').remove();
        $(this).parent('div').find('.image-dimension-error-span').remove();
        $(this).parent('div').append('<span class="text-danger image-error-span">The image field must be a file of type: jpg, jpeg, png, webp</span>');
    } else {
        var _this = $(this);
        var file = $(this)[0].files[0];

        var img = new Image();
        var img_width = img_height = 0;
        var maxwidth = $(this).data('width');
        var maxheight = $(this).data('height');

        img.src = _URL.createObjectURL(file);
        img.onload = function () {
            img_width = this.width;
            img_height = this.height;

            if (img_width != maxwidth || img_height != maxheight) {
                _this.parent('div').find('.image-error-span').remove();
                _this.parent('div').find('.image-dimension-error-span').remove();
                _this.parent('div').append('<span class="text-danger image-dimension-error-span">The image field has invalid image dimensions.</span>');
                _this.parent('div').find('.image-error-input').val('');
            } else {
                _this.parent('div').find('.image-error-span').remove();
                _this.parent('div').find('.image-dimension-error-span').remove();
                _this.parent('div').find('.image-error-input').val(1);
            }
        }
    }
});

$('.file-input').change(function () {
    var file = $('#data_sheet')[0].files[0].name;
    $(this).next('label').text(file);
});
