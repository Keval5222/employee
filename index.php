<?php session_start();
// include('process.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Employee Management System</title>
</head>
<link rel="stylesheet" href="style.css">
<body>
    <h2 class="h2">Employee Information</h2>
    
    <form method="post" enctype="multipart/form-data" action="process.php">
        <label for="name">Name:</label>
        <input type="text" name="name" value=""><br>
        <span class="error">* <?php echo $_GET['nameError']?></span> 

        <label for="designation">Designation:</label>
        <input type="text" name="designation" ><br>
        <span class="error">*  <?php echo $_GET['designationError']?></span>

        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" ><br>
        <span class="error">*  <?php echo $_GET['dobError']?></span>

        <label>Gender:</label>
        Male<input type="radio" name="gender" value="Male" > 
        Female<input type="radio" name="gender" value="Female"> <br>
        <span class="error">*  <?php echo $_GET['genderError']?></span>
        
        <br>

        <label>Hobbies:</label>
        Reading <input type="checkbox" name="hobbies[]" value="Reading">
        Travelling <input type="checkbox" name="hobbies[]" value="Travelling"> 
        Gaming <input type="checkbox" name="hobbies[]" value="Gaming"> <br>
        <span class="error">*  <?php echo $_GET['hobbiesError']?></span>
        
        <br> 

        <label for="profile_image">Profile Image:</label>
        <input type="file" name="profile_image" multiple accept="image/*"><br>
        <span class="error">*  <?php echo $_GET['profileErrors']?></span>
        <br>
        <input class="submit" type="submit" name="submit" value="Submit"> 
        <input type="button" style="background-color: #4caf50;color: #fff;padding: 10px 15px; border: none;border-radius: 3px;cursor: pointer;"; class="button" name="cancel" value="cancel" onclick="redirectToIndex()">

    </form>
    <script>
    function redirectToIndex() {
      window.location.href = "list.php";
    }
  </script>
</body>
</html>

