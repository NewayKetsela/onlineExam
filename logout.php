<?php
session_start();
$_SESSION['login']='none';

header("location: index.php");
?>