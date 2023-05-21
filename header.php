<?php
session_start();
require('./database/DatabaseHandler.php');
$db = new DatabaseHandler();
$Categories = $db->Categories();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#201520">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/fontawesome.css">

    <link rel="stylesheet" href="./css/owl.carousel.css">
    <link rel="stylesheet" href="./css/owl.theme.default.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/card_item.css">
    //<link rel="shortcut icon" href="./imgs/icon_launcher.png">
    <title>Coffee Shop</title>
</head>


<body>
    <header class="container d-none justify-content-between align-items-center d-md-flex">
        <p class="mb-0 "></p>
        <?php if (isset($_SESSION['log_detail'])) : ?>
            <?php if (isset($_SESSION['admin'])) : ?>
                <span class="d-flex gap-2"><a href="manage_product.php"> <i>Hi, <?= $_SESSION["log_name"] ?></i></a> / <a href="logout.php">Sign out</a></span>
            <? else : ?>
                <span class="d-flex gap-2"><a href=""> <i>Hi, <?= $_SESSION["log_name"] ?></i></a> / <a href="logout.php">Sign out</a></span>

            <? endif ?>
        <?php else : ?>
            <span class="d-flex gap-2"><a href="#" class="btnSignUp">Sign up</a> / <a class="btnSignIn" href="#">Sign in</a></span>
        <?php endif ?>
    </header>
    <div class="mt-md-0 mt-5 pt-5 pt-md-0 mb-5">
        <nav class="header-nav navbar navbar-expand-xxl navbar-dark  container rounded-5 rounded px-5">
            <div class="container-fluid d-flex align-items-center">
                <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse order-0 w-100 dual-collapse2  ">
                    <ul class="navbar-nav ms-5">
                        <li class="nav-item px-3">
                            <a class="nav-link  fw-bold" href="index.php">Home</a>
                        </li>
                        <li class="nav-item  px-3">
                            <a class="nav-link fw-bold " href="lienhe.php">Contact</a>
                        </li>
                        <li class="nav-item dropdown  px-3">
                            <a class="nav-link dropdown-toggle fw-bold" href="#" id="dropDownTour" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categories </a>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropDownTour">
                                <?php foreach ($Categories as $category) : ?>
                                    <li>
                                        <a class="dropdown-item fw-bold" href="././category.php?id=<?= $category->id; ?>"> <?= $category->name ?></a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="p-3 rounded-circle" id="logo-center">
                    <a class="" href="index.php">
                        <img style="width:150px; height:150px;" class="rounded-circle" src="../imgs/icon_launcher.png" alt="">
                    </a>
                </div>

                <div class="d-flex align-items-center order-4 flex-row justify-content-center text-light gap-2 ">
                    <?php if (!isset($_SESSION["log_detail"])) :  ?>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                            <i style="color: var(--color-tan); " class="fa fa-cart-shopping  fa-2x">

                            </i>
                        </a>
                    <? else : ?>
                        <a href="cart.php">
                            <i style="color: var(--color-tan); " class="fa fa-2x fa-cart-shopping position-relative">
                                <span style="font-size: 13px;" class="position-absolute small px-2 top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                                    <span class=""><?= count($db->GetDetailsCartByUser($_SESSION["log_detail"])) ?> </span>
                                </span>
                            </i>
                        </a>
                    <? endif; ?>

                </div>
            </div>
        </nav>
    </div>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <div class="d-flex justify-content-center w-100" style="background-color: var(--dark-purple-primary);">
                <img class="rounded-circle" style="width:150px; height:150px;" src="../imgs/icon_launcher.png" alt="">
            </div>
            <button type="button" class="btn-close text-reset shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-unstyled ps-0">
                <li class="mb-1">
                    <a href="index.php" class="list-group-item p-3 link-dark">Home</a>
                </li>
                <li class="border-top my-1"></li>
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed p-3" data-bs-toggle="collapse" data-bs-target="#tour-collapse" aria-expanded="false">
                        Categories
                    </button>
                    <div class="collapse ms-4" id="tour-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <?php foreach ($Categories as $category) : ?>
                                <li>
                                    <a class="link-dark my-5  text-decoration-none rounded" href="././category.php?id=<?= $category->id; ?>"> <?= $category->name ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </li>
                <li class="border-top my-1"></li>
                <li class="mb-1">
                    <a href="lienhe.php" class="list-group-item p-3 link-dark">Contact</a>
                </li>


                <?php if (!isset($_SESSION['log_detail'])) : ?>
                    <li class="border-top my-1"></li>
                    <li class="mb-1">
                        <a href="#" class="list-group-item p-3 link-dark btnSignIn"><i class="fa fa-user"></i> Sign in</a>
                    </li>
                    <li class="border-top my-1"></li>
                    <li class="mb-1">
                        <a href="#" class="list-group-item p-3 link-dark btnSignUp"> <i class="fa fa-user-plus"></i> Sign out</a>
                    </li>
                    <li class="border-top my-1"></li>
                <?php else : ?>
                    <li class="border-top my-1"></li>
                    <li class="mb-1">
                        <a href="logout.php" class="list-group-item p-3 link-dark"> <i class="fa fa-sign-out"></i> Sign out</a>
                    </li>
                    <li class="border-top my-1"></li>
                <?php endif ?>

            </ul>

        </div>
    </div>