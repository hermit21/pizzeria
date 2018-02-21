$(document).ready(function () {
    $("#active_token").prop("disabled", "disabled");
    $('input').on('blur keyup', function () {
        if($("#activate_form").valid()) {
            $("#active_token").prop("disabled", false);
        }
        else {
            $("#active_token").prop("disabled", "disabled");
        }
    });

    $("#activate_form").validate({
        rules: {
            username: {
                required: true,
                minlength: 8,
                email: true
            },
            token: {
                required: true
            }
        }
    });
});