<?php
$servername = "localhost";
$username = "user";
$password = "password";
$dbname = "school";
  

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$ledOn = 1;
$ledOff = 0;

//$sql = "SELECT FROM ledSite (ledOn, ledOff)
//VALUES ('$true', '$false')";
$sql = "SELECT * FROM students";
$sql = "UPDATE students SET ledStatus=0";

if ($conn->query($sql) === TRUE) {
    echo "LED Off";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
include 'ledButton.php';
?>
