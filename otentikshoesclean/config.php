<?php

$server = "localhost";
$username = "otentik_user";
$password = "password";
$database = "otentikshoesclean";

$conn = mysqli_connect($server,$username,$password,$database);

if(!$conn){
    die("<script>alert('connection Failed.')</script>");
}
// else{
//     echo "<script>alert('connection successfully.')</script>";
// }
?>