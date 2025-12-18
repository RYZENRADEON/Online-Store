<table class="table table-striped">

    <thead>

        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th class="text-center">Action</th>
        </tr>

    </thead>

    <tbody>
        <?php

        include '../../config/connection.php';

        $page = 1;
        if (isset($_GET["page"]) && $_GET["page"] > 1) {
            $page = $_GET["page"];
        }

        $rs = Database::search("SELECT * FROM `users` WHERE `user_type_id` = '2'");
        $num = $rs->num_rows;

        $resultsPerPages = 5;
        $noOfPages = ceil($num / $resultsPerPages);
        $pageResults = ($page - 1) * $resultsPerPages;

        $rs2 = Database::search("SELECT * FROM `users` WHERE `user_type_id` = '2' LIMIT $resultsPerPages OFFSET $pageResults");
        $num2 = $rs2->num_rows;


        while ($row = $rs2->fetch_assoc()) {
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
                        ? '<button class="btn btn-sm btn-primary w-100" onclick="changeUserStatus(' . $row["id"] . ', 2,' . $page . ');">active</button>'
                        : '<button class="btn btn-sm btn-danger w-100" onclick="changeUserStatus(' . $row["id"] . ', 1, ' . $page . ');">inactive</button>';
                    ?>
                </th>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<!-- pagination -->
<nav class="mt-4">
    <ul class="pagination justify-content-end">

        <li class="page-item">
            <a class="page-link" aria-label="Previous" <?php
                                                        if ($page > 1) {
                                                        ?> onclick="loadUsers(<?php echo ($page - 1); ?>);" <?php
                                                                                                        }
                                                                                                            ?>>
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>

        <?php
        for ($i = 1; $i <= $noOfPages; $i++) {
            if ($i == $page) {
        ?>
                <li class="page-item active"><a class="page-link" onclick="loadUsers(<?php echo ($i); ?>)"><?php echo ($i); ?></a></li>
            <?php
            } else {
            ?>
                <li class="page-item"><a class="page-link" onclick="loadUsers(<?php echo ($i); ?>)"><?php echo ($i); ?></a></li>
        <?php
            }
        }
        ?>

        <li class="page-item">
            <a class="page-link" aria-label="Next" <?php
                                                    if ($page < $noOfPages) {
                                                    ?> onclick="loadUsers(<?php echo ($page + 1); ?>);" <?php
                                                                                                    }
                                                                                                        ?>>
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>

    </ul>
</nav>
<!-- pagination -->