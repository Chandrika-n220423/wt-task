<!DOCTYPE html>
<html>
<head>
    <title>File Upload</title>
</head>
<body>

<h2>Upload File</h2>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="file" required>
    <br><br>
    <input type="submit" name="upload" value="Upload">
</form>

<?php
if (isset($_POST['upload'])) {

    $folder = "uploads/";
    $fileName = $_FILES['file']['name'];
    $tmpName = $_FILES['file']['tmp_name'];

    if (move_uploaded_file($tmpName, $folder.$fileName)) {
        echo "<p style='color:green;'>File uploaded successfully</p>";
        echo "<a href='download.php?file=$fileName'>Download File</a>";
    } else {
        echo "<p style='color:red;'>Upload failed</p>";
    }
}
?>

</body>
</html>