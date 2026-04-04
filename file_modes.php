<?php
fopen("mode.txt", "r");
fopen("mode.txt", "w");
fopen("mode.txt", "a");
fopen("new1.txt", "x");
fopen("mode.txt", "r+");
fopen("mode.txt", "w+");
fopen("mode.txt", "a+");
fopen("new2.txt", "x+");

echo "All file modes executed successfully";
?>