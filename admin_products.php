<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = $_POST['price'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'product name already added';
   }else{
      $add_product_query = mysqli_query($conn, "INSERT INTO `products`(name, price, image) VALUES('$name', '$price', '$image')") or die('query failed');

      if($add_product_query){
         if($image_size > 2000000){
            $message[] = 'image size is too large';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'product added successfully!';
         }
      }else{
         $message[] = 'product could not be added!';
      }
   }
}
if(isset($_POST['add_service'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = $_POST['price'];
   $description = mysqli_real_escape_string($conn, $_POST['description']);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;
   $duration = $_POST['duration'];
   $availability = $_POST['availability'];
   $select_service_name = mysqli_query($conn, "SELECT name FROM `services` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_service_name) > 0){
      $message[] = 'service name already added';
   }else{
      $add_service_query = mysqli_query($conn, "INSERT INTO `services`(name, price, description, image,duration, availability) VALUES('$name', '$price', '$description', '$image', '$duration', '$availability')") or die('query failed');

      if($add_service_query){
         if($image_size > 2000000){
            $message[] = 'image size is too large';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'service added successfully!';
         }
      }else{
         $message[] = 'service could not be added!';
      }
   }
}
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_products.php');
}

if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];

   mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price' WHERE id = '$update_p_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image file size is too large';
      }else{
         mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/'.$update_old_image);
      }
   }
   header('location:admin_products.php');

}

if(isset($_POST['update_service'])){

   $update_s_id = $_POST['update_s_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];
   $update_description = $_POST['update_description'];

   mysqli_query($conn, "UPDATE `services` SET name = '$update_name', price = '$update_price', description = '$update_description' WHERE id = '$update_s_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image file size is too large';
      }else{
         mysqli_query($conn, "UPDATE `services` SET image = '$update_image' WHERE id = '$update_s_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/'.$update_old_image);
      }
   }
   header('location:admin_products.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css">

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

</head>
<body>
   
<?php include 'admin_header.php'; ?>
<section class="add-forms-container">
   
<section class="add-products">

<h1 class="title">shop Products</h1>

<form action="" method="post" enctype="multipart/form-data">
   <h3>add product</h3>
   <input type="text" name="name" class="box" placeholder="enter product name" required>
   <input type="number" min="0" name="price" class="box" placeholder="enter product price" required>
   <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
   <input type="submit" value="add product" name="add_product" class="btn">
</form>

</section>
<section class="add-services">

<h1 class="title">Shop Services</h1>

<form action="" method="post" enctype="multipart/form-data">
   <h3>Add Service</h3>
   <input type="text" name="name" class="box" placeholder="Enter service name" required>
   <input type="number" min="0" name="price" class="box" placeholder="Enter service price" required>



   <input type="text" name="description" class="box" placeholder="Enter description here" required>
   <input type="text" name="duration" class="box" placeholder="Enter duration here" required>
   <input type="text" name="availability" class="box" placeholder="Enter availability here" required>


   <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
   <input type="submit" value="Add Service" name="add_service" class="btn">
</form>

</section>





</section>
<section class="show-products">
<h1 class="title">Your Products</h1>

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="box">
         <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <div class="price">&#8377;<?php echo $fetch_products['price']; ?>/-</div>
         <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">update</a>
         <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

</section>

<section class="show-services">

   <h1 class="title">Your Services</h1>

   <div class="box-container">

      <?php
         $select_services = mysqli_query($conn, "SELECT * FROM `services`") or die('query failed');
         if(mysqli_num_rows($select_services) > 0){
            while($fetch_services = mysqli_fetch_assoc($select_services)){
      ?>
      <div class="box">
         <img src="uploaded_img/<?php echo $fetch_services['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_services['name']; ?></div>
         <div class="price">&#8377;<?php echo $fetch_services['price']; ?>/-</div>
         <div class="description"><?php echo $fetch_services['description']; ?></div>
         <a href="admin_products.php?update_service=<?php echo $fetch_services['id']; ?>" class="option-btn">Update</a>
         <a href="admin_products.php?delete_service=<?php echo $fetch_services['id']; ?>" class="delete-btn" onclick="return confirm('delete this service?');">Delete</a>
      </div>

      <?php
         }
      }else{
         echo '<p class="empty">No services added yet!</p>';
      }
      ?>
   </div>

</section>




<section class="edit-product-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
      <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="enter product name">
      <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="enter product price">
      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="update" name="update_product" class="btn">
      <input type="reset" value="cancel" id="close-update" class="option-btn">
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>

</section>



<section class="edit-service-form">

   <?php
      if(isset($_GET['update_service'])){
         $update_id = $_GET['update_service'];
         $update_query = mysqli_query($conn, "SELECT * FROM `services` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_s_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
      <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="Enter service name">
      <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="Enter service price">
      <textarea name="update_description" class="box" required placeholder="Enter service description"><?php echo $fetch_update['description']; ?></textarea>
      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="Update Service" name="update_service" class="btn">
      <input type="reset" value="Cancel" id="close-update" class="option-btn">
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-service-form").style.display = "none";</script>';
      }
   ?>

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





































