<?php

require_once 'actions/db_connect.php';
require_once 'navbar.php';

?>

<div class="container">
    <div class="row">
        <fieldset>
            <legend>Add Table</legend>

            <form action="actions/a_create.php" method="post">
                <table cellspacing="0" cellpadding="0">
                    <tr>
                        <th>Table</th>
                        <td><input type="text" name="table_name" placeholder="Description" /></td>
                    </tr>     
                    <tr>
                        <th>Capacity</th>
                        <td><input type="text" name="table_capacity" placeholder="Capacity" /></td>
                    </tr>
                    <tr>
                        <td><button type="submit" class="btn btn-primary">Add Table</button></td>
                        <td><a href="home.php"><button type="button" class="btn btn-secondary">Back to Home</button></a></td>
                    </tr>
                </table>
            </form>
        </fieldset>        
    </div>
</div>



</body>
</html>