$(document).ready(function() {
  $("#change_password").on('submit', function(e){

    let p = $('input[name=new_password]').val()
    let cp = $('input[name=confirm_new_password]').val()

    if (!(p === cp)) {
      alert('Passwords don\'t match')
      return false
    } else {

      if(confirm("Are you sure you want to change the password?")){
        return true;
      } else {
        return false;
      }

    }

  });
});
