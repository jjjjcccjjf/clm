$(document).ready(function() {
  $("form").on('submit', function(e){

    let p = $('input[name=new_password]').val()
    let cp = $('input[name=confirm_new_password]').val()

    if (!(p === cp)) {
      alert('Passwords don\'t match')
      return false
    }
  });
});
