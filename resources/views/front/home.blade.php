@extends('front.layouts.app')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/slick/slick/slick.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/slick/slick/slick-theme.css') }}"/>
<link rel="stylesheet" href="{{ asset('vendors/magnific-popup/dist/magnific-popup.css') }}">
@endsection

@section('body')
<section class="container px-3 lg:mx-auto mt-16 lg:mt-44">
	<div class="flex items-center py-3 text-center leading-5">
		<div class="text-white bg-red-500 rounded uppercase px-3 py-1 font-semibold mr-3">
			breaking news
		</div>
		<div class="text-red-500 leading-5">
			Apa itu konteks dan mengapa hal itu penting dalam pembuatan produk digital?
		</div>
	</div>
</section>

<section class="container">
	
</section>

<section class="w-full bg-gray-600">
	<div class="container px-3 lg:mx-auto py-10">
		<div class="bg-gray-500 h-60 w-full"></div>
	</div>
</section>

<section class="container px-3 lg:mx-auto w-full py-6">
	<div class="text-xl font-bold uppercase py-6">berita terbaru</div>
	<div class="lg:grid lg:grid-cols-6 lg:gap-6 w-full">
		<div class="col-span-4">
			<div class="bg-gray-300 h-96 w-full"></div>
			<button class="text-white bg-red-500 rounded px-6 py-2 my-6 font-semibold text-xs">World</button>
			<div class="font-semibold text-2xl leading-normal">Apa itu Konteks dan mengapa hal itu penting dalam pembuatan produk digital?</div>
			<div class="text-gray-500 text-sm py-3">2 September 2021</div>
			<div class="text-gray-400 text-sm pb-6 leading-normal">
				Bayangkan jika saat Anda di mini market, membawa banyak barang dan saat tiba di kasir, sang kasir malah menaruh kembali barang barang Anda di rak seperti semula, tanpa memberitahu alasannya...
			</div>

			<div class="lg:grid lg:grid-cols-3 lg:gap-6 w-full">
				@for($i=1;$i<=6;$i++)
				<div>
					<div class="bg-gray-300 h-44 w-full mb-3"></div>
					<a href="#" class="font-semibold text-base leading-6">Apa itu Konteks dan mengapa hal itu penting dalam pembuatan produk digital?</a>
					<div class="text-gray-500 text-sm py-3">2 September 2021</div>
				</div>
				@endfor
			</div>
		</div>

		<div class="col-span-2">

			<div class="text-base font-semibold mb-5">Supported By</div>
			<div class="grid grid-cols-3 gap-4 mb-8">
				<div class="bg-gray-300 h-28 w-full"></div>
				<div class="bg-gray-300 h-28 w-full"></div>
				<div class="bg-gray-300 h-28 w-full"></div>
			</div>

			<div class="text-base font-semibold mb-5">Maklumat Pelayanan</div>
			<div class="bg-gray-300 h-60 w-full mb-8"></div>

			<div class="text-base font-semibold mb-5">Categories</div>
			<ul class="list-disc list-inside space-y-3 mb-8" style="column-count: 2;">
				@for($i=1;$i<=14;$i++)
				<li><a href="#">Category {{ $i }}</a></li>
				@endfor
			</ul>

			<div class="text-base font-semibold mb-5">Pictures</div>
			<div class="grid grid-cols-5 gap-2">
				@for($i=1;$i<=15;$i++)
				<div class="bg-gray-300 h-16 w-full"></div>
				@endfor
			</div>
		</div>
	</div>
</section>

<section class="bg-gray-200 py-8">
	<div class="container px-3 lg:mx-auto">
		<div class="text-xl font-bold uppercase pb-6">statistik</div>
		<div class="bg-gray-300 h-96 w-full"></div>
	</div>
</section>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('vendors/slick/slick/slick.min.js') }}"></script>
<script src="{{ asset('vendors/magnific-popup/dist/jquery.magnific-popup.min.js') }}"></script>
@endsection