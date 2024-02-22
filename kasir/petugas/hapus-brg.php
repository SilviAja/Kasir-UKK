<?php
// include database connection file
include_once("../conn/koneksi.php");

//Get id from URL to deletethat user
$id = $_GET['produkID'];

// Delete user row from table based on given id
$result = mysqli_query($koneksi, "DELETE FROM produk WHERE produkID=$id");

 
// After delete redirect to Home,to that latest user list will be displayed.
header("location:index.php?page=stok");
?> 