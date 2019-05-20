$(document).ready(function () {
  $('#login_form').on('submit', function (e) {
    e.preventDefault()

    $('#login_btn').attr('disabled', 'disabled');
    $('#login_btn').val('Trying to login...');

    let email = $('input[name="email"]').val()
    let password = $('input[type="password"]').val()

    $.ajax({
      url: base_url + 'admin/login/attempt/sellers',
      type: 'POST',
      data: { email: email, password: password},
      success: function (res, textStatus, xhr) {

        $('#login_btn').removeAttr('disabled');
        $('#login_btn').val('LOGIN');

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
