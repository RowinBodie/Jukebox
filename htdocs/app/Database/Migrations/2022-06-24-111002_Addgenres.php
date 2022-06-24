<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Addgenres extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id"=>[
                "type"          =>"INT",
                "constraint"    =>11,
                "unsigned"      =>true,
                "auto_increment"=>true
            ],
            "name"=>[
                "type"          =>"VARCHAR",
                "constraint"    =>255
            ],
            "lyrics"=>[
                "type"          =>"TEXT"
            ],
            "genre"=>[
                "type"          =>"INT",
                "constraint"    =>11
            ]
        ]);
        $this->forge->addPrimaryKey("id");
        $this->forge->createTable("songs");
    }

    public function down()
    {
        $this->forge->dropTable("songs");
    }
}
