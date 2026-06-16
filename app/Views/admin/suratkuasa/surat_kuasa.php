<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>SURAT KUASA</title>
    <style>
        body {
            font-family: "Century Gothic", sans-serif;
            font-size: 10pt;
            line-height: 1;
            margin: 20px;
        }

        .title {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .subtitle {
            text-align: center;
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 20px;
        }

        .bold {
            font-weight: bold;
        }

        .underline {
            text-decoration: underline;
        }

        .italic {
            font-style: italic;
        }

        ul {
            list-style-type: none;
            padding-left: 0;
            margin: 0;
        }

        li {
            margin-bottom: 10px;
        }

        .signature {
            margin-top: 20px;
            width: 100%;
            text-align: center;
        }

        .signature div {
            display: inline-block;
            width: 45%;
            vertical-align: top;
        }

        .signature div p {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="title">S U R A T K U A S A</div>
    <div class="subtitle">Nomor: <?= $suratKuasa['nomor_surat']; ?></div>

    <div class="section">
        <p>Yang bertandatangan di bawah ini :</p>
        <p>
            Nama: <span class="bold underline"><?= $suratKuasa['nama_pemberi']; ?></span>, jenis kelamin <?= $suratKuasa['jenis_kelamin_pemberi']; ?>;
            tempat/tanggal lahir, <?= $suratKuasa['ttl_pemberi']; ?>; agama <?= $suratKuasa['agama_pemberi']; ?>;
            pekerjaan <span class="italic"><?= $suratKuasa['pekerjaan_pemberi']; ?></span>;
            beralamat di <?= $suratKuasa['alamat_pemberi']; ?>
            ;
        </p>
        <ul>
            <li>Pemegang KTP NIK: <span class="underline"><?= $suratKuasa['nik_pemberi']; ?></span>;</li>
            <li>Bertindak untuk dan atas nama <span class="italic">Sendiri</span> selaku
                <span class="italic">Pemilik Lahan</span>, sekaligus selaku <span class="italic">Korban</span>
                tindak Pidana Penyerobotan Tanah sebagaimana dimaksud;
            </li>
            <li>Untuk selanjutnya disebut sebagai: <span class="bold">P E M B E R I K U A S A</span>.
            </li>
        </ul>
    </div>

    <div class="section">
        <p>Dengan ini <span class="italic">mengaku telah memberikan Kuasa penuh kepada</span>:</p>
        <p>
            Nama: <span class="bold"><?= $suratKuasa['nama_penerima']; ?></span>, Adalah <?= $suratKuasa['pekerjaan_penerima']; ?>,
            Penasihat Hukum pada Kantor Hukum <span class="italic">"NAWASENA" & PARTNER</span>
            <?= $suratKuasa['pekerjaan_penerima']; ?>; yang ber<span class="italic">kantor</span>
            <?= $suratKuasa['kantor_penerima']; ?>;
            HandPhone: <?= $suratKuasa['hp_penerima']; ?> WhatsApp: <?= $suratKuasa['hp_penerima']; ?> e-mail: <span class="underline"><?= $suratKuasa['email_penerima']; ?></span>;
        </p>
        <ul>
            <li>Bertindak secara bersama-sama maupun sendiri-sendiri;</li>
            <li>Untuk selanjutnya disebut sebagai: <span class="bold">P E N E R I M A K U A S A</span>.
            </li>
        </ul>
    </div>

    <div class="section">
        <p>Kuasa diberikan oleh Pemberi Kuasa guna untuk <span class="italic">mengurus</span> dan
            <span class="italic">menyelesaikan</span> permasalahan hukum yang timbul, baik secara
            <span class="italic">Pidana</span> maupun secara <span class="italic">Perdata</span>,
            dan tak terkecuali timbulnya Sengketa Tata Usaha Negara, akibat tindakan dan “Perbuatan Melawan Hukum
            oleh Penguasa (Onrechtmatige overheids daad), terkait dengan bidang tanah milik Pemberi Kuasa...
        </p>
    </div>

    <div class="signature" style="padding-top:20px">
        <div>
            <p><?= $suratKuasa['tempat_dikeluarkan']; ?>,<?= $suratKuasa['tanggal_dikeluarkan']; ?></p>
            <p style="padding-top:20px"><strong>PEMBERI KUASA</strong></p>
            <br><br><br>
            <p><span class="bold"><?= $suratKuasa['nama_pemberi']; ?></span></p>
        </div>
        <div>
            <p>&nbsp;</p>
            <p style="padding-top:20px"><strong>PENERIMA KUASA</strong></p>
            <br><br><br>
            <p><span class="bold"><?= $suratKuasa['nama_penerima']; ?></span></p>
        </div>
    </div>
</body>

</html>