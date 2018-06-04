<article class="maincontent" id="page-content-wrapper">
  <div class="projects-inner">

    <?php $this->load->view('front/partials/projects-pre', $project) ?>

    <div id="updates" class="tabcontent updates">

      <?php foreach ($latest_updates as $key => $value): ?>
        <ul class="pad-0 listn update-list">
          <h5><?php echo date_format(date_create($key),"F d, Y"); ?></h5>

          <?php foreach ($latest_updates[$key] as $u): ?>
            <li>
              <figure>
                <a href="<?php echo $u->image_url ?>" target="_blank">
                  <img src="<?php echo $u->image_url ?>">
                </a>
              </figure>
            </li>
          <?php endforeach; #end individual update arr ?>
        </ul>

      <?php endforeach; #end updatelist ?>

    </div>

  </article>
</section>

</div>


</article>
