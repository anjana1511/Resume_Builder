<?php
// include '../print_header.php';

// Agar future me database se template select karna ho
$template = "modern";
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Resume</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../assets/fontawesome/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Main CSS -->
    <link rel="stylesheet" href="templates/<?php echo $template; ?>/style.css">

    <!-- Print CSS -->
    <link rel="stylesheet" href="templates/<?php echo $template; ?>/print.css" media="print">

</head>

<body>

<div class="resume-container">

    <!-- LEFT SIDEBAR -->

    <aside class="left-side">

        <?php include "components/sidebar.php"; ?>

    </aside>



    <!-- RIGHT CONTENT -->

    <main class="right-side">

        <?php include "components/profile.php"; ?>

        <?php include "components/experience.php"; ?>

        <?php include "components/education.php"; ?>

        <?php include "components/projects.php"; ?>

        <?php include "components/certificates.php"; ?>

        <?php include "components/achievements.php"; ?>

        <?php include "components/references.php"; ?>

    </main>

</div>

<script src="resume.js"></script>

</body>
</html>

<?php
// include '../print_footer.php';
?>