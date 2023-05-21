<?php
ob_start();
require('includes/header.php');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id;
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $product = $db->GetProductByID($id);
    }

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        if ($action == 'order') {
            $db->Order($_SESSION['log_detail'], $id);
            header('Location: cart.php');
        }
    }
}
?>

<style>
    .img-fluid {
        aspect-ratio: 5/2;
        object-fit: contain;
        height: 600px;
    }
</style>

<div class="container mt-5 pt-5">
    <div class="col">
        <div class="row">
            <div class="col-md-8 col-12">
                <div class="text-center">
                    <img class="img-fluid" src="<?= $product->image ?>" alt="">
                </div>
                <p class="color-tan mt-4"><?= $product->description ?> Cappuccino Drizzled with Caramel A single espresso shot poured into hot foamy milk, with the surface topped with mildly sweetened cocoa powder and drizzled with scrumptious caramel syrup</p>
            </div>
            <div class="col-md-4 col-12 text-tan">
                <div class="p-4" style="background-color: var(--light-purple-primary);">
                    <h3><?= $product->name; ?></h3>

                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="mb-0">Favourite</p>
                        <p class="mb-0 text-yellow"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></p>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between align-items-center ">
                        <p class="mb-0">Price: </p>
                        <p class="mb-0"><?= number_format($product->price, 0, '.', ','); ?> $</p>
                    </div>
                    <hr>
                    <div class="text-center d-flex flex-column">
                        <div class="mt-3">
                            <?php if (!isset($_SESSION["log_detail"])) :  ?>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalSignIn" class="bg-tan btn-secondary btn text-dark fw-bold text-uppercase">Buy now</a>
                            <? else : ?>
                                <a href="detail.php?action=order&id=<?= $product->id ?>" class="bg-tan btn-secondary btn text-dark fw-bold text-uppercase">Buy now</a>
                            <? endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php
require('includes/footer.php');
?>