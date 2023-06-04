<?php
include 'config.php';

// Assuming you have a database connection established
if (!$config) {
    die("Database connection failed: " . mysqli_connect_error());
}

$comsats_id = $_POST['comsats_id'];

// Perform a database query to retrieve the student name based on the ID
// Replace 'students_tbl' with your actual table name and 'std_name' with the correct column name for student name
$query = "SELECT std_name FROM students_tbl WHERE comsats_id = '$comsats_id'";
$result = mysqli_query($config, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $std_name = $row['std_name'];

    // Echo the student name
    echo $std_name;
} else {
    echo "Student not found";
}

mysqli_close($config);
?>