<?php
require('database/DatabaseHandler.php');
header('Content-Type: application/json');
$db = new DatabaseHandler();

$data =  null;
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['type'])) {
        $type = $_GET['type'];
        if ($type == 'GetProducts') {
            $data =  $db->Products();
        } else if ($type == 'GetCategories') {
            $data =  $db->Categories();
        } else if ($type == 'DetailsProduct') {
            $id = $_GET['id'];
            $data = $db->GetProductByID($id);
        } else if ($type == 'GetCart') {
            $id_user = $_GET['id_user'];
            $data = $db->GetCartByUser($id_user);
        } else if ($type == 'GetCartByIdCart') {
            $id_cart = $_GET['id_cart'];
            $data = $db->GetCartByIdCart($id_cart);
        } else if ($type == 'GetDetailsCart') {
            $id_user = $_GET['id_user'];
            $data = $db->GetDetailsCartByUser($id_user);
        } else if ($type == 'PlaceOrder') {
            $id_user = $_GET['id_user'];
            $address = $_GET['address'];
            $db->Pay($id_user, $address);
        } else if ($type == 'ListCartOrdered') {
            $id_user = $_GET['id_user'];
            $data = $db->GetCartOrderedByUser($id_user);
        } else if ($type == 'GetDetailsCartById') {
            $id_cart = $_GET['id_cart'];
            $data = $db->GetDetailsCartByIdCart($id_cart);
        } else if ($type == 'Login') {
            $username = $_GET['username'];
            $password = $_GET['password'];
            $data = $db->getUserLogin($username, $password);
        } else if ($type == 'DeleteDetailCart') {
            $id = $_GET['id'];
            $id_user = $_GET['id_user'];
            $data = $db->DeleteCartDetail($id);
            if ($data != null) {
                //update total price
                $total = 0;
                $cart = $db->GetCartByUser($id_user);
                $detailcarts = $db->GetDetailsCartByUser($id_user);
                if ($cart != null) {
                    $id_cart = $cart->id;
                    foreach ($detailcarts as $detail) {
                        $product = $db->GetProductByID($detail->id_product);
                        $total += $product->price * $detail->quantity;
                    }
                    //
                    $db->UpdateCart($id_cart, $total);
                }
            }
        } else if ($type == 'UpdateDetailCart') {
            $id = $_GET['id'];
            $id_user = $_GET['id_user'];
            $quantity = $_GET['quantity'];
            $db->UpdateCartDetail($id, $quantity);

            //update total price
            $total = 0;
            $cart = $db->GetCartByUser($id_user);
            $detailcarts = $db->GetDetailsCartByUser($id_user);
            if ($cart != null) {
                $id_cart = $cart->id;
                foreach ($detailcarts as $detail) {
                    $product = $db->GetProductByID($detail->id_product);
                    $total += $product->price * $detail->quantity;
                }
                //
                $db->UpdateCart($id_cart, $total);
            }
        } else if ($type == 'AddToCart') {
            $id_user = $_GET['id_user'];
            $id_product = $_GET['id_product'];
            $db->Order($id_user, $id_product);
            //update total price
            $total = 0;
            $cart = $db->GetCartByUser($id_user);
            $detailcarts = $db->GetDetailsCartByUser($id_user);
            if ($cart != null) {
                $id_cart = $cart->id;
                foreach ($detailcarts as $detail) {
                    $product = $db->GetProductByID($detail->id_product);
                    $total += $product->price * $detail->quantity;
                }
                //
                $db->UpdateCart($id_cart, $total);
            }
        } else if ($type == 'PutDetailsCart') {
            $id_user = $_GET['id_user'];
            $id_product = $_GET['id_product'];
            $db->Order($id_user, $id_product);
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_GET['type'];
}

echo json_encode($data);
