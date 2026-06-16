<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!-- Begin Page Content -->

<div class="main-container">
    <div class="pd-ltr-20">

        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="h3 mb-4 text-gray-900"><?= $title; ?></h3>
                    <a href="<?= base_url('admin/pengaduan/unduhLaporan/3'); ?>" class="btn btn-primary btn-sm" type="button">&#x1F4C4; Unduh Laporan</a>
                </div>
            </div>
            <div class="card-body">
                <div class="data-table table stripe hover nowrap">
                    <table class="table" id="semua-pengaduan">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Judul</th>
                                <th>Status</th>
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
                                    <td> <span class="badge-danger p-1 rounded-sm">
                                            <?= ($list['row_status'] == 0) ? 'Dihapus' : $list['row_status']; ?>
                                        </span></td>

                                    <td>
                                        <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a href="/admin/pengaduan/<?= $list['id']; ?>" class="dropdown-item">Detail</a>
                                            <?= form_open('/admin/pengaduan/' . $list['id'], ['class' => 'd-inline']) . csrf_field() .
                                                "<input type=\"hidden\" name=\"_method\" value=\"DELETE\"><button onclick=\"return confirm('yakin?')\" type=\"submit\" class=\"dropdown-item\">Delete</button>" . form_close(); ?>
                                            <input type="hidden" name="id" value="<?= $list['id']; ?>">
                                        </div>
                                        <?= form_close(); ?>
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
<!-- /.container-fluid -->
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