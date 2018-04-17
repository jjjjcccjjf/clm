<div id="wrapper" class="active">
  <!-- Sidebar -->
  <aside id="sidebar-wrapper" class="sidebar">
    <a id="menu-toggle" class="togglebtn" href="#"><img src="<?php echo base_url('public/front/') ?>images/toggle.png"></a>
    <div class="sideprofile">

      <div class="logo">
        <a href="<?php echo base_url('dashboard') ?>">
        <img src="<?php echo base_url('public/front/') ?>images/clm-logo2.png">
      </a>
      </div>


      <section class="profile">
        <aside>
          <img src="<?php echo $side_seller->image_url ?>">
          <div><img src="<?php echo base_url('public/front/') ?>images/badge_<?php echo $side_seller->master_class ?>.png"></div>
        </aside>
        <article>
          <h3><?php echo $side_seller->full_name ?></h3>
          <h4>RANKED NO. <?php echo $side_seller->rank ?></h4>
          <h6><?php echo $side_seller->master_class ?> CLASS</h6>
        </article>

        <div class="calendar">
          <img src="<?php echo base_url('public/front/') ?>images/calendarimg.jpg">
        </div>
      </div>
    </section>
  </aside>
  <!-- End of Sidebar -->
