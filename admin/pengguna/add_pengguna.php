<section class="content-header">
	<h1>
		Pengguna Sistem
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="index.php">
				<i class="fa fa-home"></i>
				<b>Si Tabsis</b>
			</a>
		</li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- general form elements -->
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title">Tambah Pengguna</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse">
							<i class="fa fa-minus"></i>
						</button>
						<button type="button" class="btn btn-box-tool" data-widget="remove">
							<i class="fa fa-remove"></i>
						</button>
					</div>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form action="" method="post" enctype="multipart/form-data">
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Nama Pengguna</label>
							<input type="text" name="nama_pengguna" id="nama_pengguna" class="form-control" placeholder="Nama pengguna">
						</div>

						<div class="form-group">
							<label for="exampleInputEmail1">Username</label>
							<input type="text" name="username" id="username" class="form-control" placeholder="Username">
						</div>

						<div class="form-group">
							<label for="exampleInputPassword1">Password</label>
							<input type="password" name="password" id="password" class="form-control" placeholder="Password">
						</div>

						<div class="form-group">
							<label>Level</label>
							<select name="level" id="level" class="form-control">
								<option>-- Pilih Level --</option>
								<option>Administrator</option>
								<option>Petugas</option>
							</select>
						</div>

					</div>
					<!-- /.box-body -->

					<div class="box-footer">
						<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
						<a href="?page=MyApp/data_pengguna" title="Kembali" class="btn btn-warning">Batal</a>
					</div>
				</form>
			</div>
			<!-- /.box -->
</section>

<?php

    // Interface Prototype berisi metode klone()
interface Prototype
{
    public function klone();
}

// Class Pengguna sebagai konkret prototype yang mengimplementasikan interface Prototype
class Pengguna implements Prototype
{
    private $nama_pengguna;
    private $username;
    private $password;
    private $level;

    public function __construct($nama_pengguna, $username, $password, $level)
    {
        $this->nama_pengguna = $nama_pengguna;
        $this->username = $username;
        $this->password = $password;
        $this->level = $level;
    }

    // Metode klone untuk menghasilkan salinan objek pengguna baru
    public function klone()
    {
        return new Pengguna($this->nama_pengguna, $this->username, $this->password, $this->level);
    }

    // Getter dan setter (Anda bisa menambahkan metode lain sesuai kebutuhan)
    // ...
}

// Penggunaan pola prototype
if (isset($_POST['Simpan'])) {
    // Anggap variabel $_POST sudah divalidasi dan bersih

    // Membuat objek prototype Pengguna
    $prototypePengguna = new Pengguna(
        $_POST['nama_pengguna'],
        $_POST['username'],
        md5($_POST['password']),
        $_POST['level']
    );

    // Mengklon objek prototype untuk membuat objek pengguna baru
    $penggunaBaru = $prototypePengguna->klone();

    // Simpan data ke database menggunakan objek klon
    $sql_simpan = "INSERT INTO tb_pengguna (nama_pengguna, username, password, level) VALUES (
      '" . $penggunaBaru->nama_pengguna . "',
      '" . $penggunaBaru->username . "',
      '" . $penggunaBaru->password . "',
      '" . $penggunaBaru->level . "')";

    // Eksekusi query ke database dan tangani hasilnya
    $query_simpan = mysqli_query($koneksi, $sql_simpan);

    if ($query_simpan) {
        echo "<script>
        Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=MyApp/data_pengguna';
            }
        })</script>";
    } else {
        echo "<script>
        Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=MyApp/add_pengguna';
            }
        })</script>";
    }
}

     //selesai proses simpan data
    
