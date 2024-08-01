<?php
include 'config.php';
session_start();
$message = array(); 
if(isset($_POST['submit'])){
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   if(empty($_POST['password'])) {
      $message[] = 'Please enter your password!';
   } elseif (!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $_POST['password'])) {
      $message[] = 'Password should be at least 8 characters long and contain at least one numeric digit and one capital letter!';
   } else {
      $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');
      if(mysqli_num_rows($select_users) > 0){
         $row = mysqli_fetch_assoc($select_users);
         if($row['user_type'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_page.php');
         } elseif($row['user_type'] == 'user'){
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
         }
      } else {
         $message[] = 'Incorrect email or password!';
      }
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <style>
      .animated-form {
         opacity: 0;
         transform: translateY(50px);
      }
   </style>
</head>
<body>
<?php
if(!empty($message)){
   foreach($message as $msg){
      echo '
      <div class="message">
         <span>'.$msg.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
<div class="form-container">
   <form action="" method="post">
      <h3>Login Now</h3>
      <input type="email" name="email" placeholder="Enter your email" required class="box">
      <input type="password" name="password" placeholder="Enter your password" required class="box">
      <input type="submit" name="submit" value="Login Now" class="btn">
      <p>Don't have an account? <a href="register.php">Register Now</a></p>
   </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.3/TweenMax.min.js"></script>
<script src="//s3-us-west-2.amazonaws.com/s.cdpn.io/16327/MorphSVGPlugin.min.js?r=182"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
<script>
   gsap.to('.animated-form', { opacity: 1, y: 0, duration: 2, ease: 'power4.out' });
   gsap.from('.box', { opacity: 0, y: 50, stagger: 0.2, duration: 1, ease: 'power2.out' });
   gsap.from('.btn', { opacity: 0, y: 50, duration: 0.5, ease: 'power2.out' });
   gsap.from('h3', { opacity: 0, y: 50, duration: 0.5,  ease: 'power2.out' });
</script>
</body>
</html>