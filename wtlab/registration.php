<?php
$conn = new mysqli("localhost", "root", "", "cafe");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['signup'])) {

    $name         = trim($_POST['Name']);
    $email        = trim($_POST['Email']);
    $password     = $_POST['Password'];

    $sql = "INSERT INTO users
            (Name, Email,Password)
            VALUES (?, ?,?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sss",
        $name,
        $email,
        $password
    );

    if ($stmt->execute()) {
        echo " Inserted successfully";
    } else {
        echo " Not inserted";
    }

    $stmt->close();
}

$conn->close();
?>
