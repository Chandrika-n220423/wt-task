<!DOCTYPE html>
<html>
<head>
    <title>Mini File Manager</title>
</head>
<body>

<h2>Mini File Manager</h2>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" name="upload" value="Upload">
</form>

<?php
$dir = "uploads/";

if (isset($_POST['upload'])) {
    move_uploaded_file($_FILES['file']['tmp_name'], $dir.$_FILES['file']['name']);
}

if (isset($_GET['delete'])) {
    unlink($dir.$_GET['delete']);
    header("Location: file_manager.php");
}

$files = scandir($dir);

echo "<table border='1'>
<tr>
<th>File Name</th>
<th>Size</th>
<th>Last Modified</th>
<th>Action</th>
</tr>";

foreach ($files as $file) {
    if ($file != "." && $file != "..") {
        echo "<tr>
        <td>$file</td>
        <td>".filesize($dir.$file)." bytes</td>
        <td>".date("d-m-Y H:i:s", filemtime($dir.$file))."</td>
        <td>
            <a href='download.php?file=$file'>Download</a> |
            <a href='?delete=$file'>Delete</a>
        </td>
        </tr>";
    }
}
echo "</table>";
?>

</body>
</html>