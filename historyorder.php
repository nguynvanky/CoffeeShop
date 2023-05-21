<?php
ob_start();
require("includes/header.php");
if (isset($_SESSION['log_detail']) == false) {
    header("Location: index.php");
    exit();
}
$id_user = $_SESSION['log_detail'];
$carts = $db->GetCartOrderedByUser($id_user);

?>

<div class="container mt-5 pt-3 color-tan" style="min-height: 70vh;">
    <div class="justify-content-end d-flex mb-5">
        <a href="cart.php" class="text-tan nav-link"> <i>Back to previous</i> </a>
    </div>
    <?php if ($carts  == null) : ?>
        <div class="text-center">
            <h1 class="text-uppercase">Empty cart</h1>
            <img src="imgs/g6.jpg" alt="">
        </div>
    <? else : ?>
        <div class="col color-tan">
            <div class="">
                <div class=col-12">
                    <div class="shadow rounded-4 p-5 px-3">
                        <h1 class="text-center">Order History</h1>
                        <?php foreach ($carts as $cart) { ?>
                            <a href="detailhistory.php?id_cart=<?= $cart->id ?>" class="nav-link">
                                <div class="rounded-4 rounded bg-dark-purple-secondary w-100 d-flex item-cart-cart p-3 mt-4">
                                    <div class="ms-3 d-flex flex-column">
                                        <h5>Coffee Shop to: <?= $cart->address ?></h5>
                                        <h5><?= number_format($cart->total_price, 0, '.', ','); ?> $</h5>
                                    </div>
                                </div>
                            </a>
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