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

<div class="header">

<img src="../../image/users/<?php echo $row['image']; ?>" class="photo">

<h1><?php echo $row['name']; ?></h1>

<p>
<?php echo $row['email']; ?> |
<?php echo $row['mono']; ?>
</p>

</div>


<div class="section">

<h2>Career Objective</h2>

<p>
Motivated fresher looking for opportunity to apply my knowledge and grow professionally.
</p>

</div>


<div class="section">

<h2>Skills</h2>

<ul>

<?php
$skills=mysqli_query($conn,"SELECT * FROM skills WHERE user_id=$id");

while($s=mysqli_fetch_array($skills)){
?>

<li><?php echo $s['skill']; ?></li>

<?php } ?>

</ul>

</div>


<div class="section">

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

</div>


<div class="section">

<h2>Projects</h2>

<p>Resume Builder System</p>

</div>


<div class="section">

<h2>Languages</h2>

<p>English</p>

<p>Gujarati</p>

</div>

</div>