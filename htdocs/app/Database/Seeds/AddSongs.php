<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AddSongs extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => "Worlds blowing facts",
                'duration' => "190",
                'lyrics' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nec nunc felis. Quisque non massa ac ex efficitur dapibus id imperdiet leo. Cras commodo, eros nec elementum.",
                'genre' => "1",
                'artist' => "Creeper",
            ],
            [
                'name' => "Life in Rock n roll",
                'duration' => "201",
                'lyrics' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nec nunc felis. Quisque non massa ac ex efficitur dapibus id imperdiet leo. Cras commodo, eros nec elementum.",
                'genre' => "1",
                'artist' => "Zombie",
            ],
            [
                'name' => "Flexing on skylights",
                'duration' => "223",
                'lyrics' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nec nunc felis. Quisque non massa ac ex efficitur dapibus id imperdiet leo. Cras commodo, eros nec elementum.",
                'genre' => "2",
                'artist' => "Villager",
            ],
            [
                'name' => "Living a nightmare",
                'duration' => "178",
                'lyrics' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nec nunc felis. Quisque non massa ac ex efficitur dapibus id imperdiet leo. Cras commodo, eros nec elementum.",
                'genre' => "3",
                'artist' => "Sheep",
            ],
            [
                'name' => "Living a dream",
                'duration' => "192",
                'lyrics' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nec nunc felis. Quisque non massa ac ex efficitur dapibus id imperdiet leo. Cras commodo, eros nec elementum.",
                'genre' => "3",
                'artist' => "Pillager",
            ],
            [
                'name' => "Blocky road",
                'duration' => "183",
                'lyrics' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nec nunc felis. Quisque non massa ac ex efficitur dapibus id imperdiet leo. Cras commodo, eros nec elementum.",
                'genre' => "4",
                'artist' => "Ghast",
            ],
            [
                'name' => "Worlds blowing facts",
                'duration' => "197",
                'lyrics' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nec nunc felis. Quisque non massa ac ex efficitur dapibus id imperdiet leo. Cras commodo, eros nec elementum.",
                'genre' => "5",
                'artist' => "Glow Squid",
            ],
            [
                'name' => "Man eating worlds",
                'duration' => "214",
                'lyrics' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nec nunc felis. Quisque non massa ac ex efficitur dapibus id imperdiet leo. Cras commodo, eros nec elementum.",
                'genre' => "5",
                'artist' => "Zombiepigman",
            ],
            [
                'name' => "living the last minute",
                'duration' => "199",
                'lyrics' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nec nunc felis. Quisque non massa ac ex efficitur dapibus id imperdiet leo. Cras commodo, eros nec elementum.",
                'genre' => "2",
                'artist' => "Enderman",
            ],
            [
                'name' => "Fear my life",
                'duration' => "231",
                'lyrics' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nec nunc felis. Quisque non massa ac ex efficitur dapibus id imperdiet leo. Cras commodo, eros nec elementum.",
                'genre' => "1",
                'artist' => "Baby zombie villager with a potato in his hand",
            ],
        ];

        foreach($data as $item){
            $name = $item['name'];            
            $lyrics = $item['lyrics'];
            $genre = $item['genre'];
            $duration = $item['duration'];
            $artist = $item['artist'];

            $this->db->query("INSERT INTO songs (name,lyrics,genre,duration,artist) VALUES ('$name',  '$lyrics', '$genre', '$duration', '$artist')");
        }
    }
}
