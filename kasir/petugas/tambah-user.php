<div class="row">
        <div class="col-lg-4">
          <div class="card">
            <div class="card-header">
              <form action="" class="form-signin" method="post"> 
              <h3 class="">DAFTAR AKUN</h3>
                <div class="card-body">
                  <form action="" method="post">
                    <div class="mb-3 mt-3">
                    <table for="" class="form-label">id</table>
                      <input type="number" name="user_id" class="form-control" require autofocus>
                    </div>
                    <div class="mb-3 mt-3">
                      <table for="" class="form-label">nama_user</table>
                      <input type="text" name="nama_user" class="form-control" require autofocus>
                    </div>
                    <div class="mb-3 mt-3">
                      <label for="" class="form-label">password</label>
                      <input type="password" name="password" class="form-control" require>
                    </div>
                    
                      <button name="daftar" class="btn btn-primary" href="user.php">Daftar</button>
                      
                    </div> 
                  </form>
                  <?php 
			include '../conn/koneksi.php';
				if(isset($_POST['daftar'])){
					$password = md5($_POST['password']);

					$query=mysqli_query($koneksi,"INSERT INTO user VALUES ('".$_POST['user_id']."','".$_POST['nama_user']."','".$password."', '')");
					if($query){
						echo "<script>alert('Berhasil mendaftar akun')</script>";
						echo "<script>location:index.php?page=user';</script>";
					}
				}
			 ?>
                </div>
            </div>
          </div>
        </div>
    </div>