<?php include "header.php";
$sql="SELECT * FROM courses";
$query=mysqli_query($config,$sql);
?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
      <!-- Begin Page Content -->
      <div class="container-fluid">
        <div class="card shadow mb-4">
          <div class="card-header pb-1 d-flex justify-content-between">
            <span class="text-success">New Student Enrolment </span>
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
          <div class="card-body text-primary">
            <div class="table-responsive">
              <form class="row px-2" action="" method="POST" enctype="multipart/form-data">
                <div class="col-md-6 my-1">
                  <label class="form-label">Name<sup class="text-danger">*</sup></label>
                  <input type="text" class="form-control" placeholder="Name" name="std_name" required>
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Father Name <sup class="text-danger">*</sup></label>
                  <input type="text" class="form-control" placeholder="Father Name" name="father_name" required>
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">ID Card</label>
                  <input type="text" class="form-control" placeholder="13 Digit ID" name="id_card" autocomplete="off" maxlength="15">
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Qualification</label>
                  <input type="text" class="form-control" placeholder="Qualification" name="qualification">
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Course <sup class="text-danger">*</sup></label>
                  <select class="form-control" required name="course_id">
                    <option value="">Select Course</option>
                    <?php while ($courses=mysqli_fetch_assoc($query)) { ?>
                <option value="<?= $courses['course_id'] ?>"><?= $courses['course_name'] ?></option>
            <?php } ?>
                  </select>
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Phone <sup class="text-danger">*</sup></label>
                  <input type="text" class="form-control" placeholder="Mobile no." name="phone_I" maxlength="12" required>
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Phone-II</label>
                  <input type="text" class="form-control" placeholder="Mobile no." name="phone_II" maxlength="12">
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Photo</label>
                  <input type="file" class="form-control-file" name="std_photo">
                </div>
                <div class="col-6 my-1">
                  <label class="form-label">Permanent Address <sup class="text-danger">*</sup></label>
                  <input type="text" class="form-control" placeholder="Permanent Address" name="p_address" required>
                </div>
                <div class="col-6 my-1">
                  <label class="form-label">Temporary Address</label>
                  <input type="text" class="form-control" placeholder="Living Address" name="t_address">
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Course Start Date <sup class="text-danger">*</sup></label>
                  <input type="date" class="form-control" name="start_date" required>
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Course End Date</label>
                  <input type="date" class="form-control" name="end_date">
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Total Fee</label>
                  <input type="number" name="total_fee" class="form-control" placeholder="Total Fee">
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Additional Information</label>
                  <textarea class="form-control" name="add_info" placeholder="Additional Information" rows="1"></textarea>
                </div>
                <div class="col-12 mt-1 mb-2">
                  <input type="submit" class="btn btn-primary btn-sm" name="register" value="Register">
                  <a href="students.php" class="btn btn-secondary btn-sm">Go Back</a>                 
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content --> 
<?php include "footer.php";
if (isset($_POST['register'])) {
  $std_name=mysqli_real_escape_string($config,$_POST['std_name']);
  $father_name=mysqli_real_escape_string($config,$_POST['father_name']);
  $id_card=mysqli_real_escape_string($config,$_POST['id_card']);
  $qualification=mysqli_real_escape_string($config,$_POST['qualification']);
  $course_id=mysqli_real_escape_string($config,$_POST['course_id']);
  $phone_I=mysqli_real_escape_string($config,$_POST['phone_I']);
  $phone_II=mysqli_real_escape_string($config,$_POST['phone_II']);
  $filename=$_FILES['std_photo']['name'];
  //if user do not upload img
  if (empty($filename)) {
  $p_address=mysqli_real_escape_string($config,$_POST['p_address']);
  $t_address=mysqli_real_escape_string($config,$_POST['t_address']);
  $start_date=$_POST['start_date'];
  $end_date = $_POST['end_date'];
  $total_fee=$_POST['total_fee'];
  $add_info=$_POST['add_info'];
    $sql2="INSERT INTO students_tbl(std_name,father_name,id_card,qualification,course_id,phone_I,phone_II,std_photo,p_address,t_address,start_date,end_date,total_fee,add_info) VALUES('$std_name','$father_name','$id_card','$qualification','$course_id','$phone_I','$phone_II','','$p_address','$t_address','$start_date','$end_date','$total_fee','$add_info')";
      $query2=mysqli_query($config,$sql2);
      if ($query2) {
        $_SESSION['success']="Student enrolled successfully";
          header("location:add_students.php");
        }
      else
      {
        $_SESSION['error']="Failed,please try again";
          header("location:add_students.php");
      }
    }
  else { 
  $tmp_name=$_FILES['std_photo']['tmp_name'];
  $size=$_FILES['std_photo']['size'];
  $image_ext=strtolower(pathinfo($filename,PATHINFO_EXTENSION));
  $image_name=strtolower(pathinfo($filename,PATHINFO_FILENAME));
  $newfilename=$image_name.date('sidmY').".".$image_ext;
  $stdPhoto=preg_replace('/\s+/','', $newfilename);
  $allow_type=['jpg','png','jpeg'];
  $destination="assets/img/".$stdPhoto;
  $p_address=mysqli_real_escape_string($config,$_POST['p_address']);
  $t_address=mysqli_real_escape_string($config,$_POST['t_address']);
  $start_date=$_POST['start_date'];
  $end_date = $_POST['end_date'];
  $total_fee=$_POST['total_fee'];
  $add_info=$_POST['add_info'];
  if (in_array($image_ext, $allow_type)) {
    if ($size <= 1000000) {
      move_uploaded_file($tmp_name, $destination);
      $sql2="INSERT INTO students_tbl(std_name,father_name,id_card,qualification,course_id,phone_I,phone_II,std_photo,p_address,t_address,start_date,end_date,total_fee,add_info) VALUES('$std_name','$father_name','$id_card','$qualification','$course_id','$phone_I','$phone_II','$stdPhoto','$p_address','$t_address','$start_date','$end_date','$total_fee','$add_info')";
      $query2=mysqli_query($config,$sql2);
      if ($query2) {
        $_SESSION['success']="Student enrolled successfully";
          header("location:add_students.php");
      }
      else
      {
        $_SESSION['error']="Failed,please try again";
          header("location:add_students.php");
      }
    }
    else
    {
      $_SESSION['error']="image size should not be greater than 1mb";
        header("location:add_students.php");
    }
  }
  else
  {
    $_SESSION['error']="File type is not allowed (only jpg,png and jpeg)";
    header("location:add_students.php");
  }
}}
?>