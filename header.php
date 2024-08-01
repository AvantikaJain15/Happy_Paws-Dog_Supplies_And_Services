
<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Header</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="header">

   <div class="header-1">
      <div class="flex">
      <a href="home.php" class="logo">&#128062; <span>The Happy Paws.</span></a>
      </div>
   </div>

   <div class="header-2">
      <div class="flex">
      <div class="share">
            <a href="https://www.facebook.com" class="fab fa-facebook-f"></a>
            <a href="https://www.twitter.com" class="fab fa-twitter"></a>
            <a href="https://www.instagram.com" class="fab fa-instagram"></a>
         </div>
         
         <button class="menu-toggle"><i class="fas fa-bars"></i></button>
         <nav class="navbar nav-menu">
            <a href="home.php">home</a>
            <a href="about.php">about</a>
            <a href="shop.php">shop</a>
            <a href="contact.php">contact</a>
            <a href="orders.php">orders</a>
         </nav>
         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
               $cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?>
            <a href="cart.php"> <i class="fas fa-shopping-cart"></i> (<?php echo $cart_rows_number; ?>) </a>
         </div>
         <div class="user-box">
            <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
         </div>
      </div>
   </div>

   <style>
      body {
         font-family: Arial, sans-serif;
      }

      .header {
         display: flex;
         flex-direction: column;
      }

      .header-1, .header-2 {
         width: 100%;
         background-color: #f8f8f8;
         padding: 10px 0;
      }

      .header-1 .flex, .header-2 .flex {
         display: flex;
         justify-content: space-between;
         align-items: center;
         padding: 0 20px;
      }

      .header-2 .share a {
         margin: 0 10px;
         color: #333;
         font-size: 1.2em;
      }

      .header-1 .logo {
         font-size: 1.5em;
         color: #333;
      }

      .nav-menu {
         display: flex;
         gap: 15px;
      }

      .menu-toggle {
         display: none; /* Hidden by default */
      }

      .icons {
         display: flex;
         gap: 15px;
         align-items: center;
      }

      .user-box {
         display: none; /* Hidden by default */
         position: absolute;
         top: 100%;
         right: 20px;
         background-color: #fff;
         padding: 10px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
         border-radius: 5px;
      }

      /* Responsive Header */
      @media (max-width: 768px) {
         .header-2 .flex {
            flex-direction: column;
            align-items: flex-start;
         }

         .nav-menu {
            display: none;
            flex-direction: column;
            width: 100%;
         }

         .menu-toggle {
            display: block;
            cursor: pointer;
         }

         .nav-menu.active {
            display: flex;
         }

         .icons {
            width: 100%;
            justify-content: space-between;
         }
      }

      .logo {
         animation: bounce 1s infinite;
      }

      @keyframes bounce {
         0% {
            transform: translateY(-5px);
         }
         50% {
            transform: translateY(0);
         }
         100% {
            transform: translateY(-5px);
         }
      }
   </style>

</header>
<script src="js/script.js"></script>
</body>
</html>
