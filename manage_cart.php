<?php
session_start();
if (isset($_SESSION['admin']) == false) {
    header("Location: index.php");
    exit();
}
require('database\DatabaseHandler.php');
$db = new DatabaseHandler();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $img = $_POST['img'];
    $desc = $_POST['desc'];
    $category = $_POST['category'];
    $db->AddProduct($name, $price, $desc, $img, $category);
    header('Location: manage_product.php');
    exit();
}
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'delete') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $db->DeleteProduct($id);
            header('Location: manage_product.php');
            exit();
        }
    }
}
$products = $db->Products();
$categories = $db->Categories();
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
    <link rel="shortcut icon" href="./imgs/icon_launcher.png">

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
    <div class="modal fade" id="AddNewProduct" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">Add new product to database</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body text-dark">
                        <p class="mt-1">Name of product</p>
                        <input class=" form-control shadow-none" autocomplete="off" required type="text" name="name">
                        <p class="mt-1">Price of product</p>
                        <input class=" form-control shadow-none" autocomplete="off" required type="number" name="price">
                        <p class="mt-1">Description of product</p>
                        <input class=" form-control shadow-none" autocomplete="off" required type="text" name="desc">
                        <p class="mt-1">Link image of product</p>
                        <input class=" form-control shadow-none" autocomplete="off" required type="text" name="img">
                        <p class="mt-1">Category</p>
                        <select class="form-select shadow-none" name="category" id="">
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category->id ?>"><?= $category->name ?></option>
                            <? endforeach; ?>
                        </select>

                    </div>
                    <div class="modal-footer text-dark">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            Yes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
        <h1 class="text-center">LIST OF PRODUCT</h1>
        <a href="#" data-bs-toggle="modal" data-bs-target="#AddNewProduct" class="text-tan link-light text-decoration-none"><i class="fa fa-plus-square"></i> Add new product</a>
    </div>
    <div class="table-responsive container border border-2 rounded rounded-4 mt-5">
        <table class="table text-tan">
            <thead>
                <tr>
                    <th class="col-2">Image</th>
                    <th class="col-2">Name</th>
                    <th class="col-1">Price</th>
                    <th>Description</th>
                    <th class="col-1"></th>
                </tr>
            </thead>
            <tbody style="vertical-align: middle;" class="fw-bold">
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td class="p-4">
                            <img loading="lazy" class="img-fluid rounded rounded-5" src="<?= $product->image ?>" alt="">
                        </td>
                        <td><?= $product->name ?></td>
                        <td><?= number_format($product->price, 0, '.', ','); ?> $</td>
                        <td><?= $product->description ?></td>

                        <td>
                            <div class="d-flex justify-content-around">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#Edit_<?= $product->id ?>"><i class="fa fa-edit text-tan"></i></a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#DeleteConfirm_<?= $product->id ?>"><i class="fa fa-trash text-tan"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php foreach ($products as $product) : ?>
        <div class="modal fade" id="DeleteConfirm_<?= $product->id ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark">Confirm delete</h5>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-dark">
                        Are you want to delete <?= $product->name ?>?
                    </div>
                    <div class="modal-footer text-dark">
                        <button data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
                        <a href="manage_product.php?action=delete&id=<?= $product->id ?>" class="btn btn-primary">Yes</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="Edit_<?= $product->id ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark">Update product</h5>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="updateproduct.php">
                        <div class="modal-body text-dark">
                            <input class="d-none" autocomplete="off" required type="number" name="id" value="<?= $product->id ?>">

                            <p class="mt-1">Name of product</p>
                            <input class=" form-control shadow-none" autocomplete="off" required type="text" name="name" value="<?= $product->name ?>">
                            <p class="mt-1">Price of product</p>
                            <input class=" form-control shadow-none" autocomplete="off" required type="number" name="price" value="<?= $product->price ?>">
                            <p class="mt-1">Description of product</p>
                            <input class=" form-control shadow-none" autocomplete="off" required type="text" name="desc" value="<?= $product->description ?>">
                            <p class="mt-1">Link image of product</p>
                            <input class=" form-control shadow-none" autocomplete="off" required type="text" name="img" value="<?= $product->image ?>">
                            <p class="mt-1">Category</p>
                            <select class="form-select shadow-none" name="category" id="">
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category->id ?>"><?= $category->name ?></option>
                                <? endforeach; ?>
                            </select>

                        </div>
                        <div class="modal-footer text-dark">
                            <button type="button" data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                Yes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</body>
<script src="./script/bootstrap.bundle.js"></script>


</html>