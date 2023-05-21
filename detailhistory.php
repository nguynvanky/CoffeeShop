<?php
ob_start();
require("includes/header.php");
if (isset($_SESSION['log_detail']) == false) {
    header("Location: index.php");
    exit();
}
$detailcarts = null;
if (isset($_GET['id_cart'])) {
    $detailcarts = $db->GetDetailsCartByIdCart($_GET['id_cart']);
}

?>

<div class="container mt-5 pt-3 color-tan" style="min-height: 70vh;">
    <div class="justify-content-end d-flex mb-5">
        <a href="historyorder.php" class="text-tan nav-link"> <i>Back to order history</i> </a>
    </div>
    <?php if ($detailcarts  == null) : ?>
        <div class="text-center">
            <h1 class="text-uppercase">Empty cart</h1>
            <img src="imgs/g6.jpg" alt="">
        </div>
    <? else : ?>
        <div class="col color-tan">
            <div class="row">
                <div class="col-12">
                    <div class="shadow rounded-4 p-5 px-3">
                        <?php foreach ($detailcarts as $detail) { ?>
                            <?php $product = $db->GetProductByID($detail->id_product); ?>
                            <div class="rounded-4 rounded bg-dark-purple-secondary w-100 d-flex item-detail-cart p-3 mt-4">
                                <img class="img-fluid" src="<?= $product->image ?>" alt="">
                                <div class="ms-3 d-flex flex-column">
                                    <h4><?= $product->name ?></h4>
                                    <h5><?= number_format($product->price, 0, '.', ','); ?> $</h5>
                                </div>
                                <div class="ms-auto d-flex align-items-center justify-content-center">
                                    <input type="text" name="action" value="update" hidden>
                                    <input type="text" name="id" value="<?= $detail->id ?>" hidden>
                                    <input class="form-control mx-auto shadow-none fw-bold" name="quantity" type="number" value="<?= $detail->quantity ?>">
                                </div>
                            </div>
                        <? } ?>
                    </div>
                </div>
            </div>

        </div>
    <? endif; ?>

</div>
<div class="modal fade " tabindex="-1" id="ConfirmPay">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Pay now?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" data-bs-dismiss="modal" class="btn btn-primary" onclick="Pay()">Accept</button>
            </div>
        </div>
    </div>
</div>
<div aria-live="polite" aria-atomic="true" style="position: relative;">
    <div class="toast" style="position: fixed; top: 7%; right: 2%; z-index:999999;">
        <div class="toast-header d-flex justify-content-between">
            <img src="imgs/icon_launcher.png" style="height:20px; width:auto;" class="rounded mr-2 img-fluid" alt="...">
            <strong class="mr-auto">Coffee shop</strong>
            <button type="button" class="ml-2 mb-1 btn-close shadow-none" data-bs-dismiss="toast" aria-label="Close">
            </button>
        </div>
        <div class="toast-body fw-bolder">
            Thank you very much for using our services. We will always strive to do our best. ♥
        </div>
    </div>
</div>

<?php
require("includes/footer.php");

?>