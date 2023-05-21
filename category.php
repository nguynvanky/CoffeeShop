<?php
ob_start();
require_once('includes/header.php');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $products_ori = $db->ProductsById_Category($id);
        $limit = 8;
        $total_rows = count($products_ori);
        $total_pages = ceil($total_rows / $limit);

        if (!isset($_GET['page'])) {

            $page = 1;
        } else {

            $page = $_GET['page'];
        }
        $initial_page = ($page - 1) * $limit;

        $products = $db->ProductsById_Category_WithPagination($id, $initial_page, $limit);
    } else {
        header('Location: index.php');
        exit();
    }
}

?>
<div class="container mt-5 py-3">
    <div class="text-center my-5">
        <h1 class="text-uppercase fw-bold text-tan"><?= $db->getNameCategory($id); ?></h1>
    </div>
    <div class="col" id="seamless-replace">
        <div class="row g-5">
            <? foreach ($products as $product) : ?>
                <div class="col-12 p-4 col-md-6 col-sm-6  col-lg-3">
                    <div class="card mx-4 mx-lg-2 rounded rounded-4 pb-3">
                        <div class="card-img-top text-center">
                            <img class="img-fluid p-3 pb-1 " style="" src="<?= $product->image ?>" alt="">
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
        <nav class="mt-5">
            <ul class="pagination justify-content-center w-pagination-wrapper fw-semibold">
                <?php
                for ($page_number = 1; $page_number <= $total_pages; $page_number++) : ?>
                    <?php if ($page_number == $page) : ?>
                        <li class="page-item">
                            <a class="page-link  page-active shadow-none"><?= $page_number ?></a>
                        </li>
                    <? else : ?>
                        <li class="page-item">
                            <a class="page-link  shadow-none" href="category.php?id=<?= $id ?>&page=<?= $page_number ?>"><?= $page_number ?></a>
                        </li>
                    <? endif; ?>
                <? endfor ?>
            </ul>
        </nav>

    </div>
</div>
<?php
require_once('includes/footer.php');
?>