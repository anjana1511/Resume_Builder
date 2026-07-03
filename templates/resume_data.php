<?php
session_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]!=true)
{
    header("location: ../../Auth/login.php");
    exit;

} 

require_once "../config/config.php";
  
$mail=$_SESSION['email'];
$id=$_SESSION["id"];
$username=$_SESSION["username"];


$sel="select * from users join per_info on users.user_id=per_info.user_id where users.name='$username' and users.email='$mail'";
$res=mysqli_query($conn,$sel);
$row=mysqli_fetch_array($res);

//  Skills
$skill_query = mysqli_query($conn,"SELECT * FROM skills WHERE user_id='$id'");


//languages
$lang_query = mysqli_query($conn," SELECT * FROM languages WHERE user_id='$id'");

//summary, career_objective
$summary_query = mysqli_query($conn,"SELECT * FROM summary WHERE user_id='$id'");
$summary=mysqli_fetch_array($summary_query);
//education
$edu_query = mysqli_query($conn,"SELECT * FROM edu_info WHERE user_id='$id'");

//experince
$exp_query = mysqli_query($conn,"SELECT * FROM exe_info WHERE user_id='$id'");


//add certificate
$cer_query = mysqli_query($conn,"SELECT * FROM add_cer WHERE user_id='$id'");


?>