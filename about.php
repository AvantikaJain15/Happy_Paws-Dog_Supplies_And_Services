<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
   header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <style>.about .content p {
           font-size: 1.2rem; 
       }
       .reviews {
           margin-top: 2rem;
       }
       .footer {
           margin-top: 4rem; 
       }
   </style>

</head>
<body>  
<?php include 'header.php'; ?>
<div class="heading">
   <h3>about us</h3>
   <p> <a href="home.php">home</a> / about </p>
</div>
<section class="about">
   <div class="flex">
      <div class="image">
         <img src="images/a.jpg" alt="">
      </div>
      <div class="content">
         <h3>Also!!</h3>         
             <p>We provide comprehensive medical services for dogs, including:
         <ul>
            <li>Vaccinations</li>
            <li>Regular health check-ups</li>
            <li>Emergency care</li>
            <li>Surgical procedures</li>
            <li>Dental care</li>
            <li>Specialized treatments</li>
         </ul></p>
         <a href="contact.php" class="btn">contact us</a>
      </div>
   </div>
</section>

<div class="reviews-container">
<section class="reviews">
   <h1 class="title">client's reviews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/profile1.jpg" alt="">
         <p>"This dog care is exceptional! The staff is knowledgeable and caring, 
            providing a safe and fun environment for my dog. The facility is clean and spacious, with regular
             updates on my pet's activities. I highly recommend it for pet owners seeking reliable and trustworthy
              care for their furry companions."</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>MAX</h3>
      </div>

      <div class="box">
         <img src="images/profile2.png" alt="">
         <p>
"This dog care is fantastic! The staff is knowledgeable and caring, the facility is clean and spacious, and my dog 
loves it. I feel confident leaving my furry friend here knowing she's well taken care of. They even send updates throughout
 the day. Highly recommended for pet owners!"</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Rocky</h3>
      </div>

      <div class="box">
         <img src="images/profile3.png" alt="">
         <p>"This dog care is top-notch! The staff is knowledgeable and caring, providing a safe and welcoming environment. The facility is clean and spacious, perfect for dogs to play. Regular updates keep owners informed. Highly recommended for anyone seeking reliable care for their furry friends. A fantastic experience overall!"</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Lucy</h3>
      </div>

      <div class="box">
         <img src="images/profile4.png" alt="">
         <p>"This dog care is top-notch! The staff is knowledgeable and caring, and the facility is clean and spacious. My dog loves spending time here, and I feel confident leaving him in their hands. They provide updates throughout the day, giving me peace of mind. Highly recommend!"</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Bella</h3>
      </div>

      <div class="box">
         <img src="images/profile5.png" alt="">
         <p>"This dog care is fantastic! The staff is knowledgeable and caring, and the facility is clean and safe. My dog loves it here, and I feel confident leaving him in their hands. They provide regular updates, making me feel connected. Highly recommend for any pet owner seeking top-notch care!"</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Milo</h3>
      </div>

      <div class="box">
         <img src="images/profile6.png" alt="">
         <p> "This dog care is exceptional! The staff is knowledgeable and caring, providing a safe environment for pets to play and socialize. The facility is clean and spacious, with regular updates on my dog's activities. I highly recommend it to pet owners seeking a reliable and loving daycare."</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Cooper</h3>
      </div>

   </div>

</section>
</div>

<section class="footer">
   <div class="box-container">
      <div class="box">
         <h3>Quick Links</h3>
         <a href="home.php">Home</a>
         <a href="about.php">About</a>
         <a href="shop.php">Shop</a>
         <a href="contact.php">Contact</a>
      </div>
      <div class="box">
         <h3>Extra Links</h3>
         <a href="login.php">Login</a>
         <a href="register.php">Register</a>
         <a href="cart.php">Cart</a>
         <a href="orders.php">Orders</a>
      </div>
      <div class="box">
         <h3>Contact Info</h3>
         <p><i class="fas fa-phone"></i> +919410602141</p>
         <p><i class="fas fa-envelope"></i> avantijain15@gmail.com</p>
         <p><i class="fas fa-map-marker-alt"></i> India</p>
      </div>
      <div class="box">
         <h3>Follow Us</h3>
         <a href="https://www.facebook.com"><i class="fab fa-facebook-f"></i> Facebook</a>
         <a href="https://www.twitter.com"><i class="fab fa-twitter"></i> Twitter</a>
         <a href="https://www.instagram.com"><i class="fab fa-instagram"></i> Instagram</a>
      </div>
   </div>
   <p class="credit">&copy; <?php echo date('Y'); ?> Happy Paws.</p>
</section>


<script src="js/script.js"></script>

</body>
</html>

