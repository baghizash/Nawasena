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

                    <?php if (session()->getFlashdata('msg')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('msg'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="pd-ltr-20">

        <div class="card shadow">
            <div class="card-header">

                <div class="col text-center text-md-left mb-2 mb-md-0">
                    <a href="<?= base_url('masyarakat/suratkuasa/'); ?>" class="btn btn-success mb-2 mb-md-0 d-block d-md-inline-block"><i class="fa fa-plus"></i> Ajukan Surat Kuasa</a>
                </div>

            </div>
            <div class="card-body">
                <div class="data-table table stripe hover nowrap">
                    <table id="semua-surat-kuasa" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pemberi</th>
                                <th>Nama Penerima</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($surat_kuasa as $surat): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= esc($surat['nama_pemberi']); ?></td>
                                    <td>
                                        <?php
                                        // Cek apakah nama penerima kosong
                                        if (empty($surat['nama_penerima'])) {
                                            echo "Pengajuan masih diproses"; // Tampilkan jika kosong
                                        } else {
                                            echo esc($surat['nama_penerima']); // Tampilkan nama penerima jika ada
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="<?= site_url('masyarakat/suratkuasa/detail/' . $surat['id']); ?>" role="button">
                                                Detail
                                            </a>

                                            <a class="dropdown-item" href="<?= site_url('masyarakat/suratkuasa/edit/' . $surat['id']); ?>" role="button">
                                                Edit
                                            </a>

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