<?php 
session_start();


echo '<pre>';

print_r($_SESSION['profile']);
echo '</pre>';
$img=$_SESSION['profile']['img'];
echo "img  <a href='./uploads/$img'>img</a>";



?>