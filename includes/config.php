<?php 

//Sites appearance
$site_title = "Moment 2";
$divider = " - ";

//Auto load classes
spl_autoload_register(function($class_name) {
    include("classes/" . $class_name . ".class.php");
}); 
?>