<?php
session_start();
if($_SESSION['logged_in'] == true ){
session_unset();
session_destroy();
    header('Location: /login.php');
}
