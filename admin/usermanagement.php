<?php 
include('../db/db.php');
error_reporting (E_ALL ^ E_NOTICE);

?>

<!DOCTYPE html>
<html>
  <head>
    <title>User Management System</title>
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
      integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../css/styles.css">
  </head>
  <?php 


if(isset($_POST['search_user']))
{
    if(!empty($_POST['search']))
    {
        $search = $_POST['search'];
        $query = "SELECT * FROM users WHERE user_id like '%$search'";
        $result = mysqli_query($conn,$query);
        
        if (mysqli_num_rows($result) > 0) {

          $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
      
      
        }
        else {
          echo '<script type="text/javascript">'; 
          echo 'alert("No result found");'; 
          echo 'window.location.href = "usermanagement.php";';
          echo '</script>';
        }

         
    }
    else
    {
        $searchErr = "Please enter the information";
    }
    
}

if(isset($_POST['delete']))
{
  $search = $_POST['search'];
  $query = "DELETE FROM users WHERE user_id like '%$search'";
  $result = mysqli_query($conn,$query);

}

if(isset($_POST['update']))
{
  

  if(!empty($_POST['search'])){

    $search = $_POST['search'];
    $query = "SELECT * FROM users WHERE user_id like '%$search'";
    $result = mysqli_query($conn,$query);
        
    if (mysqli_num_rows($result) > 0) {

        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
      
        }

        if(!empty($search)) {

          if(!empty($_POST['first_name']) || !empty($_POST['last_name']) || !empty($_POST['email']) || !empty($_POST['country']) || !empty($_POST['state']) || !empty($_POST['city']) || !empty($_POST['phone_no']) || !empty($_POST['user_password'])) {
  

            $first_name =trim($_POST['first_name']);
            $last_name =trim($_POST['last_name']);
            $email = trim($_POST['email']);
            $country = ($_POST['country']);
            $state = trim($_POST['state']);
            $city = trim($_POST['city']);
            $phone_no = ($_POST['phone_no']);
            // if(!empty($_POST['user_password'])){
            //   $password = md5(trim(($_POST['user_password'])));
            // }
            // else {
            //   $password = $users[0]["user_password"];
            // }
            
            

            $query = "UPDATE users SET first_name = '".$first_name."', last_name = '".$last_name."', email = '".$email."', country = '".$country."', state = '".$state."', city = '".$city."', phone_no = '".$phone_no."' WHERE user_id = '".$search."'";
          
            $run = mysqli_query($conn, $query) or die(mysqli_error($conn));
          
            // Check to see if updates pushed to db or not
            
            if($run) {
              echo '<script type="text/javascript">'; 
              echo 'alert("User data updated successfully");'; 
              echo 'window.location.href = "usermanagement.php";';
              echo '</script>';
            }
            else {
              echo "Data not updated";
            }
          
          }
          else {
            echo "Please enter new data to update";
          }

        }
        else {
          echo "Please enter a user ID to update that account";
        }
        

    }
        
         
}
  
  ?>
  <body>
  <div class="content">
  <div class="banner">
          <h1>Managing User: <?php echo $users[0]["user_id"]; ?> </h1> 
        </div>
    <div class="testbox">
      <form action="usermanagement.php" method="post">
      <label for="search"><b>Key in User ID</b></label>
      <input id="search" type="text" name="search" required/>
        
        <div class="colums">
        <!-- <div class="item">
            <label><b>User ID: </b></label><?php echo $users[0]["user_id"]; ?>
          </div> -->
          <div class="item">
          <label><b>First Name </b></label>
          <input id="first_name" pattern="^[A-Za-z]+$" type="text" name="first_name"  value="<?php echo $users[0]["first_name"]; ?>"/>
          </div>
          <div class="item">
          <label><b>Last Name </b></label>
          <input id="last_name" pattern="^[A-Za-z]+$" type="text" name="last_name"  value="<?php echo $users[0]["last_name"]; ?>"/>
          </div>
          <div class="item">
          <label><b>Email </b></label>
          <input id="email" type="email" name="email" value="<?php echo $users[0]["email"]; ?>" />
          </div>
          
          <div class="item">
          <label><b>Country </b></label>
          <input id="country" type="text" name="country" value="<?php echo $users[0]["country"]; ?>" />
          </div>
          <div class="item">
          <label><b>State </b></label>
          <input id="state" pattern="^[A-Za-z\s]+$" type="text" name="state" value="<?php echo $users[0]["state"]; ?>" />
          </div>
          <div class="item">
          <label><b>City </b></label>
          <input id="city" pattern="^[A-Za-z\s]+$" type="text" name="city" value="<?php echo $users[0]["city"]; ?>" />
          </div>
          <div class="item">
          <label><b>Phone </b></label>
          <input id="phone_no" pattern="[0-9]+" type="tel" name="phone_no" value="<?php echo $users[0]["phone_no"]; ?>" />
          </div>
          
        </div>
        <div class="three-buttons">
        <button type="submit" name="delete" onclick="return confirm('You are about to delete this user. This cannot be undone. Are you sure?')">Delete User</button>
        <button type="submit" name="update" onclick="return confirm('Update user data?')">Update</button>
        <button type="submit" name="search_user">Search</button>
        </div>
      </form>
    </div>
    </div>
  </body>
</html>
