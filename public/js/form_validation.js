
$(document).ready(function(){

    $('#agency_affiliation').change(function() {
        if ($(this).val() === 'yes') {
          $('#agency_affiliation_details').removeClass('d-none').addClass('d-block');
        } else {
          $('#agency_affiliation_details').removeClass('d-block').addClass('d-none');
          $('#agency_affiliation_name').val('');
        }
    });

    $.validator.addMethod('validNumber', function(value, element) {
      value = $.trim(value);
      var contactNumberRegex = /^\d{11}$/;
      return this.optional(element) || contactNumberRegex.test(value);
    }, 'Please enter a valid number.');

    $.validator.addMethod('password_regex', function(value, element, reexp) {
      var regex = new RegExp(reexp);
      return this.optional(element) || regex.test(value);
    }, 'Invalid password pattern.');

    // client-side validation for coop
    $('#coopForm').validate({
        rules: {
            'authorized_representative' : {
                required: true,
                minlength: 3
            },
            'coop_name': {
                required: true,
                minlength:2
            },
            'address': {
                required: true,
                minlength: 3
            },
            'contact_number': {
                required: true,
                validNumber: true
            },
            'email': {
                required: true,
                email: true
            },
            'agency_affiliation': {
                required: true
            },
            'agency_affiliation_name': {
                required: {
                    depends: function() {
                        return $('#agency_affiliation').val() === 'yes';
                    }
                }
            },
            'username': {
                required: true,
                minlength: 3
            },
            'password': {
                required: true,
                minlength: 8,
                password_regex: '^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$'
            },
            'password_confirmation': {
                required: true,
                equalTo: '#password'
            },
        },
        errorPlacement: function(error, element) {
            error.appendTo(element.closest('.form-group').find('.error-container'));
        },
        highlight: function(element) {
            $(element).removeClass('is-valid').addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    //console.log('got thru');


    // client-side validation for merchant
    $('#merchant_form').validate({
        rules: {
            'name' : {
                required: true,
                minlength: 3
            },
            'address': {
                required: true,
                minlength: 3
            },
            'contact_number': {
                required: true,
                validNumber: true
            },
            'email': {
                required: true,
                email: true
            },
            'username': {
                required: true,
                minlength: 3
            },
            'password': {
                required: true,
                minlength: 8,
                password_regex: '^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$'
            },
            'password_confirmation': {
                required: true,
                equalTo: '#password'
            },
        },
        errorPlacement: function(error, element) {
            error.appendTo(element.closest('.form-group').find('.error-container'));
        },
        highlight: function(element) {
            $(element).removeClass('is-valid').addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        },
        submitHandler: function(form) {
            form.submit();
        }
    });


    $('#BuyerForm').validate({
        rules: {
            'authorized_representative' : {
                required: false,
                minlength: 3
            },
            'name': {
                required: true,
                minlength:2
            },
            'address': {
                required: true,
                minlength: 3
            },
            'contact_number': {
                required: true,
                validNumber: true
            },
            'email': {
                required: true,
                email: true
            },
            'username': {
                required: true,
                minlength: 3
            },
            'password': {
                required: true,
                minlength: 8,
                password_regex: '^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$'
            },
            'password_confirmation': {
                required: true,
                equalTo: '#password'
            },
        },
        errorPlacement: function(error, element) {
            error.appendTo(element.closest('.form-group').find('.error-container'));
        },
        highlight: function(element) {
            $(element).removeClass('is-valid').addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        },
        submitHandler: function(form) {
            form.submit();
        }
    });


});
