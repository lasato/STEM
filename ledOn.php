<?php
$servername = "localhost";
$username = "school";
$password = "password";
$dbname = "ledSite";
  

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
$sql = "UPDATE students SET ledStatus=1";

if ($conn->query($sql) === TRUE) {
    echo "LED On";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
include 'ledButton.php';
?>
