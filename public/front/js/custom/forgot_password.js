$(document).ready(function() {
  $('form').on('submit', function (e) {
    e.preventDefault()

    let email = $('input[type="email"]').val()

    $("input[type=submit]").val('Please wait...');
    $("input[type=submit]").attr('disabled', 'disabled');

    $.ajax({
      url: base_url + '/dashboard/send_password_token',
      type: 'POST',
      data: { email: email },
      success: function (res, textStatus, xhr) {
        if (xhr.status === 200 && res.code === 'ok') {
          let thingToAppend = `
          <ul>
          <li> <label>Success. ${res.message}.</label> </li>
          <li><a href="${base_url}login">Already have an account? Login</a></li>
          </ul>
          `;
          appendToEl($(".tab"), thingToAppend);
        } else if (xhr.status === 200 && res.code === 'error') {

          $("input[type=submit]").val('RESET PASSWORD');
          $("input[type=submit]").removeAttr('disabled');

          alert(res.message);
        }
      },
      error: function (err) {
        console.error(err)
      }
    })

  })
});
