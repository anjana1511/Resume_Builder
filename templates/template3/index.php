<?php
session_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]!=true)
{
    header("location: login.php");
    exit;

} 
require_once "../../config/config.php";
  
$mail=$_SESSION['email'];
$id=$_SESSION["id"];
$username=$_SESSION["username"];
//    include 'header.php';


                        $sel="select * from users join per_info on users.user_id=per_info.user_id where users.name='$username' and users.email='$mail'";
            $res=mysqli_query($conn,$sel);
            $row=mysqli_fetch_array($res);
            ?>
<body>
<br>
<div class="submenu">
                  	<a><button  class="button button-a" onClick="PrintDiv();"><i class="fa fa-print"></i> Print</button></a>
				<div class="submenu-right">
                  <a href="home.php"><button  class="button button-a"><i class="fa fa-backward"></i> Back</button></a></div>
                  </div>
<div id="print" class="page">
		<link rel="stylesheet" type="text/css" href="../../assets/css/resume3.css">
		<link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
		<link href="../../assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<div class="resume-box">

    <!-- LEFT SECTION -->
    <div class="left-section">

        <img src="../../image/users/<?php echo (!empty($row['image'])) ? $row['image'] : 'user.jpg'; ?>" class="profile-img">

        <h1 class="name">
            <?php echo $row['fname']; ?><br>
            <span><?php echo $row['lname']; ?></span>
        </h1>

        <div class="profession">
            <?php echo $row['profession']; ?>
        </div>

        <!-- CONTACT -->
        <div class="section-title">Contact</div>

        <div class="contact-item">
            📞 <?php echo $row['mono']; ?>
        </div>

        <div class="contact-item">
			
            ✉ <?php echo $row['email']; ?>
        </div>

        <div class="contact-item">
			<p class="p1">
            📍 <span><?php echo $row['address']; ?></span></p>
        </div>

        <!-- PERSONAL INFO -->
        <div class="section-title">Personal Info</div>

        <div class="contact-item">
            DOB : <?php echo $row['dob']; ?>
        </div>

        <div class="contact-item">
            Gender : <?php echo $row['gender']; ?>
        </div>
<div class="section-title">Languages</div>

<?php
$lang=mysqli_query($conn,"SELECT * FROM languages WHERE user_id=$id");

while($lg=mysqli_fetch_assoc($lang))
{
    switch($lg['level'])
    {
        case 'Beginner': $width=25; break;
        case 'Intermediate': $width=50; break;
        case 'Advanced': $width=75; break;
        case 'Native': $width=100; break;
        default: $width=25;
    }
?>
    <div class="lang-box">
        <p><?php echo $lg['lname']; ?></p>

        <div class="progress">
            <div class="progress-fill"
                 style="width:<?php echo $width; ?>%">
            </div>
        </div>
    </div>
<?php } ?>


    </div>

    <!-- RIGHT SECTION -->
    <div class="right-section">

        <!-- SUMMARY -->
        <?php
        $summary=mysqli_query($conn,"SELECT * FROM summary WHERE user_id=$id");
        if(mysqli_num_rows($summary)>0){
            $srow=mysqli_fetch_assoc($summary);
        ?>
        <div class="right-title">Profile</div>
        <p><?php echo $srow['summary']; ?></p>
        <?php } ?>

        <!-- EXPERIENCE -->
        <?php
        $exp=mysqli_query($conn,"SELECT * FROM exe_info WHERE user_id=$id");
        if(mysqli_num_rows($exp)>0){
        ?>
        <div class="right-title">Experience</div>

        <?php while($erow=mysqli_fetch_assoc($exp)){ ?>
        <div class="timeline">
            <h4><?php echo $erow['position']; ?></h4>
            <small>
                <?php echo $erow['jdate']; ?>
                -
                <?php echo $erow['edate']; ?>
            </small>
            <p><?php echo $erow['company_name']; ?></p>
            <p><?php echo $erow['work']; ?></p>
        </div>
        <?php } } ?>

        <!-- EDUCATION -->
        <?php
        $edu=mysqli_query($conn,"SELECT * FROM edu_info WHERE user_id=$id");
        if(mysqli_num_rows($edu)>0){
        ?>
        <div class="right-title">Education</div>

        <?php while($ed=mysqli_fetch_assoc($edu)){ ?>
        <div class="timeline">
            <h4><?php echo $ed['qualification']; ?></h4>
            <small><?php echo $ed['passyear']; ?></small>
            <p><?php echo $ed['board']; ?></p>
            <p><?php echo $ed['per'].' '.$ed['rtype']; ?></p>
        </div>
        <?php } } ?>

        <!-- CERTIFICATES -->
        <?php
        $cert=mysqli_query($conn,"SELECT * FROM add_cer WHERE user_id=$id");
        if(mysqli_num_rows($cert)>0){
        ?>
        <div class="right-title">Certificates</div>

        <?php while($cr=mysqli_fetch_assoc($cert)){ ?>
        <div class="timeline">
            <h4><?php echo $cr['cname']; ?></h4>
            <p><?php echo $cr['cdetails']; ?></p>
        </div>
        <?php } } ?>

        <!-- SKILLS -->
        <?php
        $skills=mysqli_query($conn,"SELECT * FROM skills WHERE user_id=$id");
        if(mysqli_num_rows($skills)>0){
        ?>
        <div class="right-title">Skills</div>

        <?php while($sk=mysqli_fetch_assoc($skills)){ ?>
		       <span class="hobby-tag">
				<?php echo $sk['skill']; ?>
              </span>
       <?php } } ?>



        <!-- HOBBIES -->
        <?php if(!empty($row['hobbies'])){ ?>
        <div class="right-title">Hobbies</div>

        <?php
        $hobbies = explode(',', $row['hobbies']);

        foreach($hobbies as $hob){
        ?>
            <span class="hobby-tag">
                <?php echo trim($hob); ?>
            </span>
        <?php } } ?>

    </div>

</div>


	</div>
</div>
<!-- <button class="btn btn-success"  onClick="PrintDiv();"><i class="fa fa-print"></i> Print</button> -->
 
</body>
<script type="text/javascript">     
          function PrintDiv() {    
           var divToPrint = document.getElementById('print');
           var popupWin = window.open('', '_blank');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
     </script>
</html>