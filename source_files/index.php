<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <title>CRUD</title>
</head>
<body>
    <?php require_once 'process.php'; ?>

    <!-- Save and Delete message alert -->
    <?php if(isset($_SESSION['message'])): ?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>
    <?php endif; ?>

    <?php
        $mysqli = new mysqli('localhost', 'root', 'root', 'crud') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);

        // print_r($result->fetch_assoc());
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th colspan="2">Action</th>
                    </tr>

                    <?php while($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['location'] ?></td>
                            <td>
                                <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                                <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </thead>
            </table>
        </div>
    </div>

    <div class="row justify-content-center">
        <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control" name="name" value="<?php echo $name; ?>" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" class="form-control" name="location" value="<?php echo $location; ?>" placeholder="Location">
            </div>
            <div class="form-group">
                <?php if($update == true): ?>
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                <?php else: ?>
                    <button type="submit" class="btn btn-primary" name="save">Save</button>
                <?php endif; ?>
            </div>
        </form>
    </div>
</body>
</html>