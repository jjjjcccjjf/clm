<!-- Main Dashboard -->
<article class="maincontent" id="page-content-wrapper">
  <div class="projects-inner">

    <?php $this->load->view('front/partials/projects-pre', $project) ?>

    <div id="gallery" class="tabcontent gallery">
      <div class="main">
        <div class="slider slider-for">
          <?php if ($gallery): ?>
            <?php foreach ($gallery as $key => $value): ?>
              <div>
                <figure>
                  <img src="<?php echo $value->image_url ?>">
                </figure>
              </div>
            <?php endforeach; ?>
          </div> <!-- end slider for -->
          <div class="slider slider-nav">
            <?php foreach ($gallery as $key => $value): ?>
              <div>
                <figure>
                  <img src="<?php echo $value->image_url ?>">
                </figure>
              </div>
            <?php endforeach; ?>
          </div> <!-- end slider nav -->
        <?php else: ?>
          No images available yet
        <?php endif; ?>

      </div>
    </div>


  </article>
</section>

</div>


</article>
<!-- End of Main Dashboard -->

<script type="text/javascript">
$(document).ready(function(){
  $('.slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    fade: true,
    asNavFor: '.slider-nav',
  });
  $('.slider-nav').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    dots: true,
    focusOnSelect: true,
    arrows: false,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 871,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 351,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });


  $('.slider-for').on('.tabcontent.gallery', function (e) {
    $('.slider-for').resize();
  });

});
</script>
