<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h1 class="h3 mb-4 text-gray-900" style="display:inline-block; margin-left: 20px;"><?= $title; ?></h1>

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

                            <form action="<?= site_url('Pengaduan/ubah_pengaduan/' . $data['id']) ?>" method="post">
                                <?= csrf_field(); ?>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="judul">Perihal</label>
                                            <input type="text" name="judul_pengaduan" id="judul" class="form-control <?= $validation->hasError('judul_pengaduan') ? 'is-invalid' : ''; ?>" value="<?= old('judul_pengaduan') ? old('judul_pengaduan') : $data['judul_pengaduan']; ?>" autofocus>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('judul_pengaduan'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="isi">Jelaskan lebih rinci</label>
                                            <textarea name="isi_pengaduan" id="isi" cols="30" rows="13" class="form-control <?= $validation->hasError('isi_pengaduan') ? 'is-invalid' : ''; ?>"><?= old('isi_pengaduan') ? old('isi_pengaduan') : $data['isi_pengaduan']; ?></textarea>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('isi_pengaduan'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nama_pengadu">Nama Pengadu</label>
                                            <input type="text" class="form-control <?= $validation->hasError('nama_pengadu') ? 'is-invalid' : ''; ?>" name="nama_pengadu" id="nama_pengadu" value="<?= old('nama_pengadu') ? old('nama_pengadu') : $data['nama_pengadu']; ?>" autofocus>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('nama_pengadu'); ?>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label>Upload foto bukti</label>
                                            <div class="mb-3">
                                                <p class="mb-0 text-info">Aturan: wajib upload 1 gambar, maksimal 3 gambar, setiap gambar maksimal ukuran sebesar 1 MB.</p>
                                            </div>
                                            <hr>
                                            <?= session()->getFlashdata('debug-msg'); ?>
                                            <input type="hidden" name="bukti_id" value="<?= isset($bukti['id']) ? $bukti['id'] : ''; ?>">

                                            <input type="file" name="images[]" id="images" class="p-1 form-control <?= $validation->hasError('images') ? 'is-invalid' : ''; ?>" multiple>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('images'); ?>
                                            </div>
                                            <?= session()->getFlashdata('err-files'); ?>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary btn-block">Ubah Data</button>
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

<?= $this->section('additional-js'); ?>
<script>
    $('.pengadu').hide();
    $('input[type=radio][name=nama_pengadu]').click(function() {
        if ($(this).val() === 'anonym') {
            $('.pengadu').hide();
        } else {
            $('.pengadu').show();
        }
    });
</script>
<?= $this->endSection(); ?>

<?= $this->endSection(); ?>