<?php
include("conn/koneksi.php");
include("header.php");
?>
<body>


    <div class="main-content">
        <div class="card-container">
            <?php
            $sql = $koneksi->query("SELECT * FROM produk");
            while ($data= $sql->fetch_assoc()) {
                ?>
                <div class='card' style='width: 18rem; margin: 10px;'>
                
                    <?php echo "<img class='card-foto-top' src='foto/" . $data['foto'] . "' width='230' height='250'>" ?>
                    <div class='card-body'>
                        <h5 class='card-title'><?php echo $data['namaproduk']?></h5>
                        <p class='card-text'>Harga: RP.<?php echo number_format($data['harga']) ?></p>
                        <p class='card-text'>Stok: <?php echo $data['stok']?></p>
                        <a href='transaksi.php?id=<?= $data['produkID']; ?>' class='btn btn-md btn-primary float-end'>Beli</a>
                    </div>
                
                </div>

                <?php
            }
            ?>
        </div>
    </div>
</body>