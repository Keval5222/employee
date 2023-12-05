<!-- <link rel="stylesheet" href="style.css"> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
     <a class='btn btn-success' href='index.php?id='>Add User</a>

</body>
</html>
<?php
$db = new mysqli('localhost', 'root', 'root@1234', 'Employee');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} else {
    // echo "Coneection Successfully";
}
$result = $db->query("SELECT * FROM employee_info");
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>Name</th>";
    echo "<th>Designation</th>";
    echo "<th>DOB</th>";
    echo "<th>Gender</th>";
    echo "<th>Hobbies</th>";
    echo "<th>Profile Image</th>";
    echo "<th>Action</th>";
    echo "</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>{$row['name']}</td>";
    echo "<td>{$row['designation']}</td>";
    echo "<td>{$row['dob']}</td>";
    echo "<td>{$row['gender']}</td>";
    echo "<td>{$row['hobbies']}</td>";
    echo "<td><img src='uploads/{$row['profile_image']}' alt='Profile Image' width='60'></td>";
    // echo "<td><img src='uploads/{$row['profile_image']}' alt='Profile Image' width='60'></td>";
    echo "<td>";
    echo "<a class='btn btn-info'  href='edit.php?id={$row['id']}'>Edit</a>";
    echo " <a class='btn btn-danger' href='delete.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>";
    echo "</td>";
    echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No employees found.";
}


$db->close();
?>

