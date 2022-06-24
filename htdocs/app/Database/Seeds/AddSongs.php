<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AddSongs extends Seeder
{
    public function run()
    {
        $data = [
            'name'          => 'darth',
            'genre'         => '0',
            'duration'      => '',
            'lyrics'        => '',
        ];

        // Simple Queries
        $this->db->query('INSERT INTO songs (name, genre) VALUES(:name:, :genre:)', $data);
    }
}
