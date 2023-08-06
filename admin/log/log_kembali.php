<section class="content-header">
	<h1 style="text-align:center;">
		Riwayat Pengembalian Buku
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
<!-- Main content -->
<section class="content">
	<div class="box box-primary">
		<!-- /.box-header -->
		<div class="box-body">
			<div class="table-responsive">
			
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Buku</th>
							<th>Peminjam</th>
							<th>Tgl Di kembalikan</th>
						</tr>
					</thead>
					<tbody>

					<?php
					interface Command {
   					 public function execute($data);
					}

					class RowCommand implements Command {
					private $no;

					public function __construct($no) {
						$this->no = $no;
					}

					public function execute($data) {
						$tgl = $data['tgl_dikembalikan'];
						$formattedDate = date("d/M/Y", strtotime($tgl));

						echo '<tr>
								<td>' . $this->no++ . '</td>
								<td>' . $data['judul_buku'] . '</td>
								<td>' . $data['id_anggota'] . '-' . $data['nama'] . '</td>
								<td>' . $formattedDate . '</td>
							</tr>';
					}
				}

				class Invoker {
					private $command;

					public function setCommand($command) {
						$this->command = $command;
					}

					public function run($data) {
						$this->command->execute($data);
					}
				}

				// Contoh data
				$data1 = [
					'judul_buku' => 'Judul Buku 1',
					'id_anggota' => 'A001',
					'nama' => 'John Doe',
					'tgl_dikembalikan' => '2023-08-07',
				];

				$data2 = [
					'judul_buku' => 'Judul Buku 2',
					'id_anggota' => 'A002',
					'nama' => 'Jane Smith',
					'tgl_dikembalikan' => '2023-08-10',
				];

				$no = 1;

				// Membuat instance dari kelas Invoker
				$invoker = new Invoker();

				// Membuat instance dari kelas RowCommand dan mengeksekusi perintah untuk data 1 dan 2
				$invoker->setCommand(new RowCommand($no++));
				$invoker->run($data1);

				$invoker->setCommand(new RowCommand($no++));
				$invoker->run($data2);
				?>

                ?>
					</tbody>

				</table>
			</div>
		</div>
	</div>
</section>

