<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratKuasaModel extends Model
{
    protected $table = 'surat_kuasa';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'nomor_surat',
        'nama_pemberi',
        'jenis_kelamin_pemberi',
        'ttl_pemberi',
        'agama_pemberi',
        'pekerjaan_pemberi',
        'alamat_pemberi',
        'nik_pemberi',
        'nama_penerima',
        'pekerjaan_penerima',
        'kantor_penerima',
        'alamat_penerima',
        'hp_penerima',
        'email_penerima',
        'kekuasaan',
        'tanggal_dikeluarkan',
        'tempat_dikeluarkan'
    ];
}
