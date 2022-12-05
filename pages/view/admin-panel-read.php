<?php
// Include config file
require_once "../controller/read-users.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>ID</label>
                        <p><b><?php echo $row["id"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>username</label>
                        <p><b><?php echo $row["username"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>mail</label>
                        <p><b><?php echo $row["mail"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>role</label>
                        <p><b><?php echo $row["role"]; ?></b></p>
                    </div>
                    <p><a href="../controller/admin-panel.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>