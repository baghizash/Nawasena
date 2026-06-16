<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Password;

class UpdateAdminSeeder extends Seeder
{
    public function run()
    {
        // Menggunakan UserModel untuk mengambil data user
        $userModel = new UserModel();

        // Cari user berdasarkan username 'baghiz1'
        $admin = $userModel->where('username', 'agis')->first();

        if ($admin) {
            // Pastikan user termasuk dalam grup 'admin'
            if ($userModel->withGroup('admin')->find($admin->id)) {
                // Update password baru
                $admin->password_hash = Password::hash('newpassword');  // Ganti 'newpassword' dengan password baru

                // Simpan perubahan ke database
                $userModel->save($admin);

                echo "Password admin dengan username 'agis' berhasil diupdate!";
            } else {
                echo "User 'baghiz1' bukan admin!";
            }
        } else {
            echo "Admin dengan username 'agis' tidak ditemukan!";
        }
    }
}
