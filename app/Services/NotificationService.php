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
                'value' => '',
                'label' => 'Buah dan sayur (termasuk jamur, umbi, kacang termasuk kacang kedelai, dan lidah buaya), rumput laut, biji-bijian'
            ],
            [
                'value' => '',
                'label' => 'Daging dan produk daging, termasuk daging unggas dan daging hewan buruan'
            ],
            [
                'value' => '',
                'label' => 'Es untuk dimakan (edible ice, termasuk sherbet dan sorbet)'
            ],
            [
                'value' => '',
                'label' => 'Food contact material'
            ],
            [
                'value' => '',
                'label' => 'Garam, rempah, sup, saus, salad, produk protein'
            ],
            [
                'value' => '',
                'label' => 'Ikan dan produk perikanan termasuk moluska, krustase, ekinodermata, serta amfibi dan reptil'
            ],
            [
                'value' => '',
                'label' => 'Kembang gula/permen dan cokelat'
            ],
            [
                'value' => '',
                'label' => 'Lemak, minyak, dan emulsi minyak'
            ],
            [
                'value' => '',
                'label' => 'Makanan ringan siap santap'
            ],
            [
                'value' => '',
                'label' => 'Minuman, tidak termasuk produk susu'
            ],
            [
                'value' => '',
                'label' => 'Pakan'
            ],
            [
                'value' => '',
                'label' => 'Pangan campuran (komposit), tidak termasuk pangan dari kategori 01.0 sampai 15.0'
            ],
            [
                'value' => '',
                'label' => 'Pemanis termasuk madu'
            ],
            [
                'value' => '',
                'label' => 'Produk bakeri'
            ],
            [
                'value' => '',
                'label' => 'Produk pangan untuk keperluan gizi khusus'
            ],
            [
                'value' => '',
                'label' => 'Produk-produk susu dan analognya, kecuali yang termasuk kategori 02.0'
            ],
            [
                'value' => '',
                'label' => 'Serealia dan produk serelia yang merupakan produk turunan dari biji serealia, akar dan umbi, kacang dan empulur'
            ],
            [
                'value' => '',
                'label' => 'Telur dan produk-produk telur'
            ],
        ];
    }
}