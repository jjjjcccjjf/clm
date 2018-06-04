<h1><?php echo $title ?></h1>
<p><?php echo $address ?></p>

<section class="prjinner-hldr clearfix">
  <aside>
    <figure>
      <img src="<?php echo $image_url ?>">
    </figure>
    <article>
      <ul class="listn pad-0">
        <li>
          <h5>Total Land Area</h5>
          <p><?php echo $total_land_area ?></p>
        </li>
        <li>
          <h5>Phases</h5>
          <p><?php echo $phases ?></p>
        </li>
        <li>
          <h5>Status</h5>
          <p><?php echo $status ?></p>
        </li>
      </ul>
    </article>

  </aside>
  <article>
    <div class="tab">
      <a href="<?php echo base_url('dashboard/latest-updates/' . $id)  ?>"><button class="tablinks <?php echo $this->uri->segment(2) === 'latest-updates' ? 'active': ''; ?>">Latest Updates</button></a>
      <a href="<?php echo base_url('dashboard/gallery/' . $id)  ?>"><button class="tablinks <?php echo $this->uri->segment(2) === 'gallery' ? 'active': ''; ?>" >Gallery</button></a>
      <a href="<?php echo base_url('dashboard/downloadables/' . $id)  ?>"><button class="tablinks <?php echo $this->uri->segment(2) === 'downloadables' ? 'active': ''; ?>" >Downloadables</button></a>
    </div>
