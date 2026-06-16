<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Myth\Auth\Entities\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Inisialisasi UserModel dan GroupModel
        $userModel = model('UserModel');
        $groupModel = model('GroupModel');

        // Data admin yang akan dibuat
        $adminData = [
            'email'            => 'admin@gmail.com',
            'username'         => 'admin',
            'password'         => 'apaapa123',
            'active'           => 1,
            'force_pass_reset' => 0,
        ];

        // Cek apakah user dengan email atau username sudah ada
        $existingUser = $userModel->where('email', $adminData['email'])
            ->orWhere('username', $adminData['username'])
            ->first();

        if (!$existingUser) {
            // Buat entitas user dari data
            $adminUser = new User($adminData);

            // Simpan user ke database
            if ($userModel->save($adminUser)) {
                // Mendapatkan ID user yang baru dibuat
                $userId = $userModel->getInsertID();

                // Pastikan ID user valid
                if ($userId > 0) {
                    // Cari grup admin berdasarkan nama untuk mendapatkan objek grup
                    $adminGroup = $groupModel->where('name', 'admin')->first();

                    // Pastikan grup admin ditemukan
                    if ($adminGroup) {
                        $adminGroupId = $adminGroup->id;

                        // Tambahkan user ke grup 'admin'
                        $groupModel->addUserToGroup($userId, $adminGroupId);
                    } else {
                        throw new \Exception('Grup admin tidak ditemukan');
                    }
                } else {
                    throw new \Exception('Gagal menyimpan user, ID tidak valid');
                }
            } else {
                // Jika user gagal disimpan, tampilkan error
                $errors = $userModel->errors();
                print_r($errors); // Cetak error yang terjadi
                throw new \Exception('Gagal menyimpan user');
            }
        } else {
            echo "User sudah ada dengan email: {$adminData['email']} atau username: {$adminData['username']}\n";
        }
    }
}
