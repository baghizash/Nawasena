<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="main-container">
    <div class="pd-ltr-20">


        <div class="card-box pd-20 height-100-p mb-30">
            <h2 class="mb-4 text-center">Form Pemberian Kuasa</h2>
            <form action="<?= site_url('masyarakat/suratkuasa/submitMasyarakat') ?>" method="post" class="form-horizontal">

                <?= csrf_field() ?>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="hidden" name="user_id" value="<?= session()->get('user_id'); ?>">
                        <div class="form-group">
                            <label for="nama_pemberi">Nama:</label>
                            <input type="text" name="nama_pemberi" id="nama_pemberi" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin_pemberi">Jenis Kelamin:</label>
                            <input type="text" name="jenis_kelamin_pemberi" id="jenis_kelamin_pemberi" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="ttl_pemberi">Tempat/Tanggal Lahir:</label>
                            <input type="text" name="ttl_pemberi" id="ttl_pemberi" class="form-control form-control-sm" required>
                        </div>

                        <div class="form-group">
                            <label for="pekerjaan_pemberi">Pekerjaan:</label>
                            <input type="text" name="pekerjaan_pemberi" id="pekerjaan_pemberi" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="agama_pemberi">Agama:</label>
                            <input type="text" name="agama_pemberi" id="agama_pemberi" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat_pemberi">Alamat:</label>
                            <input type="text" name="alamat_pemberi" id="alamat_pemberi" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="nik_pemberi">NIK:</label>
                            <input type="text" name="nik_pemberi" id="nik_pemberi" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_dikeluarkan">Tanggal Dikeluarkan:</label>

                            <input type="date" name="tanggal_dikeluarkan" id="tanggal_dikeluarkan" class="form-control form-control-sm" required>

                        </div>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="kekuasaan" class="col-sm-3 col-form-label">Kekuasaan yang Diberikan:</label>
                    <div class="col-sm-9">
                        <textarea name="kekuasaan" id="kekuasaan" class="form-control form-control-sm" required></textarea>
                    </div>
                </div>



                <div class="form-group row mb-3">
                    <label for="tempat_dikeluarkan" class="col-sm-3 col-form-label">Tempat Dikeluarkan:</label>
                    <div class="col-sm-9">
                        <input type="text" name="tempat_dikeluarkan" id="tempat_dikeluarkan" class="form-control form-control-sm" required>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-sm">Kirim</button>
                    <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>