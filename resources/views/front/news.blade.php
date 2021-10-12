@extends('front.layouts.app')

@section('style')
@endsection

@section('body')
<section class="bg-gray-200 px-3 lg:mx-auto mt-16 lg:mt-44">
	<div class="container mx-auto flex justify-between items-center py-8">
		<div class="text-xl font-bold uppercase tracking-wide">Berita</div>
		<div class="text-sm text-gray-500 tracking-wide">
			<a href="#">Home</a> / <a href="javascript:void(0)" class="font-semibold">Berita</a>
		</div>
	</div>
</section>
<section class="container px-3 lg:mx-auto py-8">
	<div class="grid grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-6 w-full pb-8">
		@for($i=1;$i<=4;$i++)
		<div>
			<img src="{{ asset('seeder/image_1.jpg') }}" class="w-full pb-4">
			<a href="{{ route('news_detail',1) }}" class="font-semibold text-base leading-6">Apa itu Konteks dan mengapa hal itu penting dalam pembuatan produk digital?</a>
			<div class="text-gray-500 text-sm py-3">2 September 2021</div>
		</div>
		<div>
			<img src="{{ asset('seeder/image_2.jpg') }}" class="w-full pb-4">
			<a href="{{ route('news_detail',1) }}" class="font-semibold text-base leading-6">Apa itu Konteks dan mengapa hal itu penting dalam pembuatan produk digital?</a>
			<div class="text-gray-500 text-sm py-3">2 September 2021</div>
		</div>
		<div>
			<img src="{{ asset('seeder/image_3.jpg') }}" class="w-full pb-4">
			<a href="{{ route('news_detail',1) }}" class="font-semibold text-base leading-6">Apa itu Konteks dan mengapa hal itu penting dalam pembuatan produk digital?</a>
			<div class="text-gray-500 text-sm py-3">2 September 2021</div>
		</div>
		@endfor
	</div>
	<div class="text-center flex gap-5 justify-center items-center">
		<a href="#" class="flex items-center h-7 w-7 justify-center rounded-full hover:bg-blue-400 hover:text-white text-blue-800 p-1"><</a>
		<a href="#" class="flex items-center h-7 w-7 justify-center rounded-full hover:bg-blue-400 hover:text-white bg-blue-800 text-white p-1">1</a>
		<a href="#" class="flex items-center h-7 w-7 justify-center rounded-full hover:bg-blue-400 hover:text-white text-blue-800 p-1">2</a>
		<a href="#" class="flex items-center h-7 w-7 justify-center rounded-full hover:bg-blue-400 hover:text-white text-blue-800 p-1">3</a>
		<a href="#" class="flex items-center h-7 w-7 justify-center rounded-full hover:bg-blue-400 hover:text-white text-blue-800 p-1">4</a>
		<a href="#" class="flex items-center h-7 w-7 justify-center rounded-full hover:bg-blue-400 hover:text-white text-blue-800 p-1">5</a>
		<a href="#" class="flex items-center h-7 w-7 justify-center rounded-full hover:bg-blue-400 hover:text-white text-blue-800 p-1">></a>
	</div>
</section>
@endsection

@section('script')
@endsection