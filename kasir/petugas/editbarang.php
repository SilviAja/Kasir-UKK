<?php
include_once("../conn/koneksi.php");

if (isset($_POST['update'])) {
    $id = $_GET['produkID'];
    $name = $_POST['namaproduk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    
    $result = mysqli_query($koneksi, "UPDATE produk SET namaproduk='$name', harga='$harga', stok='$stok' WHERE produkID=$id");

    if ($result) {
        echo "<script>alert('Berhasil mengedit produk');window.location.href='?page=stok';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

$id = $_GET['produkID'];

$result1 = mysqli_query($koneksi, "SELECT * FROM produk WHERE produkID=$id");

while ($barang_data = mysqli_fetch_array($result1)) {
    $name = $barang_data['namaproduk'];
    $harga = $barang_data['harga'];
    $stok = $barang_data['stok'];
}
$koneksi->close();
?>

<div class="row well">
    <div class="col-md-4">
        <div class="card well">
            <div class="card-header">
                <h3 class="">Update barang</h3>
            </div>
                   
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="mb-3 mt-3">
                        <label for="nama" class="form-label">Nama:</label>
                        <input type="text" class="form-control" id="name" value="<?php echo $name; ?>" placeholder="Masukkan Nama" name="namaproduk">
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga:</label>
                        <input type="text" class="form-control" id="harga" value="<?php echo $harga; ?>" placeholder="Masukkan Harga" name="harga">
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok:</label>
                        <input type="text" class="form-control" id="stok" value="<?php echo $stok; ?>" placeholder="Masukkan Stok" name="stok">
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
