<!-- Main Dashboard -->
<article class="maincontent" id="page-content-wrapper">
  <section class="dbleft">
    <article class="featured">
      <ul class="featured-news">
        <?php foreach ($news as $key => $value): ?>

          <li>
            <a href="#<?php echo "news-{$key}"?>" class="open-popup-link">
              <img src="<?php echo $value->image_url ?>" alt="">
              <div class="caption">
                <h3><?php echo $value->title ?></h3>
                <p><?php echo $value->excerpt ?></p>
              </div>
            </a>
          </li>

        <?php endforeach; ?>
      </ul>
    </article>



    <aside class="events-calendar">
      <div class="calendar-container">
        <div id="v-cal">
          <div class="vcal-header">
            <button class="vcal-btn" data-calendar-toggle="previous">
              <svg height="24" version="1.1" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"></path>
              </svg>
            </button>

            <div class="vcal-header__label" data-calendar-label="month">
              March 2017
            </div>


            <button class="vcal-btn" data-calendar-toggle="next">
              <svg height="24" version="1.1" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                <path d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"></path>
              </svg>
            </button>
          </div>
          <div class="vcal-week">
            <span>Mon</span>
            <span>Tue</span>
            <span>Wed</span>
            <span>Thu</span>
            <span>Fri</span>
            <span>Sat</span>
            <span>Sun</span>
          </div>
          <div class="vcal-body" data-calendar-area="month"></div>
        </div>


      </div>
      <article class="events-list">
        <!-- initialized via js  -->
      </article>
    </aside>
  </section>

  <aside class="top-sellers">
    <h2>Top Sellers</h2>
    <ul>
      <?php $i = 1; foreach ($top_sellers as $key => $value):
        ?>
        <li>
          <figure>
            <img src="<?php echo $value["image_url"] ?>">
            <div><?php echo $i++; ?></div>
          </figure>
          <figcaption>
            <h4><?php echo $key ?></h4>
            <h5><?php echo $value["position"] ?></h5>
            <h5><?php echo $value["division"] ?></h5>
            <h6>Php <?php echo number_format($value["sales_amount"]) ?></h6>
          </figcaption>
        </li>
      <?php endforeach; ?>
    </ul>
  </aside>
</article>

<?php foreach ($news as $key => $value): ?>
  <!-- Inline Popup -->
  <div id="<?php echo "news-{$key}"?>" class="white-popup mfp-hide">
    <section class="event-details">
      <h3><?php echo $value->title ?></h3>
      <aside>
        <img src="<?php echo $value->image_url ?>">
      </aside>
      <article>
        <p><?php echo $value->description; ?></p>
      </article>
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

<!-- Vanilla Calendar -->
<script>
window.addEventListener('load', function () {
  vanillaCalendar.init({
    disablePastDays: true
  });
})
</script>
<!-- End of Vanilla Calendar -->
