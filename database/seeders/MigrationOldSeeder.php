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
use App\Models\{AttachmentType, Country, DangerousCategory, DangerousCategoryLevel, DistributionStatus, Institution, NotificationAttachment, UomResult};
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
            DB::table('dangerous_infos')->truncate();
            DB::table('dangerous_sampling_infos')->truncate();
            DB::table('risk_infos')->truncate();
            DB::table('traceability_lot_infos')->truncate();
            DB::table('border_control_infos')->truncate();
            DB::table('notification_attachments')->truncate();
            DB::table('follow_up_notifications')->truncate();
            DB::table('follow_up_notification_attachments')->truncate();
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
            $notification_type = null;
            echo "Data Loaded :" . $count . "\n";
            foreach ($datas as $i => $n) {
                $search = DB::connection('mysql_old')
                    ->table('prm_negara')
                    ->where('kode', 'like', $n->id_negara_notifying)
                    ->first()->nama;
                $id_country = $this->searchCountry($search);

                $produk = DB::connection('mysql_old')
                    ->table('notifikasi_produk')
                    ->where('id', $n->id)
                    ->first();
                $based = DB::connection('mysql_old')
                    ->table('prm_kat_notifikasi')
                    ->where('id', $n->id_kat_notifikasi)
                    ->first();
                $danger = DB::connection('mysql_old')
                    ->table('notifikasi_bahaya')
                    ->where('id', $n->id)
                    ->first();
                $risk = DB::connection('mysql_old')
                    ->table('notifikasi_lain')
                    ->where('id', $n->id)
                    ->first();
                $trace = DB::connection('mysql_old')
                    ->table('notifikasi_keterlusuran')
                    ->where('id', $n->id)
                    ->first();
                $border = DB::connection('mysql_old')
                    ->table('notifikasi_border')
                    ->where('id', $n->id)
                    ->first();

                $attachments = DB::connection('mysql_old')
                    ->table('notifikasi_attach')
                    ->where('id', $n->id)
                    ->get();
                if (str_contains($n->nomor_referensi, "IN.UP")) {

                    $notification_type = "upstream";
                    $upstream = UpStream::make(
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
                    if ($upstream->origin_source_notif === 'local') {
                        $upstream->source_notif = isset($mapping_source_id[$n->id_sumber]) ? $mapping_source_id[$n->id_sumber] : 'balai besar';
                    } else {
                        $upstream->source_notif = isset($mapping_source_id[$n->id_sumber]) ? $mapping_source_id[$n->id_sumber] : 'arasff';
                    }
                    $upstream->setStatus('open', 'Dibuat ');

                    if (DateTime::createFromFormat('Y-m-d H:i:s', $n->tgl_notifikasi) == true) {
                        $upstream->created_at = $upstream->date_notif;
                        $upstream->updated_at = $upstream->date_notif;
                    } else if (DateTime::createFromFormat('Y-m-d H:i', $n->tgl_notifikasi) == true) {
                        $upstream->date_notif = DateTime::createFromFormat('Y-m-d H:i', $n->tgl_notifikasi);
                        $upstream->created_at = $upstream->date_notif;
                        $upstream->updated_at = $upstream->date_notif;
                    } else if (DateTime::createFromFormat('Y-m-d H.i', $n->tgl_notifikasi) == true) {
                        $upstream->date_notif = DateTime::createFromFormat('Y-m-d H.i', $n->tgl_notifikasi);
                        $upstream->created_at = $upstream->date_notif;
                        $upstream->updated_at = $upstream->date_notif;
                    } else {
                        $upstream->date_notif = null;
                        $upstream->created_at = null;
                        $upstream->updated_at = null;
                    }

                    array_push($upstreams, $upstream);
                    echo "ID: " . $n->id . " " . $n->tgl_notifikasi;
                    $upstream->save();
                    $upstream->upstreamInstitution()->create([
                        'institution_id' => Institution::where('type', 'ncp')->first()->id ?? 5,
                        'write' => true,
                        'status' => 'assigned',
                    ]);
                    //additional institution bpom
                    $upstream->upstreamInstitution()->create([
                        'institution_id' => Institution::where('name', 'BPOM')->first()->id ?? 1,
                        'write' => true,
                        'status' => 'assigned',
                    ]);
                    $notif = $upstream;
                    echo "NEW Upstream ID: " . $upstream->id . " ";
                    echo "\n";
                    // echo "Data Downstream: " . (sizeof($upstreams)) . " of " . $count . " data \n";
                }
                // else if (str_contains($n->nomor_referensi, "IN.DS")) {
                else {
                    $notification_type = "downstream";
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
                    $downstream->setStatus('ccp process', 'Diproses ');

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
                        'institution_id' => Institution::where('type', 'ncp')->first()->id ?? 5,
                        'write' => true,
                        'status' => 'assigned',
                    ]);
                    $notif = $downstream;
                    echo "NEW Downstream ID: " . $downstream->id . " ";
                    echo "\n";
                    // echo "Data Downstream: " . (sizeof($downstreams)) . " of " . $count . " data \n";
                }

                if ($notif != null) {
                    if ($danger != null) {
                        $old_kat_bahaya = DB::connection('mysql_old')
                            ->table('prm_kat_bahaya')
                            ->where('id', $danger->id_bahaya)
                            ->first() ?? null;

                        if ($old_kat_bahaya != null) {
                            // Check in main category
                            $dangerous_category = DangerousCategory::where('name', $old_kat_bahaya->nama)
                                ->first();
                            $category_id = null;
                            $cl1_id = null;
                            $cl2_id = null;
                            $cl3_id = null;
                            // If not in MC check in Level Category
                            if ($dangerous_category == null) {
                                $dcl = DangerousCategoryLevel::where('name', $old_kat_bahaya->nama)
                                    ->first();
                                if ($dcl != null) {
                                    if ($dcl->parent() != null) {
                                        $dcl1 = $dcl->parent();
                                        if ($dcl1->parent() != null) {
                                            $dcl2 = $dcl1->parent();
                                            echo "DCL 2: " . $dcl2->id . " \n";
                                            $category_id = $dcl2->dangerousCategory->id;
                                            $cl1_id = $dcl2->id;
                                            $cl2_id = $dcl1->id;
                                            $cl3_id = $dcl->id;
                                        } else {
                                            $category_id = $dcl1->dangerousCategory->id;
                                            $cl1_id = $dcl1->id;
                                            $cl2_id = $dcl->id;
                                        }
                                    } else {
                                        $cl1_id = $dcl->id;
                                    }
                                }
                            } else {
                                $category_id = $dangerous_category->id;
                            }
                        }

                        $dangerous = $notif->dangerous()->make([
                            'name' => $danger->jenis,
                            'category_id' => $category_id,
                            'cl1_id' => $cl1_id,
                            'cl2_id' => $cl2_id,
                            'cl3_id' => $cl3_id,
                            'notification_type' => $notification_type
                        ]);
                        $dangerous->save();
                        // echo "Sampling Date: " . $danger->sampling_tgl . " ";
                        $uom_danger = DB::connection('mysql_old')
                            ->table('prm_konsentrasi')
                            ->where('id', $danger->id_konsentrasi)
                            ->first() ?? null;
                        $dangerous->sampling()->create([
                            'sampling_date' => $danger->sampling_tgl !== "" ? $danger->sampling_tgl : null,
                            'sampling_count' => $danger->sampling_jml,
                            'sampling_method' => $danger->sampling_metode,
                            'sampling_place' => $danger->sampling_tempat,
                            'name_result' => $danger->nilai_konsentrasi,
                            'uom_result_id' => $uom_danger != null ? (UomResult::where('name', $uom_danger->nama)->first()->id ?? null) : null,
                            'laboratorium' => $danger->analysis_lab,
                            'matrix' => $danger->analysis_metode,
                            'scope' => $danger->batas_referensi,
                            'max_tollerance' => $danger->batas_maks
                        ]);
                    }

                    if ($risk != null) {
                        $old_risk = DB::connection('mysql_old')
                            ->table('prm_distribusi')
                            ->where('id', $risk->id_distribusi ?? null)
                            ->first();

                        $risks = $notif->risks()->make([
                            'distribution_status_id' => $old_risk != null ?
                                (DistributionStatus::where('name', $old_risk->nama)->first()->id ?? null) :
                                null,
                            'serious_risk' => $risk->person_ill,
                            // 'victim' => ,
                            'symptom' => $risk->tipe_penyakit,
                            'notification_type' => $notification_type
                        ]);
                        $risks->save();
                    }

                    if ($trace != null) {
                        $search_trace_country = DB::connection('mysql_old')
                            ->table('prm_negara')
                            ->where('kode', 'like', $trace->id_negara_asal)
                            ->first()->nama;
                        $id_produser_country = null;
                        $id_importer_country = null;
                        $id_wholesaler_country = null;
                        $id_trace_country = null;
                        if ($trace->produsen_negara != null) {
                            $search_produser_country = DB::connection('mysql_old')
                                ->table('prm_negara')
                                ->where('kode', 'like', $trace->produsen_negara)
                                ->first()->nama;
                            $id_produser_country = $this->searchCountry($search_produser_country);
                        }
                        if ($trace->importir_negara != null) {
                            $search_importer_country = DB::connection('mysql_old')
                                ->table('prm_negara')
                                ->where('kode', 'like', $trace->importir_negara)
                                ->first()->nama;
                            $id_importer_country = $this->searchCountry($search_importer_country);
                        }
                        if ($trace->wholesaler_negara != null) {
                            $search_wholesaler_country = DB::connection('mysql_old')
                                ->table('prm_negara')
                                ->where('kode', 'like', $trace->wholesaler_negara)
                                ->first()->nama;
                            $id_wholesaler_country = $this->searchCountry($search_wholesaler_country);
                        }
                        $id_trace_country = $this->searchCountry($search_trace_country);

                        $traceability = $notif->traceabilityLot()->make([
                            'source_country_id' => $id_trace_country,
                            'number' => $trace->nomor_batch,
                            'used_by' => $this->mappingDate($trace->tgl_usedbydate),
                            'best_before' => $this->mappingDate($trace->tgl_bestbefore),
                            'sell_by' => $this->mappingDate($trace->tgl_sellbydate),
                            'number_unit' => $trace->ket_nounits,
                            'net_weight' => $trace->ket_total,
                            'cert_number' => $trace->sertifikat_nomor,
                            'cert_date'  => $this->mappingDate($trace->sertifikat_tgl),
                            'cert_institution'  => $trace->sertifikat_instansi,
                            'add_cert_number' => $trace->sertifikat_lain_nomor,
                            'add_cert_date' => $this->mappingDate($trace->sertifikat_lain_tgl),
                            'add_cert_institution' => $trace->sertifikat_lain_instansi,
                            'cved_number' => $trace->cved_nomor,
                            'producer_name' => $trace->produsen_nama,
                            'producer_address' => $trace->produsen_alamat,
                            'producer_city' => $trace->produsen_kota,
                            'producer_country_id' => $id_produser_country,
                            'producer_approval' => $trace->produsen_reg,
                            'importer_name' => $trace->importir_nama,
                            'importer_address' => $trace->importir_alamat,
                            'importer_city' => $trace->importir_kota,
                            'importer_country_id' => $id_importer_country,
                            'importer_approval' => $trace->importir_reg,
                            'wholesaler_name' => $trace->wholesaler_nama,
                            'wholesaler_address' => $trace->wholesaler_alamat,
                            'wholesaler_city' => $trace->wholesaler_kota,
                            'wholesaler_country_id' => $id_wholesaler_country,
                            'wholesaler_approval' => $trace->wholesaler_reg,
                            'notification_type' => $notification_type
                        ]);
                        // echo "Traceablity before convert : " . $trace->tgl_bestbefore;
                        // echo "Traceability best before date: " . $traceability->best_before . "\n";
                        $traceability->save();
                    }

                    if ($border != null) {
                        $search_border_country = DB::connection('mysql_old')
                            ->table('prm_negara')
                            ->where('kode', 'like', $border->negara_tujuan)
                            ->first()->nama;
                        $id_border_country = $this->searchCountry($search_border_country);
                        $border_control = $notif->borderControl()->make([
                            'start_point' => $border->titik_berangkat,
                            'entry_point' => $border->titik_masuk,
                            'supervision_point' => $border->titik_pengawas,
                            'destination_country_id' => $id_border_country,
                            'consignee_name' => $border->penerima_nama,
                            'consignee_address' => $border->penerima_alamat,
                            'container_number' => $border->container,
                            'transport_name' => $border->transport,
                            'transport_description' => $border->transport_other_info,
                            'notification_type' => $notification_type
                        ]);
                        $border_control->save();
                    }

                    if (sizeof($attachments) > 0) {
                        foreach ($attachments as $l => $attachment) {
                            $id_type_old = DB::connection('mysql_old')
                                ->table('prm_attachment_type')
                                ->where('id', $attachment->id_type)
                                ->first();
                            $new_type_id = AttachmentType::where('name', 'like', $id_type_old->nama)
                                ->first();
                            $attach = $notif->attachment()->make([
                                'link' => $attachment->filename,
                                'title' => $attachment->filename,
                                'type_id' => $new_type_id ? $new_type_id->id : 1, //default main info
                                'info' => $new_type_id ? $new_type_id->info : 'main_info', //default main info
                                'notification_type' => $notification_type,
                                'created_at' => $this->mappingDate($attachment->tgl),
                                'updated_at' => $this->mappingDate($attachment->tgl),
                            ]);
                            $attach->save();
                        }
                    }
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

    private function mappingDate($date)
    {
        if ($date === "" || $date === "-")
            return null;

        if (DateTime::createFromFormat('Y-m-d H:i:s', $date) == true) {
            return DateTime::createFromFormat('Y-m-d H:i:s', $date);
        } else if (DateTime::createFromFormat('Y-m-d H:i', $date) == true) {
            return DateTime::createFromFormat('Y-m-d H:i', $date);
        } else if (DateTime::createFromFormat('Y-m-d H.i', $date) == true) {
            return DateTime::createFromFormat('Y-m-d H.i', $date);
        } else if (DateTime::createFromFormat('Y-m', $date) == true) {
            return DateTime::createFromFormat('Y-m', $date);
        } else if (DateTime::createFromFormat('d-m-Y', $date) == true) {
            return DateTime::createFromFormat('d-m-Y', $date);
        } else if (DateTime::createFromFormat('Y-m-d', $date) == true) {
            return DateTime::createFromFormat('Y-m-d', $date);
        } else {
            return null;
        }
    }
}
