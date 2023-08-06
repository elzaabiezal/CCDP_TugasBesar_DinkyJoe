<?php
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

// Cara mengakses dan menggunakan manajer peminjaman buku:
$manager = BookManager::getInstance();

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
    $manager->addBook($data);
}

// Mengakses daftar buku dari singleton BookManager
$allBooks = $manager->getBooks();
