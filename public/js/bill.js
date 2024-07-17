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

$(document).on('keyup', '#kwh', function() {
    var kwh = $('#kwh').val();
    var rate = $('#rate').val();
    $("#bill").val(kwh * rate);
});
$(document).on('keyup', '#rate', function() {
    var kwh = $('#kwh').val();
    var rate = $('#rate').val();
    $("#bill").val(kwh * rate);
});

$(document).on('submit', "#create-bill", function(e){
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: '/create/bill',
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
            if(response.Error == 0) {
                SweetAlert.fire({
                    icon: 'success',
                    title: 'Done',
                    text: response.Message,
                    confirmButtonColor: "#3a57e8"
                }).then(function(){ 
                    location.reload();
                    });
            }
        }
    })
});

$(document).on('submit', "#update-bill", function(e){
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: '/update/bill',
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
            if(response.Error == 0) {
                SweetAlert.fire({
                    icon: 'success',
                    title: 'Done',
                    text: response.Message,
                    confirmButtonColor: "#3a57e8"
                }).then(function(){ 
                    location.reload();
                    });
            }
        }
    })
});

$(document).on("click", "#delete-bill", function(e){
    var id = $  (this).data('id');
    SweetAlert.fire({
        icon: 'warning',
        title: 'Are you sure?',
        text: "This will delete the bill permanently.",
        showCancelButton: true,
        confirmButtonColor: '#160e45',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'DELETE',
                url: '/delete/bill',
                data: {id},
                dataType: 'json',
                cache: false,
                headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                beforeSend:function(){
                    SweetAlert.fire({
                        position: 'center',
                        icon: 'info',
                        title: 'Deleting...',
                        showConfirmButton: false
                    })
                },
                success:function(response){
                    if(response.Error == 0) {
                        SweetAlert.fire({
                            icon: 'success',
                            title: 'Done',
                            text: response.Message,
                            confirmButtonColor: "#3a57e8"
                        }).then(function(){ 
                            location.reload();
                            });
                    }
                }
            });
        }
    })
});

$(document).on('submit', "#pay-bill", function(e){
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: '/pay/bill',
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
            if(response.Error == 0) {
                window.location.href = response.Path
            }
        }
    })
});

$(document).on("click", "#confirm-bill", function(e){
    var id = $  (this).data('id');
    SweetAlert.fire({
        icon: 'question',
        title: 'Are you sure?',
        text: "This will confirm the bill payment.",
        showCancelButton: true,
        confirmButtonColor: '#160e45',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Confirm!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: '/confirm/bill',
                data: {id},
                dataType: 'json',
                cache: false,
                headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                beforeSend:function(){
                    SweetAlert.fire({
                        position: 'center',
                        icon: 'info',
                        title: 'Processing...',
                        showConfirmButton: false
                    })
                },
                success:function(response){
                    if(response.Error == 0) {
                        SweetAlert.fire({
                            icon: 'success',
                            title: 'Done',
                            text: response.Message,
                            confirmButtonColor: "#3a57e8"
                        }).then(function(){ 
                            location.reload();
                            });
                    }
                }
            });
        }
    })
});