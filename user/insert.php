<?php 
include('../db/db.php');

if(isset($_POST['save'])){

  if(!empty($_POST['user_id']) && !empty($_POST['user_password']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['country']) && !empty($_POST['state']) && !empty($_POST['city']) && !empty($_POST['phone_no'])) {
  
    $user_id = trim($_POST['user_id']);
    $user_password = md5(trim($_POST['user_password']));
    $first_name = trim($_POST['first_name']);
    $last_name =trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $country = trim($_POST['country']);
    $state = trim($_POST['state']);
    $city = trim($_POST['city']);
    $phone_no = trim($_POST['phone_no']);
  
    $query = "INSERT INTO users (user_id, user_password, first_name, last_name, email, country, state, city, phone_no) VALUES ( '$user_id', '$user_password', '$first_name', '$last_name', '$email', '$country', '$state', '$city', '$phone_no')";
  
    $run = mysqli_query($conn, $query) or die(mysqli_error($conn));
  
    if($run) {
      echo '<script type="text/javascript">'; 
      echo 'alert("New record created successfully");'; 
      echo 'window.location.href = "newuser.php";';
      echo '</script>';
    }
    else {
      echo "Form not submitted";
    }
  
  }
  else {
    echo "All Fields required";
  }
  
  }

?>