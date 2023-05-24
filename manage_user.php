<?php
session_start();
if (isset($_SESSION['admin']) == false) {
    header("Location: index.php");
    exit();
}
include_once('config.php');
require('database/DatabaseHandler.php');
$db = new DatabaseHandler(db_host, db_name, db_user, db_password);
$users = $db->Users();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="https://github.com/nguynvanky/images/blob/main/icon_launcher.png?raw=true">

    <title>ADMIN</title>
</head>

<style>
    img {
        aspect-ratio: 4/4;
        object-fit: cover;
        max-height: 270px;
    }
</style>

<body>
    <div class="container-fluid">
        <a href="index.php" class=" link-light fw-bold text-decoration-none">Go to website</a>
    </div>
    <nav class="container py-4 mt-5 rounded rounded-4" style="background-color: #38232a;">
        <ul class="navbar-expand  d-flex justify-content-evenly nav-bar nav">
            <li class="nav-item">
                <a class="nav-link text-uppercase" href="manage_product.php">
                    <h3>Product</h3>
                </a>
            </li>
            <li class="nav-item text-uppercase">
                <a class="nav-link" href="manage_user.php">
                    <h3>User</h3>
                </a>
            </li>
            <li class="nav-item text-uppercase">
                <a class="nav-link" href="manage_cart.php">
                    <h3>Cart</h3>
                </a>
            </li>

        </ul>

    </nav>
    <div class="container mt-5">
        <h1 class="text-center">LIST OF USER</h1>
    </div>
    <div class="table-responsive container border border-2 rounded rounded-4 mt-5">
        <table class="table text-tan">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Role</th>
                    <th>Username</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody style="vertical-align: middle;" class="fw-bold">
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= $user->full_name ?></td>
                        <td><?= $user->email ?></td>
                        <td><?= $user->phonenumber ?></td>
                        <td><?= $user->role ?></td>
                        <td><?= $user->username ?></td>
                        <td><?= $user->_password ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
<script src="./script/bootstrap.bundle.js"></script>


</html>