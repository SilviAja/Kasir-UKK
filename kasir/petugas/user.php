<div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar User</h4>
                    <p class="card-description">
                    <!-- Add class <code>.table</code> -->
                        <a href="?page=tambah-user" title="Tambah Produk" 
                            class="btn btn-primary btn-icon-split btn-sm">
                                <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                                <span class="text">Tambah User</span>
                        </a>
                    </p>

                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>username</th>
                                    <th>password</th>
                                    <th>opsi</th>   
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $no = 1;
                                $sql = $koneksi->query("SELECT * FROM user");
                                while ($data= $sql->fetch_assoc()) {
                                    
                            ?>
                        <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $data['nama_user']?></td>
                        <td><?php echo str_repeat('-', strlen($data['password']))?></td>
                        <td>
                        <a href="?page=edit-user&user_id=<?= $data['user_id']?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="?page=hapus-user&user_id=<?php echo $data['user_id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus user ini?')">
                            <i class="fas fa-trash"></i> Hapus
                        </a>
                    </td>
                 </tr>
                    </tr>
                        <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>