<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KonserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->insert([
            [
                'concert_name' => 'Konser Musik The Weekend',
                'category' => 'Musik',
                'ticket_price' => 50000,
                'description' => 'Deskripsi konser musik The Weekend',
                'image' => 'konser_theweekend.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'concert_name' => 'Festival Mas Amba',
                'category' => 'Festival',
                'ticket_price' => 75000,
                'description' => 'Deskripsi festival Mas Amba',
                'image' => 'festival_masamba.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'concert_name' => 'Seminar Anti Narkoba',
                'category' => 'Seminar',
                'ticket_price' => 30000,
                'description' => 'Deskripsi seminar Anti Narkoba',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'concert_name' => 'Seminar Anti Narkoba',
                'category' => 'Seminar',
                'ticket_price' => 30000,
                'description' => 'Deskripsi seminar Anti Narkoba',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'concert_name' => 'Seminar Anti Narkoba',
                'category' => 'Seminar',
                'ticket_price' => 30000,
                'description' => 'Deskripsi seminar Anti Narkoba',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
