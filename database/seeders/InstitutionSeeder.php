<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Institution;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Institution::insert([
            [
                'name' => 'BPOM',
                'type' => 'ccp'
            ],
            [
                'name' => 'Kementrian Kelautan dan Perikanan',
                'type' => 'ccp'
            ],
            [
                'name' => 'Kementrian Pertanian',
                'type' => 'ccp'
            ],
            [
                'name' => 'Direktorat Jenderal Bea dan Cukai',
                'type' => 'ccp'
            ],
        ]);

        $lccps = [
            'BBPOM Aceh' => [
                'parent_id' => 1
            ],
            'BBPOM Denpasar' => [
                'parent_id' => 1
            ],
            'BBPOM Lampung' => [
                'parent_id' => 1
            ],
            'BBPOM Manado' => [
                'parent_id' => 1
            ],
            'BBPOM Medan' => [
                'parent_id' => 1
            ],
            'BBPOM Padang' => [
                'parent_id' => 1
            ],
            'BBPOM Surabaya' => [
                'parent_id' => 1
            ],
            'BBPOM Yogyakarta' => [
                'parent_id' => 1
            ],
            'Dit. Pengawasan Pangan Risiko Rendah dan Sedang'  => [
                'parent_id' => 1
            ],
            'Dit. Pengawasan Pangan Risiko Tinggi dan Teknologi' => [
                'parent_id' => 1
            ],
            'Karantina Pertanian' => [
                'parent_id' => 3
            ],
            'Direktorat Pengawasan Produksi Pangan Olahan' => [
                'parent_id' => 1
            ],
            'Pusat Pengujian Obat dan Makanan' => [
                'parent_id' => 1
            ],
        ];
        

        foreach ($lccps as $key => $lccp) {
            Institution::create([
                'name' =>  $key,
                'type' => 'lccp',
                'parent_id' => $lccp['parent_id']
            ]);
        }
    }
}
