<?php
require_once "config.php";
session_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]!=true)
{
    header("location: login.php");
    exit;
} 

$mail=$_SESSION['email'];

   include 'header_single.php';

                        $sel="select * from users join per_info on users.user_id=per_info.user_id where users.name='$username' and users.email='$mail'";
            $res=mysqli_query($conn,$sel);
            $row=mysqli_fetch_array($res);
            ?> 

<!-- CSS Stylesheet -->
<link rel="stylesheet" type="text/css" href="assets/css/resume.css" />
 
<!--[if lt IE 9]> 
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
 
</head>
<body><br><br>
	<button class="btn btn-success"  onClick="PrintDiv();"><i class="fa fa-print"></i> Print</button>
	<div id="print" class="page">
 <link rel="stylesheet" type="text/css" href="assets/css/resume.css" />
<!-- Begin Wrapper -->
<div id="wrapper">
 
<!-- Begin Content Area -->
<div id="content">
 
<!-- Begin Header -->
<header>
 
<!-- Begin Contact Section -->
<section id="contact-details">
 
<!-- Begin Profile Image Section -->
<div class="header_1">
<img src="assets/img/<?php echo $row['image']; ?>" width="250" height="250" alt="<?php echo $row['name']; ?>" />
</div>
<!-- End Profile Image Section -->
 
<!-- Begin Profile Information Section -->
<div class="header_2">
 
<h1><span><?php echo $row['fname']." ".$row['lname']  ?></span></h1>
<h3><?php echo $row['profession'] ?></h3>
 
<ul class="info_1">
<li class="address"><?php echo $row['address']; ?></li>
</ul>
 
<ul class="info_2">
<li class="phone"><?php echo $row['mono']; ?></li>
<li class="email"><a href="mailto:<?php echo $row['email']; ?>"><?php echo $row['email']; ?></a></li>
</ul>
 
</div>
<!-- End Profile Information Section -->
 
</section>
<!-- End Contact Section -->
 
</header>
<!-- End Header -->
 
<div class="clear">&nbsp;</div>
 
<!-- Begin Profile Section -->
<dl>
<dt>Profile:</dt>
<dd>
 
<section class="summary">
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. 
</section>
 <hr />
</dd>
</dl>
<!-- End Profile Section -->
 
<div class="clear">&nbsp;</div>
 
<!-- Begin Skills Section -->
 
<dl>
<dt>Skills:</dt>
<dd>
 
<section id="skills">
<ul class="list1">
      <?php   $id=$_SESSION['id'];
             $sel1="SELECT * FROM skills WHERE user_id=$id" ;
           $qur=mysqli_query($conn,$sel1);
           while($row1=mysqli_fetch_array($qur,MYSQLI_ASSOC))
           { ?>
<li><?php echo $row1['skill']; ?></li>

<?php
 } ?>
</ul>
 <hr />
</section>
 
</dd>

</dl>

<!-- End Skills Section -->
 
<div class="clear">&nbsp;</div>
<dl>
	<dt>Language Known</dt>
	<dd>
		<section id="skills">
			<ul class="list1">
				<?php
                    $id=$_SESSION['id'];
                    $sel1="SELECT * FROM languages WHERE user_id=$id" ;
         			  $qur=mysqli_query($conn,$sel1);
           				while($row1=mysqli_fetch_array($qur,MYSQLI_ASSOC))
           				{ ?>
						<li><?php echo $row1['lname']; ?></li>

						<?php
						 } ?>
						
			</ul><hr />
		</section>
	</dd>
</dl>
 
 <div class="clear">&nbsp;</div>
<!-- Begin Experience Section -->
<dl>
<dt>Experience:</dt>
 
<dd>
 
<section id="experience">
 
<!-- Position #1 -->
  <?php 
      
      $qur=mysqli_query($conn,"SELECT * FROM exe_info where user_id=$id"); 
          while($qow=mysqli_fetch_array($qur,MYSQLI_ASSOC))
        { ?>
<h2 class="top"><?php echo $qow['position']; ?></h2>
<p class="bus1"><?php echo $qow['company_name'] ?></p>
<p class="time"><?php echo $qow['jdate']."-".$qow['edate']; ?></p>
 
<p>
<?php echo $qow['work']; ?>
</p>
 <hr />
 <?php } ?>
 
</section>
 
</dd>
</dl>
<!-- End Experience Section -->
 
<div class="clear">&nbsp;</div>
 
<!-- Begin Education Section -->
<dl>
<dt>Education:</dt>
<dd>
 
<section id="education">
 <?php 
      $qu=mysqli_query($conn,"SELECT * FROM edu_info where user_id=$id"); 
          while($qo=mysqli_fetch_array($qu,MYSQLI_ASSOC))
        {
      ?>
<p class="bus1"><?php echo $qo['board']; ?></p>
 
<?php echo $qo['qualification'] ?>
<br />
<?php echo $qo['per']." ".$qo['rtype']; ?>
<p class="time"><?php echo $qo['passyear']; ?></p>
<hr />
<?php } ?>
 
</section>
 
</dd>
</dl>
<!-- End Education Section -->
 
<div class="clear">&nbsp;</div>
 
 <!-- Begin Certificate Section -->
<dl>
<dt>Additional Certificate:</dt>
<dd>
 
<section id="education">
 <?php 
$cqu=mysqli_query($conn,"SELECT * FROM add_cer where user_id=$id"); 
          while($cer=mysqli_fetch_array($cqu,MYSQLI_ASSOC))
        {
      ?>
<p class="bus1"><?php echo $cer['cname']; ?></p>
 
<?php echo $cer['cdetails'] ?>
<br />
<p class="time">2020</p>
<hr />
<?php } ?>
 
</section>
 
</dd>
</dl>
<!-- End Education Section -->
 
<div class="clear">&nbsp;</div>


 
</div>
<!-- End Content -->
 
</div>
<!-- End Wrapper -->
 </div> <!-- End Print -->

 <!-- Begin Footer -->
<footer id="footer">
 
<!-- Begin Footer Content -->
<div class="footer_content">
 
<!-- Begin Schema Person -->
  
<ul class="icons_1">
<!--<button class="btn btn-success"  onClick="PrintDiv();"><i class="fa fa-print"></i> Print</button> -->
</ul>
 
<!-- End Schema Person -->
 
</div>
<!-- End Footer Content -->
  
</footer>
<!-- End Footer -->

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

<?php
include 'footer.php';
?>