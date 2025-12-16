<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OccasionName;

class OccasionNamesTableSeeder extends Seeder
{
    public function run(): void
    {
        $occasions = [
            [
                'name' => 'Birthday',
                'description' => 'Celebration of birth date.',
                'background_color' => '#C42424',
                'title_color' => '#FFFFFF',
                'image_background' => 'occasions/1.png',
                'is_recommend' => false,
                'date' => null,
            ],
            [
                'name' => 'Graduation',
                'description' => 'Celebration of finishing school or university.',
                'background_color' => '#1F9854',
                'title_color' => '#FFFFFF',
                'image_background' => 'occasions/2.png',
                'is_recommend' => false,
                'date' => null,
            ],
            [
                'name' => 'Wedding',
                'description' => 'Celebration of marriage ceremony.',
                'background_color' => '#F9B900',
                'title_color' => '#000000',
                'image_background' => 'occasions/3.png',
                'is_recommend' => false,
                'date' => null,
            ],
            [
                'name' => 'Engagement',
                'description' => 'Celebration of engagement or proposal.',
                'background_color' => '#E91E63',
                'title_color' => '#FFFFFF',
                'image_background' => 'occasions/4.png',
                'is_recommend' => false,
                'date' => null,
            ],
            [
                'name' => 'Eid',
                'description' => 'Celebration of Eid holiday.',
                'background_color' => '#1F9854',
                'title_color' => '#FFFFFF',
                'image_background' => 'occasions/5.png',
                'is_recommend' => true,
                'date' => '2025-04-10',
            ],
            [
                'name' => 'Ramadan',
                'description' => 'Celebration during Ramadan.',
                'background_color' => '#0F5132',
                'title_color' => '#FFFFFF',
                'image_background' => 'occasions/6.png',
                'is_recommend' => true,
                'date' => '2025-03-01',
            ],
            [
                'name' => 'Christmas',
                'description' => 'Celebration of Christmas holiday.',
                'background_color' => '#C42424',
                'title_color' => '#FFFFFF',
                'image_background' => 'occasions/7.png',
                'is_recommend' => true,
                'date' => '2025-12-25',
            ],
            [
                'name' => 'New Year',
                'description' => 'Celebration of the new year.',
                'background_color' => '#1E1E2F',
                'title_color' => '#FFFFFF',
                'image_background' => 'occasions/8.png',
                'is_recommend' => true,
                'date' => '2026-01-01',
            ],
            [
                'name' => 'Mother\'s Day',
                'description' => 'Celebration to honor mothers.',
                'background_color' => '#E91E63',
                'title_color' => '#FFFFFF',
                'image_background' => 'occasions/9.png',
                'is_recommend' => true,
                'date' => '2025-03-21',
            ],
            [
                'name' => 'Father\'s Day',
                'description' => 'Celebration to honor fathers.',
                'background_color' => '#2196F3',
                'title_color' => '#FFFFFF',
                'image_background' => 'occasions/10.png',
                'is_recommend' => true,
                'date' => '2025-06-21',
            ],
            [
                'name' => 'Congratulations',
                'description' => 'General congratulations for any achievement.',
                'background_color' => '#4CAF50',
                'title_color' => '#FFFFFF',
                'image_background' => 'occasions/11.png',
                'is_recommend' => false,
                'date' => null,
            ],
            [
                'name' => 'Thank You',
                'description' => 'Expressing gratitude and appreciation.',
                'background_color' => '#FFC107',
                'title_color' => '#000000',
                'image_background' => 'occasions/12.png',
                'is_recommend' => false,
                'date' => null,
            ],
            [
                'name' => 'Get Well Soon',
                'description' => 'Wishing someone a speedy recovery.',
                'background_color' => '#FF9800',
                'title_color' => '#000000',
                'image_background' => 'occasions/13.png',
                'is_recommend' => false,
                'date' => null,
            ],
            [
                'name' => 'Housewarming',
                'description' => 'Celebration for moving into a new home.',
                'background_color' => '#795548',
                'title_color' => '#FFFFFF',
                'image_background' => 'occasions/14.png',
                'is_recommend' => false,
                'date' => null,
            ],
            [
                'name' => 'Farewell',
                'description' => 'Saying goodbye or farewell.',
                'background_color' => '#9C27B0',
                'title_color' => '#FFFFFF',
                'image_background' => 'occasions/15.png',
                'is_recommend' => false,
                'date' => null,
            ],
            [
                'name' => 'Sympathy',
                'description' => 'Expressing sympathy and condolences.',
                'background_color' => '#424242',
                'title_color' => '#FFFFFF',
                'image_background' => 'occasions/16.png',
                'is_recommend' => false,
                'date' => null,
            ],
        ];

        foreach ($occasions as $occasion) {
            OccasionName::create($occasion);
        }
    }
}
