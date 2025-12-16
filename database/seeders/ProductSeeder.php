<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Vendor;
use App\Models\Country;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::pluck('id')->toArray();
        $brands = Brand::pluck('id')->toArray();
        $vendors = Vendor::pluck('id')->toArray();
        $countries = Country::pluck('id')->toArray();

        $products = [
            // ========== ELECTRONICS ==========
            [
                'title_en' => 'Apple iPhone 15',
                'title_ar' => 'ايفون 15',
                'description_en' => 'Apple iPhone 15 with A17 chip and 48MP camera.',
                'description_ar' => 'ايفون 15 بمعالج A17 وكاميرا 48 ميجا.',
                'price' => 1200,
                'image' => 'https://images.unsplash.com/photo-1598327105666-5b89351aff97'
            ],
            [
                'title_en' => 'Samsung Galaxy S23',
                'title_ar' => 'سامسونج جالكسي S23',
                'description_en' => 'Flagship Samsung smartphone with Dynamic AMOLED display.',
                'description_ar' => 'هاتف رائد من سامسونج بشاشة AMOLED ديناميكية.',
                'price' => 1100,
                'image' => 'https://images.unsplash.com/photo-1610945265064-0e34d47a0e5b'
            ],
            [
                'title_en' => 'Sony WH-1000XM5 Headphones',
                'title_ar' => 'سوني WH-1000XM5 سماعات',
                'description_en' => 'Premium noise-canceling over-ear headphones.',
                'description_ar' => 'سماعات رأس بعزل ضوضاء ممتازه.',
                'price' => 450,
                'image' => 'https://images.unsplash.com/photo-1518442163552-7d3b85a75a1b'
            ],
            [
                'title_en' => 'Apple Watch Series 9',
                'title_ar' => 'ساعة ابل الجيل 9',
                'description_en' => 'Smartwatch with advanced health features.',
                'description_ar' => 'ساعة ذكية بخصائص صحية متقدمة.',
                'price' => 500,
                'image' => 'https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1'
            ],
            [
                'title_en' => 'GoPro Hero 12 Black',
                'title_ar' => 'جو برو هيرو 12',
                'description_en' => 'Professional action camera with 5K recording.',
                'description_ar' => 'كاميرا اكشن احترافية بدقة 5K.',
                'price' => 600,
                'image' => 'https://images.unsplash.com/photo-1508898578281-774ac4893c0e'
            ],

            // ========== FASHION ==========
            [
                'title_en' => 'Nike Air Force 1',
                'title_ar' => 'نايك اير فورس 1',
                'description_en' => 'Classic Nike sneaker with durable build.',
                'description_ar' => 'حذاء نايك كلاسيكي بجودة عالية.',
                'price' => 180,
                'image' => 'https://images.unsplash.com/photo-1600180758890-a1d475a89f24'
            ],
            [
                'title_en' => 'Adidas Ultraboost',
                'title_ar' => 'أديداس الترا بوست',
                'description_en' => 'Premium running shoes with Boost cushioning.',
                'description_ar' => 'حذاء جري فاخر مع تقنية Boost.',
                'price' => 200,
                'image' => 'https://images.unsplash.com/photo-1606813902859-5b8eec5d4c30'
            ],
            [
                'title_en' => 'Zara Leather Jacket',
                'title_ar' => 'جاكيت جلد من زارا',
                'description_en' => 'High-quality leather jacket for men.',
                'description_ar' => 'جاكيت جلد عالي الجودة للرجال.',
                'price' => 150,
                'image' => 'https://images.unsplash.com/photo-1532298229144-0ec0c57515c7'
            ],
            [
                'title_en' => 'H&M Cotton Hoodie',
                'title_ar' => 'هودي قطني من H&M',
                'description_en' => 'Soft cotton hoodie with modern design.',
                'description_ar' => 'هودي قطني ناعم بتصميم عصري.',
                'price' => 60,
                'image' => 'https://images.unsplash.com/photo-1598032895397-5e4b72f888e8'
            ],
            [
                'title_en' => 'Puma Sport T-Shirt',
                'title_ar' => 'تيشيرت رياضي من بوما',
                'description_en' => 'Breathable sports T-shirt for daily workout.',
                'description_ar' => 'تيشيرت رياضي قابل للتهوية للتمارين.',
                'price' => 35,
                'image' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d'
            ],

            // ========== BEAUTY ==========
            [
                'title_en' => 'Dior Sauvage Perfume',
                'title_ar' => 'عطر ديور سوفاج',
                'description_en' => 'Luxury men’s perfume with long-lasting scent.',
                'description_ar' => 'عطر فاخر للرجال برائحة ثابتة.',
                'price' => 110,
                'image' => 'https://images.unsplash.com/photo-1594035910387-fe13b08d1a4b'
            ],
            [
                'title_en' => 'Chanel Coco Mademoiselle',
                'title_ar' => 'شانيل كوكو مدموزيل',
                'description_en' => 'Elegant feminine fragrance by Chanel.',
                'description_ar' => 'عطر أنثوي أنيق من شانيل.',
                'price' => 140,
                'image' => 'https://images.unsplash.com/photo-1600185365483-26f0e59101df'
            ],
            [
                'title_en' => 'The Ordinary Skincare Set',
                'title_ar' => 'طقم ذا اورديناري للعناية بالبشرة',
                'description_en' => 'Complete skincare bundle with active serums.',
                'description_ar' => 'مجموعة عناية بالبشرة بتركيبات فعالة.',
                'price' => 55,
                'image' => 'https://images.unsplash.com/photo-1601047390532-85a3b6ba96f3'
            ],
            [
                'title_en' => 'Maybelline Makeup Kit',
                'title_ar' => 'طقم مكياج ميبيلين',
                'description_en' => 'Full makeup set with foundation, lipstick, and mascara.',
                'description_ar' => 'طقم مكياج كامل يحتوي على فاونديشن و ماسكرا.',
                'price' => 45,
                'image' => 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9'
            ],
            [
                'title_en' => 'Philips Hair Dryer',
                'title_ar' => 'مجفف شعر فيليبس',
                'description_en' => 'High-power hair dryer with temperature control.',
                'description_ar' => 'مجفف شعر عالي الأداء مع تحكم بالحرارة.',
                'price' => 65,
                'image' => 'https://images.unsplash.com/photo-1620781167634-df77a3d8a8fa'
            ],

            // ========== HOME & KITCHEN ==========
            [
                'title_en' => 'Home Decor LED Lamp',
                'title_ar' => 'مصباح ديكور LED',
                'description_en' => 'Modern LED lamp perfect for home decoration.',
                'description_ar' => 'مصباح LED عصري مناسب لتزيين المنزل.',
                'price' => 40,
                'image' => 'https://images.unsplash.com/photo-1606312619070-12e08af0cc16'
            ],
            [
                'title_en' => 'Ceramic Dinnerware Set',
                'title_ar' => 'طقم سفرة سيراميك',
                'description_en' => '18-piece ceramic dining set.',
                'description_ar' => 'طقم سفرة سيراميك مكون من 18 قطعة.',
                'price' => 70,
                'image' => 'https://images.unsplash.com/photo-1615873968403-89e2fda62716'
            ],
            [
                'title_en' => 'Kitchen Knife Set',
                'title_ar' => 'طقم سكاكين مطبخ',
                'description_en' => 'Premium stainless steel kitchen knives.',
                'description_ar' => 'طقم سكاكين مطبخ ستانلس ستيل عالي الجودة.',
                'price' => 55,
                'image' => 'https://images.unsplash.com/photo-1592415486689-7ef2cbb71ae8'
            ],
            [
                'title_en' => 'Aroma Diffuser Humidifier',
                'title_ar' => 'مرطب جو مع معطر',
                'description_en' => 'Aroma diffuser with humidity control.',
                'description_ar' => 'مرطب للجو مزود بخاصية ناشر الروائح.',
                'price' => 50,
                'image' => 'https://images.unsplash.com/photo-1591781887997-93d4cb918f1a'
            ],
            [
                'title_en' => 'Luxury Throw Blanket',
                'title_ar' => 'بطانية فاخرة ناعمة',
                'description_en' => 'Soft luxury throw blanket for home comfort.',
                'description_ar' => 'بطانية ناعمة وفاخرة لراحة المنزل.',
                'price' => 85,
                'image' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85'
            ],

            // ========== SPORTS ==========
            [
                'title_en' => 'Fitness Dumbbells Set',
                'title_ar' => 'طقم دامبلز لياقة',
                'description_en' => 'Adjustable dumbbells for strength training.',
                'description_ar' => 'دامبلز قابلة للتعديل لتمارين القوة.',
                'price' => 90,
                'image' => 'https://images.unsplash.com/photo-1599058917212-d750089bc07c'
            ],
            [
                'title_en' => 'Yoga Exercise Mat',
                'title_ar' => 'حصيرة يوغا',
                'description_en' => 'Non-slip yoga mat for exercise and stretching.',
                'description_ar' => 'حصيرة يوغا مانعة للانزلاق للتمارين.',
                'price' => 30,
                'image' => 'https://images.unsplash.com/photo-1605296867304-46d5465a13f1'
            ],
            [
                'title_en' => 'Puma Training Gloves',
                'title_ar' => 'قفازات تدريب بوما',
                'description_en' => 'Padded gloves for weightlifting and workout.',
                'description_ar' => 'قفازات مبطنة لرفع الأثقال.',
                'price' => 25,
                'image' => 'https://images.unsplash.com/photo-1599058917212-d750089bc07c'
            ],
            [
                'title_en' => 'Basketball Spalding',
                'title_ar' => 'كرة سلة سبولدنغ',
                'description_en' => 'Professional indoor/outdoor basketball.',
                'description_ar' => 'كرة سلة احترافية مناسبة للمنزل والملعب.',
                'price' => 45,
                'image' => 'https://images.unsplash.com/photo-1517649763962-0c623066013b'
            ],
            [
                'title_en' => 'Nike Training Bottle',
                'title_ar' => 'زجاجة تدريب نايك',
                'description_en' => 'Sport water bottle for gym sessions.',
                'description_ar' => 'زجاجة مياه رياضية من نايك.',
                'price' => 20,
                'image' => 'https://images.unsplash.com/photo-1526403228364-5f81f2d79c52'
            ],
        ];

        // Duplicate to reach 50 items
        $products = array_merge($products, $products); // 50 items

        foreach ($products as $index => $data) {

            $externalId = "EXT_" . Str::uuid()->toString();

            Product::create([
                'external_id' => $externalId,
                'brand_id' => $brands[array_rand($brands)],
                'name_en' => $data['title_en'],
                'name_ar' => $data['title_ar'],
                'description_en' => $data['description_en'],
                'description_ar' => $data['description_ar'],
                'fingerprint' => hash("sha256", $externalId),
                'category_id' => $categories[array_rand($categories)],
                'material' => 'Mixed',
                'gender_en' => 'Unisex',
                'gender_ar' => 'للجنسين',
                'currency' => 'USD',
                'price' => $data['price'],
                'old_price' => $data['price'] + rand(10, 100),
                'qty' => rand(5, 200),
                'url' => $data['image'],
                'colors_en' => "Black, White",
                'colors_ar' => "أسود، أبيض",
                'sizes_en' => "S, M, L",
                'sizes_ar' => "صغير، متوسط، كبير",
                'vendor_id' => $vendors[array_rand($vendors)],
                'country_id' => $countries[array_rand($countries)],
                'version' => 1,
            ]);
        }
    }
}
