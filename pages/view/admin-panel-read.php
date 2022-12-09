<?php
// Include config file
require_once "../controller/read-users.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View profile</title>
    <link rel="stylesheet" href="../model/style.css">
</head>

<body>
    <h1>View profile</h1>
    <section class="tab-admin-panel">
        <section class="inside-table-admin-panel">
            <table>
                <thead>
                    <tr>
                        <th>
                            <label>ID</label>
                        </th>
                        <th>
                            <label>Username</label>
                        </th>
                        <th>
                            <label>Mail</label>
                        </th>
                        <th>
                            <label>Role</label>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php echo $row["id"]; ?>
                        </td>
                        <td>
                            <?php echo $row["username"]; ?>
                        </td>
                        <td>
                            <?php echo $row["mail"]; ?>
                        </td>
                        <td>
                            <?php echo $row["role"]; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button class="form-btn">
                <a href="../controller/admin-panel.php">Cancel</a>
            </button>
        </section>
    </section>
</body>

</html>