<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="main-container">
    <div class="pd-ltr-20">
        <div class="card-box pd-20 height-90-p mb-30">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <img src="<?= base_url(); ?>/backend/vendors/images/banner-img.png" alt="" />
                </div>
                <div class="col-md-8">
                    <h4 class="font-40 weight-500 mb-10 text-capitalize">
                        <?= $title; ?>

                    </h4>
                </div>

            </div>
        </div>
        <div class="card shadow">
            <div class="card-header">

                <div class="row">
                    <div class="col text-center text-md-left mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#tambahPengacaraModal ?>">
                            <i class="fa fa-plus"></i> Tambah Pengacara
                        </button>
                    </div>
                    <div class="col text-center text-md-right">
                        <button class="btn btn-info d-block d-md-inline-block" data-toggle="modal" data-target="#infoModal"><i class="fa fa-info-circle"></i> Informasi Pengaduan</button>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="data-table table stripe hover nowrap">
                    <table id="semua-pengacara" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Pengacara</th>
                                <th scope="col">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($pengacara as $d): ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $d['nama_pengacara'] ?> </td>

                                    <td>
                                        <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </a>


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
        $("#semua-pengacara").DataTable({
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