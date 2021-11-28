<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DangerousCategoryLevel as DCL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DangerousCategoryLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bahaya_kimia = 1;
        $bahaya_mikrobiologi = 2;
        $bahaya_fisik = 3;
        $mutu = 4;
        $dokumen = 5;
        $label = 6;

        Schema::disableForeignKeyConstraints();
        DB::table('dangerous_category_levels')->truncate();
        /**
         * Start Level 1
         */

        // Insert Bahaya Kimia
        DCL::insert([
            [
                'name' => 'Alergen',
                'level' => 1,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => null
            ],
            [
                'name' => 'Bahan Tambahan yang Dilarang',
                'level' => 1,
                'has_child' => true,
                'dc_id' => $bahaya_kimia,
                'parent_id' => null
            ],
            [
                'name' => 'BTP melebihi batas',
                'level' => 1,
                'has_child' => true,
                'dc_id' => $bahaya_kimia,
                'parent_id' => null
            ],
            [
                'name' => 'BTP yang tidak diizinkan (unauthorized food additive)',
                'level' => 1,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => null
            ],
            [
                'name' => 'Cemaran proses',
                'level' => 1,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => null
            ],
            [
                'name' => 'Genetically modified organisms (GMO)',
                'level' => 1,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => null
            ],
            [
                'name' => 'Logam Berat',
                'level' => 1,
                'has_child' => true,
                'dc_id' => $bahaya_kimia,
                'parent_id' => null
            ],
            [
                'name' => 'Residu Antibiotik',
                'level' => 1,
                'has_child' => true,
                'dc_id' => $bahaya_kimia,
                'parent_id' => null
            ],
            [
                'name' => 'Residu obat hewan',
                'level' => 1,
                'has_child' => true,
                'dc_id' => $bahaya_kimia,
                'parent_id' => null
            ],
            [
                'name' => 'Residu Pestisida',
                'level' => 1,
                'has_child' => true,
                'dc_id' => $bahaya_kimia,
                'parent_id' => null
            ],
            [
                'name' => 'Toksin',
                'level' => 1,
                'has_child' => true,
                'dc_id' => $bahaya_kimia,
                'parent_id' => null
            ],

            
        ]);

        // Insert Bahaya Mikrobiologi
        DCL::insert([
            [
                'name' => 'Uji Biologi/Mikrobiologi',
                'level' => 1,
                'has_child' => true,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => null
            ],
        ]);

        // Insert Bahaya Fisik
        DCL::insert([
            [
                'name' => 'Pecahan Kaca',
                'level' => 1,
                'has_child' => false,
                'dc_id' => $bahaya_fisik,
                'parent_id' => null
            ],
            [
                'name' => 'Serpihan Logam',
                'level' => 1,
                'has_child' => false,
                'dc_id' => $bahaya_fisik,
                'parent_id' => null
            ],
        ]);

        // Insert Dokumen
        DCL::insert([
            [
                'name' => 'Tidak Sesuai',
                'level' => 1,
                'has_child' => false,
                'dc_id' => $dokumen,
                'parent_id' => null
            ],
            [
                'name' => 'Tidak Lengkap',
                'level' => 1,
                'has_child' => false,
                'dc_id' => $dokumen,
                'parent_id' => null
            ],
        ]);

        /** 
         * End of Level 1
         */

        /**
         * Start of Level 2
        */

        $btyd = DCL::where('name', 'Bahan Tambahan yang Dilarang')->first()->id;

        DCL::insert([
            [
                'name' => 'Boraks',
                'level' => 2,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $btyd
            ],
            [
                'name' => 'Formalin',
                'level' => 2,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $btyd
            ],
            [
                'name' => 'Metanil Yellow',
                'level' => 2,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $btyd
            ],
            [
                'name' => 'Rhodamin B',
                'level' => 2,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $btyd
            ],
        ]);

        $btpmb = DCL::where('name', 'BTP melebihi batas')->first()->id;

        DCL::insert([
            [
                'name' => 'Pemanis',
                'level' => 2,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $btpmb
            ],
            [
                'name' => 'Pengawet',
                'level' => 2,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $btpmb
            ],
        ]);

        $lb = DCL::where('name', 'Logam Berat')->first()->id;

        DCL::insert([
            [
                'name' => 'Antimoni (Sb)',
                'level' => 2,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $lb
            ],
            [
                'name' => 'Arsenik (As)',
                'level' => 2,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $lb
            ],
            [
                'name' => 'Besi (Fe)',
                'level' => 2,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $lb
            ],
            [
                'name' => 'Kadmium (Cd)',
                'level' => 2,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $lb
            ],
            [
                'name' => 'Merkuri (Hg)',
                'level' => 2,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $lb
            ],
            [
                'name' => 'Seng (Zn)',
                'level' => 2,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $lb
            ],
            [
                'name' => 'Tembaga (Cu)',
                'level' => 2,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $lb
            ],
            [
                'name' => 'Timah (Sn)',
                'level' => 2,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $lb
            ],
            [
                'name' => 'Timbal (Pb)',
                'level' => 2,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $lb
            ],
        ]);

        $ra = DCL::where('name', 'Residu Antibiotik')->first()->id;

        DCL::insert([
            [
                'name' => 'Kloramfenikol',
                'level' => 2,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $ra
            ],
        ]);

        $roh = DCL::where('name', 'Residu obat hewan')->first()->id;

        DCL::insert([
            [
                'name' => 'Malachite green',
                'level' => 2,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $roh
            ],
        ]);

        $rp = DCL::where('name', 'Residu Pestisida')->first()->id;

        DCL::insert([
            [
                'name' => 'Hidrokarbon terklorinasi / organoklorin',
                'level' => 2,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $rp
            ],
            [
                'name' => 'Karbamat',
                'level' => 2,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $rp
            ],
            [
                'name' => 'Organophosphat',
                'level' => 2,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $rp
            ],
            [
                'name' => 'Pyretroid',
                'level' => 2,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $rp
            ],
        ]);

        $t = DCL::where('name', 'Toksin')->first()->id;

        DCL::insert([
            [
                'name' => 'Kontaminan Lainnya',
                'level' => 2,
                'has_child' => true,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $t
            ],
            [
                'name' => 'Racun Bakteri',
                'level' => 2,
                'has_child' => true,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $t
            ],
            [
                'name' => 'Racun Ikan dan Kerang',
                'level' => 2,
                'has_child' => true,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $t
            ],
            [
                'name' => 'Racun Jamur',
                'level' => 2,
                'has_child' => true,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $t
            ],
        ]);

        $ubm = DCL::where('name', 'Uji Biologi/Mikrobiologi')->first()->id;

        DCL::insert([
            [
                'name' => 'Bakteri',
                'level' => 2,
                'has_child' => true,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $ubm
            ],
            [
                'name' => 'Protozoa Parasit dan Cacing',
                'level' => 2,
                'has_child' => true,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $ubm
            ],
            [
                'name' => 'Virus',
                'level' => 2,
                'has_child' => true,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $ubm
            ],
        ]);

        /** 
         * End of Level 2
         */

         /**
          * Start of Level 3
          */

          $kl = DCL::where('name', 'Kontaminan Lainnya')->first()->id;

          DCL::insert([
              [
                  'name' => 'Alkaloid Tropane',
                  'level' => 3,
                  'has_child' => false,
                  'dc_id' => $bahaya_kimia,
                  'parent_id' => $kl
              ],
              [
                  'name' => 'Histamin',
                  'level' => 3,
                  'has_child' => false,
                  'dc_id' => $bahaya_kimia,
                  'parent_id' => $kl
              ],
              [
                  'name' => 'Metanol',
                  'level' => 3,
                  'has_child' => false,
                  'dc_id' => $bahaya_kimia,
                  'parent_id' => $kl
              ],

              [
                'name' => 'Nitrit',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $kl
            ],

            [
                'name' => 'Sianida',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $kl
            ],

            [
                'name' => 'Vitamin, sodium nikotin sebagai pengawet pewarna',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $kl
            ],
          ]);

          $rb = DCL::where('name', 'Racun Bakteri')->first()->id;

          DCL::insert([
              [
                  'name' => 'Asam Bongkrek',
                  'level' => 3,
                  'has_child' => false,
                  'dc_id' => $bahaya_kimia,
                  'parent_id' => $rb
              ],
              [
                  'name' => 'Botulin',
                  'level' => 3,
                  'has_child' => false,
                  'dc_id' => $bahaya_kimia,
                  'parent_id' => $rb
              ],
              [
                'name' => 'Enteroktosin B. cereus',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $rb
            ],
            [
                'name' => 'Enteroktosin C. perfringens',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $rb
            ],
            [
                'name' => 'Enteroktosin S. aureus',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $rb
            ],
            [
                'name' => 'Enteroktosin V. cholerae O1',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $rb
            ],
            [
                'name' => 'Neurotoksin dari C. botulinum',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $rb
            ],
            [
                'name' => 'Toxoflavin',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $rb
            ],
          ]);

          $rik = DCL::where('name', 'Racun Ikan dan Kerang')->first()->id;

          DCL::insert([
            [
                'name' => 'Asam okadaik',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $rik
            ],
            [
                'name' => 'Ciguatera poisoning',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $rik
            ],
            [
                'name' => 'Ciguatoksin',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $rik
            ],
            [
                'name' => 'Saksitoksin',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $rik
            ],
            [
                'name' => 'Tetrodotoksin',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $rik
            ],
          ]);
        
        
        $rj = DCL::where('name', 'Racun Jamur')->first()->id;

        DCL::insert([
            [
                'name' => 'Amatoksin',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $rj
            ],
            [
                'name' => 'Ibotenic acid',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $rj
            ],
            [
                'name' => 'Mikotoksin',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $rj
            ],
            [
                'name' => 'Muscarin',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $rj
            ],
            [
                'name' => 'Muscimol',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $rj
            ],
            [
                'name' => 'Palatoksin',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_kimia,
                'parent_id' => $rj
            ],
        ]);

        $b = DCL::where('name', 'Bakteri')->first()->id;

        DCL::insert([
            [
                'name' => 'Aeromonas hidrophila spp',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Bacillus anthracis',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Bacillus cereus',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Brucella melitenisis',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Brucella spp.',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Brucella suis',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Campylobacter jejuni',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Clostridium botulinum',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Clostridium perfringens',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Coxiella burnetti',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'E. coli',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Enterobacter sakazakii',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Escherichia coli enteroinvasive (EIEC)',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Escherichia coli enteropathogenic (EPEC)',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Escherichia coli enterotoxigenic (ETEC)',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Escherichia coli O157:H7 enterohemorrhagic (EHEC)',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Listeria monocytogenes',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Mycobacterium bovis',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Plesiomonas shigelloides',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Salmonella spp',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Salmonella typhi (typhoid)',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Shigella spp',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Staphylococcus aureus',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Streptococcus pyogenes',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Vibrio cholerae non-O1',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Vibrio cholerae O1',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Vibrio parahaemolyticus',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
            [
                'name' => 'Vibrio vulnificus',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],

            [
                'name' => 'Yersinia enterocolitica',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],

            [
                'name' => 'Yersinia pseudotuberculosis',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $b
            ],
        ]);

        $ppc = DCL::where('name', 'Protozoa Parasit dan Cacing')->first()->id;
        
        DCL::insert([
            [
                'name' => 'Acanthamoeba',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $ppc
            ],
            [
                'name' => 'Angiostrongylus cantonensis',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $ppc
            ],
            [
                'name' => 'Anisakis sp.',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $ppc
            ],
        ]);


        $v = DCL::where('name', 'Virus')->first()->id;
        DCL::insert([
            [
                'name' => 'Adenoviruses',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $v
            ],
            [
                'name' => 'Coxackie viruses',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $v
            ],
            [
                'name' => 'Echoviruses',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $v
            ],
            [
                'name' => 'Hepatitis A',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $v
            ],
            [
                'name' => 'Hepatitis E',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $v
            ],
            [
                'name' => 'Reoviruses',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $v
            ],
            [
                'name' => 'Rotavirus',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $v
            ],
            [
                'name' => 'Virus Norwalk',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $v
            ],
            [
                'name' => 'Virus polio',
                'level' => 3,
                'has_child' => false,
                'dc_id' => $bahaya_mikrobiologi,
                'parent_id' => $v
            ],
        ]);
          /**
          * End of Level 3
          */


        Schema::enableForeignKeyConstraints();
    }
}
