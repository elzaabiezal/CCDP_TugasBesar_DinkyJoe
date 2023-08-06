<?php
// Interface untuk kelas decorator
interface BukuDecorator {
    public function getLabel(): string;
}

// Kelas dekorator untuk menambahkan fitur bookmark
class BukuBookmarkDecorator implements BukuDecorator {
    protected $buku;

    public function __construct(Buku $buku) {
        $this->buku = $buku;
    }

    public function getLabel(): string {
        return $this->buku->getLabel() . ' + Bookmark';
    }
}

// Kelas dekorator untuk menambahkan fitur highlight
class BukuHighlightDecorator implements BukuDecorator {
    protected $buku;

    public function __construct(Buku $buku) {
        $this->buku = $buku;
    }

    public function getLabel(): string {
        return $this->buku->getLabel() . ' + Highlight';
    }
}

// Kelas Buku
class Buku {
    protected $label;

    public function __construct(string $judul, string $pengarang) {
        $this->label = $judul . ' oleh ' . $pengarang;
    }

    public function getLabel(): string {
        return $this->label;
    }
}

// Contoh penggunaan decorator pattern pada buku
$buku = new Buku('Belajar Pemrograman PHP', 'John Doe');
$bukuBookmark = new BukuBookmarkDecorator($buku);
$bukuHighlight = new BukuHighlightDecorator($bukuBookmark);

echo $buku->getLabel() . '<br>'; // Belajar Pemrograman PHP oleh John Doe
echo $bukuBookmark->getLabel() . '<br>'; // Belajar Pemrograman PHP oleh John Doe + Bookmark
echo $bukuHighlight->getLabel() . '<br>'; // Belajar Pemrograman PHP oleh John Doe + Bookmark + Highlight
