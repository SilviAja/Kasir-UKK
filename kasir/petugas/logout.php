<?php

session_start();
session_destroy();

echo "<script>alert('berhasil logout!')</script>";

header("location:login.php");
?>