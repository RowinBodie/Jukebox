<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUsers extends Migration
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
                "constraint"    =>150
            ],
            "email"=>[
                "type"          =>"VARCHAR",
                "constraint"    =>150
            ],
            "password"=>[
                "type"          =>"VARCHAR",
                "constraint"    =>150
            ]
        ]);
        $this->forge->addPrimaryKey("id");
        $this->forge->createTable("users");
    }

    public function down()
    {
        $this->forge->dropTable("users");
    }
}
