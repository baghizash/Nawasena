<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="main-container">
    <div class="pd-ltr-20">


        <div class="card-box pd-20 height-100-p mb-30">
            <h2 class="mb-4 text-center">Form Penerima Kuasa</h2>
            <form action="<?= site_url('admin/suratkuasa/submitAdmin/' . $surat['id']) ?>" method="post" class="form-horizontal">

                <?= csrf_field() ?>

                <div class="form-group row mb-3">
                    <label for="nomor_surat" class="col-sm-3 col-form-label">Nomor Surat:</label>
                    <div class="col-sm-9">
                        <input type="text" name="nomor_surat" id="nomor_surat" class="form-control form-control-sm" required>
                    </div>
                </div>
                <h3>Penerima Kuasa</h3>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_penerima">Nama:</label>
                            <input type="text" name="nama_penerima" id="nama_penerima" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="pekerjaan_penerima">Pekerjaan:</label>
                            <input type="text" name="pekerjaan_penerima" id="pekerjaan_penerima" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="kantor_penerima">Kantor:</label>
                            <input type="text" name="kantor_penerima" id="kantor_penerima" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="alamat_penerima">Alamat:</label>
                            <input type="text" name="alamat_penerima" id="alamat_penerima" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="hp_penerima">Nomor HP:</label>
                            <input type="text" name="hp_penerima" id="hp_penerima" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="email_penerima">Email:</label>
                            <input type="email" name="email_penerima" id="email_penerima" class="form-control form-control-sm" required>
                        </div>
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