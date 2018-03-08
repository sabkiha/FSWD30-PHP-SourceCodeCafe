<?php

require_once 'db_connect.php';

require_once '../navbar2.php';

if($_POST) {
    $tname = $_POST['table_name'];
    $tcapacity = $_POST['table_capacity'];
    $treserved = $_POST['table_reserved'];
    $id = $_POST['table_id'];

    $sql = "UPDATE tables SET table_name = '$tname', table_capacity = '$tcapacity', table_reserved = '$treserved' WHERE table_id = {$id}";
    if($conn->query($sql) === TRUE) {
        echo "<p>Succcessfully Updated</p>";
        echo "<a href='../update.php?id=".$id."'><button type='button' class='btn btn-info'>Back</button></a>";
        echo "<a href='../home.php'><button type='button' class='btn btn-secondary'>Home</button></a>";
    } else {
        echo "Erorr while updating record : ". $conn->error;
    }

    $conn->close();
}

?>
</body>
</html>