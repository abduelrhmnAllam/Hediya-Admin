<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RelativesTableSeeder extends Seeder
{
    public function run(): void
    {
$relatives = [
    ['title' => 'Father',        'image' => 'relatives/1.png', 'gender' => 'male'],
    ['title' => 'Mother',        'image' => 'relatives/2.png', 'gender' => 'female'],
    ['title' => 'Brother',       'image' => 'relatives/3.png', 'gender' => 'male'],
    ['title' => 'Sister',        'image' => 'relatives/4.png', 'gender' => 'female'],
    ['title' => 'Grandfather',   'image' => 'relatives/6.png', 'gender' => 'male'],
    ['title' => 'Grandmother',   'image' => 'relatives/7.png', 'gender' => 'female'],
    ['title' => 'Son',           'image' => 'relatives/8.png', 'gender' => 'male'],
    ['title' => 'Daughter',      'image' => 'relatives/9.png', 'gender' => 'female'],
    ['title' => 'Uncle',         'image' => 'relatives/10.png', 'gender' => 'male'],
    ['title' => 'Aunt',          'image' => 'relatives/11.png', 'gender' => 'female'],
    ['title' => 'Wife',          'image' => 'relatives/12.png', 'gender' => 'female'],
    ['title' => 'Husband',       'image' => 'relatives/13.png', 'gender' => 'male'],

];



        foreach ($relatives as $relative) {
            DB::table('relatives')->insert([
                'title'      => $relative['title'],
                'image'      => $relative['image'],
                  'gender'      => $relative['gender'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
