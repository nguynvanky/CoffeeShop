<?php
require("class/Auth.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["fullname"]) && isset($_POST["email"]) && isset($_POST["phonenumber"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $fullname = $_POST["fullname"];
        $email = $_POST["email"];
        $phonenumber = $_POST["phonenumber"];
        Auth::Register($fullname, $phonenumber, $email, $username, $password);
        header("Location: index.php");
        exit();
    }
}
