<?php
ob_start();
include_once('includes/header.php');
include_once('config.php');
$db = new DatabaseHandler(db_host, db_name, db_user, db_password);
if (!isset($_SESSION['log_detail'])) {
    header('Location: index.php');
    exit();
}
$id_user = $_SESSION['log_detail'];
$user = $db->GetUserByID($id_user);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['full_name'];
    $phonenumber = $_POST['phonenumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // update
    $user->full_name = $fullname;
    $user->phonenumber = $phonenumber;
    $user->email = $email;
    var_dump($password);
    $flag = 0;
    if ($password != '') {
        $flag = 1; // if flag == 1 then update password
        $user->_password = $password;
    }
    $db->UpdateUser($user, $flag);
    $_SESSION['log_name'] = $fullname;
    header('Location: profile.php');
    exit();
}
?>

<div class="container w-75 pt-5 mt-5" style="min-height: 50vh;">
    <form method="post">

        <h1 class="text-center">YOUR PROFILE</h1>
        <h5>Full name</h5>
        <input type="text" name="full_name" class="input_primary form-control shadow-none" placeholder="Your full name..." value="<?= $user->full_name ?>">
        <h5 class="mt-4">Phone number</h5>
        <input type="number" name="phonenumber" class="input_primary form-control shadow-none" placeholder="Your phone number..." value="<?= $user->phonenumber ?>">
        <h5 class="mt-4">Email</h5>
        <input type="email" name="email" class="input_primary form-control shadow-none" placeholder="Your full name..." value="<?= $user->email ?>">
        <h5 class="mt-4">New password</h5>
        <input type="text" name="password" class="input_primary form-control shadow-none" placeholder="New password...">
        <div class="d-flex justify-content-center mt-3">
            <button type="submit" class="btn btn-primary shadow border border-1">Confirm</button>
        </div>
    </form>
</div>

<?php
include_once('includes/footer.php');

?>