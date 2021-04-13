
$(document).ready(function() {
    $(document).on('change', '#user-select', function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var user_id = this.value;
        $.ajax({
            type: 'POST',
            url: '/user/wallets',
            data: {user_id: user_id},
            error: function (data) {
                var errors = data.responseJSON;
                console.log(errors);
            },
            success: function (resp) {
                console.log(resp);
                if(resp == "User dont have wallet"){
                    $('.usser-wallet').empty();
                    $('.usser-wallet').append('<p>User dont have wallet</p>');
                }else if(resp == "no user"){
                    $('.usser-wallet').empty();
                    $('.usser-wallet').append('<p>No user</p>');
                }else{
                    $('.usser-wallet').empty();
                    $('.usser-wallet').append(resp) ;
                }
            }
        });
    });
});
