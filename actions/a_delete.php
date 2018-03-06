<?php

require_once 'db_connect.php';

if($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tables WHERE table_id = {$id}";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
   }
   
   //echo $id; 

    $sql = "DELETE FROM `tables` WHERE `tables`.`table_id` = {$id}";
    if($conn->query($sql) === TRUE) {
        echo "<p>Successfully deleted!!</p>";
        echo "<a href='../delete.php'><button type='button'>Back</button></a>";
    } else {
        echo "Error updating record : " . $conn->error;
    }

    $conn->close();

?>