<?php
include 'header.php';
include 'config.php';
echo '<link rel="stylesheet" type="text/css" href="assets/fee.css">';
?>
<div class="container">
  <h4 class="text-center">Student Fee Record System</h4>
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
  <form action="" method="post">
    <div class="form-group">
      <label for="comsats_id">Student ID:</label>
      <input type="number" id="comsats_id" name="comsats_id" required>
    </div>
    <div class="form-group">
      <label for="std_name">Student Name:</label>
      <input type="text" id="std_name" name="std_name" required>
    </div>
    <div class="form-group">
      <label for="fee_amount">Date:</label>
      <input type="date" id="fee_date" name="fee_date"required class="form-control">
    </div>
    <div class="form-group">
      <label for="fee_amount">Fee Amount:</label>
      <input type="number" id="fee_amount" name="submit_fee"  required>
    </div>
    <div class="form-group">
      <label for="fee_amount">Remarks:</label>
      <input type="text" placeholder="e.g Monthly Fee,Admission Fee etc." name="remarks"  required>
    </div>
    <div class="form-group">
      <input type="submit" value="Submit" name="fee_btn">
    </div>
  </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('#comsats_id').on('input', function() {
      var comsats_id = $(this).val();
      $.ajax({
        url: 'get_student_name.php',
        type: 'POST',
        data: { comsats_id: comsats_id },
        success: function(response) {
          $('#std_name').val(response);
        }
      });
    });
  });
</script>
<?php include 'footer.php';
if (isset($_POST['fee_btn'])) {
  $std_id=$_POST['comsats_id'];
  $std_name=$_POST['std_name'];
  $fee_date=$_POST['fee_date'];
  $submit_fee=$_POST['submit_fee'];
  $remarks=$_POST['remarks'];
  $sql="INSERT INTO fee_tbl (std_id,std_name,fee_date,submit_fee,remarks)VALUES('$std_id','$std_name','$fee_date','$submit_fee','$remarks')";
  $query=mysqli_query($config,$sql);
  if ($query) {
        $_SESSION['success']="Fee <span class='text-danger'>RS. $submit_fee</span> Submitted Successfully";
          header("location:std_fee.php");
      }
      else
      {
        $_SESSION['error']="Failed,please try again";
          header("location:std_fee.php");
      }
}
?>