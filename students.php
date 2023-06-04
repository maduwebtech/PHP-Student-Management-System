<?php include "header.php" ?>
<!-- Main Content -->
  <div id="content">
    <!-- Begin Page Content -->
    <div class="container-fluid">
      <div class="card shadow mb-4">
        <div class="card-header pb-1 d-flex justify-content-between">
          <span>Student Record</span>
              <?php if (isset($_SESSION['error'])){
              $error=$_SESSION['error'];?>
              <span class="text-danger font-weight-bold"><?= $error ?></span>
              <?php
              unset($_SESSION['error']);
            } elseif (isset($_SESSION['success'])) {
              $success=$_SESSION['success'];?>
              <span class="text-success font-weight-bold"><?= $success ?></span>
              <?php
              unset($_SESSION['success']);
            }?>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <td colspan="3">
                    <input type="text" id="search" placeholder="Search..." class="form-control">
                  </td>
                  <td align="center" colspan="3">
                    <a href="add_students.php" class="btn btn-primary btn-sm">Add New Student</a>
                  </td>
                  <td align="center" colspan="3">
                    <a href="#down" class="text-secondary"><i class="fas fa-angle-down fa-2x"></i></a>
                  </td>
                </tr>
                <tr class="text-primary" style="background-color: #f8f9fc;">
                    <th class='text-center'>ID</th>
                    <th>Name</th>
                    <th>Father Name</th>
                    <th>Course</th>
                    <th>Phone</th>
                    <th>Start Date</th>
                    <th colspan="3" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody id="table-data" class="text-dark">
               
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- End of Main Content -->
<?php include "footer.php";?>
<!-- for delete student -->
<?php
if (isset($_POST['delete_btn'])) {
    $id = $_POST['comsats_id'];
    $photo = "assets/img/" . $_POST['std_photo'];
    $delete = "DELETE FROM students_tbl WHERE comsats_id='$id'";
    $run = mysqli_query($config, $delete);
    if ($run) {
        unlink($image);
        $_SESSION['success']="Student Record Deleted Successfully";
          header("location:students.php");
        exit; // Add an exit statement to stop executing further code
    } else {
        $_SESSION['error']="Failed,please try again";
        header("location:students.php");
        exit; // Add an exit statement to stop executing further code
    }
}
?>
<script type="text/javascript">
  $(document).ready(function() {
    //load data
    function loadTable() {
      $.ajax({
        url: "load_students.php",
        type: "POST",
        success: function(data) {
          $("#table-data").html(data);
        }
      });
    }
    loadTable();

    // live search
    $("#search").on("keyup",function() {
      var search_term=$(this).val();
      $.ajax({
        url: "search_student.php",
        type: "POST",
        data: {search:search_term},
        success: function(data) {
          $("#table-data").html(data);
        }
      });
    });
  });
</script>
<script type="text/javascript">
  function loadPage(page) {
    $.ajax({
      url: "load_students.php",
      type: "POST",
      data: { page: page },
      success: function(data) {
        $("#table-data").html(data);
      }
    });
  }
</script>