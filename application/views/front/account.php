<style media="screen">
.optiony {
  color:black;
}
</style>

<!-- Main Dashboard -->
<article class="maincontent" id="page-content-wrapper">
  <div class="pagewrapper myaccount">
    <h1>My Account</h1>
    <section class="real-estate-record">
      <form class="" action="<?php echo base_url('dashboard/change_password') ?>" method="post" id="change_password">
        <h4>Change password
          <?php if ($flash_msg = $this->session->flash_msg): ?>

            <br>
            <sub style="color:<?php echo $flash_msg['color'] ?>;font-weight:bold">
              <?php echo $flash_msg['message']; ?></sub>
            <?php endif; ?>

          </h4>
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
            <input type="submit" name="" value="CHANGE PASSWORD">
          </ul>
        </form>
      </section>
      <section class="real-estate-record">
        <form class="" action="<?php echo base_url('dashboard/change_photo') ?>"
          method="post" id="change_photo"
          enctype="multipart/form-data"
          >
          <h4>Update display photo
            <?php if ($flash_msg = $this->session->flash_msg_photo): ?>

              <br>
              <sub style="color:<?php echo $flash_msg['color'] ?>;font-weight:bold">
                <?php echo $flash_msg['message']; ?></sub>
              <?php endif; ?>

            </h4>
            <ul>
              <li>
                <h6>Upload 1x1 photo <span>(.jpg &amp; .png only)</span></h6>
                <input type="file" name="image_url" id="file" required="required" accept=".jpg,.png,.jpeg">
              </li>
            </ul>
            <input
            style="margin-top: -10px; margin-bottom: 12px;"
            type="submit" name="" value="CHANGE DISPLAY PHOTO">
          </form>
        </section>
        <section class="personal-info">
          <h4>Personal Information</h4>
          <ul>
            <li>
              <label>Full Name</label>
              <input type="text"
              name="full_name" placeholder="Full name" required="required"
              value="<?php echo $seller->full_name ?>">
            </li>
            <li>
              <label>Birth Date</label>
              <input type="date" required="required"
              name="birth_date"
              value="<?php echo $seller->birth_date ?>">
            </li>
            <li>
              <label>Gender</label>
              <select name="gender">
                <option class="optiony">Male</option>
                <option class="optiony">Female</option>
              </select>
            </li>
            <li>
              <label>Civil Status</label>
              <select name="civil_status">
                <option class="optiony">Single</option>
                <option class="optiony">Married</option>
                <option class="optiony">Widowed</option>
              </select>
            </li>
            <li>
              <label>Home Address</label>
              <input type="text" placeholder="Home address" required="required"
              name="home_address" value="<?php echo $seller->home_address ?>">
            </li>
            <li>
              <label>Office Address</label>
              <input type="text" placeholder="Office address" required="required"
              name="office_address" value="<?php echo $seller->office_address ?>">
            </li>
          </ul>
        </section>
        <section class="contact-info">
          <h4>Contact Information</h4>
          <ul>
            <li>
              <label>Mobile</label>
              <input type="text" name="mobile_num" value="<?php echo $seller->mobile_num ?>"
              placeholder="Mobile" required="required">
            </li>
            <li>
              <label>Office / Fax</label>
              <input type="text" name="office_fax" value="<?php echo $seller->office_fax ?>"
              placeholder="Office / Fax">
            </li>
            <li>
              <label>Home</label>
              <input type="text" name="home_num" value="<?php echo $seller->home_num ?>"
              placeholder="Mobile">
            </li>
            <li>
              <label>Email Address</label>
              <input type="email" name="email" value="<?php echo $seller->email ?>"
              placeholder="Email" required="required">
            </li>
          </ul>
        </section>
        <section class="real-estate-record">
          <h4>Real Estate Record</h4>
          <h5>Are you a broker or an agent?</h5>
          <ul class="choice">
            <li>
              <label>
                <input type="radio" id="chk_broker" name="real_estate_record_type" value="Broker">
                Broker
              </label>
            </li>
            <li>
              <label>
                <input type="radio" id="chk_agent" name="real_estate_record_type" value="Agent">
                Agent
              </label>
            </li>
          </ul>
          <!-- Show if Broker is selected -->
          <aside id="real_estate_record_dynamic">
            <ul>
            </aside>
          </section>

          <input type="submit" name="" value="SUBMIT">
        </div>
      </article>
      <!-- End of Main Dashboard -->

      <!-- js stuffs for init -->

      <script type="text/javascript">
      var gender = "<?php echo $seller->gender; ?>";
      var civil_status = "<?php echo $seller->civil_status; ?>";
      var real_estate_record_type = "<?php echo $seller->real_estate_record_type; ?>";
      var json_payload = <?php echo $seller->real_estate_record_payload; ?>;
      </script>

      <script src="<?php echo base_url('public/front/') ?>js/custom/account_management.js"></script>
      <script src="<?php echo base_url('public/front/') ?>js/custom/change_password.js"></script>
      <script src="<?php echo base_url('public/front/') ?>js/custom/change_display_photo.js"></script>
