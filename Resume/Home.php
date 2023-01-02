<?php
session_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]!=true)
{
    header("location: login.php");
    exit;

} 
require_once "config.php";
  
$mail=$_SESSION['email'];

   include 'header.php';


                        $sel="select * from users join per_info on users.user_id=per_info.user_id where users.name='$username' and users.email='$mail'";
            $res=mysqli_query($conn,$sel);
            $row=mysqli_fetch_array($res);
            ?>
<div id="print" class="page">
              <link href="assets/css/resume1.css"  media='screen,print' rel="stylesheet">
              <link href="assets/css/style.css"  media='screen,print' rel="stylesheet">
  <div class='w3-content w3-margin-top' style='max-width:1400px;'>

    <!-- The Grid -->
    <div class='w3-row-padding'>
    
      <!-- Left Column -->
      <div class='w3-third'>
      
        <div class='w3-white w3-text-grey w3-card-4'>
          <div class='w3-display-container'>
                             <!-- <img src='assets/img/myphoto.jpg' class='img-fluid rounded b-shadow-a' alt=''> -->
                   
            <img src='image/users/<?php echo $row['image'] ?>' style='width:100%' alt='Avatar'>
            <div class='w3-display-bottomleft w3-container w3-text-black'>
              <h2><?php echo $row['name']; ?></h2>
            </div>
          </div>
          <div class='w3-container'>
            <p><i class='fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal'></i>Designer</p>
            <p><i class='fa fa-home fa-fw w3-margin-right w3-large w3-text-teal'></i><?php echo $row['address']; ?></p>
            <p><i class='fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal'></i><?php echo $row['email']; ?></p>
            <p><i class='fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal'></i><?php echo $row['mono']; ?></p>
            <hr>

            <p class='w3-large'><b><i class='fa fa-asterisk fa-fw w3-margin-right w3-text-teal'></i>Skills</b></p>
              <table class='demo-table'>
             <tbody>
                  <?php 

                     $id=$_SESSION['id'];
             $sel1="SELECT * FROM skills WHERE user_id=$id" ;
           $qur=mysqli_query($conn,$sel1);
           while($row1=mysqli_fetch_array($qur,MYSQLI_ASSOC))
           {
                 ?>

            <tr>
          <td valign='top'>
        
            <p><?php echo $row1['skill']; ?></p>
              <ul>
              <?php
              for($i=1;$i<=5;$i++) {
              $selected = '';
              if(!empty($row1['rate']) && $i<=$row1['rate']) {
              $selected = 'selected';
              }
              ?>
              <li class="<?php echo $selected;?>" >&#9733;</li>  
              <?php 
              } //for  ?>
            <ul></td></tr>
           
           <?php } ?>  </table>
           
            <br>

            <p class='w3-large w3-text-theme'><b><i class='fa fa-globe fa-fw w3-margin-right w3-text-teal'></i>Languages[not users ]</b></p>
            <p>English</p>
            <div class='w3-light-grey w3-round-xlarge'>
              <div class='w3-round-xlarge w3-teal' style='height:24px;width:100%'></div>
            </div>
            <p>Spanish</p>
            <div class='w3-light-grey w3-round-xlarge'>
              <div class='w3-round-xlarge w3-teal' style='height:24px;width:55%'></div>
            </div>
            <p>German</p>
            <div class='w3-light-grey w3-round-xlarge'>
              <div class='w3-round-xlarge w3-teal' style='height:24px;width:25%'></div>
            </div>
            <br>
          </div>
        </div><br>

      <!-- End Left Column -->
      </div>

      <!-- Right Column -->
      <div class='w3-twothird'>
      <!-- Start work experience -->
      
        <div class='w3-container w3-card w3-white w3-margin-bottom'>
          <h2 class='w3-text-grey w3-padding-16'><i class='fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal'></i>Work Experience</h2>
          <?php 
      
      $qur=mysqli_query($conn,"SELECT * FROM exe_info where user_id=$id"); 
          while($qow=mysqli_fetch_array($qur,MYSQLI_ASSOC))
        {
      ?>
      <div class='w3-container'>
       
            <h5 class='w3-opacity'><b><?php echo $qow['position']; ?> / <?php echo $qow['company_name']; ?></b></h5>
            <h6 class='w3-text-teal'><i class='fa fa-calendar fa-fw w3-margin-right'></i><?php echo $qow['duration']; ?> <!--<span class='w3-tag w3-teal w3-round'>Current</span> --></h6>
            <p><?php echo $qow['work']; ?></p>
            <hr>
          </div>
        <?php } ?>
      </div> 
  <!-- End work experience -->
      <!-- Education -->
        <div class='w3-container w3-card w3-white'>
          <h2 class='w3-text-grey w3-padding-16'><i class='fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal'></i>Education</h2>
      <?php 
      $qu=mysqli_query($conn,"SELECT * FROM edu_info where user_id=$id"); 
          while($qo=mysqli_fetch_array($qu,MYSQLI_ASSOC))
        {
      ?>
          <div class='w3-container'>
            <h5 class='w3-opacity'><b><?php echo $qo['qualification'] ?></b></h5>
            <h6 class='w3-text-teal'><i class='fa fa-calendar fa-fw w3-margin-right'></i><?php echo $qo['passyear']; ?></h6>
            <p><?php echo $qo['board']; ?></p><p><?php echo $qo['per']; ?>&nbsp;<?php echo $qo['rtype']; ?></p>
        
        <hr>
          </div>
        <?php } ?>

        </div>
      
       <div class='w3-container w3-card w3-white'>
          <h2 class='w3-text-grey w3-padding-16'><i class='fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal'></i>Additional Certificate</h2>
      <?php 
      $cqu=mysqli_query($conn,"SELECT * FROM add_cer where user_id=$id"); 
          while($cer=mysqli_fetch_array($cqu,MYSQLI_ASSOC))
        {
      ?>
          <div class='w3-container'>
            <h5 class='w3-opacity'><b><?php echo $cer['cname'] ?></b></h5>
            <h6 class='w3-text-teal'><i class='fa fa-calendar fa-fw w3-margin-right'></i>2020</h6>
            <p><?php echo $qo['cdetails']; ?></p>
        
        <hr>
          </div>
        <?php } ?>

        </div>


      </div>    <!-- End Right Column -->
    
      
    <!-- End Grid -->
    </div>
    
    <!-- End Page Container -->
  </div>
</div>
<button class="btn btn-success"  onClick="PrintDiv();"><i class="fa fa-print"></i> Print</button>
   <?php
include 'footer.php';
 ?>
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
?>