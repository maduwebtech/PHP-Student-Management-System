<?php include "header.php";
$id=$_GET['id'];
$sql="SELECT * FROM teachers_tbl LEFT JOIN courses ON teachers_tbl.course=courses.course_id WHERE comsats_id='$id'";
$query=mysqli_query($config,$sql);
$rows=mysqli_num_rows($query);
$result=mysqli_fetch_assoc($query);
if ($rows) {
  
?>
<div class="container">
  <div class="row">
    <div class="col-12 m-auto">
      <div class="card">
        <div class="card-body text-center">
          <?php 
          if(empty($result['photo'])) {?>
           <img class="avatar rounded-circle" src="assets/img/user.png" alt="img">
          <?php
          } else { ?>
           <img class="avatar rounded-circle" src="assets/teachers/<?=$result['photo']?>" alt="img">
          <?php } ?>
          <h4 class="card-title"><?= ucwords($result['fullname']) ?></h4>
          <p class="card-subtitle mb-2 text-primary">
              <small>COMSATS Institute of Computer Technology Muzaffarabad</small>
          </p>
          <div class="table-responsive shadow mb-3">
              <table class="table table-bordered" width="100%" cellspacing="0">
              <thead class="bg-primary text-white">
                <tr>
                    <th>Father Name</th>
                    <th>Course</th>
                    <th>Phone</th>
                    <th>Joining Date</th>
                </tr>
              </thead>
              <tbody class="text-dark">
                  <tr>
                      <td><?= ucwords($result['father_name']) ?></td>
                      <td><?= ucwords($result['course_name']) ?></td>
                      <td><?= $result['phone'] ?></td>
                      <td><?= date('d-M-Y',strtotime($result['joining_date'])) ?></td>
                  </tr>
              <thead class="bg-primary text-white">
                <tr>
                    <th colspan="2">Address</th>
                    <th>CNIC</th>
                    <th>Leave Date</th>
                </tr>
              </thead>
              <tr class="text-dark">
                    <td colspan="2"><?= $result['address'] ?></td>
                    <td><?= $result['phone'] ?></td>
                    <td><?php if(!empty($result['leave_date'])) {
                     date('d-M-Y',strtotime($result['leave_date'])); } ?></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-white bg-primary font-weight-bold">Additional Information :</td>
                    <td colspan="3" class="text-dark" align="Start"><?= $result['add_info'] ?></td>
                </tr>
            </tbody>
          </table>
          </div>
          <a href="teachers.php" class="btn btn-info">Teachers</a>
          <a href="teachers.php" class="btn btn-outline-info">Go Back</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php }
else
{
  echo "No Page Found";
}
include "footer.php";
?>