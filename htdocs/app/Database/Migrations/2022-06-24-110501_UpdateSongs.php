<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateSongs extends Migration
{
    public function up()
    {
        $Field =[
            "duration"=>[
                "type"          =>"INT",
                "constraint"    =>11,
                'after' => 'name'
            ]
        ];
        $this->forge->addColumn("songs", $Field);
    }

    public function down()
    {
        $this->forge->addColumn("songs", true);
    }
}
