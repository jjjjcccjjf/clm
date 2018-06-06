<article class="maincontent" id="page-content-wrapper">
  <div class="projects-inner">

    <?php $this->load->view('front/partials/projects-pre', $project) ?>

    <div id="updates" class="tabcontent updates">

      <?php if ($latest_updates): ?>

        <?php foreach ($latest_updates as $key => $value): ?>
          <ul class="pad-0 listn update-list">
            <h5><?php echo date_format(date_create($key),"F d, Y"); ?></h5>

            <?php $c = 0; foreach ($latest_updates[$key] as $u): ?>
              <li>
                <figure>

                  <a href="#<?php echo "event-{$key}-{$c}"?>" class="open-popup-link">
                    <img src="<?php echo $u->image_url ?>">
                  </a>
                </figure>
              </li>
            <?php endforeach; #end individual update arr ?>
          </ul>

          <?php $c++; endforeach; #end updatelist ?>
        <?php else: ?>
          No images available yet
        <?php endif; ?>

      </div>

    </article>
  </section>

</div>


</article>

<?php foreach ($latest_updates as $key => $value): ?>
  <?php $c = 0; foreach ($latest_updates[$key] as $u): ?>

    <!-- Inline Popup -->
    <div id="<?php echo "event-{$key}-{$c}"?>" class="white-popup mfp-hide">
      <section class="event-details">
        <img src="<?php echo $u->image_url ?>">
      </section>
    </div>

    <?php $c++; endforeach; #end updatelist ?>
  <?php endforeach; ?>


  <script type="text/javascript">
  $(document).ready(function() {

    $('.open-popup-link').magnificPopup({
      type:'inline',
      midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
    });

    $('select').on('change', function(){
      window.location.href = $(this).find('option:selected').data('redirect')
    })
  });
</script>
