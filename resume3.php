<?php
session_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]!=true)
{
    header("location: login.php");
    exit;

} 
require_once "config.php";
  
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
		<link rel="stylesheet" type="text/css" href="assets/css/resume3.css">
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<div class="resume-box">
	<div class="left-section">
		<div class="profile">
			<img src="image/users/<?php if(!isset($row['image']) && empty($row['image']))
              { echo "user.jpg"; } echo $row['image'] ?>" class="profile-img">
			<div class="blue-box"></div>
		</div>
		<h2 class="name"><?php if(!isset($row['lname']) && empty($row['lname']))
              { echo "Aditya"; } echo $row['lname']; ?> <br> <span><?php if(!isset($row['fname']) && empty($row['fname']))
              { echo "Rathod"; } echo $row['fname'] ?></span></h2>
		<p class="n-p"><?php if(!isset($row['profession']) && empty($row['profession'])){echo "Developer";} echo $row['profession'] ?></p>

		<div class="info">
			<p class="heading">Contact Info</p>
			<p class="p1"><span class="span1"><img src="assets/img/location.png"></span>Address<span><br><?php if(!isset($row['address']) && empty($row['address'])){echo "Station Road Surat";} echo $row['address']; ?></span></p>
			<p class="p1"><span class="span1"><img src="assets/img/call.png"></span>Phone<span><br><?php if(!isset($row['mono']) && empty($row['mono'])){echo "9999999999";} echo $row['mono']; ?></span></p>
			<p class="p1"><span class="span1"><img src="assets/img/mail.png"></span>Email<span><br><?php if(!isset($row['email']) && empty($row['email'])){echo "adi@example.com";} echo $row['email']; ?></span></p>
			
		</div>
			<div class="info">
			<p class="heading">Persional Info</p>
			<p class="p1"><span class="span1"><img src="assets/img/location.png"></span>Date Of Birth<span><br><?php if(!isset($row['dob']) && empty($row['dob'])){echo "15-11-1997";} echo $row['dob'] ?></span></p>
			<p class="p1"><span class="span1"><img src="assets/img/call.png"></span>Gender<span><br><?php if(!isset($row['gender']) && empty($row['gender'])){echo "Male";} echo $row['gender'] ?></span></p>
		  </div>

		<div class="info">
			<p class="heading">SKILL AND EXPERTIZE</p>

			<?php
                            $qur=mysqli_query($conn,"SELECT * FROM skills where user_id=$id");
							if(mysqli_num_rows($qur) == 0){
								?>
	
	            <p class="p1">HTML</p>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
			    <?php $qow['rate']="4";
				for($i=1;$i<=5;$i++) {
                  $selected = 'circle1'; 
                  if(!empty($qow['rate']) && $i<=$qow['rate']) {
              $selected = 'circle';
              }
             ?>
           <span class="fa fa-circle <?php echo $selected;?>"></span>         
								<?php } } else {
               while($qow=mysqli_fetch_array($qur,MYSQLI_ASSOC))
               {  ?>
               	        <p class="p1"><?php echo $qow['skill'] ?></p>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
			    <?php for($i=1;$i<=5;$i++) {
                  $selected = 'circle1'; 
                  if(!empty($qow['rate']) && $i<=$qow['rate']) {
              $selected = 'circle';
              }
             ?>
           <span class="fa fa-circle <?php echo $selected;?>"></span>         
		   <!-- <div id="progress" style='height:8px;width: //echo $qow['rate']; %'></div> -->
        <?php } } }?>
    </div>

	
	<div class="info">
			<p class="heading">language Known</p>

			<?php
                            $qur=mysqli_query($conn,"SELECT * FROM languages where user_id=$id"); 
						
							if(mysqli_num_rows($qur)== 0 )
							{
							?>		
							<p class="p1">English</p>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
							<div class="s-box1">
							<div class='w3-light-grey w3-round-xlarge'>
			   <div class='w3-round-xlarge w3-teal' style='height:8px;width:20%'></div>
			 </div></div>
				<?php } else {
							while($qow=mysqli_fetch_array($qur,MYSQLI_ASSOC))
               {  ?>
               	        <p class="p1"><?php echo $qow['lname'] ?></p>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
						   <div class="s-box1">
						   <div class='w3-light-grey w3-round-xlarge'>
              <div class='w3-round-xlarge w3-teal' style='height:8px;width:<?php echo $qow['rate']; ?>%'></div>
            </div></div>
        <?php } } ?>
    </div>

	</div>

	<div class="right-section">
		<div class="right-heading">
			<img src="assets/img/user.png">
			<p class="p2">Profile</p>

		</div>
		<?php
                            $qur=mysqli_query($conn,"SELECT * FROM summary where user_id=$id");
							if(mysqli_num_rows($qur) == 0){
								?>

		<p class="p3">
		         Seeking a responsible career in an organization where I can utilize my skills, 
		 knowledge to work at my level best.To grow with the organization and deliver
		 best possible services.Work hard to achieve the corporate targets and goals keeping in view the corporate
		 mission and vision.
			</p>
		<div class="clearfix"></div>
           <?php } else {
		      while($show=mysqli_fetch_array($qur,MYSQLI_ASSOC))
			  {
		   ?>
		<p class="p3">
               <?php echo $show["summary"]; ?>
			</p>
		<div class="clearfix"></div>
		<?php } } ?>
		<br><br>
		<div class="right-heading">
			<img src="assets/img/pencil.png">
			<p class="p2">Work Experience</p>
		</div>
		<div class="clearfix"></div>

		<?php 
      
      $qur=mysqli_query($conn,"SELECT * FROM exe_info where user_id=$id"); 
	  if(mysqli_num_rows($qur)== 0)
      {
      ?>
	  <div class="lr-box">
	  <div class="left">
		  <p class="p4">Dec 2020- Jun 2022</p>
		  <p class="p5">Surat</p>
	  </div>
	  <div class="right">
		  <p class="p4">Senior Developer</p>
		  <p class="p5">TATA</p>
		  <p class="p5">Implement code based on project specifications.
Create new tables within MySQL.
Test and document code.
Provide feedback to the development group to improve Agile Project management methods.</p>
		  <hr />
	  </div>
	  <div class="clearfix"></div>
  </div>
  <?php } else {
          while($qow=mysqli_fetch_array($qur,MYSQLI_ASSOC))
        {
      ?>
		<div class="lr-box">
			<div class="left">
				<p class="p4"><?php echo $qow['jdate']."-".$qow['edate'] ?></p>
				<p class="p5"><?php echo $qow['city']; ?></p>
			</div>
			<div class="right">
				<p class="p4"><?php echo $qow['position'] ?></p>
				<p class="p5"><?php echo $qow['company_name'] ?></p>
				<p class="p5"><?php echo $qow['work'] ?></p>
				<hr />
			</div>
			<div class="clearfix"></div>
		</div>
		<?php } } ?>


		<div class="right-heading">
			<img src="assets/img/edu.png">
			<p class="p2">Education</p>
		</div>
		<div class="clearfix"></div>
		<?php 
      $qu=mysqli_query($conn,"SELECT * FROM edu_info where user_id=$id"); 
	  if(mysqli_num_rows($qu)== 0)
      {
     ?>
	 		<div class="lr-box">
			<div class="left">
				<p class="p4">2015-2018</p>
				
			</div>
			<div class="right">
				<p class="p4">Master Degree</p>
				<p class="p5">London Business School</p>
				<hr />
			</div>
			<div class="clearfix"></div>

			<div class="lr-box">
			<div class="left">
				<p class="p4">2010-2013</p>
				
			</div>
			<div class="right">
				<p class="p4">Bachelor Degree</p>
				<p class="p5">School of Coding</p>
				<hr />
			</div>
			<div class="clearfix"></div>
		</div>
	 <?php } else {
          while($qo=mysqli_fetch_array($qu,MYSQLI_ASSOC))
        {
      ?>
		<div class="lr-box">
			<div class="left">
				<p class="p4"><?php echo $qo['passyear']; ?></p>
				<p class="p5"><?php echo $qo['city']; ?></p>
			</div>
			<div class="right">
				<p class="p4"><?php echo $qo['qualification']; ?></p>
				<p class="p5"><?php echo $qo['board']; ?></p>
				<p class="p5"><?php echo $qo['per']." ".$qo['rtype']; ?></p>
				<hr />
			</div>
			<div class="clearfix"></div>
		</div>
		<?php } } ?>


		<div class="right-heading">
			<img src="assets/img/skill.png">
			<p class="p2">Additional Certificate</p>
		</div>
		<?php
		    $cqu=mysqli_query($conn,"SELECT * FROM add_cer where user_id=$id"); 
			if(mysqli_num_rows($cqu)== 0)
			{
		  ?>
		   		<div class="lr-box">
			<div class="left">
			<p class="p4">W3Schools.com</p>
			</div>
			<div class="right">
				<p class="p5">Web Development! All I need to know in one place</p>
				<hr />
			</div> 
			<div class="clearfix"></div>
		  <?php } else {
			 while($cer=mysqli_fetch_array($cqu,MYSQLI_ASSOC))
		 {
		?>
		<div class="lr-box">
			<div class="left">
			<p class="p4"><?php echo $cer['cname']; ?></p>
			</div>
			<div class="right">
				<p class="p5"><?php echo $cer['cdetails']; ?></p>
				<hr />
			</div> 
			<div class="clearfix"></div>
		 </div> <?php } } ?>	
 
		<br>
		<div class="right-heading">
			<img src="assets/img/hobbies.png">
			<p class="p2">Hobby &  Internet</p>
		</div>
		<div class="clearfix"></div>
		<?php if(!isset($row['hobbies']) && empty($row['hobbies'])){echo "Drive";} echo $row['hobbies'] ?>
		 <!-- <img src="image/bicycle.png" class="h-img">
		<img src="image/games.png" class="h-img">
		<img src="image/book.png" class="h-img">
		<img src="image/design.png" class="h-img">
		<img src="image/chess.png" class="h-img"> -->

	</div>


	<div class="clearfix"></div>
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