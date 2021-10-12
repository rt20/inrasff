@extends('front.layouts.app')

@section('style')
@endsection

@section('body')
<section class="px-3 lg:mx-auto mt-16 lg:mt-44">
	<div class="container mx-auto py-8">
		<div class="font-semibold text-2xl leading-normal">Apa itu Konteks dan mengapa hal itu penting dalam pembuatan produk digital?</div>
		<div class="text-gray-500 text-sm pt-3 pb-7">2 September 2021</div>
		<img src="{{ asset('seeder/image_5.jpg') }}" class="w-full">
		<div class="leading-normal py-5">
			<p>Apa itu konteks?<br>
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
			<p>Pada kondisi 2, konteksnya adalah… Budi melakukan login, karena saat melakukan proses pemesanan barang, sistem mendeteksi bahwa budi belum login, sehingga sistem meminta budi untuk melakukan login agar bisa melanjutkan proses pemesanan.</p>
		</div>
	</div>
</section>
<section class="container px-3 lg:mx-auto py-8">
	<div class="text-xl font-bold uppercase pb-6">Related Articles</div>
	<div class="grid grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-6 w-full pb-8">
		@for($i=1;$i<=1;$i++)
		<div>
			<img src="{{ asset('seeder/image_1.jpg') }}" class="w-full pb-4">
			<a href="{{ route('news_detail', 1) }}" class="font-semibold text-base leading-6">Apa itu Konteks dan mengapa hal itu penting dalam pembuatan produk digital?</a>
			<div class="text-gray-500 text-sm py-3">2 September 2021</div>
		</div>
		<div>
			<img src="{{ asset('seeder/image_2.jpg') }}" class="w-full pb-4">
			<a href="{{ route('news_detail', 1) }}" class="font-semibold text-base leading-6">Apa itu Konteks dan mengapa hal itu penting dalam pembuatan produk digital?</a>
			<div class="text-gray-500 text-sm py-3">2 September 2021</div>
		</div>
		<div>
			<img src="{{ asset('seeder/image_3.jpg') }}" class="w-full pb-4">
			<a href="{{ route('news_detail', 1) }}" class="font-semibold text-base leading-6">Apa itu Konteks dan mengapa hal itu penting dalam pembuatan produk digital?</a>
			<div class="text-gray-500 text-sm py-3">2 September 2021</div>
		</div>
		<div>
			<img src="{{ asset('seeder/image_1.jpg') }}" class="w-full pb-4">
			<a href="{{ route('news_detail', 1) }}" class="font-semibold text-base leading-6">Apa itu Konteks dan mengapa hal itu penting dalam pembuatan produk digital?</a>
			<div class="text-gray-500 text-sm py-3">2 September 2021</div>
		</div>
		@endfor
	</div>
</section>
@endsection

@section('script')
@endsection