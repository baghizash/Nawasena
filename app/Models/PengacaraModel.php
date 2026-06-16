<?php

namespace App\Models;

use CodeIgniter\Model;

class PengacaraModel extends Model
{
    protected $table = 'pengacara';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_pengacara'
    ];
}
