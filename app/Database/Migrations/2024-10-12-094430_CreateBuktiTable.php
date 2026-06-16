<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBuktiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
            ],
            'pengaduan_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true, // Pastikan ini sesuai dengan pengaduan.id
            ],
            'img_satu' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'img_dua' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'img_tiga' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
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
            'row_status' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('pengaduan_id', 'pengaduan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('bukti', true);
    }

    public function down()
    {
        $this->forge->dropForeignKey('bukti', 'bukti_pengaduan_id_foreign'); // Pastikan nama sesuai dengan nama foreign key yang didefinisikan
        $this->forge->dropTable('bukti', true);
    }
}
