<?php
session_start(); //başlat
session_destroy(); //yoket
header("location:../login.php");
?>