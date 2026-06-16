<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="main-container">
    <div class="pd-ltr-20">
        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="h3 mb-4 text-gray-900"><?= $title; ?></h3>
                    <a href="<?= base_url('admin/pengaduan/unduhLaporan/1'); ?>" class="btn btn-primary btn-sm" type="button">&#x1F4C4; Unduh Laporan</a>
                </div>
            </div>
            <div class="card-body">
                <div class="data-table table stripe hover nowrap">
                    <table id="pengaduan-masuk" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Tentang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($pengaduan as $list): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= date('d M Y', strtotime($list['created_at'])); ?></td> <!-- Sesuaikan dengan kolom tanggal di database -->
                                    <td><?= $list['judul_pengaduan']; ?></td> <!-- Sesuaikan dengan kolom yang sesuai -->
                                    <td>
                                        <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a href="/admin/pengaduan/<?= $list['id']; ?>" class="dropdown-item">Detail</a>
                                            <?= form_open('/admin/pengaduan/' . $list['id'], ['class' => 'd-inline']) . csrf_field() . '<input type="hidden" name="_method" value="DELETE"><button onclick="return confirm(\'yakin?\')" type="submit" class="dropdown-item">Delete</button>' . form_close(); ?>
                                            <?= form_open('/admin/pengaduan/approval/' . $list['id'], ['class' => 'd-inline']) . csrf_field(); ?>
                                            <input type="hidden" name="row_status" value="<?= $list['row_status']; ?>"> <!-- Kirim status yang sekarang -->

                                            <?= form_close(); ?>
                                            <?= form_open('/admin/pengaduan/' . $list['id'], ['class' => 'd-inline']) . csrf_field() . '<input type="hidden" name="_method" value="PUT"><input type="hidden" name="status_pengaduan" value="' . $list['status_pengaduan'] . '"><button onclick="return confirm(\'yakin?\')" type="submit" class="dropdown-item">Proses</button>' . form_close(); ?>
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
<script src="<?= base_url(); ?>/backend/vendors/datatables/dataTables.min.css"></script>
<script>
    $(document).ready(function() {
        $("#pengaduan-masuk").DataTable({
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            "searchDelay": 350,
            "language": {
                "processing": "Loading data..",
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