<?php

use App\Models\SiteSetting;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class   SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            ['title' => 'Site Title', 'key' => 'site_title', 'value' => 'New Site name', 'key_group' => 'general'],
            ['title' => 'Tagline', 'key' => 'tagline', 'value' => 'Your tag line', 'key_group' => 'general'],
            ['title' => 'Header Logo', 'key' => 'header_logo', 'value' => 'Header Logo', 'key_group' => 'general'],
            ['title' => 'Footer Logo', 'key' => 'footer_logo', 'value' => 'Footer Logo', 'key_group' => 'general'],
            ['title' => 'Fav Icon', 'key' => 'fav_icon', 'value' => 'Favicon', 'key_group' => 'general'],
            ['title' => 'Site URL', 'key' => 'site_url', 'value' => '', 'key_group' => 'general'],
            ['title' => 'Copyright', 'key' => 'copyright', 'value' => 'New Company, All Rights Reserved.', 'key_group' => 'general'],
            ['title' => 'Meta Keywords', 'key' => 'meta_keywords', 'value' => 'Meta Keywords', 'key_group' => 'seo'],
            ['title' => 'Meta Description', 'key' => 'meta_description', 'value' => 'Meta Description', 'key_group' => 'seo'],
            ['title' => 'Facebook', 'key' => 'facebook', 'value' => '', 'key_group' => 'social'],
            ['title' => 'Instagram', 'key' => 'instagram', 'value' => '', 'key_group' => 'social'],
            ['title' => 'Twitter', 'key' => 'twitter', 'value' => '', 'key_group' => 'social'],
            ['title' => 'YouTube', 'key' => 'youtube', 'value' => '', 'key_group' => 'social'],
            ['title' => 'LinkedIn', 'key' => 'linkedin', 'value' => '', 'key_group' => 'social'],
            ['title' => 'Pinterest', 'key' => 'pinterest', 'value' => '', 'key_group' => 'social'],
            ['title' => 'Address', 'key' => 'address', 'value' => '3rd Floor, Siddhartha Insurance Complex, Babar Mahal, Kathmandu', 'key_group' => 'contact'],
            ['title' => 'Contact', 'key' => 'contact', 'value' => '<a href="tel:015705994">+977-01-5705994</a>, <a href="tel:015705664">015705664</a>, <a href="tel:015706318">015706318</a>, <a href="tel:015705337">015705337</a>', 'key_group' => 'contact'],
            ['title' => 'Tollfree No. For Domestic Flight Information', 'key' => 'tollfree-no-domestic', 'value' => '1660 11 22222', 'key_group' => 'contact'],
            ['title' => 'Tollfree No. For International Flight Information', 'key' => 'tollfree-no-international', 'value' => '1660 11 22222', 'key_group' => 'contact'],
            ['title' => 'Fax', 'key' => 'fax', 'value' => '', 'key_group' => 'contact'],
            ['title' => 'Email Address', 'key' => 'email_address', 'value' => 'info@nicasiacapital.com', 'key_group' => 'contact'],
            ['title' => 'Email For Online Ticketing issues', 'key' => 'ticketing_email', 'value' => 'info@nicasiacapital.com', 'key_group' => 'contact'],
            ['title' => 'Admin Email', 'key' => 'admin_email', 'value' => 'bikesh.shrestha@peacenepal.com', 'key_group' => 'contact'],
            ['title' => 'Google Analytics', 'key' => 'google_analytics', 'value' => '', 'key_group' => 'others'],
            ['title' => 'Custom Css', 'key' => 'custom_css', 'value' => '', 'key_group' => 'others'],

        ];

        foreach ($settings as $setting) {
            $data = SiteSetting::where('title', $setting['title'])->first();
            if (!$data) {
                $setting['created_at'] = Carbon::now();
                DB::table('site_settings')->insert($setting);
            }
        }
    }
}
