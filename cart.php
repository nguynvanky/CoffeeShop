<?php
ob_start();
require("includes/header.php");
if (isset($_SESSION['log_detail']) == false) {
    header("Location: index.php");
    exit();
}
$id_user = $_SESSION['log_detail'];
$detailcarts = $db->GetDetailsCartByUser($id_user);
// update tổng tiền của cart 
$total = 0;
$cart = $db->GetCartByUser($id_user);
if ($cart != null) {
    $id_cart = $cart->id;
    foreach ($detailcarts as $detail) {
        $product = $db->GetProductByID($detail->id_product);
        $total += $product->price * $detail->quantity;
    }
    //
    $db->UpdateCart($id_cart, $total);
    $user = $db->GetUserByID($id_user);
}
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'pay') {
        $address = $_GET['address'];
        $db->Pay($id_user, $address);
        header('Location: cart.php');
    }
}
if (isset($_GET['action']) &&  isset($_GET['id'])) {
    $action = $_GET['action'];
    $id_detail = $_GET['id'];
    if ($action == 'delete') {
        $db->DeleteCartDetail($id_detail);
        header('Location: cart.php');
    } else if ($action == 'update') {
        $quantity = $_GET['quantity'];
        $db->UpdateCartDetail($id_detail, $quantity);
        header('Location: cart.php');
    }
}
?>

<div class="container mt-5 pt-3 color-tan" style="min-height: 70vh;">
    <div class="justify-content-end d-flex mb-5">
        <a href="historyorder.php" class="text-tan nav-link"> <i>Your History Order</i> </a>
    </div>
    <?php if ($detailcarts  == null) : ?>
        <div class="text-center">
            <h1 class="text-uppercase">Empty cart</h1>
            <img src="imgs/g6.jpg" alt="">
        </div>
    <? else : ?>
        <div class="col color-tan">
            <div class="row">
                <div class="col-12 col-md-9">
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
                                    <form action="cart.php" method="get">
                                        <input type="text" name="action" value="update" hidden>
                                        <input type="text" name="id" value="<?= $detail->id ?>" hidden>
                                        <input class="form-control mx-auto shadow-none fw-bold" name="quantity" type="number" value="<?= $detail->quantity ?>">
                                        <input type="submit" hidden>
                                    </form>
                                </div>
                                <a class="ms-3" href="cart.php?action=delete&id=<?= $detail->id ?>"><i class="fa  fa-close text-danger"></i></a>
                            </div>
                            <!-- <td class="text-center">
                                    <form action="cart.php" method="get">
                                        <input type="text" name="action" value="update" hidden>
                                        <input type="text" name="id" value="<?= $detail->id ?>" hidden>
                                        <input class="form-control mx-auto w-50 shadow-none" name="quantity" type="number" value="<?= $detail->quantity ?>" width="5">
                                        <input type="submit" hidden>
                                    </form>
                                </td>
                                <td>
                                    <a href="cart.php?action=delete&id=<?= $detail->id ?>"><i class="fa fa-close text-danger"></i></a>
                                </td> -->
                        <? } ?>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="bg-blue p-4 rounded-4 shadow">
                        <div class="text-center">
                            <h3 class="text-white">Confirm Infomation</h3>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="mb-0">Full name</p>
                            <p class="mb-0"><?= $user->full_name; ?></p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="mb-0">Phone number</p>
                            <p class="mb-0"><?= $user->phonenumber; ?></p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="mb-0">Email</p>
                            <p class="mb-0"><?= $user->email; ?></p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="mb-0 fw-bold">Total price:</p>
                            <p class="mb-0 text-yellow fw-bold"><?= number_format($total, 0, '.', ','); ?> $</p>
                        </div>
                        <hr>
                        <input required placeholder="Address (Optional)..." type="text" id="input_address" class="form-control shadow-none">
                        <div class="text-center d-flex flex-column">
                            <div class="mt-3">
                                <a href="#" class="bg-yellow btn-warning btn text-dark fw-bold" data-bs-toggle="modal" data-bs-target="#ConfirmPay">PAY NOW</a>
                            </div>
                        </div>
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