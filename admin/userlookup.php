<?php 
include('../db/db.php');
error_reporting (E_ALL ^ E_NOTICE);

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Membership Dashboard</title>
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


if(isset($_POST['save']))
{
    if(!empty($_POST['search']))
    {
        $search = $_POST['search'];
        $result = mysqli_query($conn,"SELECT * FROM users WHERE user_id like '%$search'");
        
        if (mysqli_num_rows($result) > 0) {

          $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
      
      
        }
        else {
          echo '<script type="text/javascript">'; 
          echo 'alert("No result found");'; 
          echo 'window.location.href = "userlookup.php";';
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
  $result = mysqli_query($conn,"DELETE FROM users WHERE user_id like '%$search'");

}
  
  ?>
  <body>
  <div class="content">
  <div class="banner">
          <h1>User: <?php echo $users[0]["first_name"]; ?> </h1> 
        </div>
    <div class="testbox">
      <form action="userlookup.php" method="post">
      <label for="search">Key in User ID</label>
      <input id="search" type="text" name="search" required />
        
        <div class="colums">
        <div class="item">
            <label><b>User ID: </b></label><?php echo $users[0]["user_id"]; ?>
          </div>
          <div class="item">
            <label><b>First Name: </b></label><?php echo $users[0]["first_name"]; ?>
            
          </div>
          <div class="item">
          <label><b>Last Name: </b></label><?php echo $users[0]["last_name"]; ?>
          </div>
          <div class="item">
          <label><b>Email: </b></label><?php echo $users[0]["email"]; ?>
          </div>
          
          <div class="item">
          <label><b>Country: </b></label><?php echo $users[0]["country"]; ?>
          </div>
          <div class="item">
          <label><b>State: </b></label><?php echo $users[0]["state"]; ?>
          </div>
          <div class="item">
          <label><b>City: </b></label><?php echo $users[0]["city"]; ?>
          </div>

          <div class="item">
          <label><b>Phone:: </b></label><?php echo $users[0]["phone_no"]; ?>
          </div>
        </div>
        <!-- <input type="reset" value="Reset" class="btn-reset"> -->
        
        <button type="submit" name="delete" style="float:left" onclick="return confirm('Are you sure?')">Delete User</button>
        <button type="submit" name="save">Submit</button>
        
      </form>
    </div>
    </div>
  </body>
</html>
