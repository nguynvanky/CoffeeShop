<?php
require("class/Auth.php");
Auth::Logout();
header("Location: index.php");
exit();
