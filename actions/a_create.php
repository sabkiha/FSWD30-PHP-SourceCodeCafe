<?php

require_once 'db_connect.php';

require_once '../navbar2.php';

if($_POST) {
    $tname = $_POST['table_name'];
    $cap = $_POST['table_capacity'];

    $sql = "INSERT INTO tables (table_name, table_capacity) VALUES ('$tname', '$cap')";
    if($conn->query($sql) === TRUE) {
        echo "<p>New Table Successfully Created</p>";
        echo "<a href='../create.php'><button type='button' class='btn btn-info'>Back</button></a>";
        echo "<a href='../home.php'><button type='button' class='btn btn-secondary'>Home</button></a>";
    } else {
        echo "Error " . $sql . ' ' . $conn->connect_error;
    }

    $conn->close();
}
?>
</body>
</html>