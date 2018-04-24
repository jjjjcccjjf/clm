<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Cebu Landmasters Masters Class - Seller Rewards Program</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo base_url('public/front/') ?>css/styles.css">
  <link rel="stylesheet" href="<?php echo base_url('public/front/') ?>css/responsive.css">
  <link rel="stylesheet" href="<?php echo base_url('public/front/') ?>css/slick.css"/>
  <link href="<?php echo base_url('public/front/') ?>css/vanillaCalendar.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url('public/front/') ?>css/jPushMenu.css">
  <link rel="stylesheet" href="<?php echo base_url('public/front/') ?>css/magnific-popup.css">

  <script src="<?php echo base_url('public/front/') ?>js/jquery-1.9.1.min.js"></script>

  <!-- if="" lt="" IE="" 9="">
  <script src="<?php echo base_url('public/front/') ?>js/html5.js"></script>
  <![endif]-->
  <!-- css3-mediaqueries.js for IE less than 9 -->
  <!--[if lt IE 9]>
  <script src="<?php echo base_url('public/front/') ?>js/css3-mediaqueries.js"></script>
  <![endif]-->
  <script type="text/javascript">
    const base_url = '<?php echo base_url(); ?>';
    const loader_gif = '<?php echo createLoader(['type' => 'gear']) ?>';
  </script>
</head>

<body>
  <header>
    <aside><a href="<?php echo base_url('dashboard') ?>"><img src="<?php echo base_url('public/front/') ?>images/clm-logo2.png"></a></aside>
    <nav class="main">
      <ul>
        <li class="<?php echo ($this->uri->segment(2) === 'account') ? 'active' : ''; ?>">
          <a href="<?php echo base_url('dashboard/account'); ?>">My Account</a></li>
        <li class="<?php echo ($this->uri->segment(2) === 'sales') ? 'active' : ''; ; ?>">
          <a href="<?php echo base_url('dashboard/sales'); ?>">Sales</a></li>
        <li class="<?php echo ($this->uri->segment(2) === 'rewards')? 'active' : ''; ; ?>">
          <a href="<?php echo base_url('dashboard/rewards'); ?>">Rewards</a></li>
        <li class="<?php echo ($this->uri->segment(2) === 'events')? 'active' : ''; ; ?>">
          <a href="<?php echo base_url('dashboard/events'); ?>">Events</a></li>
        <!-- <li class="<?php echo ($this->uri->segment(2) === 'projects')? 'active' : ''; ; ?>">
          <a href="<?php echo base_url('dashboard/projects'); ?>">Projects</a></li> -->
        <li class="<?php echo ($this->uri->segment(2) === 'about')? 'active' : ''; ; ?>">
          <a href="<?php echo base_url('dashboard/about'); ?>">About Us</a></li>
        <li><a href="<?php echo base_url('login/logout') ?>">Logout</a></li>
      </ul>
    </nav>
    <button class="toggle-menu menu-right menu">MENU</button>
    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right">
      <button class="toggle-menu menu-right">X CLOSE</button>
      <ul>
        <ul>
          <li class="<?php echo ($this->uri->segment(2) === 'account') ? 'active' : ''; ?>">
            <a href="<?php echo base_url('dashboard/account'); ?>">My Account</a></li>
          <li class="<?php echo ($this->uri->segment(2) === 'sales') ? 'active' : ''; ; ?>">
            <a href="<?php echo base_url('dashboard/sales'); ?>">Sales</a></li>
          <li class="<?php echo ($this->uri->segment(2) === 'rewards')? 'active' : ''; ; ?>">
            <a href="<?php echo base_url('dashboard/rewards'); ?>">Rewards</a></li>
          <li class="<?php echo ($this->uri->segment(2) === 'events')? 'active' : ''; ; ?>">
            <a href="<?php echo base_url('dashboard/events'); ?>">Events</a></li>
          <!-- <li class="<?php echo ($this->uri->segment(2) === 'projects')? 'active' : ''; ; ?>">
            <a href="<?php echo base_url('dashboard/projects'); ?>">Projects</a></li> -->
          <li class="<?php echo ($this->uri->segment(2) === 'about')? 'active' : ''; ; ?>">
            <a href="<?php echo base_url('dashboard/about'); ?>">About Us</a></li>
          <li><a href="<?php echo base_url('login/logout') ?>">Logout</a></li>
        </ul>

      </ul>
    </nav>
  </header>
