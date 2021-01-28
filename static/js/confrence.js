$(document).ready(function () {
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
            var data = $('#confrence_form').serialize();
            var url = "/google_login/update_confrence";
            NProgress.start();
            $.ajax(url, {
                data: data,
                success: alert("Data success"),
                error: alert("Error occured"),
                type: "POST"
            });
            NProgress.start();
            $('.loading_image').show();
            $('#confrence_form').prop('method', 'POST').ajaxSubmit(options);
            return false;
        }
    });
});
