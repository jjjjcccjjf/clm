<!-- Main Dashboard -->
<article class="maincontent" id="page-content-wrapper">
  <div class="pagewrapper">
    <h1>Rewards Catalogue</h1>
    <ul class="catalogue">

      <?php foreach ($rewards as $key => $value): ?>

        <li>
          <article class="reward"
          <?php if ($value->is_grayed_out): ?>
            style="opacity:0.6"
          <?php endif; ?>
          >
          <div>
            <h3><?php echo number_format($value->cost) ?> Points
              <span><?php echo $value->winners . "/" . $value->total_winners_allowed; ?></span>
            </h3>
          </div>
          <a href="#rewards-details-<?php echo $value->id ?>" class="open-popup-link">
            <img src="<?php echo $value->image_url ?>">
          </a>
        </article>
      </li>
    <?php endforeach; ?>

  </ul>
</div>


</article>
<!-- End of Main Dashboard -->


<?php foreach ($rewards as $key => $value): ?>
  <!-- Inline Popup -->
  <div id="rewards-details-<?php echo $value->id ?>" class="white-popup mfp-hide rewards-det">
    <section class="rewards-details">
      <h3><?php echo $value->title ?></h3>
      <aside>
        <img src="<?php echo $value->image_url ?>">
      </aside>
      <article>
        <h4>Points Needed: <span><?php echo number_format($value->cost) ?> pts</span></h4>
        <h4>Winners: <span><?php echo $value->winners . "/" . $value->total_winners_allowed ?></span></h4>
        <h4>Description</h4>
        <p><?php echo $value->description ?></p>
        <?php if (!$value->is_grayed_out): ?>
          <h5><input type="checkbox" name=""><span><a href="#">Terms &amp; Conditions</a></span></h5>
          <input type="submit" name="" value="REDEEM">
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
});
</script>
