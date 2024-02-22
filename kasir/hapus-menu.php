<?php
include_once("conn/koneksi.php");
$id = $_GET['id'];
$sql = $koneksi->query("DELETE FROM detail_penjualan WHERE PenjualanID=$id");
echo "<script>
        alert('Data berhasil dihapus');
        window.location.href = 'daftar-transaksi.php';
    </script>";
?>