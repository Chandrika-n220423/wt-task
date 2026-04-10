<?php
$file = "sample.txt";

/* File Write */
$fp = fopen($file, "w");
fwrite($fp, "PHP File Handling\n");
fclose($fp);

/* File Read */
$fp = fopen($file, "r");
echo fread($fp, filesize($file));
fclose($fp);

/* file_get_contents */
echo "<br>" . file_get_contents($file);

/* file_put_contents */
file_put_contents($file, "New Data Added");

/* file() */
print_r(file($file));

echo "<br><br>File Info<br>";
echo "Exists: " . file_exists($file) . "<br>";
echo "Size: " . filesize($file) . "<br>";
echo "Type: " . filetype($file) . "<br>";
echo "Access Time: " . fileatime($file) . "<br>";
echo "Modified Time: " . filemtime($file) . "<br>";
echo "Change Time: " . filectime($file) . "<br>";
echo "Permissions: " . fileperms($file) . "<br>";
echo "Owner: " . fileowner($file) . "<br>";
echo "Group: " . filegroup($file) . "<br>";
echo "Inode: " . fileinode($file) . "<br>";

/* File & Folder */
copy($file, "copy.txt");
rename("copy.txt", "renamed.txt");
unlink("renamed.txt");

mkdir("testFolder");
rmdir("testFolder");

echo is_file($file) ? "It is a file<br>" : "";
echo is_dir("uploads") ? "It is a directory<br>" : "";

/* Directory Handling */
echo "Current Directory: " . getcwd() . "<br>";
$files = scandir("uploads");
print_r($files);

/* File Locking */
$lock = fopen("lock.txt", "w");
if (flock($lock, LOCK_EX)) {
    fwrite($lock, "File locked");
    flock($lock, LOCK_UN);
}
fclose($lock);
?>