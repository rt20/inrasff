@extends('front.layouts.app')

@section('style')
@endsection

@section('body')
<section class="px-3 bg-cover lg:mx-auto mt-16 lg:mt-44" style="background-image: url({{ asset('seeder/slider_1.jpg') }});">
	<div class="container mx-auto pt-16 pb-8 lg:py-16">
		<div class="flex justify-between items-center">
			<div>
				<div class="text-xl text-white font-bold uppercase tracking-wide mb-5">About Us</div>
				<a href="{{ route('contactus') }}" class="hidden lg:block">
					<div class="text-sm bg-secondary px-8 py-4 rounded text-white font-regular uppercase tracking-wide border border-gray-600">Contact</div>
				</a>
			</div>
			<div class="text-sm text-white tracking-wide">
				<a href="#">Home</a> / <a href="javascript:void(0)" class="font-semibold">About Us</a>
			</div>
		</div>
		<div class="flex justify-center items-center mt-5 lg:hidden">
			<a href="{{ route('contactus') }}">
				<div class="text-sm bg-secondary px-5 py-3 rounded text-white font-xs uppercase tracking-wide border border-gray-600">Contact</div>
			</a>
		</div>
	</div>
</section>

<section class="container px-3 py-12 lg:mx-auto">
	<div class="text-xl font-bold mb-5">About Us</div>
	<div class="leading-normal">
		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
		<br>
		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
		<br>
		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
		<br>
		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
		<br>
		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
	</div>
</section>

<section class="bg-gray-100">
	<div class="container px-3 py-12 lg:mx-auto">
		<div class="text-xl font-bold mb-5">What we do</div>
		<div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
			<img src="{{ asset('seeder/slider_1.jpg') }}" class="w-full">
			<img src="{{ asset('seeder/slider_1.jpg') }}" class="w-full">
			<img src="{{ asset('seeder/slider_1.jpg') }}" class="w-full">
			<img src="{{ asset('seeder/slider_1.jpg') }}" class="w-full">
		</div>
	</div>
</section>
@endsection

@section('script')
@endsection