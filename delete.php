<?php
$db = new mysqli('localhost', 'root', 'root@1234', 'Employee');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} else {
    echo "Database Connection Successfully";
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $employeeId = $_GET['id'];
    $db->query("DELETE FROM employee_info WHERE id=$employeeId");
    
    header("Location: list.php");
}
?>