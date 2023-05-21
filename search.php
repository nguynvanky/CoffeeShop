<?php
ob_start();
require_once('includes/header.php');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];
        $products = $db->SearchProduct($keyword);
    } else {
        header('Location: index.php');
        exit();
    }
}

?>
<div class="container mt-5 py-3" style="min-height: 50vh;">
    <div class="text-center my-5">
        <h1 class="text-uppercase fw-bold color-tan">Products for: <?= $keyword ?></h1>
    </div>
    <div class="col" id="seamless-replace">
        <div class="row g-5">
            <? foreach ($products as $product) : ?>
                <div class="col-12 p-2 col-md-6 col-sm-6  col-lg-3">
                    <div class="card mx-4 mx-lg-2 rounded rounded-4 pb-3">
                        <div class="card-img-top">
                            <img class=" img-fluid p-3 pb-1 " style="" src="./imgs/<?= $product->image ?>" alt="">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold " title="<?= $product->name ?>"><?= $product->name ?></h5>
                            <h6 class="card-title " title="<?= $product->description ?>"><?= $product->description ?></h6>
                        </div>
                        <div class="card-bottom mx-3 rounded-4 rounded d-flex justify-content-between" style="line-height:60px;">
                            <p class="ms-4 mb-0 text-light"><?= number_format($product->price, 0, '.', ','); ?> $</p>
                            <a href="detail.php?id=<?= $product->id ?>" class="text-decoration-none square bg-tan d-flex justify-content-center align-items-center rounded-4 rounded text-center">
                                <i class="fa fa-plus mx-auto"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</div>
<?php
require_once('includes/footer.php');
?>