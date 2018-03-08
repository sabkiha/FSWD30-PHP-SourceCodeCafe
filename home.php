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

require_once 'navbar.php';
?>

<div class="container-fluid">
    <div class="row justify-content-around ">
        <a href="create.php"><button type="button" class="ed-buttons btn btn-primary">Add Table</button></a>
        <a href='delete.php'><button type='button' class="ed-buttons btn btn-success">Delete Table</button></a>
        <a href="logout.php?logout"><button type="button" class="ed-buttons btn btn-danger">Logout</button></a> 
    </div>
<div class="row justify-content-center ">
    <div class="col-4">
            <p class="table-title">List of available tables</p>
            <table border="1" cellspacing="0" cellpadding="0" class="table1">
                <thead>
                    <tr>
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
                                <td>".$row['table_name']." </td>
                                <td>".$row['table_capacity']."</td>
                                <td>
                                    <a href='update.php?id=".$row['table_id']."'><button type='button' class='btn btn-info'>Edit</button></a>


                                    <!-- UPDATE tables SET table_reserved = 1 WHERE table_id = 5
                                         UPDATE tables SET table_reserved = 0 WHERE table_id = 5 -->
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
                    }
                    ?>            
                </tbody>
            </table>
    </div>
    <div class="col-4">
            <p class="table-title">List of reserved tables</p>
                <table border="1" cellspacing="0" cellpadding="0"  class="table1">
                    <thead>
                        <tr>
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
                                    <td>".$row['table_name']." </td>
                                    <td>".$row['table_capacity']."</td>
                                    <td>
                                        <a href='update.php?id=".$row['table_id']."'><button type='button' class='btn btn-info'>Edit</button></a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
    </div>
  </div>
</div> <!-- container-fluid-->

<?php require_once 'footer.php'; ?>

