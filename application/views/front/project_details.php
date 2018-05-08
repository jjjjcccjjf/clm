<!-- Main Dashboard -->
<article class="maincontent" id="page-content-wrapper">
  <div class="pagewrapper">
    <h1><?php echo $project->title ?> details</h1>
    <div class="video-container" >
      <img src="<?php echo $project->image_url ?>" alt="">

    </div>
    <article class="content-container" >
      <p><?php echo $project->description ?></p>
      <hr>
      <h1>Gallery</h1>
      <section class="dbleft">
        <article class="featured">
          <ul class="featured-news">
            <?php foreach ($gallery as $key => $value): ?>

              <li>
                <a href="#<?php echo "news-{$key}"?>" class="open-popup-link">
                  <img src="<?php echo $value->image_url ?>" alt="">
                </a>
              </li>

            <?php endforeach; ?>
          </ul>
        </article>
      </section>
      <hr>
      <h1>Downloadables</h1>
      <p>
        <ul>
          <?php foreach ($downloadables as $key => $value): ?>
            <li>
              <a href="<?php echo $value->file_url ?>">
                <?php echo $value->title ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </p>



    </article>
  </div>
</article>


<?php foreach ($gallery as $key => $value): ?>
  <!-- Inline Popup -->
  <div id="<?php echo "news-{$key}"?>" class="white-popup mfp-hide">
    <section class="event-details">
      <aside>
        <img src="<?php echo $value->image_url ?>">
      </aside>
    </section>
  </div>
<?php endforeach; ?>

<!-- End of Main Dashboard -->
<script src="<?php echo base_url('public/front/') ?>js/custom/event_panel.js"></script>
<!-- Responsive Slide -->
<script>
$(document).ready(function(){

  $('.open-popup-link').magnificPopup({
    type:'inline',
    midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
  });

  $('.featured-news').slick({
    autoplay: true,
    infinite: true,
    pauseOnHover: true,
    speed: 800,
    swipe: true,
    touchMove: true
  });
});
</script>
<!-- End of Responsive Slide -->
