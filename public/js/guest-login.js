//add category ajaxSetup
function guestLogin(){
  var guest_username = $("#guest_username").val();
  var login_flag = $("#login_flag").val();

  if(guest_username==null || guest_username==''){
    $("#error-msg").text('please fill the category field.');
    setTimeout(function(){
      $("#error-msg").text('');
    }, 4000);
    return false;
  }
  $('#guest_login_button').prop('disabled', true);

  $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  $.ajax({
          url: 'login',
          type: "POST",
          data:{
              name:guest_username,
              login_flag : login_flag
          },
          success:function(response){
            if (response.status===1) {
              $('#success-msg').text(response.msg);
              setTimeout(function() {
                window.location.href = 'mcq-test';
              }, 5000);
            }else{
              $('#guest_login_button').prop('disabled', false);
              $("#error-msg").text(response.msg);
              setTimeout(function(){
                $("#error-msg").text('');
              }, 4000);
            }
          }
         });

}
