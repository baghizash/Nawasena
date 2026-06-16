<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="main-container">
    <div class="pd-ltr-20">
        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('msg'); ?>
            </div>
        <?php endif; ?>

        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="h3 mb-4 text-gray-900"><?= $title; ?></h3>
                    <a href="<?= base_url('admin/pengaduan/unduhLaporan/all'); ?>" class="btn btn-primary btn-sm" type="button">&#x1F4C4; Unduh Laporan</a>
                </div>
            </div>
            <div class="card-body">
                <div class="data-table table stripe hover nowrap">
                    <style>
                        table#semua-pengaduan th:nth-child(1),
                        table#semua-pengaduan td:nth-child(1) {
                            max-width: 30px;
                            /* Lebar kolom ID */
                            white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;
                            text-align: center;
                            /* Sesuaikan dengan kebutuhan */
                        }

                        table#semua-pengaduan th:nth-child(2),
                        table#semua-pengaduan td:nth-child(2) {
                            max-width: 35px;
                            /* Lebar kolom Tanggal */
                            white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;
                        }

                        table#semua-pengaduan th:nth-child(3),
                        table#semua-pengaduan td:nth-child(3) {
                            max-width: 200px;
                            /* Lebar kolom Judul */
                            white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;
                        }

                        table#semua-pengaduan th:nth-child(4),
                        table#semua-pengaduan td:nth-child(4) {
                            max-width: 30px;
                            /* Lebar kolom Judul */
                            white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;
                        }

                        table#semua-pengaduan th:nth-child(5),
                        table#semua-pengaduan td:nth-child(5) {
                            max-width: 30px;
                            /* Lebar kolom Judul */
                            white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;
                        }
                    </style>
                    <table id="semua-pengaduan" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($pengaduan as $list): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= date('d-m-Y', strtotime($list['created_at'])); ?></td> <!-- Ganti dengan indeks array -->
                                    <td><?= $list['judul_pengaduan']; ?></td> <!-- Ganti dengan indeks array -->
                                    <td><?= $list['row_status']; ?></td> <!-- Gunakan status_label yang sudah diformat -->
                                    <td><a href="/admin/pengaduan/<?= $list['id']; ?>" class="btn btn-sm btn-info">Detail</a></td>
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
<script src="<?= base_url(); ?>/backend/vendors/datatables/dataTables.min.css"></script>
<script>
    $(document).ready(function() {
        $("#semua-pengaduan").DataTable({
            "lengthMenu": [
                [8, 15, 30, 50, -1],
                [8, 15, 30, 50, "All"]
            ],
            "responsive": true,
            "language": {
                "processing": "Memuat data..",
                "infoEmpty": "0 entri",
                "info": "Menampilkan _TOTAL_ data pengaduan.",
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