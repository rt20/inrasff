@extends('front.layouts.app')

@section('style')

@endsection

@section('body')
<section class="bg-gray-200 px-3 lg:mx-auto mt-16 lg:mt-44">
	<div class="container mx-auto text-center lg:text-left lg:flex lg:justify-between items-center py-3">
		<div class="text-xl font-bold uppercase tracking-wide mb-3 lg:mb-0">Kerangka Mitigasi</div>
		<div class="text-sm text-gray-500 tracking-wide">
			<a href="/">Home</a> / <a href="javascript:void(0)" class="font-semibold">Kerangka Mitigasi</a>
		</div>
	</div>
</section>

@if(Request::get('search'))
<section class="container px-3 lg:mx-auto pb-6 pt-4">
	<div class="text-sm text-gray-500 font-bold">
		Menampilkan pencarian "<span class="text-black">{{ Request::get('search') }}</span>"
	</div>
</section>
@endif

@if(Request::get('category'))
<section class="container px-3 lg:mx-auto pb-6 pt-4">
	<div class="text-sm text-gray-500 font-bold">
		Menampilkan kategori berita "<span class="text-black">{{ App\Models\Category::find(Request::get('category'))->name }}</span>"
	</div>
</section>
@endif
<div class="flex items-center bg-blue-200">
<section class="container px-3 lg:mx-auto py-8">

<!-- MultiStep Form -->
<div class="mt-0">
      <h2
        class="
          mb-4
          text-2xl
          font-bold
          text-center text-gray-800
          lg:text-3xl
          md:mb-0
        "
      >
        Identifikasi Sumber Kontaminasi
      </h2>

      <p class="max-w-screen-md mx-auto text-center text-gray-500 md:text-lg">
      <!--  Please fill in the details below so that we can get in contact with you. -->halo
      </p>
    </div>
	
    <div class="py-10 min-h-screen bg-gray-300 px-2">
    <div class="max-w-md mx-auto bg-gray-100 shadow-lg rounded-lg overflow-hidden md:max-w-lg">
        <!--<div class="md:flex">-->
        <div class="w-full">
            <p class="flex justify-center items-center h-16 w-full bg-pink-900 text-white">Create campaign</p>
            <div class="main block">
                <h4 class="flex justify-center items-center mt-5 text-lg text-gray-800 font-medium">Step 1. User Profile</h4>
                <div class="mt-7 px-4 relative"> <input class="h-12 transition-all px-1 outline-none w-full border rounded-lg user_name" type="text" require required> <label class="text-pink-600 absolute transition-all top-4 pointer-events-none text-sm left-5">First Name</label> </div>
                <div class="mt-6 px-4 relative"> <input class="h-12 transition-all px-1 outline-none w-full border rounded-lg" type="text" required> <label class="text-pink-600 absolute transition-all top-4 pointer-events-none text-sm left-5">Last Name</label> </div>
                <div class="mt-6 px-4 relative"> <input class="h-12 transition-all px-1 outline-none w-full border rounded-lg" type="number" require required> <label class="text-pink-600 absolute transition-all top-4 pointer-events-none text-sm left-5">Phone Number</label> </div>
                <div class="flex w-full gap-px">
                    <div class="w-full mt-6 px-4 relative"> <input class="h-12 transition-all px-1 outline-none w-full border rounded-lg" type="text" require required> <label class="text-pink-600 absolute transition-all top-4 pointer-events-none text-sm left-5">E-mail</label> </div>
                    <div class="w-full mt-6 px-4 relative"> <input class="h-12 transition-all px-1 outline-none pr-8 w-full border rounded-lg pass" type="password" require required> <label class="text-pink-600 absolute transition-all top-4 pointer-events-none text-sm left-5">Password</label> <i class="text-pink-600 fa fa-eye-slash absolute top-4 cursor-pointer right-6"></i> </div>
                </div>
                <div class="mt-6 flex justify-center px-4 relative"> <button class="create_acc text-md h-12 w-full bg-green-400 rounded-full text-white hover:bg-green-600 transition-all">Create Account<i class="fa fa-long-arrow-right absolute top-4 right-8"></i></button> </div>
                <p class="my-10 text-center text-sm px-4 text-gray-500">By clicking "Create Account",I agree<br> to Earnify's <a class="text-blue-800" href="#">Privacy Policy</a></p>
            </div>
            <div class="main hidden">
                <h4 class="flex justify-center items-center mt-5 text-lg text-gray-800 font-medium">Step 2. Contact Details</h4>
                <div class="flex w-full gap-px">
                    <div class="w-full mt-6 px-4 relative"> <input class="h-12 transition-all px-1 outline-none w-full border rounded-lg" type="text" require required> <label class="text-pink-600 absolute transition-all top-4 pointer-events-none text-sm left-5">Place of Birth</label> </div>
                    <div class="w-full mt-6 px-4 relative"> <input class="h-12 transition-all px-1 outline-none w-full border rounded-lg" type="text" require required> <label class="text-pink-600 absolute transition-all top-4 pointer-events-none text-sm left-5">Village/City/Town</label> </div>
                </div>
                <div class="flex w-full gap-px">
                    <div class="w-full mt-6 px-4 relative"> <input class="h-12 transition-all px-1 outline-none w-full border rounded-lg" type="text" required> <label class="text-pink-600 absolute transition-all top-4 pointer-events-none text-sm left-5">District</label> </div>
                    <div class="w-full mt-6 px-4 relative"> <input class="h-12 transition-all px-1 outline-none w-full border rounded-lg" type="text" require required> <label class="text-pink-600 absolute transition-all top-4 pointer-events-none text-sm left-5">State</label> </div>
                </div>
                <div class="flex w-full gap-px">
                    <div class="w-full mt-6 px-4 relative"> <input class="h-12 transition-all px-1 outline-none w-full border rounded-lg" type="text" required> <label class="text-pink-600 absolute transition-all top-4 pointer-events-none text-sm left-5">Nationality</label> </div>
                    <div class="w-full mt-6 px-4 relative"> <input class="h-12 transition-all px-1 outline-none w-full border rounded-lg" type="text" required> <label class="text-pink-600 absolute transition-all top-4 pointer-events-none text-sm left-5">Religion</label> </div>
                </div>
                <div class="flex w-full gap-px">
                    <div class="w-full mt-6 px-4 relative"> <input class="mt-6 cursor-pointer" type="radio" name="gender"> MALE <input class=" cursor-pointer" type="radio" name="gender">FEMALE <span class="text-pink-600 absolute transition-all pointer-events-none text-sm left-4">Select Gender</span> </div>
                    <div class="w-full mt-6 px-4 relative"> <input class="h-12 transition-all px-1 outline-none w-full border rounded-lg" type="text" require required> <label class="text-pink-600 absolute transition-all top-4 pointer-events-none text-sm left-5">Blood Group</label> </div>
                </div>
                <div class="mt-6 flex mb-10 justify-center px-4 relative gap-2"> <button class="back_page text-md h-12 w-full bg-green-400 rounded-full text-white hover:bg-green-600 transition-all ">Previous<i class="fa fa-long-arrow-left absolute top-4 left-8"></i></button> <button class="next_page text-md h-12 w-full bg-green-400 rounded-full text-white hover:bg-green-600 transition-all">Next<i class="fa fa-long-arrow-right absolute top-4 right-8"></i></button> </div>
            </div>
            <div class="main hidden">
                <h4 class="flex justify-center items-center mt-5 text-lg text-gray-800 font-medium">Step 3. Company Details</h4>
                <div class="mt-7 px-4 relative"> <input class="h-12 transition-all px-1 outline-none w-full border rounded-lg" type="text" require required> <label class="text-pink-600 absolute transition-all top-4 pointer-events-none text-sm left-5">Company Name</label> </div>
                <div class="mt-6 px-4 relative"> <input class="h-12 transition-all px-1 outline-none w-full border rounded-lg" type="text" require required> <label class="text-pink-600 absolute transition-all top-4 pointer-events-none text-sm left-5">Job Title</label> </div>
                <div class="mt-6 px-4 relative"> <input class="h-12 transition-all px-1 outline-none w-full border rounded-lg" type="number" required> <label class="text-pink-600 absolute transition-all top-4 pointer-events-none text-sm left-5">Number of employees</label> </div>
                <div class="w-full mt-6 px-4 relative"> <input class="h-12 transition-all px-1 outline-none w-full border rounded-lg" type="text" require required> <label class="text-pink-600 absolute transition-all top-4 pointer-events-none text-sm left-5">Website URL</label> </div>
                <div class="mt-6 flex mb-10 justify-center px-4 relative gap-2"> <button class="back_page text-md h-12 w-full bg-green-400 rounded-full text-white hover:bg-green-600 transition-all ">Previous<i class="fa fa-long-arrow-left absolute top-4 left-8"></i></button> <button class="submit_page text-sm h-12 w-full bg-blue-400 rounded-full text-white hover:bg-blue-600 transition-all">Submit Details<i class="fa fa-long-arrow-right absolute top-5 right-8"></i></button> </div>
                <p class="my-10 text-center text-sm px-4 text-gray-500">By clicking "Create Account",I agree<br> to Earnify's <a class="text-blue-800" href="#">Privacy Policy</a></p>
            </div>
            <div class="main hidden">
                <h4 class="flex justify-center items-center mt-5 text-lg text-gray-800 font-medium">Congrats Mr./Mrs. <span class="shown_name"></span></h4> <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                    <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" /> </svg>
                <p class="mt-5 mb-10 text-sm px-4 text-center text-pink-700 font-semibold	tracking-wide">Thanks for creating campaign with earnify,your details have been submitted successfully we fill contact you soon for further regards. </p>
            </div>
        </div>
        <!--</div>-->
    </div>
</div>
	



</section>
</div>
@endsection

@section('script')

@endsection