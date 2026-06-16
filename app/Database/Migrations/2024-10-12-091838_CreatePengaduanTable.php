<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengaduanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true, // Jika ini merujuk ke tabel users
            ],
            'nama_pengadu' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => 'anonym',
            ],
            'judul_pengaduan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'isi_pengaduan' => [
                'type' => 'TEXT',
            ],
            'status_pengaduan' => [
                'type' => 'ENUM',
                'constraint' => "'diproses','selesai','ditolak'",
                'default' => 'diproses',
            ],
            'row_status' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('pengaduan', true);
    }

    public function down()
    {
        $this->forge->dropTable('pengaduan', true);
    }
}
