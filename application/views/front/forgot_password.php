<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Cebu Landmasters Masters Class - Seller Rewards Program</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo base_url('public/front/') ?>css/styles.css">
  <link rel="stylesheet" href="<?php echo base_url('public/front/') ?>css/responsive.css">
  <!-- if="" lt="" IE="" 9="">
  <script src="<?php echo base_url('public/front/') ?>js/html5.js"></script>
  <![endif]-->
  <!-- css3-mediaqueries.js for IE less than 9 -->
  <!--[if lt IE 9]>
  <script src="<?php echo base_url('public/front/') ?>js/css3-mediaqueries.js"></script>
  <![endif]-->
  <script type="text/javascript">
  const base_url = '<?php echo base_url(); ?>';
  </script>
  <script src="<?php echo base_url('public/front/') ?>js/jquery-1.9.1.min.js"></script>
  <script src="<?php echo base_url('public/admin/js/custom/') ?>generic.js"></script>
</head>


<body>
  <aside class="main-logo">
    <img src="<?php echo base_url('public/front/') ?>images/clm-logo.png">
  </aside>
  <article class="loginreg">
    <div class="tabs">
      <input type="radio" name="tabs" id="tabone" checked="checked">
      <label for="tabone">Forgot Password</label>
      <div class="tab">
        <form method="post">

          <ul>
            <li>
              <label>Email Address</label>
              <input type="email" name="email" required="required">
            </li>

            <li><input type="submit" name="" value="RESET PASSWORD"></li>
            <li><a href="<?php echo base_url('login'); ?>">Already have an account? Login</a></li>
          </ul>
        </form>

        <h6>GO TO <a href="https://www.cebulandmasters.com">www.cebulandmasters.com</a></h6>
      </div>



    </div>


  </article>

  <div class="bgleft"></div>
  <div class="bgright"></div>

</body>
<script type="text/javascript">
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
          <li><a href="<?php echo base_url('login'); ?>">Already have an account? Login</a></li>
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
</script>
</html>
