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
      <label for="tabone">Reset</label>
      <div class="tab">
        <form method="post">

          <ul>
            <li>
              <label>New password</label>
              <input type="password"
              name="new_password" placeholder="New password" required="required">
            </li>
            <li>
              <label>Confirm new password</label>
              <input type="password"
              name="confirm_new_password" placeholder="Confirm " required="required">
            </li>

            <li><input type="submit" name="" value="CHANGE PASSWORD"></li>
          </ul>
        </form>
      </div>



    </div>


  </article>

  <div class="bgleft"></div>
  <div class="bgright"></div>
  <script src="<?php echo base_url('public/front/') ?>js/custom/reset_password.js"></script>
  <script src="<?php echo base_url('public/admin/js/custom/') ?>generic.js"></script>

</body>
</html>
