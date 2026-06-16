<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>


<div class="main-container">

    <div class="pd-ltr-20" style="padding-bottom: 10px;"> <!-- Kurangi padding bottom -->
        <div class="card-box pd-20 height-100-p mb-1"> <!-- Kurangi margin bottom -->
            <div class="row align-items-center">

                <div class="col-md-8">
                    <h4 class="font-30 weight-600 mb-10 text-capitalize">
                        <?= $title; ?>

                    </h4>
                    <p class="font-18 max-width-600" style="color:red">
                        Lengkapi Dulu Data Diri Anda Sebelum Melakukan Pendaftaran
                    </p>
                    <?php if (session()->getFlashdata('msg')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('msg'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="pd-ltr-20 xs-pd-20-10" style="margin-top: -10px;"> <!-- Atur margin top ke 0 -->
        <div class="min-height-200px">
            <div class="row">

                <!-- Bagian Kanan (Daftar Pengaduan) -->
                <div class="col-12">
                    <div class="card mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px; transition: box-shadow 0.3s; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);">
                        <div class="card-header">
                            <div class="row">
                                <div class="col text-center text-md-left mb-2 mb-md-0">
                                    <a href="/pengaduan/tambah" class="btn btn-success mb-2 mb-md-0 d-block d-md-inline-block"><i class="fa fa-plus"></i> Tambah Pengaduan Baru</a>
                                </div>
                                <div class="col text-center text-md-right">
                                    <button class="btn btn-info d-block d-md-inline-block" data-toggle="modal" data-target="#infoModal"><i class="fa fa-info-circle"></i> Informasi Pengaduan</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <class="table-responsive">
                                <table class="table table-bordered table-main" id="tbl-pengaduan">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tentang</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($data) : ?>
                                            <?php foreach ($data as $num => $row) : ?>
                                                <tr>
                                                    <td><?= $num + 1; ?></td>
                                                    <td><?= $row['judul_pengaduan']; ?></td>
                                                    <td>
                                                        <?= $row['row_status'] == 1
                                                            ? '<span class="badge-warning p-1 rounded-sm">Menunggu</span>'
                                                            : ($row['row_status'] == 2
                                                                ? '<span class="badge-success p-1 rounded-sm">Di Proses</span>'
                                                                : ($row['row_status'] == 0
                                                                    ? '<span class="badge-info p-1 rounded-sm">Belum Dikonfirmasi</span>'
                                                                    : '<span class="badge-info p-1 rounded-sm">Selesai</span>'))
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Action
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="<?= site_url('masyarakat/pengaduan/detail/' . $row['id']); ?>" role="button">
                                                                Detail
                                                            </a>

                                                            <a class="dropdown-item" href="<?= site_url('/pengaduan/ubah/' . $row['id']); ?>" role="button">
                                                                Edit
                                                            </a>

                                                        </div>


                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="4">
                                                    <h3 class="text-gray-900 text-center">Data belum ada.</h3>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>

<!-- Modal Informasi Pengaduan -->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel">Informasi Pengaduan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="mb-20 h5 text-blue">Informasi Pengaduan</h5>
                <ul>
                    <li><span>Total Pengaduan:</span> <?= count($data); ?></li>
                    <li><span>Pengaduan Menunggu:</span> <?= count(array_filter($data, fn($row) => $row['status_pengaduan'] == 1)); ?></li>
                    <li><span>Pengaduan Diproses:</span> <?= count(array_filter($data, fn($row) => $row['status_pengaduan'] == 2)); ?></li>
                    <li><span>Pengaduan Selesai:</span> <?= count(array_filter($data, fn($row) => $row['status_pengaduan'] == 3)); ?></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
        $("#tbl-pengaduan").DataTable({
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