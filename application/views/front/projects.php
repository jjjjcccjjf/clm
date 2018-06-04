

<!-- Main Dashboard -->
<article class="maincontent" id="page-content-wrapper">
  <div class="projects">
    <h1>Projects</h1>

    <ul class="project-list">
      <?php if ($projects): ?>
        <?php foreach ($projects as $key => $value): ?>
          <li>
            <figure>
              <a href="<?php echo base_url('dashboard/latest-updates/') . $value->id ?>">
                <img src="<?php echo $value->image_url ?>">
              </a>
            </figure>
          </li>
        <?php endforeach; ?>
      <?php else: ?>
        <li style="width:100%">
          <h3>No projects available</h3>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</article>
<!-- End of Main Dashboard -->
