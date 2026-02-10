<?php
$conn = new mysqli("localhost", "root", "", "cafe");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['signup'])) {

    // 🔹 Clean input using string functions
    $name     = trim($_POST['Name']);
    $email    = trim($_POST['Email']);
    $password = trim($_POST['Password']);

    // 🔹 Format name properly
    $name = ucwords(strtolower($name));

    // 🔹 Secure inputs
    $name  = htmlspecialchars($name);
    $email = htmlspecialchars($email);

    // 🔹 Validate input length
    if (strlen($name) < 3) {
        die("Name must be at least 3 characters long");
    }

    if (strlen($password) < 6) {
        die("Password must be at least 6 characters long");
    }

    // 🔹 Insert query
    $sql = "INSERT INTO users (Name, Email, Password) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed");
    }

    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        echo "Registration successful";
    } else {
        echo "Registration failed";
    }

    $stmt->close();
}

$conn->close();
?>
