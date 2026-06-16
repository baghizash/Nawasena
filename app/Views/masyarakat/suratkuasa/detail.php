<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px; transition: box-shadow 0.3s; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);">
                        <div class="card-header">
                            <h2 class="mb-0 text-center"><?= esc($title); ?></h2>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-md-3"><strong>Nama Pemberi</strong></div>
                                <div class="col-md-1 d-none d-md-block">:</div>
                                <div class="col-md-8">
                                    <?= esc($surat_kuasa['nama_pemberi']); ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3"><strong>Jenis Kelamin</strong></div>
                                <div class="col-md-1 d-none d-md-block">:</div>
                                <div class="col-md-8">
                                    <?= esc($surat_kuasa['jenis_kelamin_pemberi']); ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3"><strong>Tempat/Tanggal Lahir</strong></div>
                                <div class="col-md-1 d-none d-md-block">:</div>
                                <div class="col-md-8">
                                    <?= esc($surat_kuasa['ttl_pemberi']); ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3"><strong>Pekerjaan</strong></div>
                                <div class="col-md-1 d-none d-md-block">:</div>
                                <div class="col-md-8">
                                    <?= esc($surat_kuasa['pekerjaan_pemberi']); ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3"><strong>Agama</strong></div>
                                <div class="col-md-1 d-none d-md-block">:</div>
                                <div class="col-md-8">
                                    <?= esc($surat_kuasa['agama_pemberi']); ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3"><strong>Alamat</strong></div>
                                <div class="col-md-1 d-none d-md-block">:</div>
                                <div class="col-md-8">
                                    <?= esc($surat_kuasa['alamat_pemberi']); ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3"><strong>NIK</strong></div>
                                <div class="col-md-1 d-none d-md-block">:</div>
                                <div class="col-md-8">
                                    <?= esc($surat_kuasa['nik_pemberi']); ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3"><strong>Tanggal Dikeluarkan</strong></div>
                                <div class="col-md-1 d-none d-md-block">:</div>
                                <div class="col-md-8">
                                    <?= date('d M Y', strtotime($surat_kuasa['tanggal_dikeluarkan'])); ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3"><strong>Kekuasaan yang Diberikan</strong></div>
                                <div class="col-md-1 d-none d-md-block">:</div>
                                <div class="col-md-8">
                                    <?= esc($surat_kuasa['kekuasaan']); ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3"><strong>Tempat Dikeluarkan</strong></div>
                                <div class="col-md-1 d-none d-md-block">:</div>
                                <div class="col-md-8">
                                    <?= esc($surat_kuasa['tempat_dikeluarkan']); ?>
                                </div>
                            </div>

                            <hr>
                            <div class="text-center">
                                <a href="<?= base_url('/masyarakat/suratkuasa/riwayat'); ?>" class="btn btn-secondary btn-sm">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>