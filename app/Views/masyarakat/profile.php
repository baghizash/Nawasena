<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="row">



                <!-- Profil (Kiri) -->
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-30">
                    <div class="pd-20 card-box height-100-p">
                        <?php
                        $userImage = user()->user_image;
                        $imageSrc = ($userImage === 'default.jpg') ? base_url('images/default.jpg') : base_url('uploads/' . $userImage);
                        ?>
                        <div class="profile-photo" style="width: 200px; height: 200px; overflow: hidden; border-radius: 50%; display: flex; justify-content: center; align-items: center; border: 2px solid #ccc;">
                            <img src="<?= $imageSrc; ?>" alt="User Profile Photo" class="avatar-photo" style="width: 100%; height: auto;" />
                        </div>
                        <h5 class="text-center h5 mb-0"><?= user()->username; ?></h5>
                        <p class="text-center text-muted font-14"><?= user()->name; ?></p>
                        <div class="profile-info">
                            <h5 class="mb-20 h5 text-blue">Informasi Kontak</h5>
                            <ul>
                                <li><span>Alamat Email:</span> <?= user()->email; ?></li>
                                <li><span>Nomor Telepon:</span> <?= user()->no_hp; ?></li>
                                <li><span>Alamat:</span> <?= user()->address; ?></li>
                                <li><span>NIK:</span><?= user()->NIK; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Bagian Kanan (Edit Profil Saya dan Tagihan Saya) -->
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
                    <!-- Edit Profil Saya (Atas) -->
                    <div class="card mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px; transition: box-shadow 0.3s; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);">
                        <div class="card-body">
                            <h2 class="mb-4 text-center">Edit Profil Saya</h2>
                            <form action="<?= base_url('masyarakat/ubah_profile') ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                <?= csrf_field() ?>
                                <input type="hidden" name="id" value="<?= user()->id; ?>">

                                <div class="form-group row mb-3">
                                    <label for="user_image" class="col-sm-3 col-form-label">Upload Foto</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control form-control-sm" name="user_image" id="user_image" accept="image/*">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="name" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" name="name" value="<?= user()->name; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="username" class="col-sm-3 col-form-label">Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" name="username" value="<?= user()->username; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control form-control-sm" name="email" value="<?= user()->email; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="handphone" class="col-sm-3 col-form-label">Nomor <br>Handphone</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" name="no_hp" value="<?= user()->no_hp; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="address" class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" name="address" value="<?= user()->address; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="NIK" class="col-sm-3 col-form-label">NIK</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" name="NIK" value="<?= user()->NIK; ?>" required>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-sm">Simpan Perubahan</button>
                                </div>
                            </form>
                            <!-- Disclaimer -->
                            <div class="mt-2 text-center">
                                <small style="color: red;">* Anda harus melengkapi data diri untuk dapat melakukan pengaduan.</small>
                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>