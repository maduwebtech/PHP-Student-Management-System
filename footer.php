<!-- Footer -->
  <footer class="sticky-footer bg-white" id="down">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>Copyright &copy; 2023 All rights reserved</span>
      </div>
    </div>
  </footer>
  <!-- End of Footer -->
  </div>
  <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Click on Logout if you want to end current session</div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
              </div>
            </div>
          </div>
          <!-- Bootstrap core JavaScript-->
          <script src="assets/vendor/jquery/jquery.min.js"></script>
          <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
          <script type="text/javascript" src="jQuery.js"></script>
          <!-- Core plugin JavaScript-->
          <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
          <!-- Custom scripts for all pages-->
          <script src="main.js"></script>
          <!-- Page level plugins -->
          <script src="vendor/datatables/jquery.dataTables.min.js"></script>
          <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
          <!-- Page level custom scripts -->
          <script src="demo/datatables-demo.js"></script>
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </body>
</html>

<!-- Place this code after including the necessary JavaScript files -->
<script>
  $(document).ready(function() {
    // Toggle the sidebar
    $('#sidebarToggle, #sidebarToggleTop').on('click', function(e) {
      $('body').toggleClass('sidebar-toggled');
      $('.sidebar').toggleClass('toggled');
      if ($('.sidebar').hasClass('toggled')) {
        $('.sidebar .collapse').collapse('hide');
      }
    });

    // Close any open menu item when the sidebar is toggled
    $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
      if ($(window).width() > 768) {
        var e0 = e.originalEvent,
          delta = e0.wheelDelta || -e0.detail;
        this.scrollTop += (delta < 0 ? 1 : -1) * 30;
        e.preventDefault();
      }
    });
    $(window).resize(function() {
      if ($(window).width() > 768) {
        $('.sidebar .collapse').collapse('show');
      }
    });
    $(window).on('scroll', function() {
      if ($(this).scrollTop() > 100) {
        $('.scroll-to-top').fadeIn();
      } else {
        $('.scroll-to-top').fadeOut();
      }
    });

    // Scroll to top button
    $('.scroll-to-top').on('click', function(e) {
      e.preventDefault();
      $('html, body').animate({ scrollTop: 0 }, 'easeInOutExpo', 1000);
    });
  });
</script>
