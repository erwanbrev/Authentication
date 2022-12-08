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
    <section>
        <table>
            <thead></thead>
            <tbody>
                <tr>
                    <td>
                        <label>ID</label>
                        <p><b>
                                <?php echo $row["id"]; ?>
                            </b></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>username</label>
                        <p><b>
                                <?php echo $row["username"]; ?>
                            </b></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>mail</label>
                        <p><b>
                                <?php echo $row["mail"]; ?>
                            </b></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>role</label>
                        <p><b>
                                <?php echo $row["role"]; ?>
                            </b></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <button>
            <a href="../controller/admin-panel.php">Cancel</a>
        </button>
    </section>
</body>

</html>