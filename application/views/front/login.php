<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Cebu Landmasters Masters Class - Seller Rewards Program</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo base_url('public/front/') ?>css/styles.css">
  <link rel="stylesheet" href="<?php echo base_url('public/front/') ?>css/responsive.css">
  <!-- if="" lt="" IE="" 9="">
  <script src="js/html5.js"></script>
  <![endif]-->
  <!-- css3-mediaqueries.js for IE less than 9 -->
  <!--[if lt IE 9]>
  <script src="js/css3-mediaqueries.js"></script>
  <![endif]-->

  <script type="text/javascript">
  const base_url = '<?php echo base_url(); ?>';
  </script>
</head>


<body>
  <aside class="main-logo">
    <img src="<?php echo base_url('public/front/') ?>images/clm-logo.png">
  </aside>
  <article class="loginreg">
    <div class="tabs">
      <input type="radio" name="tabs" id="tabone" checked="checked">
      <label for="tabone">Login</label>
      <div class="tab">
        <ul>
          <li>
            <form method="post">

              <label>Email Address</label>
              <input type="email" name="email">
            </li>
            <li>
              <label>Password</label>
              <input type="password" name="password">
            </li>
            <li><input type="submit" name="" value="LOGIN"></li>
          </form>
          <li><a href="<?php echo base_url('forgot-password')?>">Forgot your password?</a></li>
        </ul>

        <h6>GO TO <a href="https://www.cebulandmasters.com">www.cebulandmasters.com</a></h6>
      </div>

      <input type="radio" name="tabs" id="tabtwo">
      <label for="tabtwo" class="marg10">Register</label>
      <div class="tab tabreg">
        <section class="requirements">
          <h3>List of Requirements:</h3>
          <ol>
            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </li>
            <li>Vivamus iaculis nisl nec volutpat malesuada.</li>
            <li>Aliquam bibendum, nisi vitae tempus consectetur, </li>
            <li>Duis eu nisl ut mi pretium viverra. </li>
            <li>Maecenas pulvinar est ac volutpat tempus.</li>
          </ol>
          <h3>Instructions on how to pass requirements:</h3>
          <ol>
            <li>Phasellus vestibulum congue lectus pretium tincidunt. </li>
            <li>Quisque eu tortor posuere, ultrices ligula eget, elementum leo.</li>
            <li>Etiam luctus dictum velit sit amet rhoncus.</li>
          </ol>

        </section>
        <section class="application-btn">
          <a href="#">Download</a> or <a href="#">View</a> Application Form
        </section>
      </div>

    </div>


  </article>

  <div class="bgleft"></div>
  <div class="bgright"></div>
  <script src="<?php echo base_url('public/front/') ?>js/jquery-1.9.1.min.js"></script>
  <script src="<?php echo base_url('public/front/js/custom/') ?>login.js"></script>


</body>

</html>
