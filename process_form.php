<?php
// Retrieve form data
$name = $_POST['name'];
$age = $_POST['age'];
$weight = $_POST["weight"];
$email = $_POST["email"];
$pdf = $_FILES['pdfFile']['name'];
// $pdf_name = $_FILES['pdfFile']['temp_name'];

// Validate form data (you can add more validation as required)
if (empty($name) || empty($email) || empty($pdf)) {
    echo "Please fill in all the fields.";
    exit;
}

// Sanitize form data to prevent SQL injection
$name = htmlspecialchars($name);
$age = htmlspecialchars($age);
$weight = htmlspecialchars($weight);
$email = htmlspecialchars($email);
$pdf = htmlspecialchars($pdf);

// Connect to the MySQL database
$conn = new mysqli("localhost","root","","patients");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data into the database
$sql = "INSERT INTO patients_details (name,age,weight,email,pdf) VALUES ('$name','$age','$weight','$email','$pdf')";

if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Data inserted successfully!");</script>';
} else {
    echo '<script>alert("Error: Please fill form again!");</script>'. $conn->error;
}

// Close the database connection
$conn->close();
?>
