<?php

require_once 'db_connect.php';

if($_POST) {
    $tname = $_POST['table_name'];
    $cap = $_POST['table_capacity'];

    $sql = "INSERT INTO tables (table_name, table_capacity) VALUES ('$tname', '$cap')";
    if($conn->query($sql) === TRUE) {
        echo "<p>New Table Successfully Created</p>";
        echo "<a href='../create.php'><button type='button'>Back</button></a>";
        echo "<a href='../home.php'><button type='button'>Home</button></a>";
    } else {
        echo "Error " . $sql . ' ' . $conn->connect_error;
    }

    $conn->close();
}

?>