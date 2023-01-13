<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Addgenres extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'  => 'Pop'
            ],
            [
                'name'  => 'Rock'
            ],
            [
                'name'  => 'Country'
            ],
            [
                'name'  => 'Hip-Hop'
            ],
            [
                'name'  => 'Jazz'
            ],
            
        ];

        foreach($data as $item){
            $name = $item['name'];

            $this->db->query("INSERT INTO genres (name) VALUES ('$name')");
        }
    }
}
