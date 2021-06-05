<?php

session_start();

unset($_SESSION['auth']);
unset($_SESSION['user']);
unset($_SESSION['admin']);
unset($_SESSION['incorrect']);

header("Location: LogIn/login.php");
exit();