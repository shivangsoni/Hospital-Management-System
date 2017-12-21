<html>
<style>
body
{
    border-style: solid;
    border-width: 15px;
}
</style>
<body bgcolor="#666699">
<center>
<?php
session_start();

if (!isset($_SESSION['userSession'])) {
 header("Location: index_room_patient_new.php");
} else if (isset($_SESSION['userSession'])!="") {
 header("Location: home_room_patient_new.php");
}

if (isset($_GET['logout'])) {
 session_destroy();
 unset($_SESSION['userSession']);
 header("Location: index_room_patient_new.php");
}
?>
</center></body></html>