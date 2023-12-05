<?php
$db = new mysqli('localhost', 'root', 'root@1234', 'Employee');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} else {
    // echo "Connection Successfully";
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $employeeId = $_GET['id'];
    $result = $db->query("SELECT * FROM employee_info WHERE id=$employeeId");

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $designation = $row['designation'];
        $dob = $row['dob'];
        $gender = $row['gender'];
        $hobbies = explode(', ', $row['hobbies']);
    }
    $profileImageName = '';
    if ($_FILES['profile_image']['error'] == 0) {
    $profileImageName = $_FILES['profile_image']['name'];
    $profileImagePath = 'uploads/' . $profileImageName;
    move_uploaded_file($_FILES['profile_image']['tmp_name'], $profileImagePath);
}
} 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $employeeId = $_POST['employee_id'];
    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $hobbies = implode(', ', $_POST['hobbies']);
    $query = "UPDATE employee_info SET name='$name', designation='$designation', dob='$dob', gender='$gender', hobbies='$hobbies', profile_image='$profileImagePath' WHERE id=$employeeId";

    // $query = "UPDATE employee_info SET name='$name', designation='$designation', dob='$dob', gender='$gender', hobbies='$hobbies', profile_image='$profileImagePath WHERE id=$employeeId";
    $db->query($query);
    header("Location: list.php");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel'])) {
    header("Location: list.php");   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Employee</title>
</head>
<body>
<link rel="stylesheet" href="style.css">
    <h2>Edit Employee</h2>
    <form action="edit.php" method="post">
        <input type="hidden" name="employee_id" value="<?php echo $employeeId; ?>">
        
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $name; ?>" required><br>

        <label for="designation">Designation:</label>
        <input type="text" name="designation" value="<?php echo $designation; ?>" required><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" value="<?php echo $dob; ?>" required><br>

        <label>Gender:</label>
        <input type="radio" name="gender" value="Male" <?php echo ($gender == 'Male') ? 'checked' : ''; ?>> Male
        <input type="radio" name="gender" value="Female" <?php echo ($gender == 'Female') ? 'checked' : ''; ?>> Female<br>

        <label>Hobbies:</label>
        <input type="checkbox" name="hobbies[]" value="Reading" <?php echo (in_array('Reading', $hobbies)) ? 'checked' : ''; ?>> Reading
        <input type="checkbox" name="hobbies[]" value="Travelling" <?php echo (in_array('Travelling', $hobbies)) ? 'checked' : ''; ?>> Travelling
        <input type="checkbox" name="hobbies[]" value="Gaming" <?php echo (in_array('Gaming', $hobbies)) ? 'checked' : ''; ?>> Gaming<br>
        <br>           
        <label>Profile Image:</label>
        <input type="file" name="profile_image">
        <?php echo ($profileImagePath != '') ? '<br>Image Path: ' . $profileImagePath : ''; ?>
        <br>
        <span></span>
        <br>

        <input type="submit" name="update" value="Update">
        <input type="submit" name="cancel" value="cancel">
    </form>
</body>
</html>