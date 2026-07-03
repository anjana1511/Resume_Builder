<?php
session_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]!=true)
{
    header("location: ../../Auth/login.php");
    exit;

} 
require_once "../../config/config.php";
  
$mail=$_SESSION['email'];
$id=$_SESSION["id"];
$username=$_SESSION["username"];
  //  include 'header.php';


            $sel="select * from users join per_info on users.user_id=per_info.user_id where users.name='$username' and users.email='$mail'";
            $res=mysqli_query($conn,$sel);
            $row=mysqli_fetch_array($res);
           // include "menubar.php";
            ?>
<br>
<div class="submenu">
<a><button  class="button button-a" onClick="PrintDiv();"><i class="fa fa-print"></i> Print</button></a>
<a><button  class="button button-a" ><i class="fa fa-print"></i>Save as Pdf</button></a>
<div class="submenu-right">
<a href="../../resume/home.php"><button  class="button button-a"><i class="fa fa-backward"></i> Back</button></a></div>
</div>
<!-- <button class="btn btn-success"  onClick="PrintDiv();"><i class="fa fa-print"></i> Print</button> -->
<div class="resume-main">
   <div id="print" class="page">
            <link href="../../assets/css/style.css"  media='screen,print' rel="stylesheet">
              <link href="../../assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">