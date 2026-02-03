<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SiteSetting::create([
            'site_name' => 'RealEstate',
            'site_description' => 'Your trusted real estate platform',
            'phone' => '+1234567890',
            'email' => 'info@realestate.com',
            'address' => '123 Main St, City, Country',
        ]);
    }
}
