<!-- jQuery 3 -->
<script src="/src/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/src/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/src/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/src/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/src/js/adminlte.min.js"></script>
<!-- Dashboard -->
<script src="/src/js/dashboard.js"></script>
<script>
  //Loading Dasboard
  $( window ).on( "load", function() {
      $(".loading-page").fadeOut(500);
  });
  //Fade out Flash Message
  window.setTimeout(function() {
    $('div.alert').not('.alert-important').delay(3000).fadeOut(800);
  });
</script>
