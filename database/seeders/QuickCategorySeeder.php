<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\QuickCategory;

class QuickCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'title' => 'For her',
                'prompt' => 'Gifts for women, female presents, items for her, women gifts, gifts for ladies, presents for women, female gifts, women products, ladies items, gifts suitable for women',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'For him',
                'prompt' => 'Gifts for men, male presents, items for him, men gifts, gifts for gentlemen, presents for men, male gifts, men products, gentlemen items, gifts suitable for men',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'For kids',
                'prompt' => 'Gifts for children, kids presents, items for kids, children gifts, gifts for boys and girls, presents for children, kids products, children items, toys for kids, gifts suitable for children',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'For colleagues',
                'prompt' => 'Gifts for colleagues, coworker presents, professional gifts, office gifts, workplace gifts, gifts for coworkers, professional presents, office items, corporate gifts, gifts suitable for colleagues',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Graduation',
                'prompt' => 'Graduation gifts, graduation presents, gifts for graduates, graduation day gifts, congratulatory gifts for graduation, graduation celebration gifts, academic achievement gifts, graduation ceremony gifts, gifts for graduating students',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Ramadan',
                'prompt' => 'Ramadan gifts, Ramadan presents, gifts for Ramadan, Ramadan Kareem gifts, Islamic gifts, gifts for Ramadan month, Ramadan celebration gifts, Iftar gifts, Ramadan special gifts, gifts suitable for Ramadan',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'Birthday',
                'prompt' => 'Birthday gifts, birthday presents, gifts for birthday, birthday celebration gifts, birthday party gifts, special birthday gifts, birthday day gifts, birthday wishes gifts, birthday surprise gifts, gifts for birthday celebration',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'title' => 'Anniversary',
                'prompt' => 'Anniversary gifts, anniversary presents, gifts for anniversary, wedding anniversary gifts, relationship anniversary gifts, anniversary celebration gifts, milestone anniversary gifts, anniversary day gifts, romantic anniversary gifts, gifts for anniversary celebration',
                'order' => 8,
                'is_active' => true,
            ],
            [
                'title' => 'Wedding',
                'prompt' => 'Wedding gifts, wedding presents, gifts for wedding, wedding day gifts, bridal gifts, wedding celebration gifts, wedding party gifts, marriage gifts, wedding ceremony gifts, gifts for newlyweds',
                'order' => 9,
                'is_active' => true,
            ],
            [
                'title' => 'New Baby',
                'prompt' => 'Baby gifts, new baby presents, gifts for newborn, baby shower gifts, gifts for new parents, baby arrival gifts, newborn baby gifts, baby celebration gifts, gifts for baby, welcome baby gifts',
                'order' => 10,
                'is_active' => true,
            ],
            [
                'title' => 'Valentine\'s Day',
                'prompt' => 'Valentine\'s Day gifts, Valentine presents, romantic gifts, gifts for Valentine\'s Day, love gifts, romantic presents, Valentine\'s Day celebration gifts, romantic day gifts, gifts for loved ones, Valentine\'s Day special gifts',
                'order' => 11,
                'is_active' => true,
            ],
            [
                'title' => 'Mother\'s Day',
                'prompt' => 'Mother\'s Day gifts, gifts for mothers, Mother\'s Day presents, gifts for mom, mother gifts, Mother\'s Day celebration gifts, gifts for mothers day, mom presents, mother appreciation gifts, gifts for mother',
                'order' => 12,
                'is_active' => true,
            ],
            [
                'title' => 'Father\'s Day',
                'prompt' => 'Father\'s Day gifts, gifts for fathers, Father\'s Day presents, gifts for dad, father gifts, Father\'s Day celebration gifts, gifts for fathers day, dad presents, father appreciation gifts, gifts for father',
                'order' => 13,
                'is_active' => true,
            ],
            [
                'title' => 'Eid',
                'prompt' => 'Eid gifts, Eid presents, gifts for Eid, Eid Mubarak gifts, Eid celebration gifts, Eid al-Fitr gifts, Eid al-Adha gifts, Islamic celebration gifts, Eid special gifts, gifts for Eid festival',
                'order' => 14,
                'is_active' => true,
            ],
            [
                'title' => 'Christmas',
                'prompt' => 'Christmas gifts, Christmas presents, gifts for Christmas, holiday gifts, Christmas celebration gifts, festive gifts, Christmas day gifts, holiday season gifts, Christmas special gifts, gifts for Christmas celebration',
                'order' => 15,
                'is_active' => true,
            ],
            [
                'title' => 'New Year',
                'prompt' => 'New Year gifts, New Year presents, gifts for New Year, New Year celebration gifts, New Year\'s Eve gifts, New Year day gifts, year end gifts, New Year special gifts, gifts for New Year celebration, New Year wishes gifts',
                'order' => 16,
                'is_active' => true,
            ],
            [
                'title' => 'Housewarming',
                'prompt' => 'Housewarming gifts, housewarming presents, gifts for new home, home gifts, new house gifts, housewarming party gifts, moving in gifts, home decoration gifts, new home celebration gifts, gifts for new homeowners',
                'order' => 17,
                'is_active' => true,
            ],
            [
                'title' => 'Thank You',
                'prompt' => 'Thank you gifts, appreciation gifts, gratitude gifts, thank you presents, appreciation presents, gifts to show gratitude, thank you tokens, appreciation tokens, gifts of thanks, thank you gesture gifts',
                'order' => 18,
                'is_active' => true,
            ],
            [
                'title' => 'Get Well Soon',
                'prompt' => 'Get well soon gifts, recovery gifts, gifts for sick person, healing gifts, get well presents, recovery presents, hospital gifts, healing wishes gifts, recovery wishes gifts, gifts for someone recovering',
                'order' => 19,
                'is_active' => true,
            ],
            [
                'title' => 'Engagement',
                'prompt' => 'Engagement gifts, engagement presents, gifts for engagement, engagement party gifts, engagement celebration gifts, engagement day gifts, engagement ring gifts, engagement special gifts, gifts for engaged couple, engagement ceremony gifts',
                'order' => 20,
                'is_active' => true,
            ],
            [
                'title' => 'Retirement',
                'prompt' => 'Retirement gifts, retirement presents, gifts for retirement, retirement celebration gifts, retirement party gifts, retirement day gifts, farewell gifts, retirement special gifts, gifts for retirees, retirement wishes gifts',
                'order' => 21,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            QuickCategory::updateOrCreate(
                ['title' => $category['title']],
                $category
            );
        }

        $this->command->info('Quick categories seeded successfully!');
    }
}
