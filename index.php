<?php 
session_start();

require_once 'actions/db_connect.php';
 ?>

<?php
$servername = "localhost";
$username   = "root";
$password   = ""; 
$dbname     = "source_code_cafe";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "\n");
}
?>

<html lang="en">
<head>
    <title>Welcome to the Source Code Café</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="icon" type="image/png" href="img/cup.png">
    <style> 
    .bg-1 { 
       background-color: #006;
        color: #ffffff;
    }
    body {
      background-color: #006;}
    table {
        color: white;
    }

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand" href="#">
            <img src="img/cup.png" alt="logo" style="width:40px;">
        </a>
        <a href="login.php">Source Code Café Employee Login</a>
         &nbsp&nbsp&nbsp&nbsp
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
        <br>
        <span>
            <h3>Welcome to the Source Code Café</h3>



    <table border="1" cellspacing="0" cellpadding="0">
        <thead>
              <tr>
                <th>These are our available tables at the moment&nbsp&nbsp</th>
                <th>Seats</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql = "SELECT * FROM tables WHERE table_reserved = 0";
            $result = $conn->query($sql);

            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>".$row['table_name']." </td>
                        <td>".$row['table_capacity']."</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
            }

            ?>
       
        </tbody>
    </table>
    <p>Please call, if you want to reserve one of our available tables.</p>


                <img src="img/cafe.png" class="rounded-circle"  style="max-height: 200px">          
        </span>
        <hr>
        <h3></h3>
        <br><br>
  </div>


</body>
</html>

 