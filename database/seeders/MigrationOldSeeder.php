<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Exception;
use App\Models\DownStreamNotification as DownStream;
use App\Models\NotificationBase;
use App\Models\UpStreamNotification as UpStream;
use App\Services\NotificationService;
use DateTime;
use App\Models\{Country, Institution};
use Monarobase\CountryList\CountryListFacade as Countries;
use Illuminate\Support\Str;

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
        $mapping_source_id = [
            '1' => 'balai besar',
            '2' => 'infosan',
            '3' => 'pengaduan konsumen',
            '4' => 'eurasff',
            '5' => 'arasff',
            '6' => 'karantina pertanian',
            '7' => 'karantina perikanan',
            '8' => 'program surveilan',
            '10' => 'atase',
            '11' => 'authority'
        ];

        try {
            Schema::disableForeignKeyConstraints();
            DB::table('down_stream_notifications')->truncate();
            DB::table('up_stream_notifications')->truncate();
            DB::table('down_stream_institutions')->truncate();
            DB::table('up_stream_institutions')->truncate();
            Schema::enableForeignKeyConstraints();
            DB::beginTransaction();
            $run = true;
            $upstreams = [];
            $downstreams = [];
            $count = 0;
            $datas = DB::connection('mysql_old')
                ->table('notifikasi')
                ->get();
            $count += sizeof($datas);
            echo "Data Loaded :" . $count . "\n";
            foreach ($datas as $i => $n) {
                $search = DB::connection('mysql_old')
                    ->table('prm_negara')
                    ->where('kode', 'like', $n->id_negara_notifying)
                    ->first()->nama;
                $id_country = $this->searchCountry($search);
                if (str_contains($n->nomor_referensi, "IN.UP")) {
                }
                // else if (str_contains($n->nomor_referensi, "IN.DS")) {
                else {
                    $produk = DB::connection('mysql_old')
                        ->table('notifikasi_produk')
                        ->where('id', $n->id)
                        ->first();
                    $based = DB::connection('mysql_old')
                        ->table('prm_kat_notifikasi')
                        ->where('id', $n->id_kat_notifikasi)
                        ->first();
                    $downstream = DownStream::make(
                        [
                            'title' => $n->judul,
                            'author_id' => 3, //static from ncp,
                            'status_notif_id' => isset($mapping_status_notif_id[$n->id_status]) ? $mapping_status_notif_id[$n->id_status] : 1,
                            'type_notif_id' => $n->tipe === "Food" ? 1 : 2,
                            'country_id' => $id_country,
                            'based_notif_id' => NotificationBase::where('name', $based->nama ?? "")->first()->id ?? null,
                            'origin_source_notif' => $n->sumber === "LN" ? 'interlocal' : 'local',
                            'date_notif' => $n->tgl_notifikasi !== " " ? $n->tgl_notifikasi : null,
                            'product_name' => $produk->nama ?? "No Name",
                            // 'category_product_id' => null,
                            'brand_name' => $produk->merek ?? "No Merek",
                            'registration_number' => $n->batch ?? null,
                            'package_product' => $produk->packaging ?? null,
                            'number' => $n->nomor_referensi
                        ]
                    );
                    if ($downstream->origin_source_notif === 'local') {
                        $downstream->source_notif = isset($mapping_source_id[$n->id_sumber]) ? $mapping_source_id[$n->id_sumber] : 'balai besar';
                    } else {
                        $downstream->source_notif = isset($mapping_source_id[$n->id_sumber]) ? $mapping_source_id[$n->id_sumber] : 'arasff';
                    }
                    $downstream->setStatus('open', 'Dibuat ');

                    if (DateTime::createFromFormat('Y-m-d H:i:s', $n->tgl_notifikasi) == true) {
                        $downstream->created_at = $downstream->date_notif;
                        $downstream->updated_at = $downstream->date_notif;
                    } else if (DateTime::createFromFormat('Y-m-d H:i', $n->tgl_notifikasi) == true) {
                        $downstream->date_notif = DateTime::createFromFormat('Y-m-d H:i', $n->tgl_notifikasi);
                        $downstream->created_at = $downstream->date_notif;
                        $downstream->updated_at = $downstream->date_notif;
                    } else if (DateTime::createFromFormat('Y-m-d H.i', $n->tgl_notifikasi) == true) {
                        $downstream->date_notif = DateTime::createFromFormat('Y-m-d H.i', $n->tgl_notifikasi);
                        $downstream->created_at = $downstream->date_notif;
                        $downstream->updated_at = $downstream->date_notif;
                    } else {
                        $downstream->date_notif = null;
                        $downstream->created_at = null;
                        $downstream->updated_at = null;
                    }

                    array_push($downstreams, $downstream);
                    echo "ID: " . $n->id . " " . $n->tgl_notifikasi;
                    $downstream->save();
                    $downstream->downstreamInstitution()->create([
                        'institution_id' => Institution::where('type', 'ncp')->first()->id ?? 6,
                        'write' => true,
                        'status' => 'assigned',
                    ]);
                    echo "\n";
                    // echo "Data Downstream: " . (sizeof($downstreams)) . " of " . $count . " data \n";
                }
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }
    }

    private function searchCountry($search)
    {
        $en_country =  Countries::getList('en', 'php');

        foreach ($en_country as $key => $country) {
            if (Str::lower($country) === Str::lower($search)) {
                $id = Country::where('code', $key)->first()->id ?? null;
                return $id;
                break;
            }
        }

        return null;
    }
}
