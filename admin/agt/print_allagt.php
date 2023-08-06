<?php
    include "inc/koneksi.php";

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="assets_style/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets_style/assets/bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets_style/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css>">
		<title>Laporan Perpustakaan - Data Anggota</title>
	</head>
	<body onload="window.print()" style="font-family: Quicksand, sans-serif;">
    <h3 class='text-center' style='font-family: Quicksand, sans-serif; margin-top: 30px;'>
        .:: Laporan Perpustakaan ::.
    </h3>
    <h4 class='text-center'>Data Anggota</h4>
    <?php
    // Load file koneksi.php
    include "inc/koneksi.php";
 

        $query = "SELECT * from tb_anggota"; // Tampilkan semua data anggota 
    
    ?>
    <table class="table table-striped table-bordered">
    <thead>
        <tr>
        <th  style="text-align: center;">No</th>
      <th  style="text-align: center;">ID Anggota</th>      
      <th  style="text-align: center;">Nama</th>
      <th  style="text-align: center;">Jenis Kelamin</th>
      <th  style="text-align: center;">Kelas</th>
      <th  style="text-align: center;">No Telepon</th>
    </tr>
    <?php
    $no=1;
    ?>
        <?php
            // Step 1: Buat interface DataAdapter
            interface DataAdapter {
                public function getFormattedData($data);
            }

            // Step 2: Buat kelas adapter DataFormatterAdapter
            class DataFormatterAdapter implements DataAdapter {
                public function getFormattedData($data) {
                    $tgl = date('d-m-Y', strtotime($data['id_anggota']));

                    return [
                        'no' => $data['no'],
                        'id_anggota' => $data['id_anggota'],
                        'nama' => $data['nama'],
                        'jekel' => $data['jekel'],
                        'kelas' => $data['kelas'],
                        'no_hp' => $data['no_hp'],
                        'tgl_formatted' => $tgl,
                    ];
                }
            }

            // Step 3: Kode awal Anda dengan menggunakan adapter
            $sql = mysqli_query($koneksi, $query);
            $row = mysqli_num_rows($sql);

            if ($row > 0) {
                // Buat instance dari adapter
                $dataAdapter = new DataFormatterAdapter();

                while ($data = mysqli_fetch_array($sql)) {
                    // Format data menggunakan adapter
                    $formattedData = $dataAdapter->getFormattedData($data);

                    echo "<tr>";
                    echo "<td>" . $formattedData['no'] . "</td>";
                    echo "<td>" . $formattedData['id_anggota'] . "</td>";
                    echo "<td>" . $formattedData['nama'] . "</td>";
                    echo "<td>" . $formattedData['jekel']. "</td>";
                    echo "<td>" . $formattedData['kelas'] . "</td>";
                    echo "<td>" . $formattedData['no_hp'] . "</td>";
                    echo "<td>" . $formattedData['tgl_formatted'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Data tidak ada</td></tr>";
            }
            ?>

    </table>
		<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
		document.body.innerHTML = originalContents;
	}
	
  </script>
  </body>
  
</html>

