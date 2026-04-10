<?php
$conn = mysqli_connect("localhost", "root", "", "cafe");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['login'])) {

    // 🔹 Clean inputs
    $email    = trim($_POST['Email']);
    $password = trim($_POST['Password']);

    // 🔹 Validate length
    if (strlen($email) < 5 || strlen($password) < 6) {
        die("Invalid input length");
    }

    // 🔹 Secure input
    $email = htmlspecialchars($email);

    // 🔹 Correct table name
    $query = "SELECT * FROM users WHERE Email = ? AND Password = ?";

    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        die("Query failed");
    }

    mysqli_stmt_bind_param($stmt, "ss", $email, $password);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        header("Location: success.php?action=login");
        exit();
    } else {
        echo "Invalid Login!";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
