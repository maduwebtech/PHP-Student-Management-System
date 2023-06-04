<?php include"header.php";
include 'config.php';
// Build the query to find total rows
$query = "SELECT COUNT(*) as total_rows FROM students_tbl";
// Execute the query
$result = $config->query($query);
// Fetch the result
$row = $result->fetch_assoc();
// Retrieve the total rows count
$totalRows = $row['total_rows'];

$tableName = "students_tbl";
$fieldName = "end_date";

// Build the query to find enrolled students
$query = "SELECT COUNT(*) as empty_records FROM $tableName WHERE $fieldName IS NULL OR $fieldName = ''";
// Execute the query
$result = $config->query($query);

// Fetch the result
$row = $result->fetch_assoc();

// Retrieve the count of empty records
$enrolled = $row['empty_records'];
//check diploma holders
$diploma=$totalRows-$enrolled;

//courses
$query = "SELECT COUNT(*) as courses FROM courses";
$result = $config->query($query);
$row = $result->fetch_assoc();
$courses = $row['courses'];

//teachers
$query = "SELECT COUNT(*) as teachers FROM teachers_tbl";
$result = $config->query($query);
$row = $result->fetch_assoc();
$teachers = $row['teachers'];
?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
      <!-- Begin Page Content -->
      <div class="container-fluid">
        <div class="card shadow mb-4">
          <div class="card-header">
            <p>Dashboard</p>
          </div>
          <div class="card-body">
            <div class="row">
              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Enrolled Students</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $enrolled ?></div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Diploma Holders</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $diploma ?></div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Courses</div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $courses ?></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-bookmark fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Pending Requests Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Teachers</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $teachers ?></div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
<?php include "footer.php" ?>