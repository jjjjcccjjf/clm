<!-- Main Dashboard -->
<article class="maincontent" id="page-content-wrapper">
  <div class="pagewrapper">
    <h1>Events
      <span>
        <select>
          <?php
          foreach ($month_year as $key => $value) {
            echo $value; # The options
          }
          ?>
        </select>
      </span>
    </h1>
    <ul class="events">
      <?php if ($events): ?>
        <!-- if there are events -->
        <?php foreach ($events as $key => $value): ?>
          <li>
            <article class="reward">
              <div><?php echo $value->date_f ?>
                <h3><?php echo $value->title ?></h3>
              </div>
              <a href="#<?php echo "event-{$key}"?>" class="open-popup-link">
                <img src="<?php echo $value->image_url ?>">
              </a>
            </article>
          </li>
        <?php endforeach; ?>
        <!-- /if there are events -->
      <?php else: ?>
        <li style="width:100%">
          <h3>No available events at this current month</h3>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</article>
<!-- End of Main Dashboard -->

<?php foreach ($events as $key => $value): ?>

  <!-- Inline Popup -->
  <div id="<?php echo "event-{$key}"?>" class="white-popup mfp-hide">
    <section class="event-details">
      <h3><?php echo $value->title ?></h3>
      <aside>
        <img src="<?php echo $value->image_url ?>">
      </aside>
      <article>
        <h4>Date: <span><?php echo $value->date_f; ?></span></h4>
        <p><?php echo $value->description; ?></p>
        <?php if ($value->read_more_url && $value->read_more_label): ?>
          <h5><span><a href="<?php echo $value->read_more_url ?>"><?php echo $value->read_more_label?></a></span></h5>
        <?php endif; ?>
      </article>
    </section>
  </div>
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
