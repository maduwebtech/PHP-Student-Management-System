<?php
include "config.php";

// Pagination variables
$recordsPerPage = 100;
$page = isset($_POST['page']) ? $_POST['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;

// Query to retrieve limited records
$sql = "SELECT * FROM students_tbl LEFT JOIN courses ON students_tbl.course_id = courses.course_id LIMIT $offset, $recordsPerPage";
$query = mysqli_query($config, $sql);
$rows = mysqli_num_rows($query);

if ($rows) {
    while ($result = mysqli_fetch_assoc($query)) {
        $output = ""; // Move the declaration and initialization inside the loop
        $std_name = ucwords($result['std_name']);
        $father_name = ucwords($result['father_name']);
        $date = date('d-M-Y', strtotime($result['start_date']));
        $output .= "
            <tr>
                <td class='text-center'>{$result['comsats_id']}</td>
                <td>{$std_name}</td>
                <td>{$father_name}</td>
                <td>{$result['course_name']}</td>
                <td>{$result['phone_I']}</td>
                <td>{$date}</td>
                <td><a href='profile.php?id={$result['comsats_id']}' class='text-primary'>
                    <i class='fas fa-eye'></i></a></td>
                <td><a href='edit_student.php?id={$result['comsats_id']}' class='text-success'>
                    <i class='fas fa-edit'></i></a></td>
                <td>
                    <form method='POST' onsubmit=\"return confirm('Are you sure you want to delete?')\">
                        <input type='hidden' name='comsats_id' value='{$result['comsats_id']}'>
                        <input type='hidden' name='std_photo' value='{$result['std_photo']}'>
                        <button class='text-danger border-0 bg-white' name='delete_btn'><i class='fas fa-trash-alt'></i></button>
                    </form>
                </td>
            </tr>";
        echo $output;
    }
} else {
    echo "<tr><td colspan='9'>No Record Found</td></tr>";
}

// Get total number of records
$sqlTotal = "SELECT COUNT(*) AS total FROM students_tbl";
$queryTotal = mysqli_query($config, $sqlTotal);
$rowTotal = mysqli_fetch_assoc($queryTotal);
$totalRecords = $rowTotal['total'];

// Calculate total number of pages
$totalPages = ceil($totalRecords / $recordsPerPage);

// Pagination links
echo "<tr><td colspan='9' class='text-center'>";

if ($page > 1) {
    echo "<a href='#' class='btn btn-sm btn-primary' onclick='loadPage(" . ($page - 1) . ")'>Previous</a>&nbsp;";
}

for ($i = 1; $i <= $totalPages; $i++) {
    echo "<a href='#' class='btn btn-sm btn-primary' onclick='loadPage($i)'>$i</a> ";
}

if ($page < $totalPages) {
    echo "<a href='#' class='btn btn-sm btn-primary' onclick='loadPage(" . ($page + 1) . ")'>Next</a>";
}

echo "</td></tr>";
?>