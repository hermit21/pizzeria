$(document).ready(function () {
   $("#register").prop("disabled", "disabled");
    $('input').on('blur keyup', function () {
       if($("#register_form").valid()) {
            $("#register").prop("disabled", false);
       }
      else {
           $("#register").prop("disabled", "disabled");
       }
    });

    jQuery.validator.addMethod("letters", function(value, element) {
        return this.optional(element) || /^[a-ząśćńłęóżźńA-ZĄŚŹŻĘÓŁ\s]+$/i.test(value);
    }, "Only alphabetical characters");


    $("#register_form").validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                maxlength: 15,
                letters: true
            },
            surname: {
                required: true,
                minlength: 3,
                maxlength: 20,
                letters: true
            },
            address: {
                required: true,
                minlength: 7,
                maxlength: 45,
                number: false
            },
            telephon_number: {
                required: true,
                minlength: 9,
                maxlength: 9,
                number: true
            },
            username: {
                required: true,
                minlength: 8,
                email: true
            },
            password: {
                required: true,
                minlength: 4
            },
            repeat_password: {
                required: true,
                minlength: 4,
                equalTo: "#password"
            }
        }
    });
});