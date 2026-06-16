<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="row">

                <!-- Profil (Kiri) -->
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-30">
                    <div class="pd-20 card-box height-100-p">
                        <div class="profile-photo" style="width: 200px; height: 200px; overflow: hidden; border-radius: 50%; display: flex; justify-content: center; align-items: center; border: 2px solid #ccc;">
                            <img src="<?= base_url('images/' . user()->user_image); ?>" alt="default.jpg" class="avatar-photo" style="width: 100%; height: auto;" />
                        </div>

                        <h5 class="text-center h5 mb-0"><?= $user->username; ?></h5>
                        <p class="text-center text-muted font-14"><?= user()->name; ?></p>
                        <div class="profile-info">
                            <h5 class="mb-20 h5 text-blue">Informasi Kontak</h5>
                            <ul>
                                <li><span>Alamat Email:</span> <?= $user->email; ?></li>
                                <li><span>Nomor Telepon:</span> <?= user()->no_hp; ?></li>
                                <li><span>Alamat:</span> <?= user()->address; ?></li>
                            </ul>

                        </div>
                    </div>
                </div>

                <!-- Bagian Kanan (Daftar Pengaduan atau Konten Khusus Admin) -->
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">

                    <!-- Cek apakah pengguna adalah admin -->
                    <?php if ($is_admin): ?>
                        <!-- Tampilkan konten khusus untuk admin -->
                        <div class="alert alert-info" role="alert">
                            <h4 class="alert-heading">Halaman Khusus Admin</h4>
                            <p>Ini adalah tampilan yang hanya akan muncul untuk pengguna dengan role admin. Anda dapat menambahkan informasi khusus di sini.</p>
                        </div>
                    <?php else: ?>
                        <!-- Tampilkan Daftar Pengaduan jika bukan admin -->
                        <div class="card mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px; transition: box-shadow 0.3s; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);">
                            <div class="card-header">
                                <h3 class="h3 mb-4 text-gray-900"><?= $title; ?></h3>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
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
                                            <?php if ($list_pengaduan['data']) : ?>
                                                <?php foreach ($list_pengaduan['data'] as $num => $row) : ?>
                                                    <tr>
                                                        <td><?= $num + 1; ?></td>
                                                        <td><?= $row['judul_pengaduan']; ?></td>
                                                        <td>
                                                            <?= $row['row_status'] == 1 ? '<span class="badge-warning p-1 rounded-sm">Menunggu</span>' : ($row['row_status'] == 2 ? '<span class="badge-success p-1 rounded-sm">Di Proses</span>' : '<span class="badge-info p-1 rounded-sm">Selesai</span>') ?>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <a class="btn btn-primary" href="<?= site_url('masyarakat/pengaduan/detail/' . $row['id']); ?>" role="button">
                                                                    Detail
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
                                    <a href="<?= base_url('admin/pengaduan/surat_kuasa') ?>" class="btn btn-primary btn-sm">&laquo; Kembali Ke User List</a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
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
        $("#tbl-pengaduan").DataTable({
            "lengthMenu": [
                [8, 15, 30, 50, -1],
                [8, 15, 30, 50, "All"]
            ],
            "responsive": true,
            "language": {
                "processing": "Memuat data..",
                "infoEmpty": "0 entri",
                "info": "Menampilkan _TOTAL_ data pengguna.",
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