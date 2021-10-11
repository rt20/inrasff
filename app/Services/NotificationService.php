<?php

namespace App\Services;


class NotificationService{
    public static function notificationStatus(){
        return [
            'border rejection' => [
                'value' => 'border rejection',
                'label' => 'Penolakan di Perbatasan - Border Rejection'
            ],
            'alert' => [
                'value' => 'alert',
                'label' => 'Waspada - Alert'
            ],
            'information' => [
                'value' => 'information',
                'label' => 'Informasi - Information'
            ],
            'news' => [
                'value' => 'news',
                'label' => 'Berita - News'
            ],
        ];
    }

    public static function notificationBase(){
        return [
            [
                'value' => 1,
                'label' => 'Border control - consignment detained'
            ],
            [
                'value' => 2,
                'label' => 'Border control - consignment released'
            ],
            [
                'value' => 3,
                'label' => 'Border control - consignment under customs'
            ],
            [
                'value' => 4,
                'label' => 'Border rejection'
            ],
            [
                'value' => 5,
                'label' => 'Consumer complaint'
            ],
            [
                'value' => 6,
                'label' => 'Follow-up / additional information'
            ],
            [
                'value' => 7,
                'label' => 'Hasil pengawasan mutu oleh perusahaan / company own check'
            ],
            [
                'value' => 8,
                'label' => 'Kajian surveilan pada rantai pangan'
            ],
            [
                'value' => 9,
                'label' => 'KLB Keracunan Pangan'
            ],
            [
                'value' => 10,
                'label' => 'Official control in the market'
            ],
            [
                'value' => 11,
                'label' => 'Pengawasan di perbatasan'
            ],
            [
                'value' => 12,
                'label' => 'Pengawasan pangan di pasar'
            ],
            [
                'value' => 13,
                'label' => 'Program monitoring ekspor'
            ],
            [
                'value' => 14,
                'label' => 'Program monitoring impor'
            ],
        ];
    }

    public static function notificationSource($source = 'domestic'){
        if ($source === 'domestic') {
            return [
                'balai besar' => [
                    'value' => 'balai besar',
                    'label' => 'Balai Besar / Balai BPOM'
                ],
                'karantina perikanan' => [
                    'value' => 'karantina perikanan',
                    'label' => 'Karantina Perikanan'
                ],
                'karantina pertanian' => [
                    'value' => 'karantina pertanian',
                    'label' => 'Karantina Pertanian'
                ],
                'pengaduan konsumen' => [
                    'value' => 'pengaduan konsumen',
                    'label' => 'Karantina Perikanan'
                ],
                'program surveilan' => [
                    'value' => 'program surveilan',
                    'label' => 'Program Surveilan'
                ],
            ];
        }

        return [
            'arasff' => [
                'value' => 'arasff',
                'label' => 'ARASFF'
            ],
            'eurasff' => [
                'value' => 'eurasff',
                'label' => 'EURASFF'
            ],
            'infosan' => [
                'value' => 'infosan',
                'label' => 'INFOSAN'
            ],
            'atase' => [
                'value' => 'atase',
                'label' => 'KBRI/Atase'
            ],
            'authority' => [
                'value' => 'authority',
                'label' => 'Otoritas keamanan pangan setempat'
            ],
        ];
    }

    public static function productCategory(){
        return [
            [
                'value' => 1,
                'label' => 'Bahan Tambahan Pangan'
            ],
            [
                'value' => 2,
                'label' => 'Buah dan sayur (termasuk jamur, umbi, kacang termasuk kacang kedelai, dan lidah buaya), rumput laut, biji-bijian'
            ],
            [
                'value' => 3,
                'label' => 'Daging dan produk daging, termasuk daging unggas dan daging hewan buruan'
            ],
            [
                'value' => 4,
                'label' => 'Es untuk dimakan (edible ice, termasuk sherbet dan sorbet)'
            ],
            [
                'value' => 5,
                'label' => 'Food contact material'
            ],
            [
                'value' => 6,
                'label' => 'Garam, rempah, sup, saus, salad, produk protein'
            ],
            [
                'value' => 7,
                'label' => 'Ikan dan produk perikanan termasuk moluska, krustase, ekinodermata, serta amfibi dan reptil'
            ],
            [
                'value' => 8,
                'label' => 'Kembang gula/permen dan cokelat'
            ],
            [
                'value' => 9,
                'label' => 'Lemak, minyak, dan emulsi minyak'
            ],
            [
                'value' => 10,
                'label' => 'Makanan ringan siap santap'
            ],
            [
                'value' => 11,
                'label' => 'Minuman, tidak termasuk produk susu'
            ],
            [
                'value' => 12,
                'label' => 'Pakan'
            ],
            [
                'value' => 13,
                'label' => 'Pangan campuran (komposit), tidak termasuk pangan dari kategori 01.0 sampai 15.0'
            ],
            [
                'value' => 14,
                'label' => 'Pemanis termasuk madu'
            ],
            [
                'value' => 15,
                'label' => 'Produk bakeri'
            ],
            [
                'value' => 16,
                'label' => 'Produk pangan untuk keperluan gizi khusus'
            ],
            [
                'value' => 17,
                'label' => 'Produk-produk susu dan analognya, kecuali yang termasuk kategori 02.0'
            ],
            [
                'value' => 18,
                'label' => 'Serealia dan produk serelia yang merupakan produk turunan dari biji serealia, akar dan umbi, kacang dan empulur'
            ],
            [
                'value' => 19,
                'label' => 'Telur dan produk-produk telur'
            ],
        ];
    }

    public static function categoryDangerous(){
        return [
            [
                'value' => 1,
                'label' => "Bahaya Kimia"
            ],
            [
                'value' => 2,
                'label' => "Bahaya Mikrobiologi"
            ],
            [
                'value' => 3,
                'label' => "Bahaya Fisik"
            ],
            [
                'value' => 4,
                'label' => "Mutu"
            ],
            [
                'value' => 5,
                'label' => "Dokumen"
            ],

        ];
    }

    public static function uomResult(){
        return [
            [
                'value' => 1,
                'label' => 'ppm',
            ],
            [
                'value' => 2,
                'label' => 'kol/g',
            ],
            [
                'value' => 3,
                'label' => 'g',
            ],
            [
                'value' => 4,
                'label' => 'buah',
            ],
            [
                'value' => 5,
                'label' => 'batang',
            ],
            [
                'value' => 6,
                'label' => 'ppb',
            ],
            [
                'value' => 7,
                'label' => '/25g',
            ],
            [
                'value' => 8,
                'label' => 'ng/g',
            ],
        ];
    }

    public static function distributionStatus(){
        return [
            [
                'value' => 1,
                'label' => 'Distribution on the Market (possible)',
            ],
            [
                'value' => 2,
                'label' => 'Distribution Restricted to Notifying Country',
            ],
            [
                'value' => 3,
                'label' => 'Distribution to Destination Under Customs Seals',
            ],
            [
                'value' => 4,
                'label' => 'Information on Distribution not (yet) Available',
            ],
            [
                'value' => 5,
                'label' => 'No Distribution',
            ],
            [
                'value' => 6,
                'label' => 'No Stock Left',
            ],
            [
                'value' => 7,
                'label' => 'Product Already Consumed',
            ],
            [
                'value' => 8,
                'label' => 'Product Expired (past best before date)',
            ],
            [
                'value' => 9,
                'label' => 'Product Expired (past use by date)',
            ],
        ];
    }
}