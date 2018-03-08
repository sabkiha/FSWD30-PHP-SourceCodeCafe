<?php

 ob_start();
 session_start(); // start a new session or continues the previous

 if( isset($_SESSION['user'])!="" ){
  header("Location: home.php"); // redirects to home.php
 }

 include_once 'actions/db_connect.php';

 $error = false;
 // $name = "";
 // $surname = "";
 // $email = "";
 $emailError="";
 $passError="";
 $nameError="";
 $surnameError="";
 $query = "";
 $result = "";
 $count = "";
 $res = "";

 if ( isset($_POST['btn-signup']) ) {

  // sanitize user input to prevent sql injection
  $name = trim($_POST['name']);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);

  $surname = trim($_POST['surname']);
  $surname = strip_tags($surname);
  $surname = htmlspecialchars($surname);

  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);

  // basic name validation
  if (empty($name)) {
   $error = true;
   $nameError = "Please enter your name.";
  } else if (strlen($name) <= 1) {
   $error = true;
   $nameError = "Name must have at least 1 character.";
  } else if (!preg_match("/[a-zA-Z]/",$name)) {
   $error = true;
   $nameError = "Name must contain only letters.";
  }

   if (empty($surname)) {
   $error = true;
   $surnameError = "Please enter your surname.";
  } else if (strlen($surname) <= 1) {
   $error = true;
   $surnameError = "Name must have at least 1 character.";
  } else if (!preg_match("/[a-zA-Z]/",$surname)) {
   $error = true;
   $surnameError = "Surname must contain only letters.";
  }

   //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  } else {

   // check whether the email exist or not
   $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
   $result = mysqli_query($conn, $query);
   $count = mysqli_num_rows($result);
   if($count!=0){
    $error = true;
    $emailError = "Provided Email is already in use.";
   }
  }

  // password validation
  if (empty($pass)){
   $error = true;
   $passError = "Please enter password.";
  } else if(strlen($pass) < 6) {
   $error = true;
   $passError = "Password must have at least 6 characters.";
  }

  // password encrypt using SHA256();
  $password = hash('sha256', $pass);

  // if there's no error, continue to signup
  if( !$error ) {

   $query = "INSERT INTO users(userName,Surname,userEmail,userPass) VALUES('$name', '$surname','$email','$password')";
   $res = mysqli_query($conn, $query);

   if ($res) {
    $errTyp = "success";
    $errMSG = "Your Employee Accout with the Source Code Café is registered, please login now";
    unset($name);
    unset($surname);
    unset($email);
    unset($pass);
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, please try again later...";
    }
  }
 }

require_once 'navbar.php';

?>

  <div class="container-fluid bg-1 text-center"> 
    <br>
    <div class="row justify-content-md-center">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
        <h2>New Employee Registration</h2>
          <hr />
            <?php
              if ( isset($errMSG) ) { 
            ?>
            <div class="alert">
             <?php echo $errMSG; ?>
              </div>
             <?php } ?>
            <input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" value="" />
                <span class="text-danger"><?php echo $nameError; ?></span>
            <input type="text" name="surname" class="form-control" placeholder="Enter Surname" maxlength="100" value="" />
                <span class="text-danger"><?php echo $surnameError; ?></span>
            <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="" />
                    <span class="text-danger"><?php echo $emailError; ?></span>
            <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
            <span class="text-danger"></span>
            <hr />
            <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Register your account</button>
            <hr />
            <h3><a href="login.php">Got to Login...</a></h3>
      </form>

</div>
</body>
</html>