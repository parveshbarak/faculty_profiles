
function onError() {
    alert('error');

}



var generic_success = function (data) {
    try {
        NProgress.done();
        $('.loading_image').hide();
        if (!data.success) {
            if (data.errorThrown) {
                throw_validation_error(data.errorThrown.validationError);
            } else {
                throw_error(data.errorTitle, data.errorMsg);
            }
        } else {
            throw_success(data.successTitle, data.successMsg, data.successPage);
        }
    } catch (e) {
        throw_error(e);
        NProgress.done();
        $('.loading_image').hide();
    }

}
function throw_success(success_title, success_msg, success_page) {
    Swal.fire({
        title: success_title,
        icon: 'success',
        html: success_msg,
        showCancelButton: false,
        focusConfirm: false,
        confirmButtonText: 'Okay',

    }).then((result) => {
        if (result.isConfirmed) {
            if (success_page) {
                window.location.href = success_page;
            }
        }
    });
}
function throw_error(error_title, error_msg, error_page) {
    Swal.fire({
        title: error_title,
        icon: 'error',
        html: error_msg,
        showCancelButton: false,
        focusConfirm: false,
        confirmButtonText: 'Okay',

    }).then((result) => {
        if (result.isConfirmed) {
            if (error_page) {
                window.location.href = error_page;
            }
        }
    });
}

function throw_alert(error_title, error_msg, error_page) {
    Swal.fire({
        title: error_title,
        icon: 'info',
        html: error_msg,
        showCancelButton: false,
        focusConfirm: false,
        confirmButtonText: 'Okay',

    }).then((result) => {
        if (result.isConfirmed) {
            if (error_page) {
                window.location.href = error_page;
            }
        }
    });
}


function throw_validation_error(validationError, form_id) {
    if (typeof form_id == 'undefined' || form_id == "") {
        form_id = "";
    } else {
        form_id = form_id + " ";
    }

    var errorIdArray = [];
    $.each(validationError, function (index, value) {
        if (index === "no_input") {
            $('.loading_image').hide();
            return true;
        }
        var label = $("<label>").text(value);
        if (index === "--ignore--") {

        } else {
            var id = $(form_id + "[name='" + index + "']").closest('input').attr('id');
            if (typeof id == 'undefined') {
                id = $(form_id + "[name='" + index + "']").closest('textarea').attr('id');
            }
            if (typeof id == 'undefined') {
                id = $(form_id + "[name='" + index + "']").closest('select').attr('id');
            }
        }

        if ($.inArray(id, errorIdArray) != -1) {
            return true;
        }

        errorIdArray.push(id);
        label.attr({class: 'help-block form-error', id: id + '-error', for : id});
        if (index === "--ignore--") {
        } else {
            if ($('#' + id + '-error').length) {
                $('#' + id + '-error').text(value);
                label = '#' + id;
            } else {
                if ($("#" + id).is(':radio')) {
                    var form_group = $("#" + id).parents('.form-group');
                    label.appendTo(form_group);
                } else {
                    label.insertAfter(form_id + "#" + id + "");
                }
            }
        }
        $(label).parent().addClass('has-error');
        $(label).parent().removeClass('has-success');
        $(label).closest('input').addClass('error');
        $(label).closest('input').removeClass('valid');
        $(label).parent().removeClass('has-success');
        $(label).closest('textarea').addClass('error');
        $(label).closest('textarea').removeClass('valid');
        $('.loading_image').hide();
    });
}