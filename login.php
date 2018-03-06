<?php
 ob_start();
 session_start();
 require_once 'actions/db_connect.php';

  // it will never let you open index(login) page if session is set
 if ( isset($_SESSION['user'])!="" ) {
  header("Location: home.php");
  exit;
 }

 $error = false;
$name = "";
$surname = "";
$email = "";
 $emailError="";
 $passError="";
 $nameError="";
 $surnameError="";
 $query = "";
 $result = "";
 $count = "";
 $res = "";


 if( isset($_POST['btn-login']) ) {

  // prevent sql injections/ clear user invalid inputs
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);

  // prevent sql injections / clear user invalid inputs

  if(empty($email)){
   $error = true;
   $emailError = "Please enter your email address.";
  } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  }

   if(empty($pass)){
   $error = true;
   $passError = "Please enter your password.";
  }

  // if there's no error, continue to login
  if (!$error) {
   $password = hash('sha256', $pass); // password hashing using SHA256
   $res=mysqli_query($conn, "SELECT userId, userName, userPass FROM users WHERE userEmail='$email'");
   $row=mysqli_fetch_array($res, MYSQLI_ASSOC);
   $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row

   if( $count == 1 && $row['userPass']==$password ) {
    $_SESSION['user'] = $row['userId'];
    header("Location: home.php");
   } else {
    $errMSG = "You are not registered with Source Code Café. Please follow the link to register...";
   }
  }
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Source Code Café Employee Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
  <link rel="icon" type="image/png" href="img/cup.png">
     <style> 
    body {
      background-color: #006;
    }
    .bg-1 { 
       background-color: #006;
        color: #ffffff;
      }
    .uw {
      color:  white;
      font-size: 20px;
      padding: 10px 0 0 0;
    }
    .cover {
      height: 200px;
    }
    </style>
</head>
<body>
     <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <a class="navbar-brand"href="logout.php?logout">Logout</a>&nbsp
      <img src="img/cup.png" alt="logo" style="width:40px;">&nbsp
    </a>
    <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="#">WHERE</a>
    </li>
      <li class="nav-item">
        <a class="nav-link" href="#">WHAT</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">CONTACT</a>
      </li>
    </ul>
   
  </nav>

  <div class="container-fluid bg-1 text-center"> 
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
 

             <h2>Please log into your Source Code Café Employee Account:</h2>
             <hr />
           

            <?php

   if ( isset($errMSG) ) {

echo $errMSG; ?>
                <?php
   }
   ?>

             <input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" maxlength="40" />
             <span class="text-danger"><?php echo $emailError; ?></span>
             <input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" />
            <span class="text-danger"><?php echo $passError; ?></span>
             <hr />
             <button type="submit" name="btn-login">Log In</button>
             <hr />
             <a href="register.php">Employee Registration...</a>
    </form>
    </div>

</body>
</html>

<?php ob_end_flush(); ?>

