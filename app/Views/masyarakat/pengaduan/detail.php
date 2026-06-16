<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="row">
                <div class="col-12"> <!-- Menggunakan col-12 untuk mengambil seluruh lebar -->
                    <div class="card mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px; transition: box-shadow 0.3s; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);">
                        <div class="card-header">
                            <h2 class="mb-0 text-center"><?= esc($title); ?></h2>
                        </div>
                        <div class="card-body">
                            <?php if (session()->getFlashdata('msg')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getFlashdata('msg'); ?>
                                </div>
                            <?php endif; ?>

                            <div class="row mb-2">
                                <div class="col-md-3"><strong>Nama Pengadu</strong></div>
                                <div class="col-md-1 d-none d-md-block">:</div>
                                <div class="col-md-8">
                                    <?= esc($data['nama_pengadu']); ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3"><strong>Status Pengaduan</strong></div>
                                <div class="col-md-1 d-none d-md-block">:</div>
                                <div class="col-md-8">
                                    <?= ($data['status_pengaduan'] == 1 ? 'Pengaduan Baru' : ($data['status_pengaduan'] == 2 ? 'Sedang Diproses' : 'Telah Selesai')) ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3"><strong>Tanggal Pengaduan</strong></div>
                                <div class="col-md-1 d-none d-md-block">:</div>
                                <div class="col-md-8">
                                    <?= date('d M Y', strtotime($data['created_at'])); ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3"><strong>Perihal</strong></div>
                                <div class="col-md-1 d-none d-md-block">:</div>
                                <div class="col-md-8">
                                    <?= esc($data['judul_pengaduan']); ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3"><strong>Kategori Pengaduan</strong></div>
                                <div class="col-md-1 d-none d-md-block">:</div>
                                <div class="col-md-8">
                                    <span class="text-justify"><?= esc($data['kategori_pengaduan']); ?></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3"><strong>Lokasi Kejadian</strong></div>
                                <div class="col-md-1 d-none d-md-block">:</div>
                                <div class="col-md-8">
                                    <span class="text-justify"><?= esc($data['lokasi_pengaduan']); ?></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3"><strong>Rincian</strong></div>
                                <div class="col-md-1 d-none d-md-block">:</div>
                                <div class="col-md-8">
                                    <span class="text-justify"><?= esc($data['isi_pengaduan']); ?></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3"><strong>Kontak Pengaduan</strong></div>
                                <div class="col-md-1 d-none d-md-block">:</div>
                                <div class="col-md-8">
                                    <span class="text-justify"><?= esc($data['kontak_pengadu']); ?></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3"><strong>Nomor Induk Kependudukan</strong></div>
                                <div class="col-md-1 d-none d-md-block">:</div>
                                <div class="col-md-8">
                                    <span class="text-justify"><?= esc($data['NIK']); ?></span>
                                </div>
                            </div>

                            <hr>

                            <!-- Bukti Pengaduan -->
                            <div class="row">
                                <div class="col-md-3"><strong>Bukti Pengaduan</strong></div>
                                <div class="col-md-1 d-none d-md-block">:</div>
                                <div class="col-md-8">
                                    <?php if (is_array($bukti) && !empty($bukti)): ?>
                                        <div class="d-flex flex-wrap">
                                            <?php foreach ($bukti as $b): ?>
                                                <div class="me-2 mb-2">
                                                    <a href="/uploads/<?= $b ?>" target="_blank">
                                                        <img src="/uploads/<?= $b ?>" class="img-fluid img-thumbnail" width="100">
                                                    </a>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php else: ?>
                                        <p>Tidak ada bukti yang diunggah.</p>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>