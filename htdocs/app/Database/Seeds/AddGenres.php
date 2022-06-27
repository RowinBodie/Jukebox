<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Addgenres extends Seeder
{
    public function run()
    {
        $data = [
            'name'  => 'Jazz'
        ];

        // Simple Queries
        $this->db->query('INSERT INTO genres (name) VALUES(:name:)', $data);
    }
}
