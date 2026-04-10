<!DOCTYPE html>
<html>
<head>
    <title>Success</title>
</head>
<body>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "register") {
        echo "<h2>Registered Successfully </h2>";
        echo '<p><a href="login.html"><button>Go to Login</button></a></p>';
    } elseif ($_GET['action'] == "login") {
        echo "<h2>Login Successfully </h2>";
    } else {
        echo "<h2>Success </h2>";
    }
} else {
    echo "<h2>Success </h2>";
}
?>

</body>
</html>
