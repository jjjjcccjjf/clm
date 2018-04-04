</div>
<!-- sidebar end -->




<!-- Scripts -->

<!--load jPushMenu, required-->
<script src="js/jPushMenu.js"></script>

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
