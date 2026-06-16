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
                    <h3 class="h3 text-gray-900"><?= $title; ?></h3>
                    <?php if ($data['row_status'] == 2): ?>
                        <a href="<?= base_url('admin/pengaduan/surat_kuasa') ?>" class="btn btn-primary btn-sm">&#x1F4C4; Cetak Surat Kuasa</a>
                    <?php endif; ?>
                </div>


            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">Nama Pengadu</div>
                    <div class="col-md-8"><?= $data['nama_pengadu']; ?></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">Status Pengaduan</div>
                    <div class="col-md-8">
                        <?php if ($data['row_status'] == 1): ?>
                            <?= 'Pengaduan Baru'; ?>
                        <?php elseif ($data['row_status'] == 2): ?>
                            <?= 'Sedang Diproses'; ?>
                        <?php elseif ($data['row_status'] == 3): ?>
                            <?= 'Telah Selesai'; ?>
                        <?php else: ?>
                            <?= 'Dihapus'; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">Tanggal Pengaduan</div>
                    <div class="col-md-8"><?= date('d M Y', strtotime($data['created_at'])); ?></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">Perihal</div>
                    <div class="col-md-8"><?= $data['judul_pengaduan']; ?></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">Rincian</div>
                    <div class="col-md-8">
                        <span class="text-justify"><?= $data['isi_pengaduan']; ?></span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">Foto Bukti</div>
                    <div class="col-md-8">
                        <a href="/uploads/<?= $bukti['img_satu'] ?>" target="_blank"><img src="/uploads/<?= $bukti['img_satu'] ?>" class="img-fluid img-thumbnail" width="100"></a>
                        <?php if ($bukti['img_dua'] != null) : ?>
                            <a href="/uploads/<?= $bukti['img_dua'] ?>" target="_blank"><img src="/uploads/<?= $bukti['img_dua'] ?>" class="img-fluid img-thumbnail" width="100"></a>
                        <?php endif; ?>
                        <?php if ($bukti['img_tiga'] != null) : ?>
                            <a href="/uploads/<?= $bukti['img_tiga'] ?>" target="_blank"><img src="/uploads/<?= $bukti['img_tiga'] ?>" class="img-fluid img-thumbnail" width="100"></a>
                        <?php endif; ?>



                    </div>
                </div> <a href="<?= base_url('admin/pengaduan/') ?>" class="btn btn-secondary btn-sm">&laquo; Kembali Ke List Pengaduan</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>