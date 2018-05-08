<!-- Main Dashboard -->
<article class="maincontent" id="page-content-wrapper">
  <div class="pagewrapper">
    <h1>Projects
    </h1>
    <ul class="events">
      <?php if ($projects): ?>
        <!-- if there are events -->
        <?php foreach ($projects as $key => $value): ?>
          <li>
            <article class="reward">
              <!-- <div>
                <h3><?php echo $value->title ?></h3>
              </div> -->
              <a href="<?php echo base_url('dashboard/project-details/') . $value->id ?>">
                <img src="<?php echo $value->image_url ?>">
              </a>
            </article>
          </li>
        <?php endforeach; ?>
        <!-- /if there are events -->
      <?php else: ?>
        <li style="width:100%">
          <h3>No projects available</h3>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</article>
<!-- End of Main Dashboard -->


<script type="text/javascript">
$(document).ready(function() {
});
</script>
