
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0-rc
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
<script src="{{ admin_assets("jquery.min.js") }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ admin_assets("jquery-ui.min.js") }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ admin_assets("bootstrap.bundle.min.js") }}"></script>
  @stack('js')

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- overlayScrollbars -->
<script src="{{ admin_assets("jquery.overlayScrollbars.min.js") }}"></script>
<!-- AdminLTE App -->
<script src="{{ admin_assets("adminlte.min.js") }}"></script>
<script src="{{ admin_assets("app.js") }}"></script>


@stack("dashboard")
</body>
</html>
