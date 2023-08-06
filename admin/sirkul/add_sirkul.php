<?php
// Class BookManager sebagai subject (RealSubject)
class BookManager {
    private static $instance = null;
    private $books = [];

    private function __construct() {
        // Private constructor to prevent direct instantiation
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function addBook($book) {
        $this->books[] = $book;
    }

    public function getBooks() {
        return $this->books;
    }

    // Other methods for managing books can be added here
}

// Proxy untuk BookManager
class BookManagerProxy {
    private $bookManager;

    public function __construct() {
        $this->bookManager = BookManager::getInstance();
    }

    public function addBook($book) {
        // Meneruskan pemanggilan addBook ke BookManager (RealSubject)
        $this->bookManager->addBook($book);
    }

    public function getBooks() {
        // Meneruskan pemanggilan getBooks ke BookManager (RealSubject)
        return $this->bookManager->getBooks();
    }

    // Other methods for managing books can be added here
}

// Cara mengakses dan menggunakan manajer peminjaman buku melalui Proxy:
$managerProxy = new BookManagerProxy();

$no = 1;
$sql = $koneksi->query("SELECT s.id_sk, b.judul_buku,
    a.id_anggota,
    a.nama,
    s.tgl_pinjam, 
    s.tgl_kembali
    from tb_sirkulasi s inner join tb_buku b on s.id_buku=b.id_buku
    inner join tb_anggota a on s.id_anggota=a.id_anggota where status='PIN' order by tgl_pinjam desc");

while ($data = $sql->fetch_assoc()) {
    // ... (kode yang lain tetap sama)
    $managerProxy->addBook($data);
}

// Mengakses daftar buku dari BookManager melalui Proxy
$allBooks = $managerProxy->getBooks();
?>
<section class="content-header">
    <h1>
        Sirkulasi
        <small>Buku</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="index.php">
                <i class="fa fa-home"></i>
                <b>Si Perpustakaan</b>
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
                    <h3 class="box-title">Tambah Peminjaman</h3>
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
                            <label>Id Sirkulasi</label>
                            <input type="text" name="id_sk" id="id_sk" class="form-control" 
							value="<?php echo $format; ?>" readonly />
                        </div>

                        <div class="form-group">
                            <label>Nama Peminjam</label>
                            <select name="id_anggota" id="id_anggota" class="form-control select2" style="width: 100%;">
                                <option selected="selected">-- Pilih --</option>
                                <?php
                                // ambil data dari database
                                $query = "select * from tb_anggota";
                                $hasil = mysqli_query($koneksi, $query);
                                while ($row = mysqli_fetch_array($hasil)) {
                                ?>
                                <option value="<?php echo $row['id_anggota'] ?>">
                                    <?php echo $row['id_anggota'] ?>
                                    -
                                    <?php echo $row['nama'] ?>
                                </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Buku</label>
                            <select name="id_buku" id="id_buku" class="form-control select2" style="width: 100%;">
                                <option selected="selected">-- Pilih --</option>
                                <?php
                                // ambil data dari database
                                $query = "select * from tb_buku";
                                $hasil = mysqli_query($koneksi, $query);
                                while ($row = mysqli_fetch_array($hasil)) {
                                ?>
                                <option value="<?php echo $row['id_buku'] ?>">
                                    <?php echo $row['id_buku'] ?>
                                    -
                                    <?php
