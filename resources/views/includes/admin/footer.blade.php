<div id="footer">
  <div class="wrapper">
    &copy; 2014 CertifiedComments.com. Unlawful duplication prohibited by Law.
  </div>
</div>
        
<!-- scripts  -->

<!-- jQuery 2.1.4 -->
<script type="text/javascript" src="{{ asset('/vendor/jquery/dist/jquery.min.js') }}"></script>
<!-- jQuery-UI 1.11.4 -->
<script type="text/javascript" src="{{ asset('/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 3.3.4  -->
<script type="text/javascript" src="{{ asset('/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- MomentJs -->
<script type="text/javascript" src="{{ asset('/vendor/momentjs/moment.js') }}"></script>
<!-- SlimScroll 1.3.6 -->
<script type="text/javascript" src="{{ asset('/vendor/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- SlimScroll 1.3.6 -->
<script type="text/javascript" src="{{ asset('/vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<!-- Handlebars  -->
<script type="text/javascript" src="{{ asset('/vendor/handlebars/handlebars.min.js') }}"></script>

<!-- AdminLTE App -->
<script type="text/javascript" src="{{ asset('/vendor/admin-lte/dist/js/app.min.js') }}"></script>

<!-- Paging -->
<script type="text/javascript" src="{{ asset('/vendor/paging/jquery.paging.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/vendor/jquery.easy-paging.js') }}"></script>

<!-- Tools -->
<script type="text/javascript" src="{{ asset('/js/tools.js') }}"></script>

<script type="text/javascript" src="{{ asset('/js/cc.dashboard.js') }}"></script>

<script>
  $(function() {
    //script for menu
    var liHref = $("[href='"+window.location.pathname+"']").parent();
    liHref.parent().parent().addClass('active');
    liHref.addClass('active');
  });
</script>
