<div class="left-side-bar">
    <div class="brand-logo text-center"> <!-- Menambahkan class text-center untuk memusatkan -->
        <?php if (logged_in() && in_groups('admin')): ?>
            <a href="<?= base_url('admin/index'); ?>">
            <?php endif; ?>
            <?php if (logged_in() && in_groups('masyarakat')): ?>
                <a href="<?= base_url('masyarakat/index'); ?>">
                <?php endif; ?>
                <img src="<?= base_url('/images/nawasena2.png'); ?>" alt="logo_nawasena" class="" style="max-width: 100%; height: auto; width: 220px; margin-bottom: 50px; margin-top: 130px; margin-left: 10px" /> <!-- Menambahkan margin-bottom -->
                </a>

                <div class="close-sidebar" data-toggle="left-sidebar-close">
                    <i class="ion-close-round"></i>
                </div>
    </div>
    <br> <br>

    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <div class="dropdown-divider"></div>
                <li>
                    <div class="sidebar-small-cap">INFORMASI PRIBADI</div>
                </li>
                <?php if (logged_in() && in_groups('admin')): ?>
                    <li>
                        <a href="<?= base_url('admin/profile'); ?>" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-person"></span>
                            <span class="mtext">Profil Saya</span>
                        </a>
                    </li>

                <?php endif; ?>

                <?php if (logged_in() && in_groups('masyarakat')): ?>
                    <li>
                        <a href="<?= base_url('masyarakat/profile'); ?>" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-person"></span><span class="mtext">Profil Saya</span>
                        </a>
                    </li>

                <?php endif; ?>
                <?php if (logged_in() && in_groups('admin')): ?>
                    <div class="dropdown-divider"></div>
                    <li>
                        <div class="sidebar-small-cap">KELOLA PENGGUNA</div>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/user-list'); ?>" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-people"></span>
                            <span class="mtext">List Pengguna</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/list_pengacara'); ?>" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-people"></span>
                            <span class="mtext">Data Pengacara</span>
                        </a>
                    </li>
                <?php endif; ?>
                <div class="dropdown-divider"></div>
                <li>
                    <div class="sidebar-small-cap">KELOLA KASUS</div>
                </li>
                <?php if (logged_in() && in_groups('admin')): ?>

                    <li class="" dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon bi bi-hdd-stack"></span><span class="mtext">Pengaduan</span>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="<?= base_url('admin/pengaduan'); ?>" class="dropdown-toggle no-arrow">list Semua Pengaduan</a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/pengaduan/masuk'); ?>" class="dropdown-toggle no-arrow">List Pengaduan Masuk</a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/pengaduan/diproses'); ?>" class="dropdown-toggle no-arrow">List Pengaduan Proses</a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/pengaduan/diselesaikan'); ?>" class="dropdown-toggle no-arrow">List Pengaduan Selesai</a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/pengaduan/dihapus'); ?>" class="dropdown-toggle no-arrow">List Pengaduan Dihapus</a>
                            </li>

                        </ul>
                    <li>
                        <a href="<?= base_url('admin/suratkuasa/list_pengajuan_suratkuasa'); ?>" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-file-earmark-text"></span> <!-- Menggunakan ikon yang sama -->
                            <span class="mtext">Surat Kuasa</span>
                        </a>
                    </li>

                    </li>
                <?php endif; ?>
                <?php if (logged_in() && in_groups('masyarakat')): ?>
                    <li class="class=" dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon bi bi-megaphone-fill"></span><span class="mtext">Pengaduan</span>
                        </a>
                        <ul class="submenu">

                            <li>
                                <a href="<?= base_url('masyarakat/pengaduan/tambah'); ?>" class=" dropdown-toggle no-arrow">Formulir Pengaduan</a>
                            </li>
                            <li>
                                <a href="<?= base_url('masyarakat/pengaduan'); ?>" class="dropdown-toggle no-arrow">Riwayat Pengaduan</a>
                            </li>
                        </ul>

                    <li>
                        <a href="<?= base_url('masyarakat/suratkuasa/riwayat'); ?>" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-file-earmark-text"></span> <!-- Menggunakan ikon yang sama -->
                            <span class="mtext">Surat Kuasa</span>
                        </a>
                    </li>
                    </li>

                <?php endif; ?>
                <div class="dropdown-divider"></div>
                <li>
                    <div class="sidebar-small-cap">Extra</div>
                </li>
                <li>
                    <a href="<?= base_url('logout'); ?>" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-box-arrow-right "></span><span class="mtext">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>