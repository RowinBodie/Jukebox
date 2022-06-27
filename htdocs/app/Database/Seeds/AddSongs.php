<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AddSongs extends Seeder
{
    public function run()
    {
        $data = [
            'name'          => 'Worlds blowing facts',
            'genre'         => '6',
            'duration'      => '190',
            'lyrics'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nec nunc felis. Quisque non massa ac ex efficitur dapibus id imperdiet leo. Cras commodo, eros nec elementum.',
        ];

        // Simple Queries
        $this->db->query('INSERT INTO songs (name, genre, duration, lyrics) VALUES(:name:, :genre:, :duration:, :lyrics:)', $data);
    }
}
