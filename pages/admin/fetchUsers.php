<?php

include '../../config/connection.php';

$rs = Database::search("SELECT * FROM `users` WHERE `user_type_id` = '2'");
$num = $rs->num_rows;

while ($row = $rs->fetch_assoc()) {
?>
    <tr>
        <th><?php echo $row["id"]; ?></th>
        <th><?php echo $row["fname"]; ?></th>
        <th><?php echo $row["lname"]; ?></th>
        <th><?php echo $row["email"]; ?></th>
        <th><?php echo $row["mobile"]; ?></th>
        <th>
            <?php
            echo ($row["status_id"] == 1)
                ? '<button class="btn btn-sm btn-primary w-100">active</button>'
                : '<button class="btn btn-sm btn-danger w-100">inactive</button>';
            ?>
        </th>
    </tr>
<?php
}
