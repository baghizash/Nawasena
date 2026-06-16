<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h1 class="h3 mb-4 text-gray-900" style="display:inline-block; margin-left: 20px;">Laporkan Masalah Anda !!!</h1>

                        </div>
                        <div class="card-body">
                            <?= form_open_multipart('/pengaduan/tambah_pengaduan'); ?>
                            <?= csrf_field(); ?>

                            <div class="row">
                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <label for="kategori">Kategori Pengaduan</label>
                                        <select name="kategori_pengaduan" id="kategori" class="form-control" cols="30" rows="10" required>
                                            <option value="">Pilih Kategori</option>
                                            <option value="Pelanggaran Hak Asasi Manusia">Pelanggaran Hak Asasi Manusia</option>
                                            <option value="Kekerasan">Kekerasan</option>
                                            <option value="Penipuan">Penipuan</option>
                                            <option value="Korupsi">Korupsi</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('kategori_pengaduan'); ?>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label for="isi">Jelaskan lebih rinci</label>
                                        <textarea name="isi_pengaduan" id="isi" cols="30" rows="10" class="form-control <?= $validation->hasError('isi_pengaduan') ? 'is-invalid' : ''; ?>" required><?= old('isi_pengaduan'); ?></textarea>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('isi_pengaduan'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="harapan">Harapan dari Pengaduan</label>
                                        <textarea name="harapan_pengaduan" id="harapan" cols="30" rows="3" class="form-control <?= $validation->hasError('harapan_pengaduan') ? 'is-invalid' : ''; ?>" required><?= old('harapan_pengaduan'); ?></textarea>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('harapan_pengaduan'); ?>
                                        </div>
                                    </div>


                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="nama_pengadu">Nama Pengadu</label>
                                        <input type="text" class="form-control <?= $validation->hasError('nama_pengadu') ? 'is-invalid' : ''; ?>"
                                            name="nama_pengadu" id="nama_pengadu"
                                            value="<?= old('nama_pengadu'); ?>" autofocus required>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_pengadu'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="judul">Perihal</label>
                                        <input type="text" name="judul_pengaduan" id="judul" class="form-control <?= $validation->hasError('judul_pengaduan') ? 'is-invalid' : ''; ?>" value="<?= old('judul_pengaduan'); ?>" autofocus required>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('judul_pengaduan'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="lokasi">Lokasi Kejadian</label>
                                        <input type="text" name="lokasi_pengaduan" id="lokasi" class="form-control <?= $validation->hasError('lokasi_pengaduan') ? 'is-invalid' : ''; ?>" value="<?= old('lokasi_pengaduan'); ?>" required>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('lokasi_pengaduan'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="kontak">Kontak Pengadu</label>
                                        <input type="text" name="kontak_pengadu" id="kontak" class="form-control <?= $validation->hasError('kontak_pengadu') ? 'is-invalid' : ''; ?>" value="<?= old('kontak_pengadu'); ?>" required>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('kontak_pengadu'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="kontak">Nomor Induk Kependudukan (NIK)</label>
                                        <input type="text" name="NIK" id="NIK" class="form-control <?= $validation->hasError('NIK') ? 'is-invalid' : ''; ?>" value="<?= old('NIK'); ?>" required>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('NIK'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Upload foto bukti</label>
                                        <div class="mb-2">
                                            <small class="text-info">Aturan: wajib upload 1 gambar, maksimal 3 gambar, setiap gambar maksimal ukuran sebesar 1 MB.</small>
                                        </div>
                                        <input type="file" name="images[]" id="images" class="form-control <?= $validation->hasError('images') ? 'is-invalid' : ''; ?>" multiple required>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('images'); ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary btn-block">Tambah Data</button>
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