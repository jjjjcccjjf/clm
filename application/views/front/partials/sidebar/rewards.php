<div id="wrapper" class="active">

<!-- Sidebar -->
<aside id="sidebar-wrapper" class="sidebar">
  <a id="menu-toggle" class="togglebtn" href="#"><img src="<?php echo base_url('public/front/') ?>images/toggle.png"></a>
  <div class="sideprofile">

    <div class="logo">
      <img src="<?php echo base_url('public/front/') ?>images/clm-logo2.png"></div>


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
      <ul class="rewards">
        <li>
          <h6>Available Points</h6>
          <h4>3,100</h4>
        </li>
        <li>
          <a href="<?php echo "" ?>" class="active">Rewards Catalogue</a>
        </li>
        <li>
          <a href="#">Redeem History</a>
        </li>
      </ul>
    </div>
  </section>
</aside>
<!-- End of Sidebar -->
