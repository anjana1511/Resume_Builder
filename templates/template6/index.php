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
<link rel="stylesheet" href="style.css">

<div class="resume">

<!-- LEFT SIDEBAR -->

<div class="left">

<img src="../../image/users/<?php echo $row['image']; ?>" class="photo">

<h2><?php echo $row['name']; ?></h2>

<p><?php echo $row['profession']; ?></p>

<hr>

<h3>Contact</h3>

<p>Email: <?php echo $row['email']; ?></p>
<p>Phone: <?php echo $row['mono']; ?></p>
<p>Address: <?php echo $row['address']; ?></p>

<hr>

<h3>Skills</h3>

<ul>

<?php
$skills=mysqli_query($conn,"SELECT * FROM skills WHERE user_id=$id");

while($s=mysqli_fetch_array($skills)){
?>

<li><?php echo $s['skill']; ?></li>

<?php } ?>

</ul>


<hr>

<h3>Languages</h3>

<?php
$lang=mysqli_query($conn,"SELECT * FROM languages WHERE user_id=$id");

while($l=mysqli_fetch_array($lang)){
?>

<p><?php echo $l['lname']; ?></p>

<?php } ?>

</div>


<!-- RIGHT CONTENT -->

<div class="right">

<h1><?php echo $row['name']; ?></h1>

<h2>Career Objective</h2>

<p>
Motivated fresher seeking an opportunity to apply my skills and grow in a professional environment.
</p>


<h2>Education</h2>

<?php
$edu=mysqli_query($conn,"SELECT * FROM edu_info WHERE user_id=$id");

while($e=mysqli_fetch_array($edu)){
?>

<p>

<b><?php echo $e['qualification']; ?></b>

<?php echo $e['passyear']; ?>

</p>

<?php } ?>


<h2>Projects</h2>

<p>Resume Builder System</p>

<h2>Certificates</h2>

<?php
$cer=mysqli_query($conn,"SELECT * FROM add_cer WHERE user_id=$id");

while($c=mysqli_fetch_array($cer)){
?>

<p>

<b><?php echo $c['cname']; ?></b>

</p>

<p><?php echo $c['cdetails']; ?></p>

<?php } ?>

<h2>Hobbies</h2>

<p><?php echo $row['hobbies']; ?></p>

</div>

</div>