<?php
session_start();

if (!isset($_SESSION['userSession'])) {
 header("Location: index_reception.php");
} else if (isset($_SESSION['userSession'])!="") {
 header("Location: home_reception.php");
}

if (isset($_GET['logout'])) {
 session_destroy();
 unset($_SESSION['userSession']);
 header("Location: index_reception.php");
}
?>