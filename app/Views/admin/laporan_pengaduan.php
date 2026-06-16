<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $judul; ?></title>
    <style>
        /* Gaya sederhana untuk laporan PDF */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 20px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            table-layout: fixed;
            /* Membatasi lebar tabel */
        }

        th,
        td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
            font-size: 14px;
            word-wrap: break-word;
            /* Membungkus kata yang panjang */
            white-space: normal;
            /* Mengizinkan teks terbungkus ke bawah */
        }

        /* Set lebar spesifik untuk kolom */
        th:nth-child(1),
        td:nth-child(1) {
            width: 5%;
            /* No */
        }

        th:nth-child(2),
        td:nth-child(2) {
            width: 15%;
            /* Nama Pengadu */
        }

        th:nth-child(3),
        td:nth-child(3) {
            width: 20%;
            /* Judul Pengaduan */
        }

        th:nth-child(4),
        td:nth-child(4) {
            width: 30%;
            /* Isi Pengaduan */
        }

        th:nth-child(5),
        td:nth-child(5) {
            width: 15%;
            /* Tanggal Pengaduan */
        }

        th:nth-child(6),
        td:nth-child(6) {
            width: 15%;
            /* Status Pengaduan */
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Pesan untuk tidak ada data */
        .no-data {
            text-align: center;
            font-style: italic;
            color: #888;
        }
    </style>
</head>

<body>
    <h2><?= $judul; ?></h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pengadu</th>
                <th>Judul Pengaduan</th>
                <th>Isi Pengaduan</th>
                <th>Tanggal Pengaduan</th>
                <th>Status Pengaduan</th> <!-- Tambahkan header Status Pengaduan -->
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($pengaduan)) : ?>
                <?php foreach ($pengaduan as $index => $item) : ?>
                    <tr>
                        <td><?= $index + 1; ?></td>
                        <td><?= esc($item['nama_pengadu']); ?></td>
                        <td><?= esc($item['judul_pengaduan']); ?></td>
                        <td><?= esc($item['isi_pengaduan']); ?></td>
                        <td><?= esc($item['created_at']); ?></td>
                        <td>
                            <?php
                            // Cek nilai row_status dan tampilkan status yang sesuai
                            switch ($item['row_status']) {
                                case 0:
                                    echo 'Dihapus';
                                    break;
                                case 1:
                                    echo 'Baru';
                                    break;
                                case 2:
                                    echo 'Diproses';
                                    break;
                                case 3:
                                    echo 'Selesai';
                                    break;
                                default:
                                    echo 'Tidak Diketahui';
                                    break;
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6" class="no-data">Tidak ada data pengaduan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>