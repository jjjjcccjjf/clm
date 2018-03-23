$(document).ready(function() {
  $('.edit-row').on('click', function(){

    $('form')[0].reset(); // reset the form
    const payload = $(this).data('payload');

    $('input[name=name]').val(payload.name);
    $('input[name=email]').val(payload.email);
    $('form').attr('action', base_url + 'admin/update/' + payload.id);
    $('.modal').modal();
  })

  $('form').on('submit', function(){

    let p = $('input[name=password]').val();
    let cp = $('input[name=confirm_password]').val();

    if (!(p === cp)) {
      alert('Passwords don\'t match');
      return false;
    }

  })

});
