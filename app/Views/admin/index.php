<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>

<div class="main-container">
    <div class="pd-ltr-20">
        <div class="card-box pd-20 height-90-p mb-30">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <img src="<?= base_url(); ?>/backend/vendors/images/banner-img.png" alt="" />
                </div>
                <div class="col-md-8">
                    <h4 class="font-28 weight-500 mb-10 text-capitalize">
                        Selamat Datang di NAWASENA
                        <div class="weight-600 font-30 text-blue"><?= user()->username; ?></div>
                    </h4>
                </div>

            </div>
        </div>
    </div>
    <div class="row pb-10">
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark"><?= $Pengaduan_baru; ?></div>
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
                        <div class="weight-700 font-24 text-dark"><?= $Pengaduan_diproses; ?></div>
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
                        <div class="weight-700 font-24 text-dark"><?= $Pengaduan_selesai; ?></div>
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
                        <div class="weight-700 font-24 text-dark"><?= $jumlah_user; ?></div>
                        <div class="font-14 text-secondary weight-500">Jumlah Pengguna</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon">
                            <i class="bi-person-circle" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row pb-10">
        <div class="col-md-8 mb-20">
            <div class="card-box height-100-p pd-20">
                <div
                    class="d-flex flex-wrap justify-content-between align-items-center pb-0 pb-md-3">
                    <div class="h5 mb-md-0">Aktivitas Pengaduan</div>
                    <div class="form-group mb-md-0">
                        <form method="get" action="<?= site_url('Admin/index'); ?>">
                            <select class="form-control form-control-sm selectpicker" name="rentang" id="rentang">
                                <option value="last_week" <?= $rentang == 'last_week' ? 'selected' : ''; ?>>Last Week</option>
                                <option value="last_month" <?= $rentang == 'last_month' ? 'selected' : ''; ?>>Last Month</option>
                                <option value="last_6_months" <?= $rentang == 'last_6_months' ? 'selected' : ''; ?>>Last 6 Months</option>
                                <option value="last_year" <?= $rentang == 'last_year' ? 'selected' : ''; ?>>Last 1 Year</option>
                            </select>
                        </form>
                    </div>
                </div>
                <canvas id="activities-chart"></canvas>

            </div>
        </div>
        <div class="col-md-4 mb-20">
            <div
                class="card-box min-height-200px pd-20 mb-20"
                data-bgcolor="#455a64">
                <div class="d-flex justify-content-between pb-20 text-white">
                    <div class="icon h1 text-white">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <!-- <i class="icon-copy fa fa-stethoscope" aria-hidden="true"></i> -->
                    </div>
                    <div class="font-14 text-right">
                        <div><i class="icon-copy ion-arrow-up-c"></i> 2.69%</div>
                        <div class="font-12">Since last month</div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end">
                    <div class="text-white">
                        <div class="font-14">Pengaduan Selesai</div>
                        <div class="font-24 weight-500">1865</div>
                    </div>
                    <div class="max-width-150">
                        <div id="appointment-chart"></div>
                    </div>
                </div>
            </div>
            <div class="card-box min-height-200px pd-20" data-bgcolor="#265ed7">
                <div class="d-flex justify-content-between pb-20 text-white">
                    <div class="icon h1 text-white">
                        <i class="micon bi bi-megaphone-fill" aria-hidden="true"></i>
                    </div>
                    <div class="font-14 text-right">
                        <div><i class="icon-copy ion-arrow-down-c"></i> 3.69%</div>
                        <div class="font-12">Since last month</div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end">
                    <div class="text-white">
                        <div class="font-14">Pengaduan Masuk</div>
                        <div class="font-24 weight-500">250</div>
                    </div>
                    <div class="max-width-150">
                        <div id="surgery-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('activities-chart').getContext('2d');

        // Data chart yang diterima dari PHP
        var chartData = <?= json_encode($chartData); ?>;

        // Debugging untuk memastikan data yang diterima
        console.log('Chart data:', chartData); // Menggunakan chartData, bukan data yang belum terdefinisi

        // Membuat chart menggunakan Chart.js
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.categories, // Kategori pada sumbu X
                datasets: [{
                        label: 'Pengaduan Baru', // Label untuk garis pertama
                        data: chartData.pengaduan_baru, // Data untuk pengaduan baru
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)', // Warna garis pertama
                        tension: 0.1
                    },
                    {
                        label: 'Pengaduan Diproses', // Label untuk garis kedua
                        data: chartData.pengaduan_diproses, // Data untuk pengaduan diproses
                        fill: false,
                        borderColor: 'rgb(255, 99, 132)', // Warna garis kedua
                        tension: 0.1
                    },
                    {
                        label: 'Pengaduan Selesai', // Label untuk garis ketiga
                        data: chartData.pengaduan_selesai, // Data untuk pengaduan selesai
                        fill: false,
                        borderColor: 'rgb(54, 162, 235)', // Warna garis ketiga
                        tension: 0.1
                    }
                ]
            },
            options: {
                responsive: true, // Membuat grafik responsif
                scales: {
                    y: {
                        beginAtZero: true // Mulai sumbu Y dari 0
                    }
                }
            }
        });
    </script>


    <?= $this->endSection(); ?>