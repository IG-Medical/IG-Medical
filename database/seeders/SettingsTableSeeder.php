<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('settings')->truncate();

        $now = now();

        $settings = [
            // Site identity
            ['key' => 'site_name',          'value' => 'IG Medical'],
            ['key' => 'header_logo',        'value' => null],
            ['key' => 'footer_logo',        'value' => null],
            ['key' => 'favicon',            'value' => null],

            // Contact
            ['key' => 'email',              'value' => 'inquiry@ig-medical.de'],
            ['key' => 'phone',              'value' => '+49 (0) 123 456 789'],
            ['key' => 'address',            'value' => json_encode(['en' => 'Germany', 'de' => 'Deutschland', 'ar' => 'ألمانيا'])],

            // Social
            ['key' => 'facebook',           'value' => 'https://www.facebook.com/'],
            ['key' => 'twitter',            'value' => ''],
            ['key' => 'youtube',            'value' => 'https://www.youtube.com/'],
            ['key' => 'instagram',          'value' => ''],
            ['key' => 'linkedin',           'value' => 'https://www.linkedin.com/'],

            // Welcome bar
            ['key' => 'welcome_text',       'value' => json_encode(['en' => 'Welcome to IG Medical', 'de' => 'Willkommen bei IG Medical', 'ar' => 'مرحباً بكم في IG Medical'])],
            ['key' => 'global_website',     'value' => 'https://www.ig-medical.de'],

            // Footer
            ['key' => 'footer_about_site',  'value' => json_encode(['en' => 'IG Medical is a leading medical device company providing high-quality surgical lighting solutions worldwide.', 'de' => 'IG Medical ist ein führendes Medizintechnikunternehmen.', 'ar' => 'شركة IG Medical رائدة في مجال الأجهزة الطبية.'])],

            // Home page sections
            ['key' => 'home_page_about_us_section', 'value' => json_encode([
                'title'    => ['en' => 'About Us',         'de' => 'Über uns',         'ar' => 'من نحن'],
                'sub_title'=> ['en' => 'IG Medical GmbH',  'de' => 'IG Medical GmbH',  'ar' => 'IG Medical GmbH'],
                'content'  => ['en' => 'Leading provider of innovative medical lighting and surgical solutions.', 'de' => 'Führender Anbieter innovativer medizinischer Beleuchtungs- und Chirurgielösungen.', 'ar' => 'مزود رائد لحلول الإضاءة الطبية والجراحية المبتكرة.'],
            ])],

            ['key' => 'home_page_product_section', 'value' => json_encode([
                'title'    => ['en' => 'Our Products',  'de' => 'Unsere Produkte',  'ar' => 'منتجاتنا'],
                'sub_title'=> ['en' => 'Medical Devices', 'de' => 'Medizinprodukte', 'ar' => 'الأجهزة الطبية'],
            ])],

            ['key' => 'home_page_companies_section', 'value' => json_encode([
                'title'    => ['en' => 'Our Partners',  'de' => 'Unsere Partner',  'ar' => 'شركاؤنا'],
            ])],

            // Video
            ['key' => 'video_how_it_works', 'value' => 'https://www.youtube.com/embed/dQw4w9WgXcQ'],

            // About us page
            ['key' => 'about_us_page', 'value' => json_encode([
                'title'    => ['en' => 'About IG Medical',      'de' => 'Über IG Medical',       'ar' => 'عن IG Medical'],
                'content'  => ['en' => 'IG Medical is dedicated to advancing medical technology.', 'de' => 'IG Medical widmet sich dem Fortschritt der Medizintechnik.', 'ar' => 'تكرس IG Medical جهودها للنهوض بالتكنولوجيا الطبية.'],
            ])],

            ['key' => 'certifications_page', 'value' => json_encode([
                'title'   => ['en' => 'Certifications', 'de' => 'Zertifizierungen', 'ar' => 'الشهادات'],
                'content' => ['en' => 'Our products meet the highest international standards.', 'de' => 'Unsere Produkte erfüllen die höchsten internationalen Standards.', 'ar' => 'منتجاتنا تلتزم بأعلى المعايير الدولية.'],
            ])],

            // Breadcrumbs
            ['key' => 'breadcrumb_about_us',       'value' => json_encode(['en' => 'About Us',      'de' => 'Über uns',          'ar' => 'من نحن'])],
            ['key' => 'breadcrumb_contact_us',     'value' => json_encode(['en' => 'Contact Us',    'de' => 'Kontakt',           'ar' => 'اتصل بنا'])],
            ['key' => 'breadcrumb_news',           'value' => json_encode(['en' => 'News',          'de' => 'Nachrichten',       'ar' => 'الأخبار'])],
            ['key' => 'breadcrumb_job',            'value' => json_encode(['en' => 'Careers',       'de' => 'Karriere',          'ar' => 'الوظائف'])],
            ['key' => 'breadcrumb_certifications', 'value' => json_encode(['en' => 'Certifications','de' => 'Zertifizierungen',  'ar' => 'الشهادات'])],
            ['key' => 'breadcrumb_ig_world',       'value' => json_encode(['en' => 'IG World',      'de' => 'IG Welt',           'ar' => 'عالم IG'])],
            ['key' => 'breadcrumb_public_page',    'value' => json_encode(['en' => 'Page',          'de' => 'Seite',             'ar' => 'الصفحة'])],
            ['key' => 'breadcrumb_sales',          'value' => json_encode(['en' => 'Sales',         'de' => 'Vertrieb',          'ar' => 'المبيعات'])],
            ['key' => 'breadcrumb_technical',      'value' => json_encode(['en' => 'Technical',     'de' => 'Technik',           'ar' => 'التقني'])],
            ['key' => 'breadcrumb_customized',     'value' => json_encode(['en' => 'Customized',    'de' => 'Angepasst',         'ar' => 'مخصص'])],

            // Google maps
            ['key' => 'google_map',         'value' => 'https://maps.google.com/maps?q=Germany&output=embed'],
            ['key' => 'google_map_api_key', 'value' => ''],

            // Maintenance
            ['key' => 'maintenance_mode',   'value' => '0'],

            // PDF product setting
            ['key' => 'product_pdf',        'value' => json_encode(['title' => ['en' => 'Product Catalogue', 'de' => 'Produktkatalog', 'ar' => 'كتالوج المنتجات']])],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->insert([
                'key'        => $setting['key'],
                'value'      => $setting['value'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
