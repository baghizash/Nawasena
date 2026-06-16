<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDetailPengaduanToPengaduan extends Migration
{
    public function up()
    {
        // Jika tabel sudah ada dan ingin menambahkan kolom baru
        if ($this->db->tableExists('pengaduan')) {
            $this->forge->addColumn('pengaduan', [
                'lokasi_pengaduan' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => true,
                ],
                'detail_pengaduan' => [ // Kolom baru untuk detail pengaduan
                    'type' => 'TEXT',
                    'null' => true,
                ],
            ]);
        } else {
            // Membuat tabel baru jika tabel belum ada
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
                    'unsigned' => true,
                ],
                'nama_pengadu' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'default' => 'anonym',
                ],
                'judul_pengaduan' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                ],
                'isi_pengaduan' => [
                    'type' => 'TEXT',
                ],
                'status_pengaduan' => [
                    'type' => 'ENUM',
                    'constraint' => ['diproses', 'selesai', 'ditolak'],
                    'default' => 'diproses',
                ],
                'row_status' => [
                    'type' => 'TINYINT',
                    'constraint' => 1,
                    'default' => 1,
                ],
                'lokasi_pengaduan' => [ // Kolom baru
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => true,
                ],
                'detail_pengaduan' => [ // Kolom baru untuk detail pengaduan
                    'type' => 'TEXT',
                    'null' => true,
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
    }

    public function down()
    {
        // Jika ingin menghapus kolom yang baru ditambahkan
        if ($this->db->tableExists('pengaduan')) {
            $this->forge->dropColumn('pengaduan', 'lokasi_pengaduan');
            $this->forge->dropColumn('pengaduan', 'detail_pengaduan'); // Menghapus kolom detail_pengaduan
        }
    }
}
