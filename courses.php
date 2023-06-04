<?php
include "header.php";
include 'config.php';
$sql = "SELECT * FROM courses";
$result = $config->query($sql);
if (isset($_POST['save'])) {
  $courseName = $_POST["courseName"];
  $duration = $_POST["duration"];
  $fee = $_POST["fee"];
  $sql = "INSERT INTO courses (course_name, course_duration, course_fee) VALUES ('$courseName', '$duration', '$fee')";
  if ($config->query($sql) === TRUE) {
    $_SESSION['success'] = "Record inserted successfully!";
    header("location:courses.php");
    exit;
  } else {
    $_SESSION['error'] = "Failed, please try again";
    header("location:courses.php");
    exit;
  }
}
// Handle form submission to update the record
if (isset($_POST['update'])) {
  $courseId = $_POST['courseId'];
  $courseName = $_POST['courseName'];
  $duration = $_POST['duration'];
  $fee = $_POST['fee'];

  $sql = "UPDATE courses SET course_name='$courseName', course_duration='$duration', course_fee='$fee' WHERE course_id='$courseId'";
  
  if ($config->query($sql) === TRUE) {
    $_SESSION['success'] = "Record updated successfully!";
    header("location: courses.php");
    exit;
  } else {
    $_SESSION['error'] = "Failed to update the record. Please try again.";
    header("location: courses.php");
    exit;
  }
}
$config->close();
?>
<!-- Main Content -->
<div id="content">
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <div class="card shadow mb-4">
      <div class="card-header pb-1 d-flex justify-content-between">
        <span>Courses</span>
        <?php
        if (isset($_SESSION['error'])) {
          $error = $_SESSION['error'];
          ?>
          <span class="text-danger font-weight-bold"><?= $error ?></span>
        <?php
          unset($_SESSION['error']);
        } elseif (isset($_SESSION['success'])) {
          $success = $_SESSION['success'];
          ?>
          <span class="text-success font-weight-bold"><?= $success ?></span>
        <?php
          unset($_SESSION['success']);
        }
        ?>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
              <tr>
                <td align="center" colspan="3">
                  <button id="addCourseBtn" class="btn btn-primary btn-sm">Add New Course</button>
                </td>
                <td align="center" colspan="2">
                  <a href="#down" class="text-secondary"><i class="fas fa-angle-down fa-2x"></i></a>
                </td>
              </tr>
              <tr class="text-primary" style="background-color: #f8f9fc;">
                <th align='center' class='text-center'>ID</th>
                <th>Course/Diploma</th>
                <th class="text-center">Duration</th>
                <th class="text-center">Monthly Fee</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody id="table-data" class="text-dark">
              <?php
              // Display records in the table
              if ($result->num_rows > 0) {
                $count = 0;
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td align='center'>" . ++$count . "</td>";
                  echo "<td>" . $row["course_name"] . "</td>";
                  echo "<td align='center'>" . $row["course_duration"] . "</td>";
                  echo "<td align='center'>" . $row["course_fee"] . "</td>";
                  echo "<td align='center'><a href='#' class='text-success' data-toggle='modal' data-target='#editModal" . $row['course_id'] . "'><i class='fas fa-edit'></i></a></td>";
                 echo "</tr>";
// Generate a modal for each record
echo "<div class='modal fade' id='editModal" . $row['course_id'] . "' tabindex='-1' role='dialog' aria-labelledby='editModalLabel" . $row['course_id'] . "' aria-hidden='true'>";
echo "<div class='modal-dialog' role='document'>";
echo "<div class='modal-content'>";
echo "<div class='modal-header'>";
echo "<h5 class='modal-title' id='editModalLabel" . $row['course_id'] . "'>Edit Course</h5>";
echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
echo "<span aria-hidden='true'>&times;</span>";
echo "</button>";
echo "</div>";

echo "<div class='modal-body'>";
// Add your form inputs for editing the record here
echo "<form method='POST' action='courses.php'>";
echo "<input type='hidden' name='courseId' value='" . $row['course_id'] . "'>";
echo "<label for='courseName'>Course Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>";
echo "<input type='text' name='courseName' value='" . $row['course_name'] . "'><br>";
echo "<label for='duration'>Course Duration:&nbsp;</label>";
echo "<input type='text' name='duration' value='" . $row['course_duration'] . "'><br>";
echo "<label for='fee'>Monthly Fee:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>";
echo "<input type='text' name='fee' value='" . $row['course_fee'] . "'><br><br>";
echo "<button type='submit' name='update' class='btn btn-primary'>Update</button>";
echo "</form>";
echo "</div>";

echo "</div>";
echo "</div>";
echo "</div>";
//end modal

                }
              } else {
                echo "<tr><td colspan='5' align='center'>No records found</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div id="courseFormContainer" style="display: none;">
    <div class="card">
      <div class="card-header bg-success text-white">Add New Course</div>
      <div class="card-body">
        <form id="courseForm" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="form-group">
            <label for="courseName">Course/Diploma:</label>
            <input type="text" id="courseName" name="courseName" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="duration">Duration:</label>
            <input type="text" id="duration" name="duration" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="fee">Fee:</label>
            <input type="text" id="fee" name="fee" class="form-control" required>
          </div>

          <button type="submit" class="btn btn-primary" name="save">Save Record</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End of Main Content -->

<script>
  // JavaScript code to show the popup form
  document.getElementById("addCourseBtn").addEventListener("click", function() {
    document.getElementById("courseFormContainer").style.display = "block";
  });
</script>

<?php include "footer.php"; ?>