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

require_once 'navbar.php';
?>
        <?php 
          $sql = "SELECT count(*) as 'aantal' FROM `tables` WHERE table_reserved = 0";
            $result = $conn->query($sql);
            $data = $result->fetch_assoc();
         ?>


<div class="container-fluid bg-1 ">
    <div class="row row1">
        <div class="col-3">
            <h4>Please call, if you want to reserve one of our available tables.</h4>
            <br>
            <p>Köstlergasse 1<br>1060 Wien<br>&#x260F; 0614 75 83 94 </p>
        </div><!-- col-3 -->
        <div class="col-6 text-center">
            <br><br>
            <p class="tagline">If you have a code block and your system resources are down....</p>
            <br><br>
            <h1 class="main-title">Welcome to the<br>Source Code Café</h1>  
        </div><!-- col-& -->
      <div class="col-3 text-center">
            <h3>We have <?php echo $data["aantal"]; ?> free Tables at the moment.</h3>
            <table border="1" cellspacing="0" cellpadding="0" class="table1" id="index-table">
                <thead>
                      <tr>
                        <th>Available tables&nbsp&nbsp</th>
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
      </div> <!-- col-3 -->
    </div> <!-- row -->    
</div> <!-- container-fluid -->

<?php require_once 'footer.php'; ?>
 