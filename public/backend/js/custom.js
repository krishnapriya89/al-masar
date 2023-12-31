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

    //prevent the entry of non-floating or non-integer values
    $(".amountField").on("input", function (evt) {
        this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
    });
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

        var maxFileSize = 3 * 1024 * 1024; // 3MB in bytes
        var files = this.files;

        if (files.length > 0) {
            var fileSize = files[0].size;
            if (fileSize > maxFileSize) {
                // File size exceeds the limit, clear the file input
                toastr.error('File size exceeds the limit (3MB). Please choose a smaller file.');
                file_holder.empty();
                $(this).val('');
                return false;
            }
        }

        var reader = new FileReader();

        if (is_image) {
            reader.onload = function (e) {
                $("<img />", {
                    "src": e.target.result,
                    "class": 'thumb-image',
                    "height": '80',
                    "width":'200'
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
        //removing the already inserted previewing image
        console.log($(this).parent('div').parent('div').parent('div'));
        if($(this).parent('div').parent('div').parent('div').parent('div').find('.image-container-div').length > 0)
            $(this).parent('div').parent('div').parent('div').parent('div').find('.image-container-div').empty();
        else if($(this).parent('div').parent('div').parent('div').find('.image-container-div').length > 0)
            $(this).parent('div').parent('div').parent('div').find('.image-container-div').empty();
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
                    url: base_path + '/al-masar-admin-auth/delete-image',
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
