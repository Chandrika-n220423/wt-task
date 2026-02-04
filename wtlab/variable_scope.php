<?php
echo "<h2>PHP Datatypes</h2>";

$string = "Hello";
$integer = 21;
$float = 5.5;
$boolean = true;
$array = array("PHP", "HTML", "CSS");

echo "String: $string <br>";
echo "Integer: $integer <br>";
echo "Float: $float <br>";
echo "Boolean: " . ($boolean ? "true" : "false") . "<br>";
echo "Array: ";
print_r($array);

echo "<hr><h2>Variable Scope</h2>";

// 1. Local Scope
function localScope() {
    $localVar = "I am local";
    echo "Local Variable: $localVar <br>";
}
localScope();

// 2. Global Scope
$globalVar = "I am global";

function globalScope() {
    global $globalVar;
    echo "Global Variable inside function: $globalVar <br>";
}
globalScope();

// 3. Static Scope
function staticScope() {
    static $count = 0;
    $count++;
    echo "Static Variable Count: $count <br>";
}

staticScope();
staticScope();
staticScope();
?>
