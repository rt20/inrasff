@extends('front.layouts.app')

@section('style')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<link href="https://fonts.googleapis.com/css?family=Source+Code+Pro|Roboto&display=swap" rel="stylesheet">
@endsection

@section('body')
<section class="lg:mx-auto mt-16 lg:mt-44">
	<div class="map w-full h-96"></div>
</section>

<section class="container px-3 py-12 lg:mx-auto">
	<div class="text-xl font-bold mb-5">Contact Us</div>
	<div class="leading-normal">
		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed imperdiet libero id nisi euismod, sed porta est consectetur. Vestibulum auctor felis eget orci semper vestibulum. Pellentesque ultricies nibh gravida, accumsan libero luctus, molestie nunc.L orem ipsum dolor sit amet, consectetur adipiscing elit.
	</div>
</section>

<section class="container px-3 py-8 lg:mx-auto"> 
	<div class="grid grid-cols-2 gap-6 lg:gap-0 lg:grid-cols-4 justify-center items-center">
		<div class="text-center">
			<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-geo-alt-fill h-8 lg:h-12 text-primary mx-auto mb-5" viewBox="0 0 16 16"><path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg>
			<div class="text-black text-sm lg:text-xl font-bold mb-3">Contact Info</div>
			<div class="text-gray-400 text-xs lg:text-base font-regular mb-5 leading-normal">Jalan Percetakan Negara Nomor 23 <br> Jakarta - 10560 - Indonesia</div>
		</div>
		<div class="text-center">
			<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-phone-fill h-8 lg:h-12 text-primary mx-auto mb-5" viewBox="0 0 16 16"><path d="M3 2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V2zm6 11a1 1 0 1 0-2 0 1 1 0 0 0 2 0z"/></svg>
			<div class="text-black text-sm lg:text-xl font-bold mb-3">Phone Number</div>
			<div class="text-gray-400 text-xs lg:text-base font-regular mb-5">+6221 426333</div>
		</div>
		<div class="text-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-envelope-fill h-8 lg:h-12 text-primary mx-auto mb-5" viewBox="0 0 16 16"><path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/></svg>
			<div class="text-black text-sm lg:text-xl font-bold mb-3">Email Address</div>
			<div class="text-gray-400 text-xs lg:text-base font-regular mb-5">halobpom@pom.go.gid</div>
		</div>
		<div class="text-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-calendar-fill h-8 lg:h-12 text-primary mx-auto mb-5" viewBox="0 0 16 16"><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5h16V4H0V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5z"/></svg>
			<div class="text-black text-sm lg:text-xl font-bold mb-3">Working Days/Hours</div>
			<div class="text-gray-400 text-xs lg:text-base font-regular mb-5">Senin-Jumat / 08:00-15:00</div>
		</div>
	</div>
</section>

<section class="bg-gray-100" id="sendMessage">
	<div class="container px-3 py-12 lg:mx-auto">
		<div class="text-xl font-bold mb-5">Send us a message</div>
		{!! Form::open(['route' => 'contactus.submit', 'method' => 'POST']) !!}
		<div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-8">
			<div>
				<div class="py-4">
					<div class="text-sm lg:text-base font-regular text-gray-400 mb-3">Your Name</div>
					<input type="text" name="name" class="w-full h-12 border border-gray-200 rounded p-4 @error('name') {{ 'is-invalid border-red-500' }} @enderror">
                    @error('name')
                        <small class="text-red-500">{{ $errors->first('name') }}</small>
                    @enderror
				</div>
				<div class="py-4">
					<div class="text-sm lg:text-base font-regular text-gray-400 mb-3">Your E-mail</div>
					<input type="email" name="email" class="w-full h-12 border border-gray-200 rounded p-4 @error('email') {{ 'is-invalid border-red-500' }} @enderror">
                    @error('email')
                        <small class="text-red-500">{{ $errors->first('email') }}</small>
                    @enderror
				</div>
			</div>
			<div>
				<div class="py-4">
					<div class="text-sm lg:text-base font-regular text-gray-400 mb-3">Your Message</div>
					<textarea type="text" name="message" class="w-full h-36 border border-gray-200 rounded p-4 @error('message') {{ 'is-invalid border-red-500' }} @enderror"></textarea>
                    @error('message')
                        <small class="text-red-500">{{ $errors->first('message') }}</small>
                    @enderror
				</div>
				<div class="py-4">
                    {!! NoCaptcha::display() !!}
                    @error('g-recaptcha-response')
                        <small class="text-red-500">{{ $errors->first('g-recaptcha-response') }}</small>
                    @endif

				</div>
				<div class="py-4 text-center lg:text-left">
					<button type="submit" class="bg-secondary text-white text-xs lg:text-sm tracking-wide uppercase rounded px-8 py-4">Send Message</button>
				</div>
			</div>
		</div>
		@if (session()->has('success'))
		<div class="bg-green-200 text-gray-400 px-5 py-5 rounded">
			<div>{{ session('success')}}</div>
		</div>
		@endif
		{!! Form::close() !!}
	</div>
</section>

<section class="container px-3 py-12 lg:mx-auto">
	<div class="text-xl font-bold mb-8">Frequently Asked Questions</div>
	@if($faq->count() > 0)
		@foreach($faq as $data)
			<div x-data={show:false}>
				<div class="flex justify-between items-center mb-5 py-4 border-b border-gray-200 leading-normal cursor-pointer" 
					@click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'border-b': !show }">
					<div class="font-semibold text-base lg:text-lg">
						{{ $data->question }}
					</div>
					<div class="font-semibold text-base lg:text-lg mx-3">
						
						<svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/></svg>

						<svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
					
					</div>
				</div> 
				<div x-show="show" class="border-b text-sm lg:text-base border-gray-200 pb-4 leading-normal">
					{{ $data->answer }}
				</div>
			</div>
		@endforeach
	@else
	<div x-data={show:false}>
		<div class="flex justify-between items-center mb-5 py-4 border-b border-gray-200 leading-normal cursor-pointer" 
			@click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'border-b': !show }">
			<div class="font-semibold text-base lg:text-lg">
				Curabitur eget leo at velit imperdiet viaculis vitaes?
			</div>
			<div class="font-semibold text-base lg:text-lg mx-3">
				
				<svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/></svg>

				<svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
			
			</div>
		</div> 
		<div x-show="show" class="border-b text-sm lg:text-base border-gray-200 pb-4 leading-normal">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed imperdiet libero id nisi euismod, sed porta est consectetur. Vestibulum auctor felis eget orci semper vestibulum. Pellentesque ultricies nibh gravida, accumsan libero luctus, molestie nunc.L orem ipsum dolor sit amet, consectetur adipiscing elit.
		</div>
	</div>
	<div x-data={show:false}>
		<div class="flex justify-between items-center mb-5 py-4 border-b border-gray-200 leading-normal cursor-pointer" 
			@click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'border-b': !show }">
			<div class="font-semibold text-base lg:text-lg">
				Curabitur eget leo at velit imperdiet viaculis vitaes?
			</div>
			<div class="font-semibold text-base lg:text-lg mx-3">
				
				<svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/></svg>

				<svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
			
			</div>
		</div> 
		<div x-show="show" class="border-b text-sm lg:text-base border-gray-200 pb-4 leading-normal">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed imperdiet libero id nisi euismod, sed porta est consectetur. Vestibulum auctor felis eget orci semper vestibulum. Pellentesque ultricies nibh gravida, accumsan libero luctus, molestie nunc.L orem ipsum dolor sit amet, consectetur adipiscing elit.
		</div>
	</div>
	<div x-data={show:false}>
		<div class="flex justify-between items-center mb-5 py-4 border-b border-gray-200 leading-normal cursor-pointer" 
			@click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'border-b': !show }">
			<div class="font-semibold text-base lg:text-lg">
				Curabitur eget leo at velit imperdiet viaculis vitaes?
			</div>
			<div class="font-semibold text-base lg:text-lg mx-3">
				
				<svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/></svg>

				<svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
			
			</div>
		</div> 
		<div x-show="show" class="border-b text-sm lg:text-base border-gray-200 pb-4 leading-normal">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed imperdiet libero id nisi euismod, sed porta est consectetur. Vestibulum auctor felis eget orci semper vestibulum. Pellentesque ultricies nibh gravida, accumsan libero luctus, molestie nunc.L orem ipsum dolor sit amet, consectetur adipiscing elit.
		</div>
	</div>
	<div x-data={show:false}>
		<div class="flex justify-between items-center mb-5 py-4 border-b border-gray-200 leading-normal cursor-pointer" 
			@click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'border-b': !show }">
			<div class="font-semibold text-base lg:text-lg">
				Curabitur eget leo at velit imperdiet viaculis vitaes?
			</div>
			<div class="font-semibold text-base lg:text-lg mx-3">
				
				<svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/></svg>

				<svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
			
			</div>
		</div> 
		<div x-show="show" class="border-b text-sm lg:text-base border-gray-200 pb-4 leading-normal">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed imperdiet libero id nisi euismod, sed porta est consectetur. Vestibulum auctor felis eget orci semper vestibulum. Pellentesque ultricies nibh gravida, accumsan libero luctus, molestie nunc.L orem ipsum dolor sit amet, consectetur adipiscing elit.
		</div>
	</div>
	<div x-data={show:false}>
		<div class="flex justify-between items-center mb-5 py-4 border-b border-gray-200 leading-normal cursor-pointer" 
			@click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'border-b': !show }">
			<div class="font-semibold text-base lg:text-lg">
				Curabitur eget leo at velit imperdiet viaculis vitaes?
			</div>
			<div class="font-semibold text-base lg:text-lg mx-3">
				
				<svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/></svg>

				<svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
			
			</div>
		</div> 
		<div x-show="show" class="border-b text-sm lg:text-base border-gray-200 pb-4 leading-normal">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed imperdiet libero id nisi euismod, sed porta est consectetur. Vestibulum auctor felis eget orci semper vestibulum. Pellentesque ultricies nibh gravida, accumsan libero luctus, molestie nunc.L orem ipsum dolor sit amet, consectetur adipiscing elit.
		</div>
	</div>
	<div x-data={show:false}>
		<div class="flex justify-between items-center mb-5 py-4 border-b border-gray-200 leading-normal cursor-pointer" 
			@click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'border-b': !show }">
			<div class="font-semibold text-base lg:text-lg">
				Curabitur eget leo at velit imperdiet viaculis vitaes?
			</div>
			<div class="font-semibold text-base lg:text-lg mx-3">
				
				<svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/></svg>

				<svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
			
			</div>
		</div> 
		<div x-show="show" class="border-b text-sm lg:text-base border-gray-200 pb-4 leading-normal">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed imperdiet libero id nisi euismod, sed porta est consectetur. Vestibulum auctor felis eget orci semper vestibulum. Pellentesque ultricies nibh gravida, accumsan libero luctus, molestie nunc.L orem ipsum dolor sit amet, consectetur adipiscing elit.
		</div>
	</div>
	@endif
</section>
@endsection

@section('script')
<!-- Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8pTfHmKIvNhLNS1hN0O0fERKxPIqhpnA&libraries=places&callback=initMap" async defer></script>
{!! NoCaptcha::renderJs() !!}
<script>
	function initMap() {
		let lati = -6.1885344;
		let logi = 106.8596343;
        let map = new google.maps.Map(document.querySelector('.map'), {
            center: {
                lat: lati,
                lng: logi
            },
            zoom: 16,
            mapTypeId: 'roadmap'
        });

        var myLatlng = new google.maps.LatLng(lati,logi);
        var marker = new google.maps.Marker({
		    position: myLatlng,
		    title:"The Ritz-Carlton Pacific Place"
		});
		marker.setMap(map);
    }
</script>
@endsection