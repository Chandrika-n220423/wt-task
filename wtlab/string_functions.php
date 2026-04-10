<?php
$string = "  Hello PHP World  ";

echo "<h2>Basic String Functions</h2>";
echo "Length: " . strlen($string) . "<br>";
echo "Word Count: " . str_word_count($string) . "<br>";
echo "Reverse: " . strrev($string) . "<br>";

echo "<h2>Case Conversion</h2>";
echo strtoupper($string) . "<br>";
echo strtolower($string) . "<br>";
echo ucfirst("hello") . "<br>";
echo ucwords("hello php world") . "<br>";

echo "<h2>Search & Replace</h2>";
echo "Position of PHP: " . strpos($string, "PHP") . "<br>";
echo str_replace("PHP", "MySQL", $string) . "<br>";

echo "<h2>Substring & Trimming</h2>";
echo substr($string, 0, 5) . "<br>";
echo trim($string) . "<br>";
echo ltrim($string) . "<br>";
echo rtrim($string) . "<br>";

echo "<h2>String Comparison</h2>";
echo strcmp("admin", "admin") . "<br>";
echo strcasecmp("ADMIN", "admin") . "<br>";

echo "<h2>Special Characters & Security</h2>";
echo htmlspecialchars("<script>alert('hack')</script>") . "<br>";
echo addslashes("I'm learning PHP");
?>
