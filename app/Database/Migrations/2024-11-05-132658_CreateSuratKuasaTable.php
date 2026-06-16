<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuratKuasaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nomor_surat' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'nama_pemberi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'jenis_kelamin_pemberi' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => false,
            ],
            'ttl_pemberi' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'agama_pemberi' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'pekerjaan_pemberi' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'alamat_pemberi' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'nik_pemberi' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
            ],
            'nama_penerima' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'pekerjaan_penerima' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'kantor_penerima' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'alamat_penerima' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'hp_penerima' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'null' => false,
            ],
            'email_penerima' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'kekuasaan' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'tanggal_dikeluarkan' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'tempat_dikeluarkan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('surat_kuasa');
    }

    public function down()
    {
        $this->forge->dropTable('surat_kuasa');
    }
}
