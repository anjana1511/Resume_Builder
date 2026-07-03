<?php
// session_start();

// require_once "../../config/config.php";
include '../resume_data.php';  
$mail=$_SESSION['email'];
$id=$_SESSION["id"];
$username=$_SESSION["username"];
  //  include 'header.php';


                        $sel="select * from users join per_info on users.user_id=per_info.user_id where users.name='$username' and users.email='$mail'";
            $res=mysqli_query($conn,$sel);
            $row=mysqli_fetch_array($res);
           // include "menubar.php";
// include ROOT_PATH."includes/header.php";
?>

<link rel="stylesheet" href="style.css">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Sidebar Resume</title>

    <link rel="stylesheet" href="sidebar.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>

<div class="resume">

    <!-- LEFT SIDE -->
    <aside class="left-side">

        <!-- Profile -->
        <div class="profile">

            <img src="../../uploads/<?php echo $row['photo']; ?>" class="profile-img">

            <h1>
                <?php echo strtoupper($row['fname']); ?><br>
                <?php echo strtoupper($row['lname']); ?>
            </h1>

            <p class="designation">
                <?php echo $row['jobtitle']; ?>
            </p>

        </div>


        <!-- Contact -->

        <div class="left-box">

            <h2>CONTACT</h2>

            <?php renderContact($row); ?>

        </div>


        <!-- About -->

        <div class="left-box">

            <h2>ABOUT ME</h2>

            <p class="about-text">
                <?php echo nl2br($row['about']); ?>
            </p>

        </div>



        <!-- Skills -->

        <div class="left-box">

            <h2>SKILLS</h2>

            <?php renderSkill($skillResult); ?>

        </div>

    </aside>



    <!-- RIGHT SIDE -->

    <section class="right-side">


        <!-- Education -->

        <div class="section">

            <div class="section-title">

                <h2>EDUCATION</h2>

            </div>

            <?php renderEducation($educationResult); ?>

        </div>



        <!-- Additional Certificates -->

        <div class="section">

            <div class="section-title">

                <h2>ADDITIONAL CERTIFICATES</h2>

            </div>

            <?php renderCertificate($certificateResult); ?>

        </div>




        <!-- Experience -->

        <div class="section">

            <div class="section-title">

                <h2>EXPERIENCE</h2>

            </div>

            <?php renderExperience($experienceResult); ?>

        </div>



    </section>

</div>

</body>
</html>