<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h1 class="h3 mb-4 text-gray-900" style="display:inline-block; margin-left: 20px;">
                                <?= $title; ?>
                            </h1>
                        </div>

                        <!-- Menampilkan pesan kesalahan dan sukses -->
                        <?php if (session()->getFlashdata('error-msg')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error-msg'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('msg')): ?>
                            <div class="alert alert-success">
                                <?= session()->getFlashdata('msg'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="card-body">

                            <form action="<?= site_url('masyarakat/suratkuasa/edit/' . $surat_kuasa['id']) ?>" method="post">
                                <?= csrf_field(); ?>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nama_pemberi">Nama: </label>
                                            <input type="text" class="form-control <?= $validation->hasError('nama_pemberi') ? 'is-invalid' : ''; ?>" name="nama_pemberi" id="nama_pemberi" value="<?= old('nama_pemberi') ? old('nama_pemberi') : $surat_kuasa['nama_pemberi']; ?>" autofocus>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('nama_pemberi'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nik_pemberi">NIK:</label>
                                            <input type="text" class="form-control <?= $validation->hasError('nik_pemberi') ? 'is-invalid' : ''; ?>" name="nik_pemberi" id="nik_pemberi" value="<?= old('nik_pemberi') ? old('nik_pemberi') : $surat_kuasa['nik_pemberi']; ?>" autofocus>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('nik_pemberi'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_kelamin_pemberi">Jenis Kelamin:</label>
                                            <input type="text" class="form-control <?= $validation->hasError('jenis_kelamin_pemberi') ? 'is-invalid' : ''; ?>" name="jenis_kelamin_pemberi" id="jenis_kelamin_pemberi" value="<?= old('jenis_kelamin_pemberi') ? old('jenis_kelamin_pemberi') : $surat_kuasa['jenis_kelamin_pemberi']; ?>" autofocus>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('pemberi_kuasa'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="ttl_pemberi">Tempat, Tanggal Lahir:</label>
                                            <input type="text" class="form-control <?= $validation->hasError('ttl_pemberi') ? 'is-invalid' : ''; ?>" name="ttl_pemberi" id="ttl_pemberi" value="<?= old('ttl_pemberi') ? old('ttl_pemberi') : $surat_kuasa['ttl_pemberi']; ?>" autofocus>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('pemberi_kuasa'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="agama_pemberi">Agama:</label>
                                            <input type="text" class="form-control <?= $validation->hasError('agama_pemberi') ? 'is-invalid' : ''; ?>" name="agama_pemberi" id="agama_pemberi" value="<?= old('agama_pemberi') ? old('agama_pemberi') : $surat_kuasa['agama_pemberi']; ?>" autofocus>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('agama_penerima'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="pekerjaan_pemberi">Pekerjaan: </label>
                                            <input type="text" class="form-control <?= $validation->hasError('pekerjaan_pemberi') ? 'is-invalid' : ''; ?>" name="pekerjaan_pemberi" id="pekerjaan_pemberi" value="<?= old('pekerjaan_pemberi') ? old('pekerjaan_pemberi') : $surat_kuasa['pekerjaan_pemberi']; ?>" autofocus>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('pekerjaan_penerima'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat_pemberi">Alamat:</label>
                                            <input type="text" class="form-control <?= $validation->hasError('alamat_pemberi') ? 'is-invalid' : ''; ?>" name="alamat_pemberi" id="alamat_pemberi" value="<?= old('alamat_pemberi') ? old('alamat_pemberi') : $surat_kuasa['alamat_pemberi']; ?>" autofocus>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('alamat_pemberi'); ?>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary btn-block">Simpan Perubahan</button>
                                    </div>
                                </div>

                                <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>