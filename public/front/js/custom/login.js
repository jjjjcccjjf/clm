$(document).ready(function () {
  $('form').on('submit', function (e) {
    e.preventDefault()

    let email = $('input[type="email"]').val()
    let password = $('input[type="password"]').val()

    $.ajax({
      url: base_url + 'admin/login/attempt/sellers',
      type: 'POST',
      data: { email: email, password: password},
      success: function (res, textStatus, xhr) {
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
