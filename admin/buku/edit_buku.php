<?php

class Facade
{
    private $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function ubahDataBuku($id_buku, $judul_buku, $pengarang, $penerbit, $th_terbit)
    {
        $sql_ubah = "UPDATE tb_buku SET
            judul_buku='" . $judul_buku . "',
            pengarang='" . $pengarang . "',
            penerbit='" . $penerbit . "',
            th_terbit='" . $th_terbit . "'
            WHERE id_buku='" . $id_buku . "'";
        $query_ubah = $this->model->query($sql_ubah);

        if ($query_ubah) {
            echo "<script>
                Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=MyApp/data_buku';
                    }
                })</script>";
            } else {
                echo "<script>
                Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=MyApp/data_buku';
                    }
                })</script>";
            }
    }
}

$facade = new Facade();
$facade->ubahDataBuku($_GET['kode'], $_POST['judul_buku'], $_POST['pengarang'], $_POST['penerbit'], $_POST['th_terbit']);
