<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for($i=1;$i<=36;$i++) {
		    News::insert([
		        [
		            'title' => 'Apa itu Konteks dan mengapa hal itu penting dalam pembuatan produk digital?',
		            'slug' => 'apa_itu_konteks_dan_mengapa_hal_itu_penting_dalam_pembuatan_produk_digital_'.$i,
		            'content' => '<p>Apa itu konteks?<br>
			Menurut wikipedia, Konteks adalah kondisi di mana suatu keadaan terjadi. Hmmm…. oke agak membingungkan :)) , mari gunakan contoh.</p>
			<br>
			<p>Contoh 1:<br>
			Anda berada di mini market, Anda mengambil beberapa barang, Anda membawanya ke kasir, lalu anda membayar dan pulang. Maka konteks dari kegiatan Anda tadi adalah proses membeli barang dengan tujuan mendapatkan barang.</p>
			<br>
			<p>Contoh 2:<br>
			Anda berada di rumah makan, Anda melihat menu, Anda bilang apa makanan yang Anda inginkan, dan kemudian makanan Anda datang. Maka konteks dari kegiatan Anda tadi adalah proses memesan makanan dengan tujuan mendapatkan makanan.</p>
			<br>
			<p>Sebagai designer, dalam membuat sebuah produk digital, banyak sekali konteks yang harus kita pikirkan.
			Kita ambil contoh fitur login di online shop. Fitur login adalah fitur yang digunakan user untuk masuk ke dalam akun nya. Dalam mengakses fitur login ada beberapa kondisi:</p>
			<br>
			<p>Kondisi 1:<br>
			Budi membuka suatu website online shop, lalu melakukan login, dengan tujuan ingin melihat status pengiriman barang yang kemaren dibelinya dan juga ingin mengedit data profile nya. Jadi konteks pada kondisi 1 adalah… Budi melakukan login dengan tujuan melihat status pengiriman barang.</p>
			<br>
			<p>Kondisi 2:<br>
			Budi membuka suatu website online shop, lalu memilih barang, lalu melakukan checkout, Karena Budi belum login maka untuk melanjutkan proses pemesanan barang, sistem dari website tersebut meminta Budi untuk login, agar datanya bisa tersimpan di akun Budi.</p>
			<br>
			<p>Pada kondisi 2, konteksnya adalah… Budi melakukan login, karena saat melakukan proses pemesanan barang, sistem mendeteksi bahwa budi belum login, sehingga sistem meminta budi untuk melakukan login agar bisa melanjutkan proses pemesanan.</p>',
		        ],
		    ]);
    	}
    }
}
