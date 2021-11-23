@extends('front.layouts.app')

@section('style')
@endsection

@section('body')
<section class="bg-gray-200 px-3 lg:mx-auto mt-16 lg:mt-44">
	<div class="container mx-auto text-center lg:text-left lg:flex lg:justify-between items-center py-8">
		<div class="text-xl font-bold uppercase tracking-wide mb-3 lg:mb-0">Berita</div>
		<div class="text-sm text-gray-500 tracking-wide">
			<a href="#">Home</a> / <a href="javascript:void(0)" class="font-semibold">Berita</a>
		</div>
	</div>
</section>
<section class="container px-3 lg:mx-auto py-8">
	<div class="grid grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-6 w-full pb-8">
		@if($news->count() > 0)
			@foreach($news as $data)
				<div>
					<img src="{{ $data->image ?  $data->getImage() : asset('seeder/image_1.jpg') }}" class="w-full pb-4">
					<a href="{{ route('news_detail', $data->slug)}}" class="font-semibold text-base leading-6">{{ $data->title }}</a>
					<div class="text-gray-500 text-sm py-3">{{ Carbon\Carbon::parse($data->created_at)->format('d M Y') }}</div>
				</div>
			@endforeach
		@else
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
		@endif
	</div>
	{{ $news->appends(Request::query())->onEachSide(1)->links('front.layouts.pagination') }}
	{{-- {{ $news->appends(Request::query())->onEachSide(1)->links('vendor.pagination.tailwind') }} --}}
</section>
@endsection

@section('script')
@endsection