<?php
require('./class/Cart.php');
require('./class/Category.php');
require('./class/User.php');
require('./class/DetailCart.php');
require('./class/Product.php');

class DatabaseHandler
{
    public function __construct()
    {
    }

    private function getConn()
    {
        try {
            $hostname = "localhost";
            $dbname = "coffeshop";
            $user = "vanky";
            $password = "vanky";
            //  $hostname = "sql210.epizy.com";
            // $dbname = "epiz_34241675_coffeeshop";
            // $user = "epiz_34241675";
            // $password = "tIXTKOWDvznB60";
            $dsn = "mysql:host=$hostname;dbname=$dbname;charset=UTF8";
            return new PDO($dsn, $user, $password);
        } catch (PDOException $ec) {
            echo $ec->getMessage();
            exit;
        }
    }
    public function Categories()
    {
        $connection = DatabaseHandler::getConn();
        $query = "select * from category";
        $statement =  $connection->prepare($query);


        if ($statement->execute()) {
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Category');
        } else {
            $err = $statement->errorInfo();
            var_dump($err);
        }
        return $statement->fetchAll();
    }
    public function Products()
    {
        $connection = DatabaseHandler::getConn();
        $query = "select * from product";
        $statement =  $connection->prepare($query);


        if ($statement->execute()) {
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Product');
        } else {
            $err = $statement->errorInfo();
            var_dump($err);
        }
        return $statement->fetchAll();
    }
    public function Users()
    {
        $connection = DatabaseHandler::getConn();
        $query = "select * from _user";
        $statement =  $connection->prepare($query);


        if ($statement->execute()) {
            $statement->setFetchMode(PDO::FETCH_CLASS, 'User');
        } else {
            $err = $statement->errorInfo();
            var_dump($err);
        }
        return $statement->fetchAll();
    }
    public function ProductsById_Category($id)
    {
        $connection = DatabaseHandler::getConn();
        $query = "select * from product where id_cate =:id";
        $statement =  $connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        if ($statement->execute()) {
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Product');
        } else {
            $err = $statement->errorInfo();
            var_dump($err);
        }
        return $statement->fetchAll();
    }
    public function SearchProduct($keyword)
    {
        $connection = DatabaseHandler::getConn();
        $query = 'SELECT * FROM product WHERE name COLLATE utf8mb4_general_ci LIKE \'' . "%" . $keyword . '%\'';
        $statement =  $connection->prepare($query);
        $statement->bindParam(':keyword', $keyword, PDO::PARAM_STR);

        if ($statement->execute()) {
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Product');
        } else {
            $err = $statement->errorInfo();
            var_dump($err);
        }
        return $statement->fetchAll();
    }
    public function ProductsById_Category_WithPagination($id, $initial_page, $limit)
    {
        $connection = DatabaseHandler::getConn();
        $query = "select * from product where id_cate =:id LIMIT :initial_page, :limit";
        $statement =  $connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->bindValue(':initial_page', $initial_page, PDO::PARAM_INT);
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        if ($statement->execute()) {
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Product');
        } else {
            $err = $statement->errorInfo();
            var_dump($err);
        }
        return $statement->fetchAll();
    }

    public function getNameCategory($id)
    {
        $connection = DatabaseHandler::getConn();
        $query = "select * from category where id =:id";
        $statement =  $connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        if ($statement->execute()) {
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Category');
        } else {
            $err = $statement->errorInfo();
            var_dump($err);
        }
        $loaitours =  $statement->fetchAll();
        foreach ($loaitours as $loaitour) {
            return $loaitour->name;
        }
    }
    public function AddProduct($name, $price, $desc,  $img, $category)
    {
        $connection = DatabaseHandler::getConn();
        $query = "INSERT INTO `product`(`name`, `price`, `description`, `id_cate`, `image`) VALUES (:name,:price,:desc,:category,:img)";
        $statement =  $connection->prepare($query);
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->bindParam(':price', $price, PDO::PARAM_STR);
        $statement->bindParam(':desc', $desc, PDO::PARAM_STR);
        $statement->bindParam(':category', $category, PDO::PARAM_INT);
        $statement->bindParam(':img', $img, PDO::PARAM_STR);
        if ($statement->execute()) {
            return $connection->lastInsertId();
        } else {
            return -1;
        }
    }
    public function UpdateProduct($id, $name, $price, $desc,  $img, $category)
    {
        $connection = DatabaseHandler::getConn();
        $query = "UPDATE `product` SET `id`=:id,`name`=:name,`price`=:price,`description`=:desc,`id_cate`=:category,`image`=:img WHERE id = :id";
        $statement =  $connection->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->bindParam(':price', $price, PDO::PARAM_STR);
        $statement->bindParam(':desc', $desc, PDO::PARAM_STR);
        $statement->bindParam(':category', $category, PDO::PARAM_INT);
        $statement->bindParam(':img', $img, PDO::PARAM_STR);
        if ($statement->execute()) {
            return $connection->lastInsertId();
        } else {
            return -1;
        }
    }
    public function DeleteProduct($id)
    {
        $connection = DatabaseHandler::getConn();
        $query = "DELETE FROM `product` WHERE id = :id";
        $statement =  $connection->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        if ($statement->execute()) {
            return $connection->lastInsertId();
        } else {

            return -1;
        }
    }
    public function Register($full_name, $phone_number, $email,  $username, $_password)
    {
        $connection = DatabaseHandler::getConn();
        $query = "INSERT INTO _user(full_name, phonenumber, email, role, username, _PASSWORD) VALUES (:full_name,:phone_number,:email,'user',:username,:password)";
        $statement =  $connection->prepare($query);
        $statement->bindParam(':full_name', $full_name, PDO::PARAM_STR);
        $statement->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $hash_pass = password_hash($_password, PASSWORD_BCRYPT);
        $statement->bindParam(':password', $hash_pass, PDO::PARAM_STR);
        if ($statement->execute()) {
            return $connection->lastInsertId();
        } else {
            return -1;
        }
    }
    public function getUserLogin($username, $password)
    {
        $connection = DatabaseHandler::getConn();
        $query = "SELECT * FROM _user WHERE username =:username";
        $statement =  $connection->prepare($query);
        $statement->bindValue(':username', $username, PDO::PARAM_STR);
        if ($statement->execute()) {
            $statement->setFetchMode(PDO::FETCH_CLASS, 'User');
            $user = $statement->fetch();
            if ($user == null)
                return null;
            $auth = password_verify($password, $user->_password);
            if ($auth == true) {
                return $user;
            }
        } else {
            var_dump($statement->errorInfo());
        }

        return null;
    }
    public function GetProductByID($id)
    {
        $connection = DatabaseHandler::getConn();
        $query = "SELECT * FROM product WHERE id =:id";
        $statement =  $connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        if ($statement->execute()) {
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $statement->fetch();
        } else {
        }
    }
    public function GetDetailsCartByUser_Ordered($id_user)
    {
        $connection = DatabaseHandler::getConn();
        $query = "SELECT * FROM cart WHERE id_user =:id_user and _status = 1";
        $statement =  $connection->prepare($query);
        $statement->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        if ($statement->execute()) {
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Cart');
            $cart = $statement->fetch();
            if ($cart != null) {
                $query = "SELECT * FROM detail_cart WHERE id_cart =:id_cart";
                $statement =  $connection->prepare($query);
                $statement->bindValue(':id_cart', $cart->id, PDO::PARAM_INT);
                if ($statement->execute()) {
                    $statement->setFetchMode(PDO::FETCH_CLASS, 'DetailCart');
                    return $statement->fetchAll();
                }
            }
        }
    }
    public function GetDetailsCartByIdCart($id_cart)
    {
        $connection = DatabaseHandler::getConn();
        $query = "SELECT * FROM detail_cart WHERE id_cart =:id_cart";
        $statement =  $connection->prepare($query);
        $statement->bindValue(':id_cart', $id_cart, PDO::PARAM_INT);
        if ($statement->execute()) {
            $statement->setFetchMode(PDO::FETCH_CLASS, 'DetailCart');
            return $statement->fetchAll();
        }
    }
    public function GetDetailsCartByUser($id_user)
    {
        $connection = DatabaseHandler::getConn();
        $query = "SELECT * FROM cart WHERE id_user =:id_user and _status = 0";
        $statement =  $connection->prepare($query);
        $statement->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        if ($statement->execute()) {
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Cart');
            $cart = $statement->fetch();
            if ($cart != null) {
                $query = "SELECT * FROM detail_cart WHERE id_cart =:id_cart";
                $statement =  $connection->prepare($query);
                $statement->bindValue(':id_cart', $cart->id, PDO::PARAM_INT);
                if ($statement->execute()) {
                    $statement->setFetchMode(PDO::FETCH_CLASS, 'DetailCart');
                    return $statement->fetchAll();
                }
            }
        }
    }
    public function UpdateCart($id, $total)
    {
        $connection = DatabaseHandler::getConn();
        $query = "update cart set total_price=:total where id=:id";
        $statement =  $connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->bindValue(':total', $total, PDO::PARAM_STR);
        if ($statement->execute()) {
            $connection->lastInsertId();
        }
    }
    public function Pay($id_user, $address)
    {
        $connection = DatabaseHandler::getConn();
        $query = "update cart set _status=1, address=:address where id_user=:id_user and _status=0";
        $statement =  $connection->prepare($query);
        $statement->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $statement->bindValue(':address', $address, PDO::PARAM_STR);
        if ($statement->execute()) {
            $connection->lastInsertId();
        }
    }
    public function GetUserByID($id)
    {
        $connection = DatabaseHandler::getConn();
        $query = "SELECT * FROM _user WHERE id =:id";
        $statement =  $connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        if ($statement->execute()) {
            $statement->setFetchMode(PDO::FETCH_CLASS, 'User');
            return $statement->fetch();
        } else {
        }
    }
    public function GetCartByUser($id_user)
    {
        $connection = DatabaseHandler::getConn();
        $query = "SELECT * FROM cart WHERE id_user =:id_user and _status = 0";

        $statement =  $connection->prepare($query);
        $statement->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        if ($statement->execute()) {
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Cart');
            $cart = $statement->fetch();
            return $cart;
        } else {
        }
    }
    public function GetCartByIdCart($id_cart)
    {
        $connection = DatabaseHandler::getConn();
        $query = "SELECT * FROM cart WHERE id =:id";
        $statement =  $connection->prepare($query);
        $statement->bindValue(':id', $id_cart, PDO::PARAM_INT);
        if ($statement->execute()) {
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Cart');
            $cart = $statement->fetch();
            return $cart;
        } else {
        }
    }
    public function GetCartOrderedByUser($id_user)
    {
        $connection = DatabaseHandler::getConn();
        $query = "SELECT * FROM cart WHERE id_user =:id_user and _status = 1";

        $statement =  $connection->prepare($query);
        $statement->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        if ($statement->execute()) {
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Cart');
            $carts = $statement->fetchAll();
            return $carts;
        } else {
            return null;
        }
    }
    public function DeleteCartDetail($id)
    {
        $connection = DatabaseHandler::getConn();
        $query = "delete from detail_cart where id=:id ";
        $statement =  $connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        if ($statement->execute()) {
            return $statement->errorCode();
        } else {
            return null;
        }
    }
    public function UpdateCartDetail($id, $quantity)
    {
        $connection = DatabaseHandler::getConn();
        $query = "update detail_cart set quantity=:quantity where id=:id";
        $statement =  $connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->bindValue(':quantity', $quantity, PDO::PARAM_INT);
        if ($statement->execute()) {
            $connection->lastInsertId();
        }
    }
    public function Order($id_user, $id_product)
    {
        $connection = DatabaseHandler::getConn();
        $query = "SELECT * FROM cart WHERE id_user =:id_user and _status = 0";
        $statement =  $connection->prepare($query);
        $product =  DatabaseHandler::GetProductByID($id_product);
        $statement->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        if ($statement->execute()) {
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Cart');
            $cart = $statement->fetchAll();
            $count =  count($cart);
            if ($count == 0) // trường hợp user này chưa từng order hoặc đã thanh toán rồi nên cần phải tạo lại đơn mới
            {
                $query_order = "INSERT INTO cart(id_user,total_price,_status) values(:id_user,:total,0) ";
                $statement_cart =  $connection->prepare($query_order);
                $statement_cart->bindValue(':id_user', $id_user, PDO::PARAM_INT);
                $statement_cart->bindValue(':total', $product->price, PDO::PARAM_STR);
                if ($statement_cart->execute()) {
                    $id_cart =  $connection->lastInsertId();
                    $query_cart_detail = "INSERT INTO detail_cart(id_cart,id_product,quantity,price) values(:id_cart,:id_product,1,:price) ";
                    $statement_cart_detail =  $connection->prepare($query_cart_detail);
                    $statement_cart_detail->bindValue(':id_cart', $id_cart, PDO::PARAM_INT);
                    $statement_cart_detail->bindValue(':id_product', $id_product, PDO::PARAM_INT);
                    $statement_cart_detail->bindValue(':price', $product->price, PDO::PARAM_STR);
                    if ($statement_cart_detail->execute()) {
                        $connection->lastInsertId();
                    }
                }
            } else { // trường hợp  user này đã từng order sản phẩm trước đó rồi
                //check id_product này đã có tồn tại trong detail chưa nếu có rồi chỉ cần tăng đơn vị
                $id_cart = $cart[0]->id;
                $query = "SELECT * FROM detail_cart WHERE id_cart=:id_cart and id_product =:id_product";
                $statement =  $connection->prepare($query);
                $statement->bindValue(':id_cart', $id_cart, PDO::PARAM_INT);
                $statement->bindValue(':id_product', $id_product, PDO::PARAM_INT);
                if ($statement->execute()) {
                    $statement->setFetchMode(PDO::FETCH_CLASS, 'DetailCart');
                    $detail_cart = $statement->fetch();
                    if ($detail_cart) { // nếu tồn tại thì tăng số lượng lên
                        $query = "update detail_cart set quantity=:quantity where id=:id";
                        $statement =  $connection->prepare($query);
                        $statement->bindValue(':quantity', ($detail_cart->quantity + 1), PDO::PARAM_INT);
                        $statement->bindValue(':id', $detail_cart->id, PDO::PARAM_INT);
                        if ($statement->execute()) {
                            $connection->lastInsertId();
                        }
                    } else { // nếu chưa thì thêm detail mới vào
                        $query_cart_detail = "INSERT INTO detail_cart(id_cart,id_product,quantity,price) values(:id_cart,:id_product,1,:price) ";
                        $statement_cart_detail =  $connection->prepare($query_cart_detail);
                        $statement_cart_detail->bindValue(':id_cart', $id_cart, PDO::PARAM_INT);
                        $statement_cart_detail->bindValue(':id_product', $id_product, PDO::PARAM_INT);
                        $statement_cart_detail->bindValue(':price', $product->price, PDO::PARAM_STR);
                        if ($statement_cart_detail->execute()) {
                            $connection->lastInsertId();
                        }
                    }
                }
            }
        } else {
        }
    }
}
