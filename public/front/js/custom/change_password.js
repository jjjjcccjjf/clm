$(document).ready(function() {
  $("#change_password").on('submit', function(e){

    let p = $('input[name=new_password]').val()
    let cp = $('input[name=confirm_new_password]').val()

    if (!(p === cp)) {
      alert('Passwords don\'t match')
      return false
    } else {

      if(confirm("Really change password?")){
        return true;
      } else {
        return false;
      }

    }

  });
});
