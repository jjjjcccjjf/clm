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

          <h6><?php echo $side_seller->master_class ?> CLASS</h6>
        </article>
        <ul>
          <li>
            <h6>MONTH TO DATE SALE</h6>
            <h4><?php echo formatPrice($m2d_sale) ?></h4>
            <h5><?php echo number_format($m2d_sale) ?></h5>
          </li>
          <li>
            <h6>YEAR TO DATE SALE</h6>
            <h4><?php echo formatPrice($y2d_sale) ?></h4>
            <h5><?php echo number_format($y2d_sale) ?></h5>
          </li>
          <li>
            <h6>POINTS RECEIVED</h6>
            <h4>3.1K</h4>
            <h5>3,100</h5>
          </li>
        </ul>
      </div>
    </section>
  </aside>
  <!-- End of Sidebar -->
