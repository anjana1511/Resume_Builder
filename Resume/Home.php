<?php
session_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]!=true)
{
    header("location: ../Auth/login.php");
    exit;

} 
require_once "../config/config.php";
  
$mail=$_SESSION['email'];

include ROOT_PATH.'includes/header.php';
   
?>
<!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Resume Design</h2>
        <p>Pic anyone you want</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-modern">Modern</li>
            <li data-filter=".filter-product">Product</li>
            <li data-filter=".filter-branding">Branding</li>
            <li data-filter=".filter-books">Books</li>
          </ul><!-- End Portfolio Filters -->

          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
              <?php
              $categories = ['modern', 'minimal'];

              foreach ($categories as $category) {

                  $dir = "../templates/" . $category;

                  if (!is_dir($dir)) {
                      continue;
                  }

                  $templates = scandir($dir);
              
     
                  foreach ($templates as $temp) {

                      if ($temp == "." || $temp == "..") {
                          continue;
                      }

                  //     // Sirf folders hi lena
                      if (!is_dir($dir . "/" . $temp)) {
                          continue;
                      }
              ?>
            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-<?php echo $category; ?>">
              <img src="<?php echo BASE_URL; ?>/templates/<?php echo $category; ?>/<?php echo $temp; ?>/preview.png" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><?php echo ucfirst($category); ?> Resume</h4>
                <p><?php echo ucfirst($category); ?> Resume Template</p>
                <a href="<?php echo BASE_URL; ?>/templates/<?php echo $category; ?>/<?php echo $temp; ?>/preview.png" 
                title="App 1" data-gallery="portfolio-gallery-<?php echo $category; ?>" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="<?php echo BASE_URL; ?>/templates/resume.php?category=<?php echo $category; ?>&template=<?php echo $temp;?>" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div><!-- End Portfolio Item -->
<?php
    }
}
?>
          </div><!-- End Portfolio Container -->

        </div>

      </div>

    </section><!-- /Portfolio Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Have any questions?
            Feel free to contact us using the form below.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="info-wrap" data-aos="fade-up" data-aos-delay="200">
          <div class="row gy-5">

            <div class="col-lg-4">
              <div class="info-item d-flex align-items-center">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h3>Address</h3>
                  <p>A108 Adam Street, New York, NY 535022</p>
                </div>
              </div>
            </div><!-- End Info Item -->

            <div class="col-lg-4">
              <div class="info-item d-flex align-items-center">
                <i class="bi bi-telephone flex-shrink-0"></i>
                <div>
                  <h3>Call Us</h3>
                  <p>+1 5589 55488 55</p>
                </div>
              </div>
            </div><!-- End Info Item -->

            <div class="col-lg-4">
              <div class="info-item d-flex align-items-center">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h3>Email Us</h3>
                  <p>info@example.com</p>
                </div>
              </div>
            </div><!-- End Info Item -->

          </div>
        </div>

        <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="300">
          <div class="row gy-4">

            <div class="col-md-6">
              <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
            </div>

            <div class="col-md-6 ">
              <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
            </div>

            <div class="col-md-12">
              <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
            </div>

            <div class="col-md-12">
              <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
            </div>

            <div class="col-md-12 text-center">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>

              <button type="submit">Send Message</button>
            </div>

          </div>
        </form><!-- End Contact Form -->

      </div>

    </section><!-- /Contact Section -->

<?php
include ROOT_PATH.'includes/footer.php';
 ?>
