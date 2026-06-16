<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="main-container">
    <div class="pd-ltr-20">
        <div class="card-box pd-20 height-90-p mb-30">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <img src="<?= base_url(); ?>/backend/vendors/images/banner-img.png" alt="Banner Image" class="img-fluid" />
                </div>
                <div class="col-md-8">
                    <h4 class="font-20 weight-500 mb-10 text-capitalize">
                        Selamat Datang di NAWASENA
                        <div class="weight-600 font-30 text-blue">Johnny Brown!</div>
                    </h4>
                </div>
            </div>
        </div>
        <div class="row pb-10">
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">19090</div>
                            <div class="font-14 text-secondary weight-500">
                                Pengaduan Baru
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#00eccf">
                                <i class="bi-file-earmark-text"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">798798</div>
                            <div class="font-14 text-secondary weight-500">
                                Pengaduan di Proses
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#ff5b5b">
                                <span class="bi-arrow-repeat"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">980798</div>
                            <div class="font-14 text-secondary weight-500">
                                Pengaduan Selesai
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon">
                                <i
                                    class="bi-check2-circle" data-color="#09cc06"
                                    aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">980798</div>
                            <div class="font-14 text-secondary weight-500">
                                Pengaduan Selesai
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon">
                                <i
                                    class="bi-check2-circle" data-color="#09cc06"
                                    aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel dengan Panduan Alur Pengaduan dan Berkas -->
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 mb-30">
                <div class="card-box bg-white height-100-p pd-20 min-height-200px">
                    <h4 class="text-center mb-4">Panduan Alur Pengaduan di NAWASENA</h4>
                    <p class="text-center text-muted">Berikut adalah panduan lengkap untuk mengajukan pengaduan di NAWASENA. Pastikan Anda mengikuti setiap langkah dengan teliti.</p>
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
                    </div> <!-- End Accordion -->
                </div> <!-- End of Card Box -->
            </div>

            <!-- Panel Berkas yang harus dilengkapi -->
            <div class="col-lg-6 col-md-12 col-sm-12 mb-30">
                <div class="card-box mb-30">
                    <div class="clearfix pd-20">
                        <div class="" style="text-align: center">
                            <h4 class="h4">Berkas yang Diperlukan untuk Pengaduan</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12">

                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100" src="<?= base_url(); ?>/backend/vendors/images/img3.jpg" alt="First slide">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100" src="<?= base_url(); ?>/backend/vendors/images/img4.jpg" alt="Second slide">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-100" src="<?= base_url(); ?>/backend/vendors/images/img5.jpg" alt="Third slide">
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div> <!-- End of Card Box -->
            </div> <!-- End Column -->
        </div> <!-- End Row -->
    </div>
</div>

<?= $this->endSection(); ?>