<html>
<head>
</head>
<body>
</body>
<?php
$servername = "localhost";
$username = "school";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>
</html>