<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="main-container">
    <div class="pd-ltr-20">

        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="h3 mb-4 text-gray-900"><?= $title; ?></h3>
                    <a href="<?= base_url('admin/unduhLaporanSemuaPengguna'); ?>" class="btn btn-primary btn-sm" type="button">&#x1F4C4; Unduh Laporan</a>
                </div>
            </div>
            <div class="card-body">
                <div class="data-table table stripe hover nowrap">
                    <table id="semua-pengaduan" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $user->username; ?> </td>
                                    <td><?= $user->email; ?> </td>
                                    <td><?= $user->role_name; ?></td>
                                    <td>
                                        <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a href="<?= base_url('admin/user-list/' . $user->userid); ?>" class="dropdown-item">Detail</a>
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
        $("#semua-pengaduan").DataTable({
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