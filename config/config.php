<?php
ob_start(); //Turns on output buffering
session_start();

$timezone = date_default_timezone_set("Europe/Paris");

$con = mysqli_connect("localhost", "root", "", "mspr"); //Connection variable

if(mysqli_connect_errno())
{
    echo "Failed to connect: " . mysqli_connect_errno();
}

?>