<?php
session_start();
require('./database/DatabaseHandler.php');
include_once('./config.php');

class Auth
{
    public static function Login($username, $password)
    {

        $db = new DatabaseHandler(db_host, db_name, db_user, db_password);

        $is_success = $db->getUserLogin($username, $password);
        var_dump($is_success);
        if ($is_success != null) {
            $_SESSION['log_detail'] = $is_success->id;
            $_SESSION['log_name'] = $is_success->full_name;
            if ($is_success->role == 'admin') {
                $_SESSION['admin'] = $is_success->id;
                header("Location: manage_product.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            header("Location: index.php");
            exit();
        }
    }
    public static function Register($full_name, $phone_number, $email, $username, $_password)
    {
        $db = new DatabaseHandler(db_host, db_name, db_user, db_password);


        $id = $db->Register($full_name, $phone_number, $email, $username, $_password);
        if ($id != -1) {
            $_SESSION['log_detail'] = $id;
            $_SESSION['log_name'] = $full_name;
        } else {
        }
    }
    public static function Logout()
    {

        session_unset();
        session_destroy();

        header('location: index.php');
        exit;
    }
    public static function requireLogin()
    {
        if (!isset($_SESSION['log_detail'])) {
            return true;
        }
        return false;
    }
    public static function requireAdmin()
    {
        if (!isset($_SESSION['admin'])) {
            return true;
        }
        return false;
    }
}
