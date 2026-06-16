<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="row">
                <div class="col-12">
                    <div class="card-box pd-20 mb-30">
                        <h4 class="text-center mb-4">Panduan Alur Pengaduan di LBH</h4>
                        <p class="text-center text-muted">Berikut adalah panduan lengkap untuk mengajukan pengaduan di LBH. Pastikan Anda mengikuti setiap langkah dengan teliti.</p>

                        <div class="accordion" id="alurPengaduanAccordion">

                            <!-- Step 1: Registrasi Pengaduan -->
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Langkah 1: Registrasi Pengaduan
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#alurPengaduanAccordion">
                                    <div class="card-body">
                                        Isi formulir pengaduan dengan data lengkap, seperti nama, kontak, alamat, dan deskripsi singkat terkait masalah hukum yang Anda hadapi.
                                        <ul>
                                            <li>Lengkapi data pribadi dan informasi pengaduan.</li>
                                            <li>Upload dokumen atau bukti pendukung jika diperlukan.</li>
                                            <li>Status Awal: <strong>Menunggu Verifikasi</strong>.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 2: Verifikasi Pengaduan -->
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Langkah 2: Verifikasi Pengaduan
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#alurPengaduanAccordion">
                                    <div class="card-body">
                                        Tim LBH akan memverifikasi pengaduan Anda untuk memastikan kelayakan pengaduan. Tim akan menghubungi Anda jika ada informasi yang kurang.
                                        <ul>
                                            <li>Status Setelah Verifikasi: <strong>Diverifikasi</strong>.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 3: Penunjukan Pengacara -->
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Langkah 3: Penunjukan Pengacara/Pendamping
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#alurPengaduanAccordion">
                                    <div class="card-body">
                                        LBH akan menugaskan pengacara atau pendamping yang sesuai dengan kasus yang diajukan. Pengacara akan menghubungi Anda untuk langkah pendampingan lebih lanjut.
                                        <ul>
                                            <li>Status Pengaduan: <strong>Dalam Penanganan</strong>.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 4: Pendampingan Hukum -->
                            <div class="card">
                                <div class="card-header" id="headingFour">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            Langkah 4: Pendampingan Hukum
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#alurPengaduanAccordion">
                                    <div class="card-body">
                                        Pengacara akan melakukan pendampingan hukum dan memberikan bantuan sesuai kebutuhan kasus. Anda akan menerima informasi pendampingan dan tindakan hukum yang dilakukan.
                                    </div>
                                </div>
                            </div>

                            <!-- Step 5: Penyelesaian atau Penutupan Kasus -->
                            <div class="card">
                                <div class="card-header" id="headingFive">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                            Langkah 5: Penyelesaian atau Penutupan Kasus
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#alurPengaduanAccordion">
                                    <div class="card-body">
                                        Setelah proses pendampingan selesai, kasus akan ditutup dengan laporan akhir. Hasil penyelesaian akan disampaikan kepada Anda.
                                        <ul>
                                            <li>Status Akhir: <strong>Selesai</strong>.</li>
                                            <li>Laporan kasus akan disimpan sebagai arsip LBH.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- End of Accordion -->
                    </div> <!-- End of Card Box -->
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>