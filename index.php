<?php
include_once('includes/header.php');
include_once('database/DatabaseHandler.php');


?>
<section id="searchBox" style="margin-top: 80px!important;">
    <div class="container">
        <form action="search.php">
            <div class="row height d-flex justify-content-center align-items-center">
                <div class="col-md-8">
                    <div class="search">
                        <i class="fa fa-search text-dark"></i>
                        <input required name="keyword" type="text" class="form-control" placeholder="Search something...">
                        <button id="btn-search" type="submit" class="btn fw-bold">
                            Search
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<div class="container mt-5 ">
    <div class="col">
        <div class="row">
            <div class="col-8">
                <div id="carouselControls" class="carousel slide" data-mdb-ride="carousel" data-bs-ride="carousel">
                    <div class="carousel-inner ">
                        <div class="carousel-item active text-center img-fluid ">
                            <img class="d-block w-100" src="imgs/g3.jpg" alt="">
                        </div>
                        <div class="carousel-item text-center img-fluid">
                            <img class="d-block w-100" src="imgs/g4.jpg" alt="">
                        </div>
                        <div class="carousel-item text-center img-fluid">
                            <img class="d-block w-100" src="imgs/g5.jpg" alt="">
                        </div>

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-4 ">
                <div class="row g-4">
                    <img src="imgs/g5.jpg" alt="">
                    <img src="imgs/g6.jpg" alt="">
                </div>
            </div>
        </div>
    </div>

</div>
<div class="container mt-5 main">
    <?php foreach ($Categories as $category) : ?>
        <div>
            <a class="text-decoration-none mt-5" href="category.php?id=<?= $category->id; ?>">
                <h2 class="mt-5 fw-bold  text-tan"><?= $category->name ?></h2>
            </a>
        </div>
        <hr>
        <div class="col">
            <div class="row owl-carousel owl-theme">
                <?php $products_byid = $db->ProductsById_Category($category->id);
                ?>
                <? foreach ($products_byid as $product) : ?>
                    <div class="card item mx-4 rounded rounded-4 pb-3">
                        <div class="card-img-top">
                            <img loading="lazy" class=" img-fluid p-3 pb-1 " style="" src="<?= $product->image ?>" alt="">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold " title="<?= $product->name ?>"><?= $product->name ?></h5>
                            <h6 class="card-title " title="<?= $product->description ?>"><?= $product->description ?></h6>
                        </div>
                        <div class="card-bottom mx-3 rounded-4 rounded d-flex justify-content-between" style="line-height:60px;">
                            <p class="ms-5 mb-0 text-light"><?= number_format($product->price, 0, '.', ','); ?> $</p>
                            <a href="detail.php?id=<?= $product->id ?>" class="text-decoration-none square bg-tan d-flex justify-content-center align-items-center rounded-4 rounded text-center">
                                <i class="fa fa-plus mx-auto"></i>
                            </a>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>

        </div>

    <? endforeach; ?>
</div>
<?php
include_once('includes/footer.php');

?>