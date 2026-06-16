<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaduanModel extends Model
{
    protected $table = 'pengaduan';
    protected $primaryKey = 'id';
    protected $useTimestamps = true; // Untuk mengaktifkan created_at dan updated_at

    protected $allowedFields = [
        'user_id',
        'nama_pengadu',
        'judul_pengaduan',
        'isi_pengaduan',
        'row_status',
        'deleted_at',
        'created_at',
        'updated_at',
        'lokasi_pengaduan',
        'kategori_pengaduan',
        'kontak_pengadu',
        'NIK',
        'pengacara'

    ];

    // Define default values or soft delete settings
    protected $deletedField  = 'deleted_at';
    protected $returnType    = 'array';
    protected $useSoftDeletes = true;

    // Fungsi untuk mengambil pengaduan berdasarkan user_id
    public function getPengaduanByUser($userId)
    {
        return $this->where('user_id', $userId)
            ->where('row_status', 1) // Hanya mengambil yang tidak terhapus
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }


    public function getPengaduanByStatus(int $status)
    {
        return $this->where('row_status', $status)->findAll();
    }
    public function countByStatus($status)
    {
        return $this->where('row_status', $status)->countAllResults();
    }

    // Fungsi untuk mengambil pengaduan berdasarkan ID
    public function getPengaduanById($id)
    {
        return $this->where('id', $id)
            ->where('row_status', 1) // Hanya mengambil yang tidak terhapus
            ->first(); // Mengembalikan satu hasil
    }
    public function updateStatus($id, $status)
    {
        log_message('info', 'Proses update row_status pada ID: ' . $id . ' dengan status baru: ' . $status);
        $result = $this->update($id, ['row_status' => $status]);

        if (!$result) {
            log_message('error', 'Update gagal untuk ID: ' . $id);
        }
        return $result;
    }


    // Fungsi untuk melakukan soft delete dengan row_status
    public function softDeletePengaduan($id)
    {
        return $this->update($id, [
            'deleted_at' => date('Y-m-d H:i:s'),
            'row_status' => 0
        ]);
    }
    public function getPengaduanStats($userId)
    {
        return $this->select('row_status, COUNT(*) as total')
            ->where('user_id', $userId)
            ->groupBy('row_status')
            ->findAll();
    }

    // Fungsi untuk mendapatkan pengaduan terbaru
    public function getPengaduanTerbaru($userId)
    {
        return $this->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->first();
    }
    public function countByRowStatus1()
    {
        return $this->where('row_status', 1)->countAllResults();
    }
    public function countByRowStatus2()
    {
        return $this->where('row_status', 2)->countAllResults();
    }
    public function countByRowStatus3()
    {
        return $this->where('row_status', 3)->countAllResults();
    }


    public function countByStatusAndTime($status, $rentang)
    {
        $builder = $this->builder();


        // Filter berdasarkan status dan rentang waktu
        $builder->select('COUNT(*) as total, DAYOFWEEK(created_at) as day_of_week')
            ->where('row_status', $status)
            ->groupBy('day_of_week')
            ->where('created_at >=', $this->getStartDate($rentang)) // Sesuaikan rentang waktu
            ->orderBy('day_of_week');

        // Ambil data berdasarkan status dan rentang waktu
        $query = $builder->get();
        return $query->getResult();
    }

    // Fungsi untuk menentukan tanggal awal berdasarkan rentang waktu
    private function getStartDate($rentang)
    {
        switch ($rentang) {
            case 'last_week':
                return date('Y-m-d', strtotime('-1 week'));
            case 'last_month':
                return date('Y-m-d', strtotime('-1 month'));
            case 'last_6_month':
                return date('Y-m-d', strtotime('-6 month'));
            case 'last_year':
                return date('Y-m-d', strtotime('-1 year'));
            default:
                return date('Y-m-d', strtotime('-1 week'));
        }
    }
    public function getDataForLastWeek()
    {
        $builder = $this->builder();
        $builder->where('created_at >=', date('Y-m-d H:i:s', strtotime('-1 week')));
        $query = $builder->get();

        // Ambil data dan format menjadi kategori (hari dalam seminggu)
        $result = $query->getResult();

        // Format data untuk grafik (jumlah pengaduan per hari)
        $categories = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $values = [0, 0, 0, 0, 0, 0, 0]; // Jumlah pengaduan per hari

        foreach ($result as $row) {
            $dayOfWeek = date('D', strtotime($row->created_at)); // Ambil hari dalam bentuk 'Mon', 'Tue', etc.
            $dayIndex = array_search($dayOfWeek, $categories);
            if ($dayIndex !== false) {
                $values[$dayIndex]++;
            }
        }

        return [
            'categories' => $categories,
            'values' => $values,
        ];
    }
    public function getDataForLastMonth()
    {
        $builder = $this->builder();
        $builder->where('created_at >=', date('Y-m-d H:i:s', strtotime('-1 month')));
        $query = $builder->get();

        // Ambil data dan format menjadi kategori (minggu dalam bulan)
        $result = $query->getResult();

        // Format data untuk grafik (jumlah pengaduan per minggu)
        $categories = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
        $values = [0, 0, 0, 0]; // Jumlah pengaduan per minggu

        foreach ($result as $row) {
            $weekOfMonth = ceil(date('j', strtotime($row->created_at)) / 7); // Ambil minggu dalam bulan
            $weekIndex = $weekOfMonth - 1; // Indeks minggu (0-3)
            $values[$weekIndex]++;
        }

        return [
            'categories' => $categories,
            'values' => $values,
        ];
    }
    public function getDataForLast6Months()
    {
        $builder = $this->builder();
        $builder->where('created_at >=', date('Y-m-d H:i:s', strtotime('-6 months')));
        $query = $builder->get();

        // Ambil data dan format menjadi kategori (bulan dalam 6 bulan terakhir)
        $result = $query->getResult();

        // Format data untuk grafik (jumlah pengaduan per bulan)
        $categories = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
        $values = [0, 0, 0, 0, 0, 0]; // Jumlah pengaduan per bulan

        foreach ($result as $row) {
            $month = date('M', strtotime($row->created_at)); // Ambil bulan dalam bentuk 'Jan', 'Feb', etc.
            $monthIndex = array_search($month, $categories);
            if ($monthIndex !== false) {
                $values[$monthIndex]++;
            }
        }

        return [
            'categories' => $categories,
            'values' => $values,
        ];
    }
    public function getDataForLastYear()
    {
        $builder = $this->builder();
        $builder->where('created_at >=', date('Y-m-d H:i:s', strtotime('-1 year')));
        $query = $builder->get();

        // Ambil data dan format menjadi kategori (bulan dalam tahun terakhir)
        $result = $query->getResult();

        // Format data untuk grafik (jumlah pengaduan per bulan)
        $categories = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $values = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; // Jumlah pengaduan per bulan

        foreach ($result as $row) {
            $month = date('M', strtotime($row->created_at)); // Ambil bulan dalam bentuk 'Jan', 'Feb', etc.
            $monthIndex = array_search($month, $categories);
            if ($monthIndex !== false) {
                $values[$monthIndex]++;
            }
        }

        return [
            'categories' => $categories,
            'values' => $values,
        ];
    }
}
