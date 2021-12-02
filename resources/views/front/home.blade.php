@extends('front.layouts.app')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/slick/slick/slick.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/slick/slick/slick-theme.css') }}"/>
<link rel="stylesheet" href="{{ asset('vendors/magnific-popup/dist/magnific-popup.css') }}">
{{-- <style type="text/css">	
	.slick-slide {
		padding: 0 10px;
	}
	.slick-list {
		padding: 0 -10px;
	}
	.slider-image {
	    position:relative;
	}
	.slider-image img {
	    width:100%;
	    vertical-align:top;
	}
	.slider-image:after, .slider-image:before {
	    position:absolute;
	    opacity:0;
	    transition: all 0.5s;
	    -webkit-transition: all 0.5s;
	}
	.slider-image:after {
	    content:'\A';
	    width:100%; height:100%;
	    top:0; left:0;
	    background:rgba(0,0,0,0.6);
	    opacity:1;
	}
	.slider-image:before {
	    content:'\A';
	    width:100%;
	    color:#fff;
	    z-index:1;
	    bottom:0;
	    padding:4px 10px;
	    text-align:center;
	    box-sizing:border-box;
	    -moz-box-sizing:border-box;
	    opacity:1;
	}
	@media only screen and (min-width: 600px) {
		.slick-slide {
			padding: 0 17px;
		}
		.slick-list {
			padding: 0 -17px;
		}
	}
</style> --}}
<style type="text/css">
	.slider .slick-prev {
	    left: 0;
	    z-index: 1;
	}
	.slider .slick-prev:before {
	    content: '<';
	}
	.slider .slick-next {
	    right: 6%;
	}
	.slider .slick-next:before {
	    content: '>';
	}
	.slider .slick-prev:before, .slider .slick-next:before {
	    font-size: 20px;
	    font-weight: bold;
	    color: #FFF;
	    background-color: rgba(0,0,0,0.5);
	    padding: 2rem 1rem;
	}

	@media only screen and (min-width: 600px) {
		.slider .slick-next {
		    right: 2%;
		}
	}
</style>
@endsection

@section('body')
<section class="container px-3 lg:mx-auto mt-20 lg:mt-44">
	<div class="flex items-center py-3 leading-5 mt-3">
		<div class="flex text-xs lg:text-base text-white bg-tertiary rounded uppercase px-2 lg:px-3 py-1 font-semibold text-center mx-auto">
			<span class="mr-1">breaking</span> 
			<span>news</span>
		</div>
		<marquee direction="left" class="text-tertiary text-left">
			@if($runningText->count() > 0)
				@foreach($runningText as $data)
				<span>{{ $data->title }}</span> @if(!$loop->last) <span class="mx-5"> | </span> @endif
				@endforeach
			@else
				Apa itu Konteks dan mengapa hal itu penting dalam pembuatan produk digital?
			@endif
		</marquee>
	</div>
</section>


<section class="container px-3 pb-5 lg:mx-auto">
	<div class="slider">
		@if($slider)
			@if($slider->sliderImage->count() > 0)
				@foreach($slider->sliderImage as $data)
					<img src="{{ $data->getRefAttribute() }}" class="w-full h-96 object-cover">
				@endforeach
			@else
				<img src="{{ asset('seeder/slider_3.jpg') }}" class="w-full">
				<img src="{{ asset('seeder/slider_1.jpg') }}" class="w-full">
				<img src="{{ asset('seeder/slider_2.jpg') }}" class="w-full">
				<img src="{{ asset('seeder/slider_3.jpg') }}" class="w-full">
				<img src="{{ asset('seeder/slider_1.jpg') }}" class="w-full">
			@endif
		@else
			<img src="{{ asset('seeder/slider_3.jpg') }}" class="w-full">
			<img src="{{ asset('seeder/slider_1.jpg') }}" class="w-full">
			<img src="{{ asset('seeder/slider_2.jpg') }}" class="w-full">
			<img src="{{ asset('seeder/slider_3.jpg') }}" class="w-full">
			<img src="{{ asset('seeder/slider_1.jpg') }}" class="w-full">
		@endif
	</div>
</section>

{{-- <section class="mb-0 lg:mb-8">
	<div class="slick">
		@if($slider->count() > 0)
			@foreach($slider as $data)
			<div>
				<div class="bg-cover relative">
					<div class="slider-image h-96 object-contain">
						<img src="{{ $data->getImage() }}" class="w-full">
					</div>
					<div class="absolute bottom-0 left-0 w-full lg:w-1/2 pl-5 pb-10">
						<button class="text-white bg-tertiary rounded px-6 py-2 mb-3 font-semibold text-xs">{{ $data->category->name }}</button>
						<div class="font-semibold text-base leading-6 text-white mb-3">{{ $data->title }}</div>
						<div class="text-gray-300 text-sm pb-5 mb-3">{{ Carbon\Carbon::parse($data->published_at)->format('d M Y') }}</div>
						<a class="border rounded border-white px-5 py-2 text-white hover:bg-black hover:opacity-50" href="{{ route('news_detail', $data->slug) }}">Read Story</a>
					</div>
				</div>
			</div>
			@endforeach
		@else
			@for($i=1;$i<=3;$i++)
			<div>
				<div class="bg-cover relative">
					<img src="{{ asset('seeder/slider_1.jpg') }}" class="w-full">
					<div class="absolute bottom-0 left-0 w-full lg:w-1/2 pl-5 pb-10">
						<button class="text-white bg-tertiary rounded px-6 py-2 mb-3 font-semibold text-xs">World</button>
						<div class="font-semibold text-base leading-6 text-white mb-3">Apa itu Konteks dan mengapa hal itu penting dalam pembuatan produk digital?</div>
						<div class="text-gray-300 text-sm pb-5 mb-3">2 September 2021</div>
						<a class="border rounded border-white px-5 py-2 text-white hover:bg-black hover:opacity-50" href="{{ route('news_detail', 1) }}">Read Story</a>
					</div>
				</div>
			</div>
			<div>
				<div class="bg-cover relative">
					<img src="{{ asset('seeder/slider_2.jpg') }}" class="w-full">
					<div class="absolute bottom-0 left-0 w-full lg:w-1/2 pl-5 pb-10">
						<button class="text-white bg-tertiary rounded px-6 py-2 mb-3 font-semibold text-xs">World</button>
						<div class="font-semibold text-base leading-6 text-white mb-3">Apa itu Konteks dan mengapa hal itu penting dalam pembuatan produk digital?</div>
						<div class="text-gray-300 text-sm pb-5 mb-3">2 September 2021</div>
						<a class="border rounded border-white px-5 py-2 text-white hover:bg-black hover:opacity-50" href="{{ route('news_detail', 1) }}">Read Story</a>
					</div>
				</div>
			</div>
			@endfor
		@endif
	</div>
</section> --}}

<section class="w-full bg-secondary">
	<div class="container px-3 lg:mx-auto py-10">
		<img src="{{ asset('images/klik_banner.png') }}" class="w-full">
	</div>
</section>

<section class="container px-3 lg:mx-auto w-full py-6">
	<div class="text-xl font-bold uppercase py-6">Berita Terbaru</div>
	<div class="grid grid-cols-1 lg:grid-cols-6 gap-6 w-full">
		<div class="lg:col-span-4">

			<img src="{{ $firstNews ? $firstNews->getImage() : asset('seeder/image_4.jpg') }}" class="w-full">
			<button class="text-white bg-tertiary rounded px-6 py-2 my-6 font-semibold text-xs">{{ $firstNews ? $firstNews->category->name : 'World' }}</button>
			<div class="font-semibold text-2xl leading-normal">{{ $firstNews ? $firstNews->title : 'Apa itu Konteks dan mengapa hal itu penting dalam pembuatan produk digital?' }}</div>
			<div class="text-gray-500 text-sm py-3">{{ $firstNews ? Carbon\Carbon::parse($firstNews->published_at)->format('d M Y') : '2 September 2021' }}</div>
			<div class="text-gray-400 text-sm pb-3 leading-normal">
				{{ $firstNews ? $firstNews->excerpt : 'Bayangkan jika saat Anda di mini market, membawa banyak barang dan saat tiba di kasir, sang kasir malah menaruh kembali barang barang Anda di rak seperti semula, tanpa memberitahu alasannya...' }} <br>
				<a href="{{ $firstNews ? route('news_detail',$firstNews->slug) : route('news_detail', 1) }}" class="text-blue-600 underline pointer">
					Selengkapnya
				</a>
			</div>

			<div class="grid grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-6 w-full">
				@if($news->count() > 0)
					@foreach($news as $data)
					<div>
						<img src="{{ $data->getImage() }}" class="w-full mb-2 h-60 object-contain">
						<a href="{{ route('news_detail', $data->slug) }}" class="font-semibold text-base leading-6">{{ $data->title }}</a>
						<div class="text-gray-500 text-sm py-3">{{ Carbon\Carbon::parse($data->published_at)->format('d M Y') }}</div>
					</div>
					@endforeach
				@else
					@for($i=1;$i<=2;$i++)
					<div>
						<img src="{{ asset('seeder/image_1.jpg') }}" class="w-full mb-2">
						<a href="{{ route('news_detail', 1) }}" class="font-semibold text-base leading-6">Apa itu Konteks dan mengapa hal itu penting dalam pembuatan produk digital?</a>
						<div class="text-gray-500 text-sm py-3">2 September 2021</div>
					</div>
					<div>
						<img src="{{ asset('seeder/image_2.jpg') }}" class="w-full mb-2">
						<a href="{{ route('news_detail', 1) }}" class="font-semibold text-base leading-6">Apa itu Konteks dan mengapa hal itu penting dalam pembuatan produk digital?</a>
						<div class="text-gray-500 text-sm py-3">2 September 2021</div>
					</div>
					<div>
						<img src="{{ asset('seeder/image_3.jpg') }}" class="w-full mb-2">
						<a href="{{ route('news_detail', 1) }}" class="font-semibold text-base leading-6">Apa itu Konteks dan mengapa hal itu penting dalam pembuatan produk digital?</a>
						<div class="text-gray-500 text-sm py-3">2 September 2021</div>
					</div>
					@endfor
				@endif
			</div>
		</div>

		<div class="lg:col-span-2">

			<div class="text-base font-semibold mb-5">Supported By</div>
			<div class="supported">
				@if($kementrian->count() > 0)
					@foreach($kementrian as $data)
						<div class="bg-gray-100 p-3 rounded">
							<a href="{{ $data->link }}">
								<img src="{{ $data->getImage() }}" class="w-full">
							</a>
						</div>
					@endforeach
				@else
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
				@endif
			</div>

			<div class="text-base font-semibold mb-5">Maklumat Pelayanan</div>
			<img src="{{ asset('images/maklumat_pelayanan.jpg') }}" class="w-full mb-8">

			<?php $array = ['World', 'Technology', 'Entertaintment', 'Sports', 'Media', 'Politics', 'Business', 'Lifestyle', 'Travel', 'Cricket', 'Football', 'Education', 'Photography', 'Nature']; ?>

			<div class="text-base font-semibold mb-5">Categories</div>
			<ul class="list-disc list-inside space-y-3 mb-8" style="column-count: 2;">
				@if($category->count() > 0)
					@foreach($category as $data)
					<li><a href="{{ route('news', ['category' => $data->id]) }}">{{ $data->name }}</a></li>
					@endforeach
				@else
					@foreach($array as $data)
					<li><a href="{{ route('news') }}">{{ $data }}</a></li>
					@endforeach
				@endif
			</ul>

			{{-- <div class="text-base font-semibold mb-5">Pictures</div>
			<div class="grid grid-cols-4 gap-1 mb-8">
				@if($gallery->count() > 0)
					@foreach($gallery as $data)
						<a href="{{ $data->getImage() }}" class="magnific-popup">
							<img src="{{ $data->getImage() }}" class="w-full rounded">
						</a>
					@endforeach
				@else
					@for($i=1;$i<=4;$i++)
					<a href="{{ asset('seeder/image_1.jpg') }}" class="magnific-popup">
						<img src="{{ asset('seeder/image_1.jpg') }}" class="w-full rounded">
					</a>
					<a href="{{ asset('seeder/image_2.jpg') }}" class="magnific-popup">
						<img src="{{ asset('seeder/image_2.jpg') }}" class="w-full rounded">
					</a>
					<a href="{{ asset('seeder/image_3.jpg') }}" class="magnific-popup">
						<img src="{{ asset('seeder/image_3.jpg') }}" class="w-full rounded">
					</a>
					@endfor
				@endif	
			</div> --}}

			<div class="text-base font-semibold mb-5">Related Link</div>
			<div class="break-all leading-normal">
				<div class="mb-2 font-bold text-primary">
					<a href="http://www.who.int/foodsafety/fs_management/infosan/en/">http://www.who.int/foodsafety/fs_management/infosan/en/</a>
				</div>
				<div class="mb-2 font-bold text-primary">
					<a href="https://webgate.ec.europa.eu/rasff-window/portal">https://webgate.ec.europa.eu/rasff-window/portal</a>
				</div>
				<div class="mb-2 font-bold text-primary">
					<a href="http://www.arasff.net/">http://www.arasff.net/</a>
				</div>
			</div>
		</div>
	</div>
</section>

{{-- <section class="bg-gray-100 py-8">
	<div class="container px-3 lg:mx-auto">
		<div class="text-xl font-bold uppercase pb-6">statistik</div>
		<img src="{{ asset('images/statistik.png') }}" class="w-full rounded">
	</div>
</section> --}}

<section class="bg-gray-100 py-8">
	<div class="container px-3 lg:mx-auto">
		<div class="text-xl font-bold uppercase pb-6">pictures</div>
		<div class="grid grid-cols-2 lg:grid-cols-3 gap-3 lg:gap-5 mb-8">
			@if($gallery->count() > 0)
				@foreach($gallery as $data)
					<a href="{{ $data->getImage() }}" class="magnific-popup">
						<img src="{{ $data->getImage() }}" class="w-full rounded">
					</a>
				@endforeach
			@else
				@for($i=1;$i<=4;$i++)
				<a href="{{ asset('seeder/image_1.jpg') }}" class="magnific-popup">
					<img src="{{ asset('seeder/image_1.jpg') }}" class="w-full rounded">
				</a>
				<a href="{{ asset('seeder/image_2.jpg') }}" class="magnific-popup">
					<img src="{{ asset('seeder/image_2.jpg') }}" class="w-full rounded">
				</a>
				<a href="{{ asset('seeder/image_3.jpg') }}" class="magnific-popup">
					<img src="{{ asset('seeder/image_3.jpg') }}" class="w-full rounded">
				</a>
				@endfor
			@endif	
		</div>
	</div>
</section>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('vendors/slick/slick/slick.min.js') }}"></script>
<script src="{{ asset('vendors/magnific-popup/dist/jquery.magnific-popup.min.js') }}"></script>
<script type="text/javascript">
	$('.slick').slick({
	  dots: false,
	  arrows: false,
	  infinite: false,
	  speed: 300,
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  adaptiveHeight: true,
	  mobileFirst: true,
	  responsive: [
	    {
	      breakpoint: 480,
	      settings: {
	        slidesToShow: 2.5,
	  		slidesToScroll: 1,
	      }
	    }
	    // You can unslick at a given breakpoint now by adding:
	    // settings: "unslick"
	    // instead of a settings object
	  ]
	});

	$('.slider').slick({
		dots: false,
		arrows : true,
		infinite: true,
		speed: 300,
		slidesToShow: 1,
		adaptiveHeight: true
	});

	$('.supported').slick({
	  dots: false,
	  arrows: false,
	  infinite: false,
	  speed: 300,
	  slidesToShow: 3,
	  slidesToScroll: 1,
	  adaptiveHeight: true,
	});

	$('.magnific-popup').magnificPopup({
	  type: 'image'
	  // other options
	});
</script>
@endsection