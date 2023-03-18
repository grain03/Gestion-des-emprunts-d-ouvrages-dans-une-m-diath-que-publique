<?php
include("./config/db.php");
session_start();
$book_id = $_GET['id'];
$cancel_reservations = "DELETE FROM `reservations` where `book_id` = '$book_id'; UPDATE `books` SET `available` = 'yes' where book_id = '$book_id';";
$send_request = $db->prepare($cancel_reservations);
$send_request->execute();
$_SESSION['counter'] = bcsub($_SESSION['counter'],1);
header('Location: profile.php');
?>