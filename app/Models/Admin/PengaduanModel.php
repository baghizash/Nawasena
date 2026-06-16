<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class PengaduanModel extends Model
{
    protected $table = 'pengaduan';
    protected $useTimestamps = true;
    protected $allowedFields = ['id', 'status_pengaduan', 'created_at', 'updated_at', 'deleted_at', 'row_status', 'judul_pengaduan'];

    protected $column_order = [null, 'created_at', 'judul_pengaduan', 'status_pengaduan', null];
    protected $column_search = ['judul_pengaduan'];
    protected $order = ['created_at' => 'desc'];

    protected $column_order_pm = [null, 'created_at', 'judul_pengaduan', null];
    protected $column_search_pm = ['judul_pengaduan'];
    protected $order_pm = ['created_at' => 'desc'];

    protected $column_order_dp = [null, 'created_at', 'judul_pengaduan', null];
    protected $column_search_dp = ['judul_pengaduan'];
    protected $order_dp = ['created_at' => 'desc'];

    protected $column_order_ds = [null, 'created_at', 'judul_pengaduan', null];
    protected $column_search_ds = ['judul_pengaduan'];
    protected $order_ds = ['created_at' => 'desc'];

    protected $dt;
    protected $pm;
    protected $dp;
    protected $ds;
    protected $request;

    function __construct()
    {
        parent::__construct();
        $this->dt = $this->db->table($this->table)
            ->select('id, created_at, judul_pengaduan, status_pengaduan')
            ->where('row_status', 1);
        $this->pm = $this->db->table($this->table)
            ->select('id, created_at, judul_pengaduan, status_pengaduan')
            ->where(['row_status' => 1, 'status_pengaduan' => 1]);
        $this->dp = $this->db->table($this->table)
            ->select('id, created_at, judul_pengaduan, status_pengaduan')
            ->where(['row_status' => 1, 'status_pengaduan' => 2]);
        $this->ds = $this->db->table($this->table)
            ->select('id, created_at, judul_pengaduan, status_pengaduan')
            ->where(['row_status' => 1, 'status_pengaduan' => 3]);
    }

    private function _get_datatables_query()
    {
        $this->dt = $this->db->table('pengaduan');
        $searchValue = $this->request->getPost('search')['value'] ?? null;
        $i = 0;

        foreach ($this->column_search as $item) {
            if ($searchValue) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $searchValue);
                } else {
                    $this->dt->orLike($item, $searchValue);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        $orderColumn = $this->request->getPost('order')[0]['column'] ?? null;
        $orderDir = $this->request->getPost('order')[0]['dir'] ?? null;

        if ($orderColumn !== null && $orderDir !== null) {
            $this->dt->orderBy($this->column_order[$orderColumn], $orderDir);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        $length = $this->request->getPost('length') ?? -1;
        $start = $this->request->getPost('start') ?? 0;
        if ($length != -1)
            $this->dt->limit($length, $start);
        $query = $this->dt->get();
        return $query->getResult();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        return $this->dt->countAllResults();
    }

    private function _get_datatables_query_pm()
    {
        $searchValue = $this->request->getPost('search')['value'] ?? null;
        $i = 0;

        foreach ($this->column_search_pm as $item) {
            if ($searchValue) {
                if ($i === 0) {
                    $this->pm->groupStart();
                    $this->pm->like($item, $searchValue);
                } else {
                    $this->pm->orLike($item, $searchValue);
                }
                if (count($this->column_search_pm) - 1 == $i)
                    $this->pm->groupEnd();
            }
            $i++;
        }

        $orderColumn = $this->request->getPost('order')[0]['column'] ?? null;
        $orderDir = $this->request->getPost('order')[0]['dir'] ?? null;

        if ($orderColumn !== null && $orderDir !== null) {
            $this->pm->orderBy($this->column_order_pm[$orderColumn], $orderDir);
        } else if (isset($this->order_pm)) {
            $order = $this->order_pm;
            $this->pm->orderBy(key($order), $order[key($order)]);
        }
    }

    function get_datatables_pm()
    {
        $this->_get_datatables_query_pm();
        $length = $this->request->getPost('length') ?? -1;
        $start = $this->request->getPost('start') ?? 0;
        if ($length != -1)
            $this->pm->limit($length, $start);
        $query = $this->pm->get();
        return $query->getResult();
    }

    function count_filtered_pm()
    {
        $this->_get_datatables_query_pm();
        return $this->pm->countAllResults();
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

    private function _get_datatables_query_dp()
    {
        $searchValue = $this->request->getPost('search')['value'] ?? null;
        $i = 0;

        foreach ($this->column_search_dp as $item) {
            if ($searchValue) {
                if ($i === 0) {
                    $this->dp->groupStart();
                    $this->dp->like($item, $searchValue);
                } else {
                    $this->dp->orLike($item, $searchValue);
                }
                if (count($this->column_search_dp) - 1 == $i)
                    $this->dp->groupEnd();
            }
            $i++;
        }

        $orderColumn = $this->request->getPost('order')[0]['column'] ?? null;
        $orderDir = $this->request->getPost('order')[0]['dir'] ?? null;

        if ($orderColumn !== null && $orderDir !== null) {
            $this->dp->orderBy($this->column_order_dp[$orderColumn], $orderDir);
        } else if (isset($this->order_dp)) {
            $order = $this->order_dp;
            $this->dp->orderBy(key($order), $order[key($order)]);
        }
    }

    function get_datatables_dp()
    {
        $this->_get_datatables_query_dp();
        $length = $this->request->getPost('length') ?? -1;
        $start = $this->request->getPost('start') ?? 0;
        if ($length != -1)
            $this->dp->limit($length, $start);
        $query = $this->dp->get();
        return $query->getResult();
    }

    function count_filtered_dp()
    {
        $this->_get_datatables_query_dp();
        return $this->dp->countAllResults();
    }

    private function _get_datatables_query_ds()
    {
        $searchValue = $this->request->getPost('search')['value'] ?? null;
        $i = 0;

        foreach ($this->column_search_ds as $item) {
            if ($searchValue) {
                if ($i === 0) {
                    $this->ds->groupStart();
                    $this->ds->like($item, $searchValue);
                } else {
                    $this->ds->orLike($item, $searchValue);
                }
                if (count($this->column_search_ds) - 1 == $i)
                    $this->ds->groupEnd();
            }
            $i++;
        }

        $orderColumn = $this->request->getPost('order')[0]['column'] ?? null;
        $orderDir = $this->request->getPost('order')[0]['dir'] ?? null;

        if ($orderColumn !== null && $orderDir !== null) {
            $this->ds->orderBy($this->column_order_ds[$orderColumn], $orderDir);
        } else if (isset($this->order_ds)) {
            $order = $this->order_ds;
            $this->ds->orderBy(key($order), $order[key($order)]);
        }
    }

    function get_datatables_ds()
    {
        $this->_get_datatables_query_ds();
        $length = $this->request->getPost('length') ?? -1;
        $start = $this->request->getPost('start') ?? 0;
        if ($length != -1)
            $this->ds->limit($length, $start);
        $query = $this->ds->get();
        return $query->getResult();
    }

    function count_filtered_ds()
    {
        $this->_get_datatables_query_ds();
        return $this->ds->countAllResults();
    }
    public function get_processed_complaints()
    {
        // Ganti 'status' dengan nama kolom yang sesuai yang menunjukkan pengaduan yang sedang diproses
        return $this->where('status', 'processed')->findAll();
    }
}
