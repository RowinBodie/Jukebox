<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPlaylistsToDb extends Migration
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
            "userId"=>[
                "type"          =>"INT",
                "constraint"    =>11
            ]
        ]);
        $this->forge->addPrimaryKey("id");
        $this->forge->createTable("playlists");
    }

    public function down()
    {
        $this->forge->dropTable("playlists");
    }
}
