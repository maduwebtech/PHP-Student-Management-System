<?php include "header.php";
$id=$_GET['id'];
//fetch student and course record
$sql="SELECT *
FROM students_tbl
LEFT JOIN courses ON students_tbl.course_id = courses.course_id WHERE students_tbl.comsats_id = '$id'";
$query=mysqli_query($config,$sql);
$rows=mysqli_num_rows($query);
$result=mysqli_fetch_assoc($query);
// fetch fee record
$totalPaidAmount=0;
$sql2="SELECT *
FROM fee_tbl
WHERE fee_tbl.std_id = '$id'";
$query2=mysqli_query($config,$sql2);
$rows2=mysqli_num_rows($query2);
// Calculate the Paid Fee
$paid = "SELECT SUM(submit_fee) AS total FROM fee_tbl WHERE std_id = '$id'";
$sumResult = mysqli_query($config, $paid);
$amount = mysqli_fetch_assoc($sumResult);
$PaidAmount = $amount['total'];
if ($rows) { ?> 
<div class="container profile-page">
  <div class="row">
    <div class="col-12">
      <div class="text-center"> <?php 
          if(empty($result['std_photo'])) {?> 
            <img class="avatar rounded-circle" src="assets/img/user.png" alt="img"><?php
          } 
          else { ?> 
            <img class="avatar rounded-circle" src="assets/img/<?=$result['std_photo']?>" alt="img"><?php }?>
            <h4 class="card-title"> <?= ucwords($result['std_name']) ?> </h4>
          </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="card mb-3">
        <div class="card-header">
          <h5 class="text-center text-danger">Personal Information</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
              <tbody class="text-dark">
                <tr>
                  <th>Father Name</th>
                  <td> <?= ucwords($result['father_name']) ?> </td>
                </tr>
                <tr>
                  <th>CNIC</th>
                  <td> <?= ucwords($result['id_card']) ?> </td>
                </tr>
                <tr>
                  <th>Qualification</th>
                  <td> <?= $result['qualification'] ?> </td>
                </tr>
                <tr>
                  <th>Phone I</th>
                  <td> <?= $result['phone_I'] ?> </td>
                </tr>
                <tr>
                  <th>Phone II</th>
                  <td> <?= $result['phone_II'] ?> </td>
                </tr>
                <tr>
                  <th>Permanent Address</th>
                  <td> <?= $result['p_address'] ?> </td>
                </tr>
                <tr>
                  <th>Temporary Address</th>
                  <td> <?= $result['t_address'] ?> </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card mb-3">
        <div class="card-header">
          <h5 class="text-center text-danger">Course Detail</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
              <tbody class="text-dark">
                <tr>
                  <th>Course</th>
                  <td> <?= ucwords($result['course_name']) ?> </td>
                </tr>
                <tr>
                  <th>Duration</th>
                  <td> <?= ucwords($result['course_duration']) ?> </td>
                </tr>
                <tr>
                  <th>Start Date</th>
                  <td> <?= date('d-M-Y',strtotime($result['start_date'])) ?> </td>
                </tr>
                <tr>
                  <th>End Date</th>
                  <td> <?php
                  $end_date=$result['end_date']; 
                  if ($end_date!='0000-00-00') {
                    echo date('d-M-Y',strtotime($end_date));
                  }
                  else
                  {
                    echo "---";
                   }?> </td>
                </tr>
                <tr>
                  <th>Total Fee</th>
                  <td> <?= $result['total_fee'] ?> </td>
                </tr>
                <tr>
                  <th>Paid Amount</th>
                  <td> <?= $PaidAmount ?> </td>
                </tr>
                <tr>
                  <th>Remaining Amount</th>
                  <td> <?php 
                   $t_fee = intval($result['total_fee']);
                   $remaining = $t_fee - intval($PaidAmount);
                   echo $remaining;
                   ?> </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body d-flex justify-content-around">
          <div>
            <strong class="text-danger">Additional Information:<br></strong>
            <span class="text-success">New Admission</span>
          </div>
          <div>
            <a href="students.php" class="btn btn-outline-primary">Go Back</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> <?php }
else
{
  echo "No Page Found";
}?>
<div class="card m-2">
  <div class="card-header">
    <h5 class="text-center text-danger">Fee History</h5>
  </div>
  <div class="card-body">
    <div class="table-responsive">
  <table class="custom-table table-bordered" class="table" width="100%">
     <thead class="text-primary bg-light">
      <tr>
        <th class="p-2 text-center">Sr#</th>
        <th class="p-2">Paid Amount</th>
        <th class="p-2">Submission Date</th>
        <th class="p-2">Remarks</th>
      </tr>
     </thead>
    <tbody class="text-dark">
    <?php
    if ($rows2) {
      $count=0;
      while($row=mysqli_fetch_assoc($query2)){ ?>
      <tr>
        <td><?= ++$count;?></td>
        <td><?php echo $paidAmount=$row['submit_fee'];
        $totalPaidAmount += $paidAmount;
         ?></td>
        <td><?php
        $fee=$row['fee_date'];
       if ($fee!="0000-00-00") {
        echo date('d-M-Y',strtotime($fee));
        } else{
          echo "";
        } ?></td>
        <td><?= $row['remarks'] ?></td>
      </tr>
    <?php } }?>
    <tr class="text-success"><td colspan="5">Total Paid Amount: <?= $totalPaidAmount ?>&nbsp;Rupees</td></tr>
    </tbody>
  </table>
</div>
  </div>
</div>
<?php
include "footer.php";
?>