@extends('front.layouts.app')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/slick/slick/slick.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/slick/slick/slick-theme.css') }}"/>
<link rel="stylesheet" href="{{ asset('vendors/magnific-popup/dist/magnific-popup.css') }}">
@endsection

@section('body')
<section class="container px-3 lg:mx-auto mt-16 lg:mt-44">
	<div class="flex items-center py-3 text-center leading-5">
		<div class="text-white bg-tertiary rounded uppercase px-3 py-1 font-semibold mr-3">
			breaking news
		</div>
		<div class="text-tertiary leading-5">
			Apa itu konteks dan mengapa hal itu penting dalam pembuatan produk digital?
		</div>
	</div>
</section>

<section class="container mx-auto mb-8">
	{{-- <div class="aspect-h-10 aspect-w-16">
		<img src="{{ asset('seeder/slider_1.jpg') }}" alt="..." class="w-full h-full object-cover" />
	</div> --}}
</section>

<section class="w-full bg-secondary">
	<div class="container px-3 lg:mx-auto py-10">
		<img src="{{ asset('images/klik_banner.png') }}" class="w-full">
	</div>
</section>

<section class="container px-3 lg:mx-auto w-full py-6">
	<div class="text-xl font-bold uppercase py-6">Berita Terbaru</div>
	<div class="grid grid-cols-1 lg:grid-cols-6 gap-6 w-full">
		<div class="lg:col-span-4">
			<img src="{{ asset('seeder/image_4.jpg') }}" class="w-full">
			<button class="text-white bg-tertiary rounded px-6 py-2 my-6 font-semibold text-xs">World</button>
			<div class="font-semibold text-2xl leading-normal">Apa itu Konteks dan mengapa hal itu penting dalam pembuatan produk digital?</div>
			<div class="text-gray-500 text-sm py-3">2 September 2021</div>
			<div class="text-gray-400 text-sm pb-6 leading-normal">
				Bayangkan jika saat Anda di mini market, membawa banyak barang dan saat tiba di kasir, sang kasir malah menaruh kembali barang barang Anda di rak seperti semula, tanpa memberitahu alasannya...
			</div>

			<div class="grid grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-6 w-full">
				@for($i=1;$i<=2;$i++)
				<div>
					<img src="{{ asset('seeder/image_1.jpg') }}" class="w-full">
					<a href="{{ route('news_detail', 1) }}" class="font-semibold text-base leading-6">Apa itu Konteks dan mengapa hal itu penting dalam pembuatan produk digital?</a>
					<div class="text-gray-500 text-sm py-3">2 September 2021</div>
				</div>
				<div>
					<img src="{{ asset('seeder/image_2.jpg') }}" class="w-full">
					<a href="{{ route('news_detail', 1) }}" class="font-semibold text-base leading-6">Apa itu Konteks dan mengapa hal itu penting dalam pembuatan produk digital?</a>
					<div class="text-gray-500 text-sm py-3">2 September 2021</div>
				</div>
				<div>
					<img src="{{ asset('seeder/image_3.jpg') }}" class="w-full">
					<a href="{{ route('news_detail', 1) }}" class="font-semibold text-base leading-6">Apa itu Konteks dan mengapa hal itu penting dalam pembuatan produk digital?</a>
					<div class="text-gray-500 text-sm py-3">2 September 2021</div>
				</div>
				@endfor
			</div>
		</div>

		<div class="lg:col-span-2">

			<div class="text-base font-semibold mb-5">Supported By</div>
			<div class="grid grid-cols-3 gap-4 mb-8">
				<div class="bg-gray-100 p-3 rounded">
					<a href="http://www.pom.go.id/">
						<img src="{{ asset('images/logo_bpom.png') }}" class="w-full">
					</a>
				</div>
				<div class="bg-gray-100 p-3 rounded">
					<a href="https://www.kemenkeu.go.id/">
						<img src="{{ asset('images/logo_kemenkeu.png') }}" class="w-full">
					</a>
				</div>
				<div class="bg-gray-100 p-3 rounded">
					<a href="http://www.kemendag.go.id/">
						<img src="{{ asset('images/logo_kemendag.png') }}" class="w-full">
					</a>
				</div>
				<div class="bg-gray-100 p-3 rounded">
					<a href="http://www.pertanian.go.id/">
						<img src="{{ asset('images/logo_kemen_pertanian.png') }}" class="w-full">
					</a>
				</div>
				<div class="bg-gray-100 p-3 rounded">
					<a href="http://www.kemenperin.go.id/">
						<img src="{{ asset('images/logo_kemenperin.png') }}" class="w-full">
					</a>
				</div>
				<div class="bg-gray-100 p-3 rounded">
					<a href="http://www.kkp.go.id/">
						<img src="{{ asset('images/logo_kkp.png') }}" class="w-full">
					</a>
				</div>
				<div class="bg-gray-100 p-3 rounded">
					<a href="http://www.depkes.go.id/">
						<img src="{{ asset('images/logo_kemenkes.png') }}" class="w-full">
					</a>
				</div>
			</div>

			<div class="text-base font-semibold mb-5">Maklumat Pelayanan</div>
			<img src="{{ asset('images/maklumat_pelayanan.jpg') }}" class="w-full mb-8">

			<div class="text-base font-semibold mb-5">Categories</div>
			<ul class="list-disc list-inside space-y-3 mb-8" style="column-count: 2;">
				@for($i=1;$i<=14;$i++)
				<li><a href="{{ route('news_detail',1) }}">Category {{ $i }}</a></li>
				@endfor
			</ul>

			<div class="text-base font-semibold mb-5">Pictures</div>
			<div class="grid grid-cols-5 gap-1">
				@for($i=1;$i<=5;$i++)
				<a href="{{ route('home') }}">
					<img src="{{ asset('seeder/image_1.jpg') }}" class="w-full rounded">
				</a>
				<a href="{{ route('home') }}">
					<img src="{{ asset('seeder/image_2.jpg') }}" class="w-full rounded">
				</a>
				<a href="{{ route('home') }}">
					<img src="{{ asset('seeder/image_3.jpg') }}" class="w-full rounded">
				</a>
				@endfor
			</div>
		</div>
	</div>
</section>

<section class="bg-gray-100 py-8">
	<div class="container px-3 lg:mx-auto">
		<div class="text-xl font-bold uppercase pb-6">statistik</div>
		<img src="{{ asset('images/statistik.png') }}" class="w-full rounded">
	</div>
</section>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('vendors/slick/slick/slick.min.js') }}"></script>
<script src="{{ asset('vendors/magnific-popup/dist/jquery.magnific-popup.min.js') }}"></script>
@endsection