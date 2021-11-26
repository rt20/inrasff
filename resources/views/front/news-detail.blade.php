@extends('front.layouts.app')

@section('style')
@endsection

@section('body')
<section class="px-3 lg:mx-auto mt-16 lg:mt-44">
	<div class="container mx-auto py-8">
		<div class="font-semibold text-2xl leading-normal">{{ $news->title }}</div>
		<div class="text-gray-500 text-sm pt-3 pb-7">{{ Carbon\Carbon::parse($news->published_at)->format('d M Y') }}</div>
		<img src="{{ $news->getImage() }}" class="w-full">
		<div class="leading-normal py-5">
			{!! $news->content !!}
		</div>
	</div>
</section>
<section class="container px-3 lg:mx-auto py-8">
	<div class="text-xl font-bold uppercase pb-6">Related Articles</div>
	<div class="grid grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-6 w-full pb-8">
		@if($relatedNews->count() > 0)
			@foreach($relatedNews as $data)
				<div>
					<img src="{{ $data->image ?  $data->getImage() : asset('seeder/image_1.jpg') }}" class="w-full pb-4 h-60 object-contain">
					<a href="{{ route('news_detail', $data->slug) }}" class="font-semibold text-base leading-6">{{ $data->title }}</a>
					<div class="text-gray-500 text-sm py-3">{{ Carbon\Carbon::parse($data->published_at)->format('d M Y') }}</div>
				</div>
			@endforeach
		@else
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
		@endif
	</div>
</section>
@endsection

@section('script')
@endsection