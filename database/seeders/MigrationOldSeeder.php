<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\DownStreamNotification as DownStream;
use App\Models\UpStreamNotification as UpStream;
use DateTime;

class MigrationOldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mapping_status_notif_id = [
            '1' => 4,
            '2' => 3,
            '8' => 1,
            '3' => 2
        ];
        try {
            DB::beginTransaction();
            $run = true;
            $upstreams = [];
            $downstreams = [];
            $count = 0;

            // while ($run) {
            $datas = DB::connection('mysql_old')
                ->table('notifikasi')
                //   ->take(10)
                ->get();
            // if (sizeof($datas) < 10) {
            //     $run = false;
            // }
            $count += sizeof($datas);
            echo "Data Loaded :" . $count . "\n";
            foreach ($datas as $i => $n) {
                if (str_contains($n->nomor_referensi, "IN.UP")) {
                } else if (str_contains($n->nomor_referensi, "IN.DS")) {
                    $produk = DB::connection('mysql_old')
                        ->table('notifikasi_produk')
                        ->where('id', $n->id)
                        ->first();

                    $downstream = DownStream::make(
                        [
                            'title' => $n->judul,
                            'author_id' => 3, //static from ncp,
                            'status_notif_id' => isset($mapping_status_notif_id[$n->id_status]) ? $mapping_status_notif_id[$n->id_status] : 1,
                            'type_notif_id' => $n->tipe === "Food" ? 1 : 2,
                            // 'country_id' => null,
                            // 'based_notif_id' => null,
                            'origin_source_notif' => $n->sumber === "LN" ? 'interlocal' : 'local',
                            // 'source_notif' => null,
                            'date_notif' => $n->tgl_notifikasi !== " " ? $n->tgl_notifikasi : null,
                            'product_name' => $produk->nama ?? "No Name",
                            // 'category_product_id' => null,
                            'brand_name' => $produk->merek ?? "No Merek",
                            // 'registration_number' => null,
                            'package_product' => $produk->packaging ?? null,
                            'number' => $n->nomor_referensi
                        ]
                    );
                    $downstream->setStatus('open', 'Dibuat ');

                    if (DateTime::createFromFormat('Y-m-d H:i:s', $n->tgl_notifikasi) == false) {
                        $downstream->date_notif = null;
                    }
                    // array_push($downstreams, $downstream);
                    // if ($downstream->date_notif === null) {
                    //     echo "kosong ";
                    // }
                    // echo $downstream->date_notif . " ";
                    echo "ID: " . $n->id . " " . $n->tgl_notifikasi;
                    $downstream->save();
                    echo "Data Downstream: " . (sizeof($downstreams)) . " of " . $count . " data \n";
                }
            }

            // }
            // DownStream::insert($downstreams);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }
    }
}
