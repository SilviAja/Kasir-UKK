<?php
session_start();
include "../conn/koneksi.php";

$user = $_SESSION['nama_user'];
if ($_SESSION['nama_user']=="") {
    header("location: login.php");
}
?>
<DOCTYPE html>
<html lang="en">
<head>
   <title>bosststrap Example</title>
   <meta cherset="ut-8">
   <meta name="viewport" content="widht=device-widht, initial-scale=1">
   <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
   <script scr="../bootstrap/jquery.min.js"></script>
   <script scr="../bootstrap/bootstrap.min.js"></script>
 <style>
   /* set height of the grid so .sidenav can be 100% (adjust as needed) height */
   .sidenav{
      background-color: #f1f1f1;
      height:100%;
   }
   
   /* on small screens,set heigth to 'auto' for the grid*/ 
   @media screen and (max-widht: 767px) {
    .row.contant {height:auto}
   }
 </style>
</head>
<body>

<div class="container-fluid">
 <div class="row content">
  <div class="col-sm-3 sidenav hidden-xs">
    <h2>petugas</h2>
   <ul class="nav nav-pills nav -stacked">
     <li class="active"><a href="index.php">dashboard</a></li>
     <li><a href="?page=stok">stok</a></li>
     <li><a href="?page=user">user</a></li>
    <li><a href="?page=logout">log out</a></li>
</ul><br>
</div>
<br>

<div class="col-sm-9">
<?php
   if (isset($_GET['page'])) {
        $laman = $_GET['page'];

        switch($laman){
          case 'user';
            include "user.php";
            break;
           
            case 'tambah-brg';
            include "tambah-brg.php";
            break;

            case 'logout';
            include "logout.php";
            break;

            case 'stok';
            include "stok.php";
            break;

            
            case 'tambah-user';
            include "tambah-user.php";
            break;

            case 'editbarang';
            include "editbarang.php";
            break;

            case 'hapus-brg';
            include "hapus-brg.php";
            break;

            case 'hapus-user';
            include "hapus-user.php";
            break;

            case 'edit-user';
            include "edit-user.php";
            break;
        
        
        }
      }
      else{
        include"dashboard.php";
      }
  ?>
  </div>
 <div>
<div>

</body>
</html>

    
