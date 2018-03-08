<?php

require_once 'actions/db_connect.php';

if($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tables WHERE table_id = {$id}";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    $conn->close();


?>

<?php require_once 'navbar.php'; ?>

<div class="container">
    <div class="row">
        <fieldset>
            <legend>Update Table</legend>
            <form action="actions/a_update.php" method="post">
                <table cellspacing="0" cellpadding="0">
                    <tr>
                        <th>Reserved</th>
                        <td><input type="text" name="table_reserved" placeholder="reserved" value="<?php echo $data['table_reserved'] ?>" /> 0 = Not reserved | 1 = Table is reserved</td>
                    </tr>     
                    <tr>
                        <th>Table</th>
                        <td><input type="text" name="table_name" placeholder="Description" value="<?php echo $data['table_name'] ?>" /></td>
                    </tr>
                    <tr>
                        <th>Seats</th>
                        <td><input type="text" name="table_capacity" placeholder="Capacity" value="<?php echo $data['table_capacity'] ?>" /></td>
                    </tr>
                    <tr>
                        <input type="hidden" name="table_id" value="<?php echo $data['table_id']?>" />
                        <td><button type="submit" class="btn btn-primary">Save Changes</button></td>
                        <td><a href="home.php"><button type="button" class="btn btn-secondary">Back</button></a></td>
                    </tr>
                </table>
            </form>
        </fieldset>       

    </div>
    





</div>

</body>
</html>

<?php
}

?>