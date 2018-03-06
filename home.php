<?php
 ob_start();
 session_start();

 require_once 'actions/db_connect.php';

 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: index.php");
  exit;
 }

 // select logged-in users detail
 $res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
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
    .manageUser {
        color: white;
    }
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
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <a href="logout.php?logout">Log Out</a>
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
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

<div class="container-fluid">
<div class="manageUser">
    <a href="create.php"><button type="button">Add Table</button></a>
    <a href='delete.php'><button type='button'>Delete Table</button></a>
    <br><br>
    <table border="1" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>Reserved</th>
                <th>Table</th>
                <th>Seats</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql = "SELECT * FROM tables WHERE table_reserved = 0";
            $result = $conn->query($sql);

            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>".$row['table_reserved']."</td>
                        <td>".$row['table_name']." </td>
                        <td>".$row['table_capacity']."</td>
                        <td>
                            <a href='update.php?id=".$row['table_id']."'><button type='button'>Edit</button></a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
            }

            ?>
       
        </tbody>
    </table>
<br><br>
    <table border="1" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>Reserved</th>
                <th>Table</th>
                <th>Seats</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql = "SELECT * FROM tables WHERE table_reserved = 1";
            $result = $conn->query($sql);

            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>".$row['table_reserved']."</td>
                        <td>".$row['table_name']." </td>
                        <td>".$row['table_capacity']."</td>
                        <td>
                            <a href='update.php?id=".$row['table_id']."'><button type='button'>Edit</button></a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
            }

            ?>
       
        </tbody>
    </table>

</div> <!-- manage-user-->
</div> <!-- container-fluid-->
</body>
</html>


