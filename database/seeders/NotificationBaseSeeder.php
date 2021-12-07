<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NotificationBase;

class NotificationBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NotificationBase::insert([
            [
                'name' => 'Border control - consignment detained'
            ],
            [
                'name' => 'Border control - consignment released'
            ],
            [
                'name' => 'Border control - consignment under customs'
            ],
            [
                'name' => 'Border rejection'
            ],
            [
                'name' => 'Consumer complaint'
            ],
            [
                'name' => 'Follow-up / additional information'
            ],
            [
                'name' => 'Hasil pengawasan mutu oleh perusahaan / company own check'
            ],
            [
                'name' => 'Kajian surveilan pada rantai pangan'
            ],
            [
                'name' => 'KLB Keracunan Pangan'
            ],
            [
                'name' => 'Official control in the market'
            ],
            [
                'name' => 'Pengawasan di perbatasan'
            ],
            [
                'name' => 'Pengawasan pangan di pasar'
            ],
            [
                'name' => 'Program monitoring ekspor'
            ],
            [
                'name' => 'Program monitoring impor'
            ],
        ]);
    }
}
