<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupModel extends Model
{
    protected $table = 'auth_groups_users'; // Tabel pivot yang menghubungkan user dan group
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'group_id'];

    /**
     * Ambil role dari user berdasarkan user_id
     */
    public function getGroupsForUser($userId)
    {
        return $this->db->table('auth_groups_users')
            ->select('auth_groups.name')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
            ->where('auth_groups_users.user_id', $userId)
            ->get()
            ->getResultArray();
    }
}
