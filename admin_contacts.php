<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_contacts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messages</title>

   <style>
      .footer {
         background-color: #333;
         color: #fff;
         padding: 40px 0;
         text-align: center;
      }
      
      .box-container {
         display: flex;
         justify-content: space-between;
         flex-wrap: wrap;
      }
      
      .box {
         flex: 0 0 calc(25% - 20px);
         background-color: #444;
         padding: 20px;
         border-radius: 8px;
         margin-bottom: 20px;
      }
      
      .box h3 {
         color: #fff;
         margin-bottom: 10px;
      }
      
      .box a {
         color: #ccc;
         text-decoration: none;
         display: block;
         margin-bottom: 5px;
      }
      
      .box a:hover {
         color: #fff;
      }
      
      .credit {
         color: #ccc;
         margin-top: 20px;
      }
   </style>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="messages">

   <h1 class="title"> messages </h1>

   <div class="box-container">
   <?php
      $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
      if(mysqli_num_rows($select_message) > 0){
         while($fetch_message = mysqli_fetch_assoc($select_message)){
      
   ?>
   <div class="box">
      <p> user id : <span><?php echo $fetch_message['user_id']; ?></span> </p>
      <p> name : <span><?php echo $fetch_message['name']; ?></span> </p>
      <p> number : <span><?php echo $fetch_message['number']; ?></span> </p>
      <p> email : <span><?php echo $fetch_message['email']; ?></span> </p>
      <p> message : <span><?php echo $fetch_message['message']; ?></span> </p>
      <a href="admin_contacts.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete message</a>
   </div>
   <?php
      };
   }else{
      echo '<p class="empty">you have no messages!</p>';
   }
   ?>
   </div>

</section>
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
   <p class="credit">&copy; <?php echo date('Y'); ?> The Happy Paws.</p>
</section>

<script src="js/admin_script.js"></script>

</body>
</html>