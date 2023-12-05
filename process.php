<?php
$nameError = "";
$designationError = "";
$dobError = ""; 
$genderError = "";
$hobbiesError = "";
$profileimageError = "";
$profileErrors = "";

if(isset($_POST['submit'])){
    if (empty($_POST["name"])) {
        $nameError = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $nameError = "Only letters and white space allowed";    
        }
    }  
    if (empty($_POST["designation"])) {
        $designationError = "Designation are required";
    } else {
        $designation = test_input($_POST["designation"]);
    }
    if (empty($_POST["dob"])) {
        $dobError = "Dob are required";
    } else {
        $dob = test_input($_POST["dob"]);
    }
    if (empty($_POST["gender"])) {
        $genderError = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    }
    if (empty($_POST["hobbies"])) {
        $hobbiesError = "Hobbie is required";
    } else {
        $hobbies = ($_POST["hobbies"]);
    }
    if (empty($_POST["profile_image"])) {
        $profileErrors = "Profile Image is required";
    } else {
        $profile_image = ($_POST["profile_image"]);
    }
    if(!empty($nameError) || !empty($designationError || !empty($dobError) || !empty($genderError) || !empty($hobbiesError) || !empty($profileErrors))){
        header("Location: index.php?nameError=$nameError&designationError=$designationError&dobError=$dobError&genderError=$genderError&hobbiesError=$hobbiesError&profileErrors=$profileErrors");
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<?php
$db = new mysqli('localhost', 'root', 'root@1234', 'Employee');
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } else {
        echo "Connection Successfully";
}
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $hobbies = implode(', ', $_POST['hobbies']);
    $profileImageName = '';
    if ($_FILES['profile_image']['error'] == 0) {
        $profileImageName = $_FILES['profile_image']['name'];
        $profileImagePath = 'uploads/' . $profileImageName;
        move_uploaded_file($_FILES['profile_image']['tmp_name'], $profileImagePath);
    }
    
    $query = "INSERT INTO employee_info (name, designation, dob, gender, hobbies, profile_image) VALUES ('$name', '$designation', '$dob', '$gender', '$hobbies', '$profileImageName')";
    $db->query($query);

header("Location: list.php");   
}
?>


