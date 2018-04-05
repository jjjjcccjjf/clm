$(document).ready(function () {
  $('form').on('submit', function (e) {
    e.preventDefault()

    $('input[type=submit]').attr('disabled', 'disabled');
    $('input[type=submit]').val('Trying to login...');

    let email = $('input[type="email"]').val()
    let password = $('input[type="password"]').val()

    $.ajax({
      url: base_url + 'admin/login/attempt/sellers',
      type: 'POST',
      data: { email: email, password: password},
      success: function (res, textStatus, xhr) {

        $('input[type=submit]').removeAttr('disabled');
        $('input[type=submit]').val('LOGIN');

        if (xhr.status === 200 && res.code === 'ok') {
          window.location.href = res.url;
        } else if (xhr.status === 200 && res.code === 'unauthorized') {
          alert(res.message);
        }
      },
      error: function (err) {
        console.error(err)
      }
    })

  })
})
