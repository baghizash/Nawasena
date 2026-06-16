<?php

namespace App\Models;

use CodeIgniter\Model;
use Faker\Generator;
use Myth\Auth\Authorization\GroupModel;
use Myth\Auth\Entities\User;


/**
 * @method User|null first()
 */
class UserModel extends Model
{
    protected $table          = 'users';
    protected $primaryKey     = 'id';
    protected $returnType     = 'App\Entities\User';
    protected $useSoftDeletes = true;
    protected $allowedFields  = [

        'email',
        'username',
        'password_hash',  // Menggunakan password_hash agar sesuai dengan CodeIgniter Auth
        'reset_hash',
        'reset_at',
        'reset_expires',
        'activate_hash',
        'status',
        'status_message',
        'active',
        'force_pass_reset',
        'permissions',
        'deleted_at',
        'name', // Menambahkan 'nama' karena digunakan di saveUserProfile()
        'user_image', // Menambahkan 'user_image' sesuai penggunaan di saveUserProfile()
        'no_hp',
        'address',
        'NIK'

    ];
    protected $useTimestamps   = true;
    protected $validationRules = [
        // 'id'            => 'required|is_unique[users.id]',
        // 'email'         => 'required|valid_email|is_unique[users.email,id,{id}]',
        // 'username'      => 'required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,{id}]',
        // 'password_hash' => 'required',
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    protected $afterInsert        = ['addToGroup'];

    /**
     * The id of a group to assign.
     * Set internally by withGroup.
     *
     * @var int|null
     */
    protected $assignGroup;

    /**
     * Logs a password reset attempt for posterity sake.
     */
    public function logResetAttempt(string $email, ?string $token = null, ?string $ipAddress = null, ?string $userAgent = null)
    {
        $this->db->table('auth_reset_attempts')->insert([
            'email'      => $email,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'token'      => $token,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Logs an activation attempt for posterity sake.
     */
    public function logActivationAttempt(?string $token = null, ?string $ipAddress = null, ?string $userAgent = null)
    {
        $this->db->table('auth_activation_attempts')->insert([
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'token'      => $token,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Sets the group to assign any users created.
     *
     * @return $this
     */
    public function withGroup(string $groupName)
    {
        $group = $this->db->table('auth_groups')->where('name', $groupName)->get()->getFirstRow();

        $this->assignGroup = $group->id;

        return $this;
    }

    /**
     * Clears the group to assign to newly created users.
     *
     * @return $this
     */
    public function clearGroup()
    {
        $this->assignGroup = null;

        return $this;
    }

    /**
     * If a default role is assigned in Config\Auth, will
     * add this user to that group. Will do nothing
     * if the group cannot be found.
     *
     * @param mixed $data
     *
     * @return mixed
     */
    protected function addToGroup($data)
    {
        if (is_numeric($this->assignGroup)) {
            $groupModel = model(GroupModel::class);
            $groupModel->addUserToGroup($data['id'], $this->assignGroup);
        }

        return $data;
    }



    /**
     * Faked data for Fabricator.
     */
    public function fake(Generator &$faker): User
    {
        return new User([
            'email'    => $faker->email,
            'username' => $faker->userName,
            'password' => bin2hex(random_bytes(16)),
        ]);
    }

    /**
     * Mengambil data login user berdasarkan ID.
     *
     * @param int $id
     * @return array|null
     */
    public function getUserLogin($id)
    {
        $this->select('id, username, password_hash, email, user_image');
        return $this->getWhere(['id' => $id])->getRowArray();
    }

    /**
     * Menyimpan profil user, dengan opsi mengubah gambar.
     *
     * @param array $userdata
     * @param string|null $namaFile
     * @return array
     */
    // public function saveUserProfile($userdata, $namaFile = null)
    // {
    //     $this->transBegin();

    //     // Validasi input
    //     if (empty($userdata['name']) || empty($userdata['username']) || empty($userdata['email']) || empty($userdata['no_hp'])) {
    //         return [
    //             'status' => false,
    //             'msg'    => 'Semua field harus diisi.',
    //         ];
    //     }

    //     try {
    //         // Mengatur data yang akan diupdate
    //         $dataToUpdate = [
    //             'user_image' => $userdata['user_image'],
    //             'username' => $userdata['username'],
    //             'email'    => $userdata['email'],
    //             'no_hp'    => $userdata['no_hp'], // Menambahkan no_hp
    //             'address'  => $userdata['address'], // Menambahkan address
    //             'name'     => $userdata['name'], // Pastikan ini sesuai dengan database
    //         ];

    //         // Jika ada password yang diberikan, hash dan tambahkan ke data
    //         if (!empty($userdata['password'])) {
    //             $dataToUpdate['password_hash'] = password_hash($userdata['password'], PASSWORD_DEFAULT);
    //         }

    //         // Jika ada file gambar, tambahkan ke data
    //         if (!empty($namaFile)) {
    //             $dataToUpdate['user_image'] = $namaFile;
    //         }

    //         // Lakukan update ke database
    //         $this->update($userdata['id'], $dataToUpdate);

    //         // Cek jika ada error pada query update
    //         if ($this->db->affectedRows() === 0) {
    //             throw new \Exception('Tidak ada baris yang diperbarui, mungkin ID tidak valid.');
    //         }

    //         $this->transCommit();

    //         return [
    //             'status' => true,
    //             'msg'    => 'Profile berhasil diperbarui.',
    //         ];
    //     } catch (\Exception $e) {
    //         $this->transRollback();
    //         log_message('error', 'Error while updating profile: ' . $e->getMessage());
    //         return [
    //             'status' => false,
    //             'msg'    => 'Terjadi kesalahan. Silakan coba lagi.',
    //         ];
    //     }
    // }

    public function countAllUser()
    {
        return $this->countAllResults();
    }
    public function getAllUsers()
    {
        return $this->findAll(); // Mengambil seluruh data pengguna
    }
}
