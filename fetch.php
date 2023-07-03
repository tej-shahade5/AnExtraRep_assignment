<?php
$email = $_POST['email'];

// Connect to the MySQL database
$conn = new mysqli("localhost","root","","patients");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Escape special characters to prevent SQL injection
$email = $conn->real_escape_string($email);

// Query the database to fetch the PDF file based on the email
$sql = "SELECT pdf FROM patients_details WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $pdfData = $row['pdf'];

    // Set the appropriate headers for PDF download
    header("Content-type: pdf");
    header("Content-Disposition: attachment; filename = healthReport.pdf");

    // Output the PDF data
    echo $pdfData;
} else {
    echo '<script>alert("No pdf found for the given email!");</script>';
}

// Close the database connection
$conn->close();
?>
