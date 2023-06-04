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
            <span class="text-success">Add New Teacher </span>
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
                  <label class="form-label">Full Name<sup class="text-danger">*</sup></label>
                  <input type="text" class="form-control" placeholder="Name" name="fullname" required>
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Father Name <sup class="text-danger">*</sup></label>
                  <input type="text" class="form-control" placeholder="Father Name" name="father_name" required>
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">ID Card</label>
                  <input type="text" class="form-control" placeholder="13 Digit ID" name="id_card" maxlength="15">
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Qualification</label>
                  <input type="text" class="form-control" placeholder="Qualification" name="qualification">
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Course <sup class="text-danger">*</sup></label>
                  <select class="form-control" required name="course">
                    <option value="">Select Course</option>
                    <?php while ($courses=mysqli_fetch_assoc($query)) { ?>
                <option value="<?= $courses['course_id'] ?>"><?= $courses['course_name'] ?></option>
            <?php } ?>
                  </select>
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Phone <sup class="text-danger">*</sup></label>
                  <input type="text" class="form-control" placeholder="Mobile no." name="phone" maxlength="11" required>
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Photo</label>
                  <input type="file" class="form-control-file" name="photo">
                </div>
                <div class="col-6 my-1">
                  <label class="form-label">Address <sup class="text-danger">*</sup></label>
                  <input type="text" class="form-control" placeholder="Address" name="address" required>
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Joining Date <sup class="text-danger">*</sup></label>
                  <input type="date" class="form-control" name="joining_date" required>
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Leave Date</label>
                  <input type="date" class="form-control" name="leave_date">
                </div>
                <div class="col-md-12 my-1">
                  <label class="form-label">Additional Information</label>
                  <textarea class="form-control" name="add_info" placeholder="Additional Information" rows="3"></textarea>
                </div>
                <div class="col-12 mt-1 mb-2">
                  <input type="submit" class="btn btn-primary btn-sm" name="register" value="Register">
                  <a href="teachers.php" class="btn btn-secondary btn-sm">Go Back</a>                 
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
  $fullname=mysqli_real_escape_string($config,$_POST['fullname']);
  $father_name=mysqli_real_escape_string($config,$_POST['father_name']);
  $id_card=mysqli_real_escape_string($config,$_POST['id_card']);
  $qualification=mysqli_real_escape_string($config,$_POST['qualification']);
  $course=mysqli_real_escape_string($config,$_POST['course']);
  $phone=mysqli_real_escape_string($config,$_POST['phone']);
  $filename=$_FILES['photo']['name'];
  //if user do not upload img
  if (empty($filename)) {
  $address=mysqli_real_escape_string($config,$_POST['address']);
  $joining_date=$_POST['joining_date'];
  $leave_date=$_POST['leave_date'];
  $add_info=$_POST['add_info'];
    $sql2="INSERT INTO teachers_tbl(fullname,father_name,id_card,qualification,phone,address,course,photo,joining_date,add_info,leave_date) VALUES('$fullname','$father_name','$id_card','$qualification','$phone','$address','$course','','$joining_date','$add_info','$leave_date')";
      $query2=mysqli_query($config,$sql2);
      if ($query2) {
        $_SESSION['success']="One Teacher Added Successfully";
          header("location:add_teachers.php");
        }
      else
      {
        $_SESSION['error']="Failed,please try again";
          header("location:add_teachers.php");
      }
    }
  else { 
  $tmp_name=$_FILES['photo']['tmp_name'];
  $size=$_FILES['photo']['size'];
  $image_ext=strtolower(pathinfo($filename,PATHINFO_EXTENSION));
  $image_name=strtolower(pathinfo($filename,PATHINFO_FILENAME));
  $newfilename=$image_name.date('sidmY').".".$image_ext;
  $photo=preg_replace('/\s+/','', $newfilename);
  $allow_type=['jpg','png','jpeg'];
  $destination="assets/teachers/".$photo;
  $address=mysqli_real_escape_string($config,$_POST['address']);
  $joining_date=$_POST['joining_date'];
  $leave_date=$_POST['leave_date'];
  $add_info=$_POST['add_info'];
  if (in_array($image_ext, $allow_type)) {
    if ($size <= 1000000) {
      move_uploaded_file($tmp_name, $destination);
      $sql2="INSERT INTO teachers_tbl(fullname,father_name,id_card,qualification,phone,address,course,photo,joining_date,add_info,leave_date) VALUES('$fullname','$father_name','$id_card','$qualification','$phone','$address','$course','$photo','$joining_date','$add_info','$leave_date')";
      $query2=mysqli_query($config,$sql2);
      if ($query2) {
        $_SESSION['success']="One Teacher Added Successfully";
          header("location:add_teachers.php");
      }
      else
      {
        $_SESSION['error']="Failed,please try again";
          header("location:add_teachers.php");
      }
    }
    else
    {
      $_SESSION['error']="image size should not be greater than 1mb";
        header("location:add_teachers.php");
    }
  }
  else
  {
    $_SESSION['error']="File type is not allowed (only jpg,png and jpeg)";
    header("location:add_teachers.php");
  }
}}
?>