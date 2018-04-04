</div>
<!-- sidebar end -->




<!-- Scripts -->

<!--load jPushMenu, required-->
<script src="<?php echo base_url('public/front/') ?>js/jPushMenu.js"></script>
<script type="text/javascript" src="<?php echo base_url('public/front/') ?>js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('public/front/') ?>js/slick.min.js"></script>
<script src="<?php echo base_url('public/front/') ?>js/vanillaCalendar.js" type="text/javascript"></script>
<script src="<?php echo base_url('public/front/') ?>js/jquery.magnific-popup.min.js"></script>

<!--call jPushMenu, required-->
<script>
jQuery(document).ready(function($) {
  $('.toggle-menu').jPushMenu();
});
</script>

<script>
  $("#menu-toggle").click(function(e) {
  e.preventDefault();
  $("#wrapper").toggleClass("active");
  });
</script>




</body>

</html>
