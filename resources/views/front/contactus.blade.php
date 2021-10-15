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
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-facebook h-8 lg:h-12 text-primary mx-auto mb-5" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
			<div class="text-black text-sm lg:text-xl font-bold mb-3">Contact Info</div>
			<div class="text-gray-400 text-xs lg:text-base font-regular mb-5">123 Wall Street, New York / NY</div>
		</div>
		<div class="text-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-facebook h-8 lg:h-12 text-primary mx-auto mb-5" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
			<div class="text-black text-sm lg:text-xl font-bold mb-3">Contact Info</div>
			<div class="text-gray-400 text-xs lg:text-base font-regular mb-5">123 Wall Street, New York / NY</div>
		</div>
		<div class="text-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-facebook h-8 lg:h-12 text-primary mx-auto mb-5" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
			<div class="text-black text-sm lg:text-xl font-bold mb-3">Contact Info</div>
			<div class="text-gray-400 text-xs lg:text-base font-regular mb-5">123 Wall Street, New York / NY</div>
		</div>
		<div class="text-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-facebook h-8 lg:h-12 text-primary mx-auto mb-5" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
			<div class="text-black text-sm lg:text-xl font-bold mb-3">Contact Info</div>
			<div class="text-gray-400 text-xs lg:text-base font-regular mb-5">123 Wall Street, New York / NY</div>
		</div>
	</div>
</section>

<section class="bg-gray-100">
	<div class="container px-3 py-12 lg:mx-auto">
		<div class="text-xl font-bold mb-5">Send us a message</div>
		<div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-8">
			<div>
				<div class="py-4">
					<div class="text-sm lg:text-base font-regular text-gray-400 mb-3">Your Name</div>
					<input type="text" name="name" class="w-full h-12 border border-gray-200 rounded p-4">
				</div>
				<div class="py-4">
					<div class="text-sm lg:text-base font-regular text-gray-400 mb-3">Your E-mail</div>
					<input type="email" name="email" class="w-full h-12 border border-gray-200 rounded p-4">
				</div>
			</div>
			<div>
				<div class="py-4">
					<div class="text-sm lg:text-base font-regular text-gray-400 mb-3">Your Message</div>
					<textarea type="text" name="name" class="w-full h-36 border border-gray-200 rounded p-4"></textarea>
				</div>
				<div class="py-4 text-center lg:text-left">
					<button type="submit" class="bg-secondary text-white text-xs lg:text-sm tracking-wide uppercase rounded px-8 py-4">Send Message</button>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="container px-3 py-12 lg:mx-auto">
	<div class="text-xl font-bold mb-8">Frequently Asked Questions</div>
	<div x-data={show:false}>
		<div class="flex justify-between items-center mb-5 py-4 border-b-2 border-gray-200 leading-normal cursor-pointer" 
			@click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'border-b-2': !show }">
			<div class="font-semibold text-base lg:text-lg">
				Curabitur eget leo at velit imperdiet viaculis vitaes?
			</div>
			<div class="font-semibold text-base lg:text-lg mx-3">
				
				<svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/></svg>

				<svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
			
			</div>
		</div> 
		<div x-show="show" class="border-b-2 text-sm lg:text-base border-gray-200 pb-4 leading-normal">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed imperdiet libero id nisi euismod, sed porta est consectetur. Vestibulum auctor felis eget orci semper vestibulum. Pellentesque ultricies nibh gravida, accumsan libero luctus, molestie nunc.L orem ipsum dolor sit amet, consectetur adipiscing elit.
		</div>
	</div>
	<div x-data={show:false}>
		<div class="flex justify-between items-center mb-5 py-4 border-b-2 border-gray-200 leading-normal cursor-pointer" 
			@click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'border-b-2': !show }">
			<div class="font-semibold text-base lg:text-lg">
				Curabitur eget leo at velit imperdiet viaculis vitaes?
			</div>
			<div class="font-semibold text-base lg:text-lg mx-3">
				
				<svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/></svg>

				<svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
			
			</div>
		</div> 
		<div x-show="show" class="border-b-2 text-sm lg:text-base border-gray-200 pb-4 leading-normal">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed imperdiet libero id nisi euismod, sed porta est consectetur. Vestibulum auctor felis eget orci semper vestibulum. Pellentesque ultricies nibh gravida, accumsan libero luctus, molestie nunc.L orem ipsum dolor sit amet, consectetur adipiscing elit.
		</div>
	</div>
	<div x-data={show:false}>
		<div class="flex justify-between items-center mb-5 py-4 border-b-2 border-gray-200 leading-normal cursor-pointer" 
			@click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'border-b-2': !show }">
			<div class="font-semibold text-base lg:text-lg">
				Curabitur eget leo at velit imperdiet viaculis vitaes?
			</div>
			<div class="font-semibold text-base lg:text-lg mx-3">
				
				<svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/></svg>

				<svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
			
			</div>
		</div> 
		<div x-show="show" class="border-b-2 text-sm lg:text-base border-gray-200 pb-4 leading-normal">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed imperdiet libero id nisi euismod, sed porta est consectetur. Vestibulum auctor felis eget orci semper vestibulum. Pellentesque ultricies nibh gravida, accumsan libero luctus, molestie nunc.L orem ipsum dolor sit amet, consectetur adipiscing elit.
		</div>
	</div>
	<div x-data={show:false}>
		<div class="flex justify-between items-center mb-5 py-4 border-b-2 border-gray-200 leading-normal cursor-pointer" 
			@click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'border-b-2': !show }">
			<div class="font-semibold text-base lg:text-lg">
				Curabitur eget leo at velit imperdiet viaculis vitaes?
			</div>
			<div class="font-semibold text-base lg:text-lg mx-3">
				
				<svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/></svg>

				<svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
			
			</div>
		</div> 
		<div x-show="show" class="border-b-2 text-sm lg:text-base border-gray-200 pb-4 leading-normal">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed imperdiet libero id nisi euismod, sed porta est consectetur. Vestibulum auctor felis eget orci semper vestibulum. Pellentesque ultricies nibh gravida, accumsan libero luctus, molestie nunc.L orem ipsum dolor sit amet, consectetur adipiscing elit.
		</div>
	</div>
	<div x-data={show:false}>
		<div class="flex justify-between items-center mb-5 py-4 border-b-2 border-gray-200 leading-normal cursor-pointer" 
			@click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'border-b-2': !show }">
			<div class="font-semibold text-base lg:text-lg">
				Curabitur eget leo at velit imperdiet viaculis vitaes?
			</div>
			<div class="font-semibold text-base lg:text-lg mx-3">
				
				<svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/></svg>

				<svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
			
			</div>
		</div> 
		<div x-show="show" class="border-b-2 text-sm lg:text-base border-gray-200 pb-4 leading-normal">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed imperdiet libero id nisi euismod, sed porta est consectetur. Vestibulum auctor felis eget orci semper vestibulum. Pellentesque ultricies nibh gravida, accumsan libero luctus, molestie nunc.L orem ipsum dolor sit amet, consectetur adipiscing elit.
		</div>
	</div>
	<div x-data={show:false}>
		<div class="flex justify-between items-center mb-5 py-4 border-b-2 border-gray-200 leading-normal cursor-pointer" 
			@click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'border-b-2': !show }">
			<div class="font-semibold text-base lg:text-lg">
				Curabitur eget leo at velit imperdiet viaculis vitaes?
			</div>
			<div class="font-semibold text-base lg:text-lg mx-3">
				
				<svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/></svg>

				<svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
			
			</div>
		</div> 
		<div x-show="show" class="border-b-2 text-sm lg:text-base border-gray-200 pb-4 leading-normal">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed imperdiet libero id nisi euismod, sed porta est consectetur. Vestibulum auctor felis eget orci semper vestibulum. Pellentesque ultricies nibh gravida, accumsan libero luctus, molestie nunc.L orem ipsum dolor sit amet, consectetur adipiscing elit.
		</div>
	</div>
</section>
@endsection

@section('script')
<!-- Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8pTfHmKIvNhLNS1hN0O0fERKxPIqhpnA&libraries=places&callback=initMap" async defer></script>
<script>
	function initMap() {
		let lati = -6.2240509;
		let logi = 106.8098201;
        let map = new google.maps.Map(document.querySelector('.map'), {
            center: {
                lat: lati,
                lng: logi
            },
            zoom: 15,
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