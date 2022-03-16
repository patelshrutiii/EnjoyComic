<?php
ob_start();
session_start();
// $con=new mysqli("localhost:3306","root","shruti","rtcampdb");
// if(mysqli_connect_error())
// {
//     die ("connection not found".mysqli_connect_error());

// }


// $server ='remotemysql.com';
// $username='PtbSZ2sYqe';
// $password='Fv8zxkMHs0';
// $dbname='PtbSZ2sYqe';

// $con = mysqli_connect($server,$username,$password,$dbname);
// if(!$con)
// {
//     die("connection failed:".mysqli_connect_error());
// }

$server ='remotemysql.com';
$username='KLLWqYsO7v';
$password='a0v1Pgk8g4';
$dbname='KLLWqYsO7v';

$con = mysqli_connect($server,$username,$password,$dbname);
if(!$con)
{
    die("connection failed:".mysqli_connect_error());
}
error_reporting(0);
?>
