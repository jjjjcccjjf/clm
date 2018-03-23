$(document).ready(function () {
  $('form').on('submit', function (e) {
    e.preventDefault()

    let email = $('input[type="text"]').val()
    let password = $('input[type="password"]').val()

    $.ajax({
      url: 'login/attempt/admin',
      type: 'POST',
      data: { email: email, password: password},
      success: function (res, textStatus, xhr) {
        if (xhr.status === 200 && res.code === 'ok') {
          window.location.href = 'dashboard';
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
