        <div id="footer">
            <div class="wrapper">
            &copy; 2014 CertifiedComments.com. Unlawful duplication prohibited by Law.
            </div>
        </div>
  <!-- scripts  -->
 
    <!-- jQuery 2.1.4 -->
    <script type="text/javascript" src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
    <!-- jQuery-UI 1.11.4 -->
    <script type="text/javascript" src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Bootstrap 3.3.4  -->
    <script type="text/javascript" src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- MomentJs -->
    <script type="text/javascript" src="{{ asset('vendor/momentjs/moment.js') }}"></script>
    <!-- SlimScroll 1.3.6 -->
    <script type="text/javascript" src="{{ asset('vendor/slimScroll/jquery.slimscroll.min.js') }}"></script>
     <!-- SlimScroll 1.3.6 -->
    <script type="text/javascript" src="{{ asset('vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="vendor/adminLTE/js/app.min.js" type="text/javascript"></script>

    <script src="js/dashboard.js" type="text/javascript"></script>
<script type="text/javascript">
      $(function () {
        $('#businessTable').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
        cc.business.init();
      });
    </script>