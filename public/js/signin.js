$.ajaxSetup({
    headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    headers: {  "Authorization": "Bearer " + $('meta[name="token"]').attr('content') }
});

var SweetAlert = Swal.mixin({
    customClass: {
        confirmButton: 'btn bg-dark text-white',
        cancelButton: 'btn btn-secondary ms-3'
    },
    buttonsStyling: false
});

$(document).on('submit', "#sign-in", function(e){
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: '/session',
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData:false,
        beforeSend:function(){
            SweetAlert.fire({
                position: 'center',
                icon: 'info',
                title: 'Signing In...',
                allowOutsideClick: true,
                showConfirmButton: false
            });
        },
        success: function(response)
        {
            if(response.Error == 1) {
                SweetAlert.close();
                $("#error").show(50);
                $("#error").text(response.Message);
            }
            if(response.Error == 0) {
                window.location.href="/dashboard";
            }
        }
    })
});

$(document).on("keyup", '#password', function(){

    var password = $("#password").val();
    var upperCase= new RegExp('[^A-Z]');
    var lowerCase= new RegExp('[^a-z]');
    var numbers = new RegExp('[^0-9]');

    if(password.length < 8) {
       $("#password-length").show(100);
       $("#password-length").text('Password must be at least 8 characters long. ');
    }
    else {
        $("#password-length").text('');
        $("#password-length").hide(100);
    }

    if(!$(this).val().match(upperCase) || !$(this).val().match(lowerCase) || !$(this).val().match(numbers))    
    {
        $("#password-validation").show(100);
        $("#password-validation").text("Password must have uppercase and lowercase letters or numbers. ");
    }
    else {
        $("#password-validation").text('');
        $("#password-validation").hide(100);
    }
    
});

$(document).on('submit', "#sign-up", function(e){
    e.preventDefault();
    var password_length = $("#password-length").text();
    var password_validation = $("#password-validation").text();

    if(password_length == '' && password_validation == '') {
        $.ajax({
            type: 'POST',
            url: '/register',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            beforeSend:function(){
                SweetAlert.fire({
                    position: 'center',
                    icon: 'info',
                    title: 'Signing Up...',
                    allowOutsideClick: true,
                    showConfirmButton: false
                });
            },
            success: function(response)
            {
                if(response.Error == 1) {
                    SweetAlert.close();
                    $("#error").show(50);
                    $("#error").text(response.Message);
                }
                if(response.Error == 0) {
                    window.location.href="/email/verify";
                }
            }
        })
    }
    else {
        SweetAlert.fire({
            icon: 'error',
            title: 'Error',
            text: password_length + password_validation,
            confirmButtonColor: "#3a57e8"
        })
    }
});

$(document).on('submit', "#change-password", function(e){
    e.preventDefault();
    var password_length = $("#password-length").text();
    var password_validation = $("#password-validation").text();

    if(password_length == '' && password_validation == '') {
        $.ajax({
            type: 'POST',
            url: '/reset-password',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            beforeSend:function(){
                SweetAlert.fire({
                    position: 'center',
                    icon: 'info',
                    title: 'Processing...',
                    allowOutsideClick: true,
                    showConfirmButton: false
                });
            },
            success: function(response)
            {
                if(response.Error == 1) {
                    SweetAlert.close();
                    $("#error").show(50);
                    $("#error").text(response.Message);
                }
                if(response.Error == 0) {
                    window.location.href="/login";
                }
            }
        })
    }
    else {
        SweetAlert.fire({
            icon: 'error',
            title: 'Error',
            text: password_length + password_validation,
            confirmButtonColor: "#3a57e8"
        })
    }
});