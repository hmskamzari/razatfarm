<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class CmsSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedSiteSettings();
        $this->seedHomePage();
        $this->seedAboutPage();
        $this->seedContactPage();
        $this->seedVisitTermsPage();
    }

    private function seedSiteSettings(): void
    {
        $setting = SiteSetting::current();
        $setting->update([
            'phone_primary' => '+968 23373010',
            'phone_secondary' => '+968 23373093',
            'phone_tertiary' => '+968 23373094',
            'email' => 'booking@razatfarm.gov.om',
            'address' => [
                'en' => "Razat Farm, Floor 2\nSalalah, Dhofar Governorate",
                'ar' => "الطابق 2، مزرعة رزات\nصلالة، محافظة ظفار",
            ],
            'visit_hours' => [
                'en' => 'Sun – Thu, 10:00 AM – 5:00 PM',
                'ar' => 'الأحد - الخميس، 10:00 صباحاً - 05:00 مساءً',
            ],
            'support_hours' => [
                'en' => 'Daily, 7:00 AM – 9:00 PM',
                'ar' => 'يومياً، 7:00 صباحاً - 9:00 مساءً',
            ],
            'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d9339.362497707381!2d54.21077012897704!3d17.036759292030787!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2som!4v1755066479747!5m2!1sen!2som',
            'social_links' => [],
            'footer_copyright' => [
                'en' => '© ' . date('Y') . ' Razat Royal Farm. All Rights Reserved. Powered by RCA.',
                'ar' => '© ' . date('Y') . ' مزرعة رزات السلطانية. جميع الحقوق محفوظة. مدعوم من شؤون البلاط السلطاني.',
            ],
        ]);
    }

    private function seedHomePage(): void
    {
        $page = Page::updateOrCreate(
            ['slug' => 'home'],
            [
                'title' => ['en' => 'Home', 'ar' => 'الرئيسية'],
                'meta_description' => [
                    'en' => 'Razat Royal Farm Trail — a journey into the heart of nature in Dhofar, Oman.',
                    'ar' => 'مسار مزرعة رزات السلطانية - رحلة تأخذك في قلب الطبيعة لتكتشف تنوّع المحاصيل وجمال ظفار.',
                ],
                'is_published' => true,
            ]
        );
        $page->sections()->delete();

        $heroSlider = $page->sections()->create([
            'type' => 'hero_slider',
            'sort_order' => 1,
        ]);
        $heroSlider->items()->createMany([
            [
                'image' => 'cms/home/header-1.jpg',
                'heading' => ['en' => 'Razat Royal Farm', 'ar' => 'مزرعة رزات السلطانية'],
                'body' => [
                    'en' => "A journey in which you discover the beauty of Dhofar's nature.",
                    'ar' => 'رحلة تأخذك في قلب الطبيعة، لتكتشف تنوّع المحاصيل وجمال ظفار.',
                ],
                'link_url' => '/events',
                'link_label' => ['en' => 'Book Now', 'ar' => 'اكتشف المزيد'],
                'sort_order' => 1,
            ],
            [
                'image' => 'cms/home/banana-farm.jpg',
                'heading' => ['en' => 'Unique agricultural diversity', 'ar' => 'تنوّع زراعي فريد'],
                'body' => [
                    'en' => 'From bananas and coconut to rare fruits and fresh vegetables.',
                    'ar' => 'من الموز والنارجيل إلى الفواكه النادرة والخضروات الطازجة.',
                ],
                'link_url' => '/events',
                'link_label' => ['en' => 'Book Now', 'ar' => 'استكشف المحاصيل'],
                'sort_order' => 2,
            ],
            [
                'image' => 'cms/home/razat-farm.jpg',
                'heading' => ['en' => 'An unforgettable experience', 'ar' => 'تجربة لا تُنسى'],
                'body' => [
                    'en' => 'Touristic and guided tours among fields, trees, and agricultural landmarks.',
                    'ar' => 'جولات سياحية وإرشادية وسط الحقول والأشجار والمعالم الزراعية.',
                ],
                'link_url' => '/events',
                'link_label' => ['en' => 'Book Now', 'ar' => 'خطط لزيارتك'],
                'sort_order' => 3,
            ],
        ]);

        $iconFeatures = $page->sections()->create([
            'type' => 'icon_features',
            'sort_order' => 2,
        ]);
        $iconFeatures->items()->createMany([
            [
                'image' => 'cms/shared/plant.png',
                'heading' => ['en' => 'Daily', 'ar' => 'زيارات'],
                'body' => ['en' => 'Visits', 'ar' => 'يومية'],
                'sort_order' => 1,
            ],
            [
                'image' => 'cms/shared/chip.png',
                'heading' => ['en' => 'Fresh Plants', 'ar' => 'نباتات مختلفة'],
                'body' => ['en' => 'Fresh fruits and vegetables', 'ar' => 'فواكه وخضراوات طازجة'],
                'sort_order' => 2,
            ],
            [
                'image' => 'cms/shared/horse.png',
                'heading' => ['en' => 'Horse Riding', 'ar' => 'ركوب الخيل'],
                'body' => ['en' => 'and carriage rides', 'ar' => 'والعربات'],
                'sort_order' => 3,
            ],
            [
                'image' => 'cms/shared/tickets.png',
                'heading' => ['en' => 'An Educational Experience', 'ar' => 'تجربة تعليمية'],
                'body' => ['en' => 'and interactive activities', 'ar' => 'وأنشطة تفاعلية'],
                'sort_order' => 4,
            ],
        ]);

        $page->sections()->create([
            'type' => 'content_block',
            'heading' => ['en' => 'Veterinary Clinic', 'ar' => 'العيادة البيطرية'],
            'body' => [
                'en' => 'The veterinary clinic at Razat Royal Farm provides the necessary medical care for various animals on the farm, such as the Arabian oryx and Arabian horses, and unique bird species like the weaver bird — well known in Dhofar Governorate — the ring-necked parakeet, the peacock, and several other animals and birds. The clinic is run by specialized Omani veterinary staff.',
                'ar' => 'توفر العيادة البيطرية بمزرعة رزات السلطانية العناية الطبية اللازمة لأنواع متعددة من الحيوانات في المزرعة كالمها العربي والخيول العربية، وأنواع فريدة من الطيور كطائر الحبّاك الذي تشتهر به محافظة ظفار، وببغاء براكيت المطوق، والطاووس، وعدد من الحيوانات والطيور الأخرى، وتضمّ العيادة كفاءات عمانية متخصصة في الطب البيطري.',
            ],
            'image' => 'cms/home/untitled-design-6.jpg',
            'sort_order' => 3,
        ]);

        $page->sections()->create([
            'type' => 'content_block',
            'heading' => ['en' => 'Sales Outlet', 'ar' => 'منفذ البيع'],
            'body' => [
                'en' => "The outlet is located on Sultan Qaboos Street, near the Farm's main gate, and opens on official working-day mornings. All vegetables and fruits harvested from the farm arrive at the outlet after being sorted and prepared for sale.",
                'ar' => 'يمتاز منفذ البيع بموقعه على شارع السلطان قابوس بالقرب من البوابة الرئيسية للمزرعة، ويفتح أبوابه صباح أيام العمل الرسمية، حيث تصل إلى المنفذ جميع الخضروات والفواكه التي يتم حصادها من المزرعة بعد فرزها وتهيئتها للبيع.',
            ],
            'image' => 'cms/home/untitled-design-2.png',
            'sort_order' => 4,
        ]);

        $page->sections()->create([
            'type' => 'content_block',
            'heading' => [
                'en' => 'His Majesty Sultan Haitham bin Tarik',
                'ar' => 'حضرة صاحب الجلالة السلطان هيثم بن طارق آل سعيد - حفظه الله ورعاه',
            ],
            'body' => [
                'en' => "Opening Razat Royal Farm Trail comes per the royal orders of His Majesty Sultan Haitham bin Tarik, may Allah protect him, to be a destination where visitors can learn about its distinctive fields and agricultural areas, tropical and perennial trees, and the diverse crops it holds — including fruits, vegetables, dairy products and their derivatives, and other products.\n\nVisitors will tour the farm aboard specially designed display buses, accompanied by tour guides throughout their visit.\n\nThe Gardens and Farms division of the Royal Court Affairs has worked diligently to prepare this tourist trail, ensuring visitors enjoy a captivating experience as they explore the farm.",
                'ar' => "يأتي افتتاح مسار مزرعة رزات السلطانية السياحي بأوامر سامية من لدن حضرة صاحب الجلالة السلطان هيثم بن طارق المعظّم – حفظه الله ورعاه - لتكون مزارًا يطّلع فيها الزوّار على ما تمتاز به من حقول ومساحات زراعية، وأشجار استوائية، وأخرى معمّرة، إضافة إلى المحاصيل المتنوعة التي تزخر بها، بما فيها الفواكه والخضروات ومنتجات الألبان ومشتقاتها وغيرها من المنتجات.\n\nوسيكون الزوّار في جولةٍ في حافلات مخصصة بتقنيات العرض، إضافة إلى الإرشاد السياحي الذي سيصطحب الزوّار خلال جولتهم بالمزرعة.\n\nوحرصت الحدائق والمزارع السلطانية بشؤون البلاط السلطاني على تجهيز المسار السياحي ليكون تجربة شائقة يحظى بها الزائر أثناء التجوّل بين جنبات المزرعة.",
            ],
            'image' => 'cms/home/his-majesty.webp',
            'sort_order' => 5,
        ]);

        $highlights = $page->sections()->create([
            'type' => 'card_grid',
            'heading' => [
                'en' => 'Razat Farm offers a memorable farm visit experience for all ages',
                'ar' => 'تقدم مزرعة رزات تجربة فريدة لا تُنسى',
            ],
            'sort_order' => 6,
        ]);
        $highlights->items()->createMany([
            [
                'heading' => ['en' => 'Guided Farm Tours', 'ar' => 'جولات المزارع الإرشادية'],
                'body' => [
                    'en' => 'Walk through banana fields, learn about the unique Razat Banana, and discover how we grow fresh produce.',
                    'ar' => 'تجول في مزارع الموز وتعرف على موز رزات الفريد من نوعه واكتشف كيف نزرع المنتجات الطازجة.',
                ],
                'sort_order' => 1,
            ],
            [
                'heading' => ['en' => 'Easy Booking', 'ar' => 'سهولة الحجز'],
                'body' => [
                    'en' => 'Reserve your preferred time slot — morning or afternoon — with just a few clicks. No hassle, no long queues.',
                    'ar' => 'احجز وقتك المفضل - صباحاً أو بعد الظهر - ببضع نقرات فقط. لا متاعب ولا طوابير طويلة.',
                ],
                'sort_order' => 2,
            ],
            [
                'heading' => ['en' => 'Nature & Relaxation', 'ar' => 'الطبيعة والاسترخاء'],
                'body' => [
                    'en' => 'Enjoy fresh air, green scenery, and peaceful moments — perfect for families, tourists, and nature lovers alike.',
                    'ar' => 'استمتع بالهواء النقي والمناظر الطبيعية الخضراء واللحظات الهادئة - وهي مثالية للعائلات والسائحين ومحبي الطبيعة على حد سواء.',
                ],
                'sort_order' => 3,
            ],
        ]);

        $page->sections()->create([
            'type' => 'content_block',
            'heading' => ['en' => 'Fruit Crops', 'ar' => 'محاصيل الفاكهة'],
            'body' => [
                'en' => 'The farm is rich with a wide variety of trees. Banana trees top the list of the most cultivated, followed by coconut and papaya trees, then fig, grape, soursop (cherimoya), and other fruit trees.',
                'ar' => 'تزخر المزرعة بمختلف أنواع الأشجار، وتتصدر قائمة الأشجار الأكثر زراعة أشجار الموز ثم أشجار النارجيل ثم أشجار الفافاي، يليها التين والعنب والمستعفل وغيرها من الفواكه.',
            ],
            'image' => 'cms/about/about-rrf.jpg',
            'sort_order' => 7,
        ]);

        $page->sections()->create([
            'type' => 'cta',
            'heading' => ['en' => 'Plan your visit today', 'ar' => 'خطط لزيارتك اليوم'],
            'body' => [
                'en' => 'Book your tickets online and discover Razat Royal Farm Trail for yourself.',
                'ar' => 'احجز تذاكرك عبر الإنترنت واكتشف مسار مزرعة رزات السلطانية بنفسك.',
            ],
            'sort_order' => 8,
        ])->items()->create([
            'link_url' => '/events',
            'link_label' => ['en' => 'Book Now', 'ar' => 'احجز الآن'],
            'sort_order' => 1,
        ]);
    }

    private function seedAboutPage(): void
    {
        $page = Page::updateOrCreate(
            ['slug' => 'about'],
            [
                'title' => ['en' => 'About Us', 'ar' => 'نبذة عنا'],
                'meta_description' => [
                    'en' => 'Learn about Razat Royal Farm, its history, and its diverse crops in Salalah, Dhofar.',
                    'ar' => 'تعرف على مزرعة رزات السلطانية وتاريخها ومحاصيلها المتنوعة في صلالة، ظفار.',
                ],
                'is_published' => true,
            ]
        );
        $page->sections()->delete();

        $page->sections()->create([
            'type' => 'intro',
            'heading' => ['en' => 'Royal Razat Farm', 'ar' => 'مزرعة رزات السلطانية هي المكان المثالي لأولئك الذين يريدون اكتشاف الزراعة الحديثة'],
            'body' => [
                'en' => "The farm is located on the eastern side of the Wilayat of Salalah in the Dhofar Governorate, along Sultan Qaboos Street. It is one of the sites affiliated with the Royal Court Affairs. The farm covers an area of 1,085 acres, of which 900 acres are cultivated.\n\nAmong the farm's assets is an agricultural tractor dating back to the reign of Sultan Said bin Taimur — may Allah rest his soul — during the 1950s. It stands as an iconic piece of significance, reflecting the farm's history.",
                'ar' => 'تقع المزرعة في الجانب الشرقي من ولاية صلالة بمحافظة ظفار على شارع السلطان قابوس، وهي إحدى المواقع التابعة لشؤون البلاط السلطاني، وتبلغ مساحتها ألفًا وخمسةً وثمانين فداناً، وتبلغ المساحة المزروعة منها ٩٠٠ فداناً. يوجد ضمن أصول المزرعة جرار زراعي تاريخي يعود إلى فترة حكم السلطان سعيد بن تيمور ــ طيب الله ثراه ــ خلال خمسينيات القرن الماضي، ويمثل أيقونة ذات أهمية تعكس تاريخ المزرعة.',
            ],
            'image' => 'cms/about/slider_1.jpg',
            'sort_order' => 1,
        ]);

        $stats = $page->sections()->create([
            'type' => 'stats',
            'sort_order' => 2,
        ]);
        $stats->items()->createMany([
            ['value' => '1,085', 'heading' => ['en' => 'Total Farm Area (acres)', 'ar' => 'إجمالي مساحة المزرعة (فدان)'], 'sort_order' => 1],
            ['value' => '900', 'heading' => ['en' => 'Cultivated Area (acres)', 'ar' => 'المساحة المزروعة (فدان)'], 'sort_order' => 2],
            ['value' => '16,000+', 'heading' => ['en' => 'Coconut Trees', 'ar' => 'أشجار النارجيل'], 'sort_order' => 3],
            ['value' => '50', 'heading' => ['en' => 'Tons of Turmeric / Year', 'ar' => 'طن من الكركم سنوياً'], 'sort_order' => 4],
        ]);

        $trees = $page->sections()->create([
            'type' => 'card_grid',
            'heading' => ['en' => 'The Most Common Trees', 'ar' => 'أكثر الأشجار انتشاراً'],
            'body' => [
                'en' => 'The farm is rich with a variety of trees, with banana trees topping the list of the most cultivated, followed by coconut trees and papaya trees, then fig, grape, soursop, and other fruit trees.',
                'ar' => 'تزخر المزرعة بمختلف أنواع الأشجار، وتتصدر قائمة الأشجار الأكثر زراعة أشجار الموز ثم أشجار النارجيل ثم أشجار الفافاي، يليها التين والعنب والمستعفل وغيرها من الفواكه.',
            ],
            'sort_order' => 3,
        ]);
        $trees->items()->createMany([
            [
                'image' => 'cms/about/banana-farm.jpg',
                'heading' => ['en' => 'Banana', 'ar' => 'الموز'],
                'body' => [
                    'en' => 'Banana occupies a large area of the Farm and is considered one of the main crops of significant production value. The "Williams" variety ranks first among the cultivated types, covering the largest share, followed by the "Razat" variety, in addition to other types such as "Clichuto" and "Dwarf Cavendish."',
                    'ar' => 'يشغلُ محصول الموز مساحة كبيرة من المزرعة، ويُعدّ من المحاصيل الأساسية ذات الأهمية الإنتاجية، ويأتي صنف "موز ويليامز" في مقدمة الأصناف المزروعة، ويُغطي النسبة الأكبر، ثم يليه موز رزات، بالإضافة إلى أصناف أخرى مثل "كليكوتو" و"كافندش المقزم".',
                ],
                'sort_order' => 1,
            ],
            [
                'heading' => ['en' => 'Coconut', 'ar' => 'النارجيل'],
                'body' => [
                    'en' => 'Coconut is one of the most abundant tropical fruit crops on the farm, with more than 16,000 coconut trees of varying ages.',
                    'ar' => 'يعد محصول النارجيل من أكثر محاصيل الفاكهة الاستوائية وجودًا في المزرعة، حيث تبلغ أعداد أشجار النارجيل أكثر من 16 ألف شجرة متفاوتة الأعمار.',
                ],
                'sort_order' => 2,
            ],
            [
                'heading' => ['en' => 'Papaya', 'ar' => 'الفافاي'],
                'body' => [
                    'en' => 'Papaya is one of the most important tropical fruit crops on the farm, with the most prominent variety being the local type, known for its delicious taste.',
                    'ar' => 'يعد الفافاي واحدًا من أهم محاصيل الفاكهة الاستوائية في المزرعة، وأبرز أصنافه المزروعة هو الصنف المحلي الذي يتميّز بمذاقه اللذيذ.',
                ],
                'sort_order' => 3,
            ],
        ]);

        $crops = $page->sections()->create([
            'type' => 'card_grid',
            'heading' => ['en' => 'Various Crops', 'ar' => 'محاصيل متنوعة'],
            'body' => [
                'en' => 'The Farm produces many types of fruit, including breadfruit, avocados, sapodilla, rose apples (Java apples), as well as melons and watermelons. Here are some of the most notable fruits grown at Razat Royal Farm:',
                'ar' => 'تنتج المزرعة أنواعًا كثيرة من الفاكهة منها فاكهة الخبز، والأفوكادو، والسابوتا، وتفاح الورد (تفاح جاوا)، إضافة إلى الشمام والبطيخ، ونستعرض عددًا من أبرز الفواكه بمزرعة رزات السلطانية:',
            ],
            'sort_order' => 4,
        ]);
        $crops->items()->createMany([
            [
                'heading' => ['en' => 'Grape', 'ar' => 'العنب'],
                'body' => [
                    'en' => 'The farm has expanded the cultivation of commercial grapevines due to their high economic value and abundant yield. These vines are grafted onto local grape rootstocks known for their strong resilience and adaptability to the surrounding environmental conditions.',
                    'ar' => 'توسعت المزرعة في زراعة أشجار العنب التجارية، نظرًا لقيمتها الاقتصادية العالية وإنتاجها الوفير، ويتم تطعيم هذه الأشجار على أصول من أشجار العنب المحلية المعروفة بقدرتها الكبيرة على التحمّل والتكيف مع الظروف البيئية المحيطة.',
                ],
                'sort_order' => 1,
            ],
            [
                'heading' => ['en' => 'Fig', 'ar' => 'التين'],
                'body' => [
                    'en' => 'The local red fig is one of the important crops on the farm. A local variety has been adopted for its ability to adapt to environmental conditions, its abundant yield, and the large size of its fruits, making it the foundation for propagation processes within the farm.',
                    'ar' => 'يُعد التين الأحمر المحلي من المحاصيل ذات الأهمية في المزرعة، إذ تم اعتماد صنف محلي يتميز بقدرته على التكيف مع الظروف البيئية، ويتمتع بغزارة في الإنتاج وكبر في حجم الثمار، ليكون الأساس في عمليات الإكثار داخل المزرعة.',
                ],
                'sort_order' => 2,
            ],
            [
                'heading' => ['en' => 'Cherimoya (Soursop)', 'ar' => 'المستعفل'],
                'body' => [
                    'en' => 'Cherimoya is a tropical fruit known for its delicious taste and high quality. The local white variety is well adapted to the Salalah environment and capable of producing fruit under its climatic conditions. It is considered a high-value crop, cultivated to enhance agricultural diversity and achieve profitable yields.',
                    'ar' => 'المستعفل من الفواكه الاستوائية ذات الطعم اللذيذ والجودة العالية، وهو صنف أبيض محلي يُعرف بتأقلمه الجيد مع بيئة صلالة وقدرته على الإنتاج تحت ظروفها المناخية. ويعدّ من الأصناف ذات الجدوى الاقتصادية العالية، حيث يُزرع بهدف تعزيز التنوع الزراعي وتحقيق عوائد إنتاجية مجدية.',
                ],
                'sort_order' => 3,
            ],
            [
                'heading' => ['en' => 'Omani Lemons', 'ar' => 'الليمون العُماني'],
                'body' => [
                    'en' => 'Omani lemons receive special attention on the farm due to their agricultural value and high productivity under local environmental conditions. The farm focuses on propagating and preserving this variety, which is distinguished by its abundant yield and quality.',
                    'ar' => 'يحظى الليمون العُماني في المزرعة باهتمام خاص، نظراً لقيمته الزراعية وقدرته العالية على الإنتاج تحت الظروف البيئية المحلية، وتعمل المزرعة على إكثار هذا الصنف والمحافظة عليه لما يتميز به من وفرة الإنتاج وجودته.',
                ],
                'sort_order' => 4,
            ],
        ]);

        $page->sections()->create([
            'type' => 'content_block',
            'heading' => ['en' => 'Medicinal and Aromatic Plants', 'ar' => 'نباتات طبية وعطرية'],
            'body' => [
                'en' => "The farm is dedicated to cultivating various types of medicinal and aromatic plants known for their medicinal uses, pleasant fragrances, and the potential to extract oils from some of them. These include ginger, black seed (Nigella sativa), chia, sesame, flax, mustard, basil, and several local plants such as Qamroot and Mahleb Shihri.\n\nTurmeric: Among these plants, turmeric stands out as a crop receiving special care at the Royal Razat Farm. It is an organic crop, with an annual production of around 50 tons. Turmeric cultivation at the farm began in 2017, following several trials conducted by the farm's specialists to achieve a high-quality and abundant yield. Its production undergoes processing at a dedicated facility — the first specialized turmeric production plant in the Sultanate of Oman.\n\nOver the years, the farm has expanded its turmeric cultivation and has become a pioneer in this field. It has also contributed to supporting farmers in Dhofar Governorate to cultivate turmeric, in coordination with the Ministry of Agriculture, Fisheries Wealth and Water Resources.",
                'ar' => "تهتم المزرعة بزراعة أنواع مختلفة من النباتات الطبية والعطرية التي تُعرف باستخداماتها الطبية، وروائحها العطرية، وإمكانية استخراج الزيوت من بعضها، ومن هذه النباتات الزنجبيل، وحبة البركة، ونبات الشيا، والسمسم، والكتّان، والخردل، والريحان، وعدد من النباتات المحلية كنباتي (قمروت) و(محلب شحري).\n\nالكركم: إلى جانب هذه النباتات يبرز محصول الكركم الذي يلقى رعاية خاصة بمزرعة رزات السلطانية، فهو محصول عضوي تنتجه بما يقارب ٥٠ طنًّا سنويًا، وبدأت زراعته بالمزرعة منذ عام 2017م، وذلك بعد عدة تجارب أجراها المختصون بالمزرعة للحصول على محصول وفير يتّسم بالجودة العالية، حيث يخضع إنتاجه لعمليات معالجة بالمعمل المخصص لذلك، والذي يعد أول معمل متخصص لإنتاج الكركم بسلطنة عُمان.\n\nوتوسعت المزرعة في زراعة الكركم مع مرور الأعوام، وتعتبر المزرعة رائدة في هذا الجانب، كما أسهمت في دعم المزارعين نحو زراعة الكركم بمحافظة ظفار وذلك بالتنسيق مع وزارة الثروة الزراعية والسمكية وموارد المياه.",
            ],
            'image' => 'cms/about/topic876482.jpg',
            'sort_order' => 5,
        ]);

        $page->sections()->create([
            'type' => 'cta',
            'heading' => ['en' => 'Ready to explore Razat Farm?', 'ar' => 'هل أنت مستعد لاستكشاف مزرعة رزات؟'],
            'sort_order' => 6,
        ])->items()->create([
            'link_url' => '/events',
            'link_label' => ['en' => 'Go To Book Ticket', 'ar' => 'احجز الآن'],
            'sort_order' => 1,
        ]);
    }

    private function seedContactPage(): void
    {
        $page = Page::updateOrCreate(
            ['slug' => 'contact'],
            [
                'title' => ['en' => 'Contact', 'ar' => 'اتصل بنا'],
                'meta_description' => [
                    'en' => 'Get in touch with Razat Royal Farm — phone, email, address, and visiting hours.',
                    'ar' => 'تواصل مع مزرعة رزات السلطانية - الهاتف والبريد الإلكتروني والعنوان وأوقات الزيارة.',
                ],
                'is_published' => true,
            ]
        );
        $page->sections()->delete();

        $page->sections()->create([
            'type' => 'intro',
            'heading' => ['en' => 'Contact with us', 'ar' => 'تواصل معنا'],
            'body' => [
                'en' => 'Have a question? Write to us!',
                'ar' => 'هل لديك سؤال؟ راسلنا!',
            ],
            'sort_order' => 1,
        ]);

        $page->sections()->create([
            'type' => 'content_block',
            'heading' => ['en' => 'We are here for you', 'ar' => 'نحن هنا من أجلك'],
            'body' => [
                'en' => 'Our team is available to serve our valued customers from 7:00 AM to 9:00 PM, every day.',
                'ar' => 'فريق العمل متواجد لخدمة الزبائن الكرام من الساعة 7:00 صباحًا - 9:00 مساءً.',
            ],
            'sort_order' => 2,
        ]);
    }

    private function seedVisitTermsPage(): void
    {
        $page = Page::updateOrCreate(
            ['slug' => 'visit-terms'],
            [
                'title' => ['en' => 'Terms of Visit', 'ar' => 'شروط الزيارة'],
                'meta_description' => [
                    'en' => 'Visiting terms, conditions, and the cancellation & refund policy for Razat Royal Farm.',
                    'ar' => 'شروط وأحكام الزيارة وسياسة الإلغاء والاسترداد الخاصة بمزرعة رزات السلطانية.',
                ],
                'is_published' => true,
            ]
        );
        $page->sections()->delete();

        $page->sections()->create([
            'type' => 'terms_list',
            'heading' => ['en' => 'Visiting Terms & Conditions', 'ar' => 'شروط الزيارة'],
            'body' => [
                'en' => '<ol>'
                    .'<li>Please arrive 30 minutes before the scheduled visit time.</li>'
                    .'<li>Children aged 12 years and under must be accompanied by a guardian.</li>'
                    .'<li>Entry to the farm will not be allowed for those who arrive late for the scheduled visit time. The ticket will be considered void and is non-refundable and non-exchangeable.</li>'
                    .'<li>Razat Royal Farm Trail is closed on Friday, Saturday, and official holidays.</li>'
                    .'<li>Modest dress is required for both men and women. The farm management reserves the right to refuse entry to visitors who do not comply with the dress code. No refund or ticket exchange will be granted for those denied entry.</li>'
                    .'<li>Food and beverages are not allowed inside the farm.</li>'
                    .'<li>Carrying any type of bladed weapons such as knives, daggers, sticks, or any other sharp tools is prohibited, as well as carrying flammable materials or liquids.</li>'
                    .'<li>Follow the designated visit route and guide instructions.</li>'
                    .'<li>Cooperate with security inspection staff and follow all instructions.</li>'
                    .'<li>Present entry tickets and personal identification cards (ID card, resident card, or passport) upon arrival.</li>'
                    .'<li>Maintain quietness and public etiquette while touring the farm.</li>'
                    .'<li>Farm entry tickets are subject to the cancellation/exchange policy below.</li>'
                    .'<li>Parking is available near the starting point (Reception Area). Visitors will be transported to the farm using designated buses; personal vehicles are not allowed inside the farm.</li>'
                    .'<li>Laser devices or light effects are not allowed inside the farm.</li>'
                    .'<li>Avoid disturbing pets and birds, and remain calm when riding horses or horse-drawn carriages.</li>'
                    .'<li>Farm management is responsible for maintaining public order and taking necessary measures to preserve it, and is not responsible for compensation in the event of damage or accidents resulting from visitor negligence.</li>'
                    .'</ol>'
                    .'<p>Horse and horse-drawn carriage rides are available within the farm at the following rates:</p>'
                    .'<ul><li>Horse riding: 1 OMR (adults) / 500 baisa (children)</li><li>Horse-drawn carriage: 1 OMR (adults) / 500 baisa (children)</li></ul>',
                'ar' => '<ol>'
                    .'<li>يرجى الحضور قبل موعد الزيارة بـ 30 دقيقة.</li>'
                    .'<li>يجب مرافقة ولي الأمر لمن هم في سن 12 عام وما دون.</li>'
                    .'<li>لا يسمح بالدخول إلى المزرعة لمن يصل متأخراً عن موعد الزيارة المحدد، وتعتبر التذكرة ملغية وغير قابلة للاستبدال أو الاسترداد.</li>'
                    .'<li>يُغلق مسار مزرعة رزات السلطانية يومي الجمعة والسبت، بالإضافة إلى أيام الإجازات الرسمية.</li>'
                    .'<li>الالتزام بالزي المحتشم للرجال والنساء، ويحق لإدارة المزرعة أن ترفض دخول الزوار للمزرعة في حال عدم التقيد باللباس المناسب، ولا يحق لمن لا يسمح بدخوله استرجاع قيمة التذاكر أو استبدالها.</li>'
                    .'<li>لا يسمح بإدخال الأطعمة والمشروبات إلى المزرعة.</li>'
                    .'<li>يمنع اصطحاب جميع أنواع الأسلحة البيضاء كالسكاكين، أو الخناجر، أو العصي أو أي أدوات حادة أخرى، كما يمنع اصطحاب المواد أو السوائل القابلة للاشتعال.</li>'
                    .'<li>الالتزام بمسار الزيارة وتعليمات المرشد.</li>'
                    .'<li>التعاون مع القائمين على التفتيش الأمني والتقيد بالتعليمات.</li>'
                    .'<li>إبراز تذاكر الدخول والبطاقات الشخصية (بطاقات الهوية / بطاقات المقيم أو جواز السفر) عند الحضور.</li>'
                    .'<li>الالتزام بالهدوء والآداب العامة خلال التجول في أرجاء المزرعة.</li>'
                    .'<li>تخضع تذاكر دخول المزرعة إلى سياسة الإلغاء / الاستبدال أدناه.</li>'
                    .'<li>تتوفر مواقف للمركبات بالقرب من نقطة الانطلاقة (محطة الاستقبال)، وسينقل الزوّار إلى المزرعة باستخدام حافلات مخصصة لذلك، ويمنع دخول المركبات الشخصية للتنقل داخل المزرعة.</li>'
                    .'<li>لا يسمح باستخدام أجهزة الليزر أو المؤثرات الضوئية داخل المزرعة.</li>'
                    .'<li>تجنب التسبب في إزعاج الحيوانات الأليفة والطيور والتزام الهدوء أثناء ركوب الخيل أو عربات الخيل.</li>'
                    .'<li>تعتبر الإدارة مسؤولة عن ضمان النظام العام واتخاذ الإجراءات الضرورية للحفاظ عليه، وغير مسؤولة عن التعويض إذا ما حصل ضرر أو حادث نتيجة إهمال الزائر.</li>'
                    .'</ol>'
                    .'<p>يتوفر ضمن المزرعة تذاكر ركوب الخيل وعربات الخيل وفقاً للتفاصيل الآتية:</p>'
                    .'<ul><li>ركوب الخيل (1 ريال للبالغين – 500 بيسة للأطفال)</li><li>ركوب عربات الخيل (1 ريال للبالغين – 500 بيسة للأطفال)</li></ul>',
            ],
            'sort_order' => 1,
        ]);

        $page->sections()->create([
            'type' => 'terms_list',
            'heading' => ['en' => 'Cancellation and Refund Policy for Farm Entrance Tickets', 'ar' => 'سياسة الإلغاء والاسترداد الخاصة بتذاكر دخول المزرعة'],
            'body' => [
                'en' => '<ol>'
                    .'<li>Tickets are valid only for entry to the farm during the specific time period stated on the ticket, according to the date and time mentioned.</li>'
                    .'<li>Tickets purchased through the farm\'s official website must bear the full name of the ticket holder.</li>'
                    .'<li>Visitors purchasing tickets through the farm\'s website must review their tickets carefully and verify all booking details before confirming.</li>'
                    .'<li>If the visit is canceled by the farm\'s management for any reason, the visitor will be notified, and the ticket amount will be refunded.</li>'
                    .'<li>Tickets must be booked at least 24 hours before the selected visit date and time.</li>'
                    .'<li>The latest time to cancel or reschedule a visit is 24 hours before the scheduled visit. After this period, the ticket value will not be refunded. Visitors can contact the available communication channels to modify or cancel a booking.</li>'
                    .'<li>If the booking is canceled by the visitor, they are entitled to request a refund within 60 days from the date of cancellation, provided they submit proof of purchase.</li>'
                    .'<li>The farm\'s management is not obligated to pay any additional compensation in the event of ticket cancellation, visit postponement, or any other circumstances.</li>'
                    .'<li>The sale or resale of entry tickets by unauthorized persons is strictly prohibited.</li>'
                    .'<li>In case of a lost ticket, the ticket holder must present proof of purchase and inform the staff at the starting point to verify their details.</li>'
                    .'<li>Visitors arriving late for the scheduled visit time will have their tickets canceled, and no refund will be granted.</li>'
                    .'</ol>',
                'ar' => '<ol>'
                    .'<li>التذاكر صالحة فقط للدخول إلى المزرعة خلال الفترة الزمنية المحددة وفق التاريخ والوقت المذكورين بالتذكرة.</li>'
                    .'<li>يجب أن تحمل تذاكر الدخول المباعة عبر الموقع الإلكتروني الاسم الكامل لصاحب التذكرة.</li>'
                    .'<li>على الزوّار الراغبين بشراء تذاكر الدخول عبر الموقع الإلكتروني للمزرعة تدقيق التذاكر، والتأكد من تفاصيل الحجز قبل الاعتماد.</li>'
                    .'<li>في حال تم إلغاء الزيارة من قبل إدارة المزرعة لأي سبب كان فسيتم إشعار الزائر وإعادة مبلغ التذكرة.</li>'
                    .'<li>يجب أن تُحجز تذاكر الدخول قبل 24 ساعة من الموعد المختار للزيارة كحد أدنى.</li>'
                    .'<li>أقصى موعد لإلغاء الزيارة أو تعديل موعدها هو 24 ساعة قبل الموعد المحدد للزيارة، من بعدها لن يتم إرجاع قيمة التذكرة، ويمكن التواصل عبر القنوات المختلفة لتعديل أو إلغاء الحجز.</li>'
                    .'<li>في حال إلغاء الحجز من قبل الزائر فإنه يحق له طلب استرجاع قيمة التذكرة خلال 60 يوم من تاريخ الإلغاء على أن يقدم ما يثبت الشراء.</li>'
                    .'<li>إدارة المزرعة غير ملزمة بدفع أي تعويضات إضافية في حال إلغاء التذكرة أو تأجيل الزيارة، أو أي ظرف آخر.</li>'
                    .'<li>يمنع بأي شكل من الأشكال بيع أو إعادة بيع تذاكر الدخول من قبل الأشخاص غير المخول لهم بذلك.</li>'
                    .'<li>في حال فقدان تذكرة الدخول فإنه يجب على صاحب التذكرة تقديم ما يثبت شراءه لها، وإبلاغ الموظف الموجود عند نقطة الانطلاقة للتأكد من صحة بياناته.</li>'
                    .'<li>في حال الوصول المتأخر عن موعد الزيارة المحدد للدخول إلى المزرعة تعتبر التذكرة ملغية ولا يحق لأصحاب التذاكر طلب استرجاع قيمتها.</li>'
                    .'</ol>',
            ],
            'sort_order' => 2,
        ]);
    }
}
