<?php
echo $_SERVER["REQUEST_METHOD"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from the form
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    // Database connection
    $conn = new mysqli("localhost", "root", "", "form_data");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the table
    $stmt = $conn->prepare("INSERT INTO submissions (first_name, last_name, email, phone, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $phone, $message);

    if ($stmt->execute()) {
        echo "Data submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
