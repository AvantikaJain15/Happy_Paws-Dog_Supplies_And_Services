<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'] ?? null;
if(!isset($user_id)){
   header('location:login.php');
   exit;
}
if(isset($_POST['add_to_cart'])){
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];
   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'product added to cart!';
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'header.php'; ?>
<section class="home">
   <div class="content">
      <h3>Welcome to the Happy Paws Dashboard!</h3>
      <p>This dashboard provides you with various features for your dog.</p>
      <a href="about.php" class="white-btn">discover more</a>
   </div>
</section>
<section class="products">
   <h1 class="title">latest products</h1>
   <div class="box-container">
      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <br><br><br>
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <br>
      <div class="price">&#8377; <?php echo $fetch_products['price']; ?>/-</div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <br>
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>
   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">load more</a>
   </div>
</section>
<section class="about">
   <div class="flex">
      <div class="image">
         <img src="images/a.jpg" alt="">
      </div>
      <div class="content">
         <h3>about us</h3>
         <p>
         Welcome to Happy Paws, where your dog's happiness and well-being are our top priorities. We offer a range of premium 
         products through our website, including toys, grooming essentials, and stylish accessories designed to enhance your pet's 
         life. Alongside our award-winning dog daycare, overnight and holiday boarding, and luxurious spa services, our online store
         provides everything your furry friend needs. Our dedicated team ensures that every dog receives personalized care and attention, 
         making their stay memorable. Professionally trained Dogtopians will love and care for your pup like they are our own. 
         At Happy Paws, we treat every dog like family and strive to make their experience as joyful and fulfilling aspossible.</p>
         <a href="about.php" class="btn">read more</a>
      </div>
   </div>
</section>
<section class="home-contact">
   <div class="content">
      <h3>have any questions?</h3>
      <a href="contact.php" class="white-btn">contact us</a>
   </div>
</section>
<?php include 'footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>