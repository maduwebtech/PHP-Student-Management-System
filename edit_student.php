<?php include "header.php";
// GET Student ID
$comsats_id=$_GET['id'];
if (empty($comsats_id)) {
  header("location:students.php");
}
$sql="SELECT * FROM students_tbl LEFT JOIN courses ON students_tbl.course_id=courses.course_id WHERE comsats_id='$comsats_id'";
$query=mysqli_query($config,$sql);
$rows=mysqli_num_rows($query);
$result=mysqli_fetch_assoc($query);
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
            <span class="text-success">Edit Student Record</span>
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
                  <input type="text" class="form-control" placeholder="Name" name="std_name" value="<?= ucwords($result['std_name']) ?>" required>
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Father Name <sup class="text-danger">*</sup></label>
                  <input type="text" class="form-control" placeholder="Father Name" name="father_name" value="<?= ucwords($result['father_name']) ?>" required>
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">ID Card</label>
                  <input type="text" class="form-control" placeholder="13 Digit ID" name="id_card" value="<?= ucwords($result['id_card']) ?>" maxlength="15">
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Qualification</label>
                  <input type="text" class="form-control" placeholder="Qualification" value="<?= ucwords($result['qualification']) ?>" name="qualification">
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Course <sup class="text-danger">*</sup></label>
                  <select class="form-control" required name="course_id">
                    <option value="<?= $result['course_id'] ?>"><?= ucwords($result['course_name']) ?></option>
                    <?php
                    $sql="SELECT * FROM courses";
                    $query=mysqli_query($config,$sql);
                     while ($courses=mysqli_fetch_assoc($query)) { ?>
                <option value="<?= $courses['course_id'] ?>"><?= $courses['course_name'] ?></option>
            <?php } ?>
                  </select>
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Phone <sup class="text-danger">*</sup></label>
                  <input type="text" class="form-control" placeholder="Mobile no." name="phone_I" value="<?= $result['phone_I'] ?>" maxlength="13" required>
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Phone-II</label>
                  <input type="text" class="form-control" placeholder="Mobile no." name="phone_II" value="<?= $result['phone_II'] ?>" maxlength="13">
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Photo</label>
                  <input type="file" class="form-control-file" name="std_photo">
                  <div style="width:80px;margin: 5px;border: 1px solid #ddd;padding: 5px;border-radius: 50%;">
                    <img src="assets/img/<?= $result['std_photo'] ?>" style="width: 100%;height: 100%; object-fit: fill;border-radius: 50%;">
                  </div>
                </div>
                <div class="col-6 my-1">
                  <label class="form-label">Permanent Address <sup class="text-danger">*</sup></label>
                  <input type="text" class="form-control" placeholder="Permanent Address" value="<?= $result['p_address'] ?>" name="p_address" required>
                </div>
                <div class="col-6 my-1">
                  <label class="form-label">Temporary Address</label>
                  <input type="text" class="form-control" placeholder="Living Address" name="t_address" value="<?= $result['t_address'] ?>">
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Course Start Date <sup class="text-danger">*</sup></label>
                  <input type="date" class="form-control" value="<?= $result['start_date'] ?>" name="start_date" required>
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Course End Date</label>
                  <input type="date" class="form-control" value="<?= $result['end_date'] ?>" name="end_date">
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Total Fee</label>
                  <input type="number" name="total_fee" class="form-control" placeholder="Total Fee" value="<?= $result['total_fee'] ?>">
                </div>
                <div class="col-md-6 my-1">
                  <label class="form-label">Additional Information</label>
                  <textarea class="form-control" name="add_info" placeholder="Additional Information" rows="1"><?= $result['add_info'] ?></textarea>
                </div>
                <div class="col-12 mt-1 mb-2">
                  <input type="submit" class="btn btn-primary btn-sm" name="update_btn" value="Update">
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
if (isset($_POST['update_btn'])) {
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
  $end_date=$_POST['end_date'];
  $total_fee=$_POST['total_fee'];
  $add_info=mysqli_real_escape_string($config,$_POST['add_info']);
  $sql2="UPDATE students_tbl SET std_name='$std_name',father_name='$father_name',id_card='$id_card',qualification='$qualification',course_id='$course_id',phone_I='$phone_I',phone_II='$phone_II',p_address='$p_address',t_address='$t_address',start_date='$start_date',end_date='$end_date',total_fee='$total_fee',add_info='$add_info' WHERE comsats_id='$comsats_id'";
      $query2=mysqli_query($config,$sql2);
      if ($query2) {
        $_SESSION['success']="Student Record Updated Successfully";
          header("location:students.php");
        }
      else
      {
        $_SESSION['error']="Failed,please try again";
          header("location:edit_student.php");
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
  $end_date=$_POST['end_date'];
  $total_fee=$_POST['total_fee'];
  $add_info=$_POST['add_info'];
  if (in_array($image_ext, $allow_type)) {
    if ($size <= 1000000) {
      move_uploaded_file($tmp_name, $destination);
      $sql2="UPDATE students_tbl SET std_name='$std_name',father_name='$father_name',id_card='$id_card',qualification='$qualification',course_id='$course_id',phone_I='$phone_I',phone_II='$phone_II',std_photo='$stdPhoto',p_address='$p_address',t_address='$t_address',start_date='$start_date',end_date='$end_date',total_fee='$total_fee',add_info='$add_info' WHERE comsats_id='$comsats_id'";
      $query2=mysqli_query($config,$sql2);
      if ($query2) {
        $_SESSION['success']="Student Record Updated Successfully";
          header("location:students.php");
      }
      else
      {
        $_SESSION['error']="Failed,please try again";
          header("location:edit_student.php");
      }
    }
    else
    {
      $_SESSION['error']="image size should not be greater than 1mb";
        header("location:edit_student.php");
    }
  }
  else
  {
    $_SESSION['error']="File type is not allowed (only jpg,png and jpeg)";
    header("location:edit_student.php");
  }
}
}
?>