<?php

require_once 'actions/db_connect.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Table</title>
</head>

<body>

<div class="container-fluid">
<div class="manageUser">
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
            $sql = "SELECT * FROM tables";
            $result = $conn->query($sql);

            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>".$row['table_reserved']."</td>
                        <td>".$row['table_name']." </td>
                        <td>".$row['table_capacity']."</td>
                        <td>
                            <a href='actions/a_delete.php?id=".$row['table_id']."'><button type='button'>Delete</button></a>
                        </td>
                    </tr>
                    ";
                }
            } else {
                echo "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
            }

            ?>
       
        </tbody>
    </table>
    <a href='home.php'><button type='button'>Back</button></a>
</div> <!-- manage-user-->
</div> <!-- container-fluid-->


</body>
</html>

