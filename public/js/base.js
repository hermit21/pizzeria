$(document).ready(function() {
    $('#login').prop('disabled', 'disabled');
    $('input').on('blur keyup', function () {
        if ($("#myform").valid()) {
            $('#login').prop('disabled', false);
        } else {
            $('#login').prop('disabled', 'disabled');
        }
    });

    $("#myform").validate({
        rules: {
            username: {
                required: true,
                minlength: 4,
                email: true
                //number: true
            },
            password: {
                required: true,
                minlength: 4
            }
        }
    });
});



