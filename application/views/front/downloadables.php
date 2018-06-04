<article class="maincontent" id="page-content-wrapper">
  <div class="projects-inner">

    <?php $this->load->view('front/partials/projects-pre', $project) ?>

    <div id="download" class="tabcontent dwnld">
      <ul class="pad-0">

        <?php if ($downloadables): ?>

        <?php foreach ($downloadables as $key => $value): ?>
          <li>
            <a href="<?php echo $value->file_url ?>" download><?php echo $value->title ?></a>
          </li>
        <?php endforeach; ?>

      <?php else: ?>
        <li style="list-style-type:none">No downloadables available for this project</li>
      <?php endif; ?>
      </ul>
    </div>

  </article>
</section>

</div>


</article>
