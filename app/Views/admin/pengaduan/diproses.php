<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="main-container">
    <div class="pd-ltr-20">
        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="h3 mb-4 text-gray-900"><?= $title; ?></h3>
                    <!-- Pesan Flash -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success mt-3"><?= session()->getFlashdata('success'); ?></div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger mt-3"><?= session()->getFlashdata('error'); ?></div>
                    <?php endif; ?>
                    <a href="<?= base_url('admin/pengaduan/unduhLaporan/2'); ?>" class="btn btn-primary btn-sm" type="button">&#x1F4C4; Unduh Laporan</a>
                </div>
            </div>
            <div class="card-body">
                <div class="data-table table stripe hover nowrap">
                    <style>
                        table#semua-pengaduan th:nth-child(3),
                        table#semua-pengaduan td:nth-child(3) {
                            max-width: 350px;
                            /* Lebar kolom Judul */
                            white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;
                        }

                        table#semua-pengaduan th:nth-child(2),
                        table#semua-pengaduan td:nth-child(2) {
                            max-width: 55px;
                            /* Lebar kolom Judul */
                            white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;
                        }

                        table#semua-pengaduan th:nth-child(1),
                        table#semua-pengaduan td:nth-child(1) {
                            max-width: 20px;
                            /* Lebar kolom Judul */
                            white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;
                        }

                        table#semua-pengaduan th:nth-child(5),
                        table#semua-pengaduan td:nth-child(5) {
                            max-width: 60px;
                            /* Lebar kolom Judul */
                            white-space: nowrap;
                            overflow: hidden;
                            /* text-overflow: ellipsis; */
                        }
                    </style>
                    <table id="semua-pengaduan" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Tentang</th>
                                <th>Pengacara</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($pengaduan as $list): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= date('d M Y', strtotime($list['created_at'])); ?></td>
                                    <td><?= $list['judul_pengaduan']; ?></td>
                                    <td>
                                        <?php if (empty($list['pengacara'])): ?>
                                            <!-- Tombol untuk memunculkan modal -->
                                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#pilihPengacaraModal<?= $list['id']; ?>">
                                                <i class="fa fa-plus"></i> Pilih Pengacara
                                            </button>
                                        <?php else: ?>
                                            <!-- Tampilkan nama pengacara jika ada -->
                                            <?= esc($list['pengacara']); ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a href="/admin/pengaduan/<?= $list['id']; ?>" class="dropdown-item">Detail</a>
                                            <?= form_open('/admin/pengaduan/' . $list['id'], ['class' => 'd-inline']) . csrf_field() .
                                                '<input type="hidden" name="_method" value="DELETE">
                                                 <button onclick="return confirm(\'yakin?\')" type="submit" class="dropdown-item">Delete</button>' .
                                                form_close(); ?>
                                            <?= form_open('/admin/pengaduan/' . $list['id'], ['class' => 'd-inline']) . csrf_field() . '<input type="hidden" name="_method" value="PUT"><input type="hidden" name="status_pengaduan" value="' . $list['status_pengaduan'] . '"><button onclick="return confirm(\'yakin?\')" type="submit" class="dropdown-item">Selesai</button>' . form_close(); ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>



                    <!-- Modal Pemilihan Pengacara -->
                    <?php foreach ($pengaduan as $list): ?>
                        <div class="modal fade" id="pilihPengacaraModal<?= $list['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="pilihPengacaraLabel<?= $list['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="pilihPengacaraLabel<?= $list['id']; ?>">Pilih Pengacara untuk Pengaduan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="/admin/pengaduan/assign_pengacara" method="post">
                                        <?= csrf_field(); ?>
                                        <div class="modal-body">
                                            <input type="hidden" name="pengaduan_id" value="<?= $list['id']; ?>">
                                            <div class="form-group">
                                                <label for="pengacara">Pilih Pengacara</label>
                                                <select class="form-control" id="pengacara" name="pengacara_id" required>
                                                    <option value="">-- Pilih Pengacara --</option>
                                                    <?php foreach ($pengacaraList as $pengacara): ?>
                                                        <option value="<?= $pengacara['id']; ?>"><?= $pengacara['nama_pengacara']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

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