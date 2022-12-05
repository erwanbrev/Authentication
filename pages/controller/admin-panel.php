<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin panel</title>
    <link rel="stylesheet" href="../model/style.css">
</head>

<body>
    <div>
        <h2>Users Details</h2>
        <button class="admin-btn">
            <a href="../view/admin-panel-create.php"> Add New User</a>
        </button>
    </div>
    <section class="tab-admin-panel">
        <section class="inside-table-admin-panel">
            <table>
                <thead>
                    <tr>
                        <?php
                        // Include config file
                        require_once "../model/config.php";

                        // Attempt select query execution
                        $sql = "SELECT * FROM users";
                        if ($result = $mysqli->query($sql)) {
                            if ($result->num_rows > 0) {
                                echo "<th>ID</th>";
                                echo "<th>Username</th>";
                                echo "<th>Mail</th>";
                                echo "<th>Password</th>";
                                echo "<th>Role</th>";
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                <?php
                                while ($row = $result->fetch_array()) {
                                    // echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['username'] . "</td>";
                                    echo "<td>" . $row['mail'] . "</td>";
                                    echo "<td>" . substr($row['password'], 0, 10) . "</td>";
                                    echo "<td>" . $row['role'] . "</td>";
                                    echo "<td class=\"space-btw-td\">";
                                    echo '<a href="../view/admin-panel-read.php?id=' . $row['id'] . 'title="Read Record" data-toggle="tooltip"><span>Read</span></a>';
                                    echo '<a href="../view/admin-panel-update.php?id=' . $row['id'] . ' title="Update Record" data-toggle="tooltip"><span>Update</span></a>';
                                    echo '<a href="../view/admin-panel-delete.php?id=' . $row['id'] . '" title="Delete Record" data-toggle="tooltip"><span>Delete</span></a>';
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                // Free result set
                                $result->free();
                            } else {
                                echo '<div><em>No records were found.</em></div>';
                            }
                        } else {
                            echo "Oops! Something went wrong. Please try again later.";
                        }

                        // Close connection
                        $mysqli->close();
                ?>
                    </tr>
                </tbody>
            </table>
        </section>
    </section>
</body>

</html>