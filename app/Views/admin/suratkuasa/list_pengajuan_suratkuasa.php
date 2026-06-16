<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="main-container">
    <div class="pd-ltr-20">

        <div class="card shadow">
            <div class="card-header">
                <h3 class="h3 mb-4 text-gray-900"><?= $title; ?></h3>
            </div>
            <div class="card-body">
                <div class="data-table table stripe hover nowrap">
                    <table id="semua-surat-kuasa" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nomor Surat</th>
                                <th scope="col">Nama Pemberi</th>
                                <th scope="col">Nama Penerima</th>
                                <th scope="col">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($surat_kuasa as $surat): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <?php
                                        // Cek apakah nama penerima kosong
                                        if (empty($surat['nomor_surat'])) {
                                            echo "Tambahkan Nomor Surat"; // Tampilkan jika kosong
                                        } else {
                                            echo esc($surat['nomor_surat']); // Tampilkan nama penerima jika ada
                                        }
                                        ?>
                                    </td>

                                    <td><?= $surat['nama_pemberi']; ?></td>
                                    <td>
                                        <?php
                                        // Cek apakah nama penerima kosong
                                        if (empty($surat['nama_penerima'])) {
                                            echo "Tambahkan Nama Penerima"; // Tampilkan jika kosong
                                        } else {
                                            echo esc($surat['nama_penerima']); // Tampilkan nama penerima jika ada
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a href="/admin/suratkuasa/edit_suratkuasa/<?= $surat['id']; ?>" class="dropdown-item">Tambah Data Penerima</a>
                                            <a href="<?= site_url('admin/suratkuasa/unduhSuratKuasa/' . $surat['id']); ?>" class="dropdown-item">Unduh SK</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
<?= $this->section('additional-js'); ?>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $("#semua-surat-kuasa").DataTable({
            "lengthMenu": [
                [8, 15, 30, 50, -1],
                [8, 15, 30, 50, "All"]
            ],
            "responsive": true,
            "language": {
                "processing": "Memuat data..",
                "infoEmpty": "0 entri",
                "info": "Menampilkan _TOTAL_ data surat kuasa.",
                "infoFiltered": "(difilter dari _MAX_ total entri)",
                "emptyTable": "Belum ada data",
                "lengthMenu": "Menampilkan _MENU_ entri",
                "search": "Pencarian:",
                "zeroRecords": "Data tidak ditemukan",
                "paginate": {
                    "first": "Awal",
                    "last": "Akhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                },
            }
        });
    });
</script>
<?= $this->endSection(); ?>