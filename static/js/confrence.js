$(document).ready(function () {
    $('#confrence_type, #confrence_place, #confrence_topic, #confrence_organised_by, #confrence_date_fm, #confrence_date_to').attr('autocomplete', 'none');
    $('#confrence_form').validate({
        onfocusout: function (element) {
            this.element(element);
        },
        rules: {
            confrence_type: {
                required: true
            },
            confrence_place: {
                user_name: true
            },
            confrence_topic: {
                required: true
            },
            confrence_organised_by: {
                required: true

            },
            confrence_date_fm: {
                required: true
            },
            confrence_date_to: {
                required: true
            }
        },
        errorPlacement: function (label, element) {
            label.insertAfter(element);
        },
        highlight: function (label) {
            $(label).closest(".form-group").addClass('has-error');
            $(label).closest(".form-group").removeClass('has-success');
            $(label).closest('input').addClass('error');
            $(label).closest('input').removeClass('valid');
        },
        success: function (label) {
            $(label).closest(".form-group").addClass('has-success');
            $(label).closest(".form-group").removeClass('has-error');
            $(label).closest('input').addClass('valid');
            $(label).closest('input').removeClass('error');
        },
        submitHandler: function () {
            var url = "/google_login/update_confrence";
            NProgress.start();
            var options = {
                url: url,
                success: generic_success,
                error: onError,
                type: "POST"
            };
            NProgress.start();
            $('.loading_image').show();
            $('#confrence_form').prop('method', 'POST').ajaxSubmit(options);
            return false;
        }
    });
});
