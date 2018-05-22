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
  <script src='https://www.google.com/recaptcha/api.js'></script>
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
            <form method="post" id="login_form">

              <label>Email Address</label>
              <input type="email" name="email" autofocus
              value="<?php echo $this->session->flash_email ?>"
              >
            </li>
            <li>
              <label>Password</label>
              <input type="password" name="password"
              value="<?php echo $this->session->flash_password ?>"
              >
            </li>
            <li><input type="submit" id="login_btn" name="" value="LOGIN"></li>
          </form>
          <li><a href="<?php echo base_url('forgot-password')?>">Forgot your password?</a></li>
        </ul>

        <h6>GO TO <a href="https://www.cebulandmasters.com">www.cebulandmasters.com</a></h6>
      </div>

      <input type="radio" name="tabs" id="tabtwo" >
      <label for="tabtwo" class="marg10">Register</label>
      <div class="tab tabreg">
        <section class="requirements">
          <h3>HOW TO REGISTER:</h3>
          <br>
          <h3>1. Must be a Cebu Landmasters Inc. (CLI) accredited broker or a registered seller agent.</h3>
          <br>
          <h3>2. Download, print and fill out the registration form then submit together with the
            requirements through one of the following:</h3>
            <ol>
              <li>
                Visit CLI office at the 10 th /F Park Centrale, Cebu IT Park and approach the Sales
                department.<br>
                Deliver via mail to CLI office and address to Sales department. <br>
                Scan/take a photo of registration form and requirements then email to
                <a style="color:gold" href="mailto:sales@cebulandmasters.com">sales@cebulandmasters.com</a>
              </li>
            </ol>
            <h3>*Requirements to be submitted along with the registration form are the following:</h3>
            <ol>
              <li>Photocopy of:<br>
                - PRC Certificate of Registration <br>
                - PRC Real Estate Broker ID <br>
                - HLURB Certificate of Registration <br>
                - Certificate of Registration of Business Name <br>
                - Mayor’s Permit
              </li>
              <li>1 Pc. 1x1 ID Picture <br>
                For brokers, list of agents with the following information: <br>
                - Name <br>
                - Tin <br>
                - PRC Reg. No. <br>
                - HLURB Reg. No. <br>
                - Home Address <br>
                - Contact numbers <br>
                - Email address</li>
              </ol>
              <h3>3. Approval of registration will take a month (30 days). Once approved, a CLI representative
                will contact and inform you to claim your membership card. Membership cards are
                upgradable.</h3>
                <ol>
                  <li>Membership Card Types: <br>
                    1. Classic Card – Up to `50 million pesos worth of sales <br>
                    2. Platinum Card – From 50 million to 100 million pesos worth of sales <br>
                    3. Diamond Card – From 100 million pesos and up worth of sales
                  </li>
                </ol>
                <h3>4. After approval, you may visit the Masters Class portal to keep track of your sales, check
                  available rewards programs, access project updates and materials, and company
                  announcements. For inquiries, you can email <a style="color:gold" href="mailto:sales@cebulandmasters.com">sales@cebulandmasters.com</a></h3><br>
                </section>
                <!-- <section class="application-btn" >
                <a href="#">Download</a> or <a href="#">View</a> Application Form
              </section> -->
            </div>

            <input type="radio" name="tabs" id="tabthree">
            <label for="tabthree">Accreditation Form</label>
            <div class="tab">
              <ul>
                <form method="post" id="accreditation_form">
                  <li>
                    <label>Accomplished Accreditation Form</label>
                    <input type="file" name="form_url" accept=".pdf" required>
                  </li>
                  <li>
                    <label>1x1 Photo</label>
                    <input type="file" name="image_url" accept=".jpg,.jpeg,.png" required>
                  </li>
                  <li>
                    <label>Full name</label>
                    <input type="text" name="full_name" required>
                  </li>
                  <li>
                    <div class="g-recaptcha" data-sitekey="6LeYl1oUAAAAABQG04b7zs3E8LeXNFtUMb1LSrLT"></div>
                  </li>
                  <li><input type="submit" id="acc_btn" name="" value="SUBMIT"></li>
                </form>
                <li><a href="<?php echo base_url()?>">Back to login</a></li>
              </ul>

              <h6>GO TO <a href="https://www.cebulandmasters.com">www.cebulandmasters.com</a></h6>
            </div>

          </div>


        </article>

        <div class="bgleft"></div>
        <div class="bgright"></div>
        <script src="<?php echo base_url('public/front/') ?>js/jquery-1.9.1.min.js"></script>
        <script src="<?php echo base_url('public/front/js/custom/') ?>login.js"></script>
        <script src="<?php echo base_url('public/front/js/custom/') ?>accreditation_form.js"></script>
        <?php echo $this->session->auto_login # auto login script from the reset password ?>
      </body>

      </html>
