<div id="wrapper" class="active">

<!-- Sidebar -->
<aside id="sidebar-wrapper" class="sidebar">
  <a id="menu-toggle" class="togglebtn" href="#"><img src="<?php echo base_url('public/front/') ?>images/toggle.png"></a>
  <div class="sideprofile">

    <div class="logo">
      <a href="<?php echo base_url('dashboard') ?>">
      <img src="<?php echo base_url('public/front/') ?>images/clm-logo2.png">
    </a>
    <section class="profile">
      <aside>
        <img src="<?php echo $side_seller->image_url ?>">
        <div><img src="<?php echo base_url('public/front/') ?>images/badge_<?php echo $side_seller->master_class ?>.png"></div>
      </aside>
      <article>
        <h3><?php echo $side_seller->full_name ?></h3>
        <?php if ($side_seller->rank): ?>
          <h4>RANKED NO. <?php echo $side_seller->rank ?></h4>
        <?php endif; ?>
        <h6><?php echo $side_seller->master_class ?> CLASS</h6>
      </article>
      <ul class="rewards">
        <li>
          <h6>Available Points</h6>
          <h4><?php echo $available_points ?></h4>
        </li>
        <li>
          <a href="<?php echo base_url('dashboard/rewards') ?>"
            <?php if ($this->uri->segment(2) === 'rewards'): ?>
              class="active"
            <?php endif; ?>
            >Rewards Catalogue</a>
        </li>
        <li>
          <a href="<?php echo base_url('dashboard/redeem-history') ?>"
            <?php if ($this->uri->segment(2) === 'redeem-history'): ?>
              class="active"
            <?php endif; ?>
            >Redeem History</a>
        </li>
      </ul>
    </div>
  </section>
</aside>
<!-- End of Sidebar -->
