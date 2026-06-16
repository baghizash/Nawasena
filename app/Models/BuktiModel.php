<?php

namespace App\Models;

use CodeIgniter\Model;

class BuktiModel extends Model
{
    protected $table = 'bukti';
    protected $useTimestamps = true;
    protected $allowedFields = ['id', 'pengaduan_id', 'img_satu', 'img_dua', 'img_tiga', 'updated_at', 'deleted_at', 'row_status'];

    public function getBukti($id)
    {
        $result = $this->where('pengaduan_id', $id)->first();

        // Pastikan `img_satu`, `img_dua`, dan `img_tiga` selalu tersedia dalam array yang dikembalikan
        return [
            'img_satu' => $result['img_satu'] ?? null,
            'img_dua' => $result['img_dua'] ?? null,
            'img_tiga' => $result['img_tiga'] ?? null,
        ];
    }

    public function soft_delete($pengaduan_id)
    {
        $builder = $this->table('bukti');
        $builder->set('row_status', 0);
        $builder->set('deleted_at', date('Y-m-d H:i:s'));
        $builder->where('pengaduan_id', $pengaduan_id);
        $builder->update();
    }
}
