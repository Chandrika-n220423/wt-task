<?php
$targetDir="uploads/";
if (!is_dir($targetDir)){
    mkdir($targetDir);
}
$fileName=basename($_FILES["myfile"]["name"]);
$targetFile=$targetDir.$fileName;
if (move_uploaded_file($_FILES["myfile"]["tmp_name"],$targetFile))
    {
        echo "File uploaded successfully<br>";
        echo "<a href='download.php?file=$fileName'>
                <button>Download File</button></a>";
    }
    else{
        echo "File upload failed";
    }
    ?>