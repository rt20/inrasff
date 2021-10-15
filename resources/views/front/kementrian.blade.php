@extends('front.layouts.app')

@section('style')
@endsection

@section('body')
<section class="bg-gray-200 px-3 lg:mx-auto mt-16 lg:mt-44">
	<div class="container mx-auto flex justify-between items-center py-8">
		<div class="text-xl font-bold uppercase tracking-wide">Kementrian</div>
		<div class="text-sm text-gray-500 tracking-wide">
			<a href="#">Home</a> / <a href="javascript:void(0)" class="font-semibold">Kementrian</a>
		</div>
	</div>
</section>

<section class="container px-3 py-12 lg:mx-auto">
	<div class="slider">
		<img src="{{ asset('seeder/slider_3.jpg') }}" class="w-full">
	</div>
</section>

<section class="container px-3 py-8 lg:mx-auto"> 
	<div class="grid grid-cols-2 gap-6 lg:gap-0 lg:grid-cols-4 justify-center items-center">
		<div class="text-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-facebook h-12 lg:h-24 text-black mx-auto mb-5" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
			<div class="text-primary text-5xl lg:text-6xl font-bold mb-3 uppercase">8465</div>
			<div class="text-gray-400 text-xs lg:text-xl font-regular mb-5 uppercase">Clients Served</div>
		</div>
		<div class="text-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-facebook h-12 lg:h-24 text-black mx-auto mb-5" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
			<div class="text-primary text-5xl lg:text-6xl font-bold mb-3 uppercase">8465</div>
			<div class="text-gray-400 text-xs lg:text-xl font-regular mb-5 uppercase">Clients Served</div>
		</div>
		<div class="text-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-facebook h-12 lg:h-24 text-black mx-auto mb-5" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
			<div class="text-primary text-5xl lg:text-6xl font-bold mb-3 uppercase">8465</div>
			<div class="text-gray-400 text-xs lg:text-xl font-regular mb-5 uppercase">Clients Served</div>
		</div>
		<div class="text-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-facebook h-12 lg:h-24 text-black mx-auto mb-5" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
			<div class="text-primary text-5xl lg:text-6xl font-bold mb-3 uppercase">8465</div>
			<div class="text-gray-400 text-xs lg:text-xl font-regular mb-5 uppercase">Clients Served</div>
		</div>
	</div>
</section>

<section class="container px-3 py-16 lg:mx-auto"> 
	<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
		<div class="grid grid-cols-1 lg:grid-cols-2">
			<div class="bg-gray-100 p-8 lg:p-16 rounded flex justify-center items-center mx-auto w-1/2 lg:w-full">
				<img src="{{ asset('images/logo_bpom.png') }}" class="w-full">
			</div>
			<div class="p-6">
				<div class="text-xl font-semibold mb-5 leading-normal">
					Badan Pengawasan Obat dan Makanan Republik Indonesia
				</div>
				<div class="text-regular text-gray-400 mb-8 leading-normal">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nibh morbi tristique id purus sed sit ipsum, elementum. Ac at dui sed et dis auctor non sapien.
				</div>
				<div class="flex items-center">
					<a href="https://facebook.com">
						<div class="flex items-center bg-gray-100 rounded-full p-2 mr-5">
	            			<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-facebook h-5 text-black mx-auto" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
						</div>
					</a>
					<a href="https://facebook.com">
						<div class="flex items-center bg-gray-100 rounded-full p-2 mr-5">
	            			<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-facebook h-5 text-black mx-auto" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
						</div>
					</a>
					<a href="https://facebook.com">
						<div class="flex items-center bg-gray-100 rounded-full p-2 mr-5">
	            			<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-facebook h-5 text-black mx-auto" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="grid grid-cols-1 lg:grid-cols-2">
			<div class="bg-gray-100 p-8 lg:p-16 rounded flex justify-center items-center mx-auto w-1/2 lg:w-full">
				<img src="{{ asset('images/logo_bpom.png') }}" class="w-full">
			</div>
			<div class="p-6">
				<div class="text-xl font-semibold mb-5 leading-normal">
					Badan Pengawasan Obat dan Makanan Republik Indonesia
				</div>
				<div class="text-regular text-gray-400 mb-8 leading-normal">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nibh morbi tristique id purus sed sit ipsum, elementum. Ac at dui sed et dis auctor non sapien.
				</div>
				<div class="flex items-center">
					<a href="https://facebook.com">
						<div class="flex items-center bg-gray-100 rounded-full p-2 mr-5">
	            			<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-facebook h-5 text-black mx-auto" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
						</div>
					</a>
					<a href="https://facebook.com">
						<div class="flex items-center bg-gray-100 rounded-full p-2 mr-5">
	            			<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-facebook h-5 text-black mx-auto" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
						</div>
					</a>
					<a href="https://facebook.com">
						<div class="flex items-center bg-gray-100 rounded-full p-2 mr-5">
	            			<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-facebook h-5 text-black mx-auto" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="grid grid-cols-1 lg:grid-cols-2">
			<div class="bg-gray-100 p-8 lg:p-16 rounded flex justify-center items-center mx-auto w-1/2 lg:w-full">
				<img src="{{ asset('images/logo_bpom.png') }}" class="w-full">
			</div>
			<div class="p-6">
				<div class="text-xl font-semibold mb-5 leading-normal">
					Badan Pengawasan Obat dan Makanan Republik Indonesia
				</div>
				<div class="text-regular text-gray-400 mb-8 leading-normal">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nibh morbi tristique id purus sed sit ipsum, elementum. Ac at dui sed et dis auctor non sapien.
				</div>
				<div class="flex items-center">
					<a href="https://facebook.com">
						<div class="flex items-center bg-gray-100 rounded-full p-2 mr-5">
	            			<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-facebook h-5 text-black mx-auto" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
						</div>
					</a>
					<a href="https://facebook.com">
						<div class="flex items-center bg-gray-100 rounded-full p-2 mr-5">
	            			<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-facebook h-5 text-black mx-auto" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
						</div>
					</a>
					<a href="https://facebook.com">
						<div class="flex items-center bg-gray-100 rounded-full p-2 mr-5">
	            			<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-facebook h-5 text-black mx-auto" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="grid grid-cols-1 lg:grid-cols-2">
			<div class="bg-gray-100 p-8 lg:p-16 rounded flex justify-center items-center mx-auto w-1/2 lg:w-full">
				<img src="{{ asset('images/logo_bpom.png') }}" class="w-full">
			</div>
			<div class="p-6">
				<div class="text-xl font-semibold mb-5 leading-normal">
					Badan Pengawasan Obat dan Makanan Republik Indonesia
				</div>
				<div class="text-regular text-gray-400 mb-8 leading-normal">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nibh morbi tristique id purus sed sit ipsum, elementum. Ac at dui sed et dis auctor non sapien.
				</div>
				<div class="flex items-center">
					<a href="https://facebook.com">
						<div class="flex items-center bg-gray-100 rounded-full p-2 mr-5">
	            			<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-facebook h-5 text-black mx-auto" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
						</div>
					</a>
					<a href="https://facebook.com">
						<div class="flex items-center bg-gray-100 rounded-full p-2 mr-5">
	            			<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-facebook h-5 text-black mx-auto" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
						</div>
					</a>
					<a href="https://facebook.com">
						<div class="flex items-center bg-gray-100 rounded-full p-2 mr-5">
	            			<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-facebook h-5 text-black mx-auto" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@section('script')
@endsection