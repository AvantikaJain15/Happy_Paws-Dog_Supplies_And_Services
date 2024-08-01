
<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}
function generatePaytmQRCode($orderId, $amount) {
    $qrData = "paytm://qr?link=https://yourwebsite.com/payment?order_id=$orderId&amount=$amount";
    $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($qrData);
    return $qrCodeUrl;
}
function sendEmailWithQRCode($userEmail, $qrCodeUrl) {
    $to = $userEmail;
    $subject = "Paytm Payment QR Code";
    $message = "Dear customer,<br><br>Please use the following QR code to make your payment:<br><img src='$qrCodeUrl' alt='Paytm QR Code'>";
    $headers = "From: your@example.com\r\n";
    $headers .= "Content-type: text/html\r\n";
    mail($to, $subject, $message, $headers);
}

$message = array();  

if(isset($_POST['update_order'])){
    $order_update_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];

    if($update_payment == 'paytm' || $update_payment == 'paypal') {
        $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE id = '$order_update_id'") or die('Query failed');
        $fetch_orders = mysqli_fetch_assoc($order_query);
        $qrCodeUrl = generatePaytmQRCode($order_update_id, $fetch_orders['total_price']);
        sendEmailWithQRCode($fetch_orders['email'], $qrCodeUrl);
    }
    mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('Query failed');
    $message[] = 'Payment status has been updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('Query failed');
   header('location:admin_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>

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
         background-color: #f5f5f5;
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

<section class="orders">

   <h1 class="title">Placed Orders</h1>

   <div class="box-container">
      <?php
      $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('Query failed');
      if(mysqli_num_rows($select_orders) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
      <div class="box">
         <p> User ID: <span><?php echo $fetch_orders['user_id']; ?></span> </p>
         <p> Placed On: <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> Name: <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> Number: <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> Email: <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> Address: <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> Total Products: <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> Total Price: <span>&#8377;<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
         <p> Payment Method: <span><?php echo $fetch_orders['method']; ?></span> </p>
         <form action="" method="post">
            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
            <select name="update_payment">
               <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
               <option value="pending">Pending</option>
               <option value="completed">Completed</option>
            </select>
            <input type="submit" value="Update" name="update_order" class="option-btn">
            <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('Delete this order?');" class="delete-btn">Delete</a>
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">No orders placed yet!</p>';
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

