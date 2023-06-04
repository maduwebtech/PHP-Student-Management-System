<?php
include "config.php";

$sql = "SELECT * FROM teachers_tbl LEFT JOIN courses ON teachers_tbl.course = courses.course_id";

$query = mysqli_query($config, $sql);
$rows = mysqli_num_rows($query);

if ($rows) {
    $count=0;
    while ($result = mysqli_fetch_assoc($query)) {
        $output = ""; // Move the declaration and initialization inside the loop
        $fullname = ucwords($result['fullname']);
        $father_name = ucwords($result['father_name']);
        $date = date('d-M-Y', strtotime($result['joining_date']));
        $output .= "
            <tr>
                <td class='text-center'>" . (++$count) . "</td>
                <td>{$fullname}</td>
                <td>{$father_name}</td>
                <td>{$result['course_name']}</td>
                <td>{$result['phone']}</td>
                <td>{$date}</td>
                <td><a href='profile2.php?id={$result['comsats_id']}' class='text-primary'>
                    <i class='fas fa-eye'></i></a></td>
                <td><a href='edit_teacher.php?id={$result['comsats_id']}' class='text-success'>
                    <i class='fas fa-edit'></i></a></td>
                <td>
                    <form method='POST' onsubmit=\"return confirm('Are you sure you want to delete?')\">
                        <input type='hidden' name='comsats_id' value='{$result['comsats_id']}'>
                        <input type='hidden' name='photo' value='{$result['photo']}'>
                        <button class='text-danger border-0 bg-white' name='teacher_delete'><i class='fas fa-trash-alt'></i></button>
                    </form>
                </td>
            </tr>";
        echo $output;
    }
} else {
    echo "<tr><td colspan='9'>No Record Found</td></tr>";
}
?>