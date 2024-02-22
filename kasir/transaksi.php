<?php
include('conn/koneksi.php');
include("header.php");

if (isset($_POST['tambah'])) {
    $TanggalPenjualan = $_POST['TanggalPenjualan'];
    $nama = $_POST['NamaPelanggan'];
    $nomeja = $_POST['NoMeja'];
    $menu_jumlah = $_POST['menu'];
    $jumlah_array = $_POST['jumlah'];
    $stok = true;

    foreach ($menu_jumlah as $i => $item) {
        $parts = explode("|", $item);
        $produk_id = $parts[0];
        $harga = $parts[1];
        $jumlah = $jumlah_array[$i];

        $sql_stok = $koneksi->query("SELECT Stok FROM produk WHERE ProdukID = '$produk_id'");
        $row = $sql_stok->fetch_assoc();
        $stok_produk = $row['Stok'];

        if ($jumlah > $stok_produk) {
            $stok = false;
            break;
        }
    }
    if ($stok) {
    // Menyisipkan data ke dalam tabel penjualan
    $sql_penjualan = $koneksi->query("INSERT INTO penjualan (TanggalPenjualan) VALUES ('$TanggalPenjualan')");
    $id_transaksi_baru = $koneksi->insert_id; // Menggunakan insert_id dari objek koneksi

    // Menyisipkan data ke dalam tabel pelanggan menggunakan nilai kunci dari tabel penjualan
    $sql_pelanggan = $koneksi->query("INSERT INTO pelanggan (PelangganID, NamaPelanggan, NoMeja) VALUES ('$id_transaksi_baru', '$nama', '$nomeja')");
    $id_pelanggan_baru = $koneksi->insert_id; // Menggunakan insert_id dari objek koneksi

    

    foreach ($menu_jumlah as $i => $item) {
        $item_parts = explode("|", $item);
        $produk_id = $item_parts[0];
        $harga = $item_parts[1];
        $jumlah = $jumlah_array[$i];

        // Menyisipkan data ke dalam tabel detailpenjualan dengan nilai kunci primer yang unik
        $sql3 = $koneksi->query("INSERT INTO detail_penjualan (detail_id, produk_id, jumlah_produk, subtotal) VALUES ('$id_pelanggan_baru', '$produk_id', '$jumlah', '$harga')");
        // Periksa apakah query berhasil dijalankan
        if (!$sql3) {
            // Jika query gagal, tampilkan pesan error dan hentikan eksekusi
            die("Error: " . $koneksi->error);
        }

        $sql4 = $koneksi->query("UPDATE produk SET Stok = stok - $jumlah  WHERE produkID = '$produk_id'");
        $sql5 = $koneksi->query("UPDATE produk SET Terjual = Terjual + $jumlah WHERE produkID = '$produk_id'");
        }

        header("Location: daftar-transaksi.php");
        exit();

        } else {
        echo "<script>alert('Maaf, jumlah pesanan melebihi stok yang tersedia. Silakan periksa kembali pesanan Anda.')</script>";
            }
    }
?>


<script>
    // Fungsi untuk menambahkan input field untuk menu
    function tambahMenu() {
        var container = document.getElementById("menuContainer");
        var newMenuInput = document.createElement("div");

        newMenuInput.innerHTML = `
        <div class="">
            <label for="menu" class="form-label">Menu</label>
            <select id="menu" name="menu[]" class="form-control">
                <option>Pilih Menu</option>
                <?php
                $sql6 = $koneksi->query("SELECT * FROM produk");
                while ($data = $sql6->fetch_assoc()) {
                    echo "<option value='" . $data['produkID'] . "|" . $data['harga'] . "'>" . $data['namaproduk'] . " - Rp." . number_format($data['harga']) . " - stok:" . $data['stok'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" min="1" class="form-control" id="jumlah" name="jumlah[]">
        </div>
    `;

        container.appendChild(newMenuInput);
    }
</script>


        <div class="p-4" id="main-content">
          <div class="card mt-5" style="background-color: rgb(245,245,245)">
            <div class="card-body">
                <div class="container mt-5">
                    <h2>Buat Pemesanan</h2>
                    <form action="" method="POST">
                        <div class="">
                            <label for="tanggal" class="form-label">Tanggal Pemesanan</label>
                            <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="tanggal" name="tanggal" readonly required>
                        </div>
                        <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="nama" class="form-label">Nama Anda</label>
                            <input type="text" class="form-control" id="nama" name="NamaPelanggan" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="nomeja" class="form-label">No Meja</label>
                            <input type="number" min="1" class="form-control" id="NoMeja" name="NoMeja" required>
                        </div>
                        </div>
                        <div id="menuContainer">
                          <div>
                              <label for="menu" class="form-label">Menu</label>
                              <select id="menu" name="menu[]" class="form-control">
                                <option>Pilih Menu</option>
                                <?php
                                    $sql7 = $koneksi->query("SELECT * FROM produk WHERE Stok > 0");
                                    while ($data = $sql7->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $data['produkID'] . '|' . $data['harga']; ?>">
                                    <?php echo $data['namaproduk'] . " - Rp." . number_format($data['harga']) . " - stok:" . $data['stok']; ?>
                                </option>
                                <?php } ?>
                              </select>
                          </div>
                          <div class="mb-3">
                              <label for="jumlah" class="form-label">Jumlah</label>
                              <input type="number" min="1" class="form-control" id="jumlah" name="jumlah[]" required>
                          </div>
                          
                        </div>

                        <button type="button" class="btn btn-warning me-3" onclick="tambahMenu()">Tambah Menu+</button>

                        <button type="submit" name="tambah" class="btn btn-primary">Pesan</button>
                    </form>
                </div>            
            </div>
          </div>
        </div>