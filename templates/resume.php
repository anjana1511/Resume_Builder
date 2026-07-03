<?php
include 'resume_data.php';

$category = $_GET['category'];
$template = $_GET['template'];
// echo $category;
// echo $template;
// exit;

include $category.'/functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Resume</title>

<link href="<?php echo BASE_URL; ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo $category.'/'.$template; ?>/style.css">
                              <!-- echo $category.'/'.$template.'.css'; -->
<link rel="stylesheet" href="<?php echo $category.'/'.$template; ?>/print.css" media="print">

</head>

<body>

<div class="resume-container">

    <!--=============================
            LEFT SIDEBAR
    ==============================-->

    <aside class="left-side">

        <div class="sidebar">

            <div class="profile-box">
                <img src="../image/users/<?php if(!isset($row['image']) && empty($row['image']))
              { echo "user.jpg"; } echo $row['image'] ?>" class="profile-img" alt="Profile">

                <h2 class="name">
                    <?php echo $row["lname"];  ?> <span><?php echo $row["fname"];  ?></span>
                </h2>

                <p class="designation">
                    <?php echo $row["profession"]; ?>
                </p>

            </div>

            <div class="sidebar-section">

                <h3>Contact</h3>
                <div class="contact-item">
                    <i class="bi bi-telephone-fill"></i>
                    <span><?php echo $row["mono"]; ?></span>                   
                </div>
                <div class="contact-item">
                    <i class="bi bi-envelope-fill"></i>
                    <span><?php echo $row["email"]; ?></span>
                </div>
                <div class="contact-item">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span><?php echo $row["address"]; ?></span>
                </div>

            </div> <!-- end contact sidebar  -->

            <div class="sidebar-section">

                <h3>Skills</h3>
                <?php while($skill=mysqli_fetch_array($skill_query)){ ?>


                 <?= renderSkill($skill['skill'],$skill['rate'],$template); ?>

                <?php        } //end while loop for skills ?>

            </div><!-- end skill section side bar -->

            <div class="sidebar-section">

                <h3>Languages</h3>
                <?php while($lang=mysqli_fetch_array($lang_query)){ ?>
                

                 <?= renderLanguage($lang["lname"],$lang['level'],$template); ?>


                <?php    } //end while laguage ?> 

            </div> <!-- end laguages -->

            <div class="sidebar-section">

                <h3>Interests</h3>
             <div class="interest-item">
                  <?php renderInterest($row["hobbies"]); ?>
            </div>


            </div> <!-- end hobbies -->

        </div>
    </aside>   <!-- end left side  -->



    <!--=============================
            RIGHT SIDE
    ==============================-->

    <main class="right-side">

           <section class="resume-section">

                <h2>Profile</h2>
                 
                <p>
                    <?php  echo $summary["career_objective"]; ?>
               </p>    
            </section> <!-- end resume profile -->

        <?php  if(mysqli_num_rows($exp_query) > 0){ ?>
            <section class="resume-section">

                <h2>Experience</h2>
               <?php while($experience = mysqli_fetch_assoc($exp_query)){ ?>
 
                <div class="timeline">

                    <h4><?php echo $experience['position']; ?></h4>

                    <span><?php echo $experience['company_name']; ?>
                     | <?php echo $experience['jdate']." to ".$experience['edate'] ?></span>

                    <p>
                        <?php echo $experience['work']; ?>
                    </p>

                </div> <!-- end timeline ->
               <?php  } ?> 

            </section><!-- end resume experience -->
        <?php } 

        if(mysqli_num_rows($edu_query) > 0){ ?>
        
            <section class="resume-section">

                <h2>Education</h2>
              <?php  while($education=mysqli_fetch_assoc($edu_query)){  ?>  
                <div class="timeline">
                    <h4><?php echo $education['qualification']; ?></h4>

                    <span><?php echo $education['board']; ?> <br> 
                    <?php echo $education['passyear']; ?>
                    | within : <?php echo $education['per']; ?> %</span>

               </div> <!-- end timeline -->
              <?php } ?>

            </section><!-- end resume profile -->
        <?php }     
            if(mysqli_num_rows($cer_query)>0){ ?>
            <section class="resume-section">

                <h2>Certificates</h2>
                <?php while($cer=mysqli_fetch_assoc($cer_query)){ ?>
                <div class="timeline">
                        <h4><?php echo $cer['cname']; ?></h4>
                        <span><?php echo $cer['cdetails']; ?></span>
                </div>
                <?php } ?>

            </section><!-- end resume profile -->
         <?php } ?>
            

        </main><!-- end right side -->
 

</div>  <!--  end resume-container -->

<script src="resume.js"></script>

</body>

</html>

<?php

// include '../print_footer.php';

?>