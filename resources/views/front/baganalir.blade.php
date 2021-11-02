@extends('front.layouts.app')

@section('style')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<link href="https://fonts.googleapis.com/css?family=Source+Code+Pro|Roboto&display=swap" rel="stylesheet">
@endsection

@section('body')
<section class="px-3 bg-cover lg:mx-auto mt-16 lg:mt-44" style="background-image: url({{ asset('seeder/slider_1.jpg') }});">
	<div class="container mx-auto pt-16 pb-8 lg:py-16">
		<div class="text-center lg:text-left lg:flex lg:justify-between lg:items-center">
			<div>
				<div class="text-xl text-white font-bold uppercase tracking-wide mb-5">About Us</div>
			</div>
			<div class="text-sm text-white tracking-wide">
				<a href="#">Home</a> / <a href="javascript:void(0)" class="font-semibold">About Us</a>
			</div>
		</div>
	</div>
</section>

<section class="bg-white">
	<div class="container px-3 py-12 lg:mx-auto">
		<div class="text-xl font-bold mb-5">Bagan Alir Penerapan INRASFF</div>
		<div class="mx-auto text-center w-full">
			<img src="http://inrasff.net/images/banner/140/gmbr3.gif" class="w-full">
		</div>
	</div>
</section>
@endsection

@section('script')
@endsection