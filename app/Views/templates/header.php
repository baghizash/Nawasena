<style>
    .user-icon {
        display: inline-block;
        width: 50px;
        /* Sesuaikan ukuran lingkaran */
        height: 60px;
        /* Sesuaikan ukuran lingkaran */
        border-radius: 50%;
        /* Membuat gambar berbentuk lingkaran */
        overflow: hidden;
        /* Menyembunyikan bagian luar lingkaran */
    }

    .user-image {
        width: 100%;
        /* Memastikan gambar memenuhi lingkaran */
        height: 100%;
        object-fit: cover;
        /* Memastikan gambar tidak terdistorsi */
    }

    .user-name {
        display: inline-block;
        /* Mengatur tata letak inline yang lebih rapi */
        font-size: 16px;
        /* Sesuaikan ukuran font */
        font-weight: bold;
        /* Membuat teks menjadi tebal */
        color: #333;
        /* Warna teks, bisa disesuaikan */
        margin-left: 10px;
        /* Jarak antara nama dan gambar pengguna */
        vertical-align: middle;
        /* Menyesuaikan posisi teks dengan gambar */
        text-transform: capitalize;
        /* Opsional: Membuat huruf pertama kapital */
        font-family: Arial, sans-serif;
        /* Sesuaikan font */
        white-space: nowrap;
        /* Mencegah teks terpotong atau terbungkus */
    }
</style>
<div class="header">
    <div class="header-left">
        <div class="menu-icon bi bi-list"></div>
    </div>
    <div class="header-right">
        <div class="dashboard-setting user-notification">
            <div class="dropdown">
                <a
                    class="dropdown-toggle no-arrow"
                    href="javascript:;"
                    data-toggle="right-sidebar">
                    <i class="dw dw-settings2"></i>
                </a>
            </div>
        </div>
        <?php
        $userImage = user()->user_image;
        $imageSrc = ($userImage === 'default.jpg') ? base_url('images/default.jpg') : base_url('uploads/' . $userImage);
        ?>
        <div class="user-info-dropdown">
            <span class="user-icon">
                <img src="<?= $imageSrc; ?>" alt="User Image" class="user-image" />
            </span>
            <span class="user-name"><?= user()->username ?></span>
        </div>
    </div>
</div>

</div>
</div>