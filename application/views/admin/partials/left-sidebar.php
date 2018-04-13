
<section id="container" class="">
  <!--header start-->
  <header class="header white-bg">
    <div class="sidebar-toggle-box">
      <i class="fa fa-bars"></i>
    </div>
    <!--logo start-->
    <a href="index.html" class="logo" >Flat<span>lab</span></a>
    <!--logo end-->
    <div class="top-nav ">
      <ul class="nav pull-right top-menu">
        <li class="dropdown">
          <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <!-- <img alt="" src="img/avatar1_small.jpg"> -->
            <span class="username">Welcome back, <?php echo $this->session->userdata('name'); ?></span>
            <b class="caret"></b>
          </a>
          <ul class="dropdown-menu extended logout">
            <li><a href="<?php echo base_url('admin/login/logout') ?>"><i class="fa fa-key"></i> Log Out</a></li>
          </ul>
        </li>

      </ul>
    </div>
  </header>
  <!--header end-->
  <!--sidebar start-->
  <aside>
    <div id="sidebar"  class="nav-collapse ">
      <!-- sidebar menu start-->
      <ul class="sidebar-menu" id="nav-accordion">
        <li>
          <a href="<?php echo base_url('admin') ?>"
            class="<?php echo $this->uri->segment(1) === 'admin' && $this->uri->segment(2) === null ? 'active': ''; ?>">
            <i class="fa fa-dashboard"></i>
            <span>Admin Management</span>
          </a>
        </li>
        <li class="sub-menu">

          <a href="javascript:;" class="<?php echo (in_array($this->uri->segment(2), ['news', 'events', 'about']))  ? 'active': ''; ?>">
            <i class="fa fa-tasks"></i>
            <span>Portal Management</span>
          </a>
          <ul class="sub" >
            <li><a
              <?php echo $this->uri->segment(2) === 'news' ? 'style="color:#ff6c60"': ''; ?>
              href="<?php echo base_url('admin/news') ?>">News</a></li>
              <li><a
                <?php echo $this->uri->segment(2) === 'events' ? 'style="color:#ff6c60"': ''; ?>
                href="<?php echo base_url('admin/events') ?>">Events</a></li>
                <li><a
                  <?php echo $this->uri->segment(2) === 'about' ? 'style="color:#ff6c60"': ''; ?>
                  href="<?php echo base_url('admin/about') ?>">About</a></li>
                </ul>
              </li>
              <li>
                <a href="<?php echo base_url('admin/sellers')?>"
                  class="<?php echo in_array($this->uri->segment(2), ['sellers', 'sales']) ? 'active': ''; ?>">
                  <i class="fa fa-users"></i>
                  <span>Sellers</span>
                </a>
              </li>
              <li>
                <a href="<?php echo base_url('admin/sales-bulk-import')?>"
                  class="<?php echo $this->uri->segment(2) === 'sales-bulk-import' ? 'active': ''; ?>">
                  <i class="fa fa-plus-square"></i>
                  <span>Sales bulk import</span>
                </a>
              </li>
              <li>
                <a href="<?php echo base_url('admin/rewards')?>"
                  class="<?php echo $this->uri->segment(2) === 'rewards' ? 'active': ''; ?>">
                  <i class="fa fa-trophy"></i>
                  <span>Rewards</span>
                </a>
              </li>

            </ul>
            <!-- sidebar menu end-->
          </div>
        </aside>
        <!--sidebar end-->
