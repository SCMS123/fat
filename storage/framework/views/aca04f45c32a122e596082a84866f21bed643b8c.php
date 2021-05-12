<!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020-2021 <a href="#">FAT</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.5
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- jQuery -->
<script src="<?php echo e(asset('assets/admin/plugins/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/inputmask/jquery.inputmask.min.js')); ?>"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo e(asset('assets/admin/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/jszip/jszip.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/pdfmake/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/pdfmake/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/datatables-buttons/js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/datatables-buttons/js/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('assets/admin/dist/js/adminlte.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/summernote/summernote-bs4.min.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(asset('assets/admin/dist/js/demo.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/toastr/toastr.min.js')); ?>"></script>

<script src="<?php echo e(asset('/vendor/yajra/laravel-datatables-buttons/src/resources/assets/buttons.server-side.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/select2/js/select2.full.min.js')); ?>"></script>


<!-- jQuery -->
<!-- <script src="<?php echo e(asset('assets/admin/plugins/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/chart.js/Chart.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/sparklines/sparkline.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/jqvmap/jquery.vmap.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/jqvmap/maps/jquery.vmap.usa.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/jquery-knob/jquery.knob.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/summernote/summernote-bs4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/dist/js/adminlte.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/dist/js/pages/dashboard.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/dist/js/demo.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/datatables-buttons/js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/datatables-buttons/js/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js')); ?>"></script> -->

<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<script type="text/javascript">
   <?php if(Session::has('message')): ?>
      var type = "<?php echo e(Session::get('alert-type', 'info')); ?>";
      switch(type){
         case 'info':
            toastr.info("<?php echo e(Session::get('message')); ?>");
            break;

         case 'warning':
            toastr.warning("<?php echo e(Session::get('message')); ?>");
            break;

         case 'success':
            toastr.success("<?php echo e(Session::get('message')); ?>");
            break;
                
         case 'error':
            toastr.error("<?php echo e(Session::get('message')); ?>");
            break;
      }
   <?php endif; ?>
</script>

</body>
</html><?php /**PATH C:\xampp\htdocs\fat\resources\views/admin/includes/footer.blade.php ENDPATH**/ ?>