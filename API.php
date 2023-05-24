<?php
header('Content-Type: application/json');
require('database/DatabaseHandler.php');
require('config.php');
$db = new DatabaseHandler(db_host, db_name, db_user, db_password);


$data = null;
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
        } else if ($type == 'Login') {
            $username = $_GET['username'];
            $password = $_GET['password'];
            $data = $db->getUserLogin($username, $password);
        } else if ($type == 'AddProduct') {
            $name = $_GET['name'];
            $price = $_GET['price'];
            $img = $_GET['img'];
            $desc = $_GET['desc'];
            $category = $_GET['category'];
            $db->AddProduct($name, $price, $desc, $img, $category);
        } else if ($type == 'AddProduct') {
            $name = $_GET['name'];
            $price = $_GET['price'];
            $img = $_GET['img'];
            $desc = $_GET['desc'];
            $category = $_GET['category'];
            $db->AddProduct($name, $price, $desc, $img, $category);
        } else if ($type == 'Register') {
            $username = $_GET["username"];
            $password = $_GET["password"];
            $fullname = $_GET["fullname"];
            $email = $_GET["email"];
            $phonenumber = $_GET["phonenumber"];
            $db->Register($fullname, $phonenumber, $email, $username, $password);
            $data = $db->getUserLogin($username, $password);
        } else if ($type == 'UpdateProduct') {
            $id = $_GET['id'];
            $name = $_GET['name'];
            $price = $_GET['price'];
            $img = $_GET['img'];
            $desc = $_GET['desc'];
            $category = $_GET['category'];
            $db->UpdateProduct($id, $name, $price, $desc, $img, $category);
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['type'];
    // if ($type == 'Login') {
    //     $username = $_POST['username'];
    //     $password = $_POST['password'];
    //     $data = $db->getUserLogin($username, $password);
    // }
}


echo json_encode($data);
