<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPlaylistSongsToDb extends Migration
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
            "songId"=>[
                "type"          =>"INT",
                "constraint"    =>11
            ],
            "playlistId"=>[
                "type"          =>"INT",
                "constraint"    =>11
            ]
        ]);
        $this->forge->addPrimaryKey("id");
        $this->forge->createTable("playlistSongs");
    }

    public function down()
    {
        $this->forge->dropTable("playlistSongs");
    }
}
