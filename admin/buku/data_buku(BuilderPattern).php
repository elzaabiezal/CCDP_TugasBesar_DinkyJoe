<?
class BukuBuilder {
    private $idBuku;
    private $judulBuku;
    private $pengarang;
    private $penerbit;
    private $tahunTerbit;

    public function setIdBuku($idBuku) {
        $this->idBuku = $idBuku;
    }

    public function setJudulBuku($judulBuku) {
        $this->judulBuku = $judulBuku;
    }

    public function setPengarang($pengarang) {
        $this->pengarang = $pengarang;
    }

    public function setPenerbit($penerbit) {
        $this->penerbit = $penerbit;
    }

    public function setTahunTerbit($tahunTerbit) {
        $this->tahunTerbit = $tahunTerbit;
    }

    public function build() {
        return new Buku($this->idBuku, $this->judulBuku, $this->pengarang, $this->penerbit, $this->tahunTerbit);
    }
}

class Buku {
    private $idBuku;
    private $judulBuku;
    private $pengarang;
    private $penerbit;
    private $tahunTerbit;

    public function __construct($idBuku, $judulBuku, $pengarang, $penerbit, $tahunTerbit) {
        $this->idBuku = $idBuku;
        $this->judulBuku = $judulBuku;
        $this->pengarang = $pengarang;
        $this->penerbit = $penerbit;
        $this->tahunTerbit = $tahunTerbit;
    }

    public function getIdBuku() {
        return $this->
