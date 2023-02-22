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
      <!--  Please fill in the details below so that we can get in contact with you. -->
      </p>
    </div>
	
    <div class="text-gray-600 A0">
      <div class="container flex flex-col flex-wrap px-5 py-4 mx-auto">

        <div class="flex flex-wrap mx-auto">
          <a
            class="
              inline-flex
              items-center
              justify-center
              w-1/2
              py-3
              font-medium
              leading-none
              tracking-wider
              text-indigo-500
              bg-gray-100
              border-b-2 border-indigo-500
              rounded-t
              sm:px-6 sm:w-auto sm:justify-start
              title-font
            "
          >
            Pertanyaan 1
          </a>
          <a
            class="
              inline-flex
              items-center
              justify-center
              w-1/2
              py-3
              font-medium
              leading-none
              tracking-wider
              text-indigo-500
              border-b-2 border-gray-200
              sm:px-6 sm:w-auto sm:justify-start
              title-font
              hover:text-gray-900
            "
          >
		  Pertanyaan 2
          </a>
          <a
            class="
              inline-flex
              items-center
              justify-center
              w-1/2
              py-3
              font-medium
              leading-none
              tracking-wider
              border-b-2 border-gray-200
              sm:px-6 sm:w-auto sm:justify-start
              title-font
              hover:text-gray-900
            "
          >
		  Pertanyaan 3
          </a>
        </div>
        <div class="flex flex-col w-full text-center">
          <div class="py-6 bg-white sm:py-8 lg:py-12">
            <div class="px-4 mx-auto max-w-screen-2xl md:px-8">
              <!-- form - start -->
			  
              <form class="max-w-screen-md mx-auto">
                <div class="flex flex-col mb-4">
				<label for="name" class="inline-flex mb-2 text-sm text-gray-800">
                    PTA0</label>
                    <label class="radio-choice" style="display: none">
                <input type="radio" name="default-radio" id="default-radio" value="" checked>
            </label>
					<div class="flex items-center mb-4">
						<input checked type="radio" value="PTA1" name="default-radio" class="default-radio w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
						<label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ya</label>
					</div>
					<div class="flex items-center">
						<input type="radio" value="PTA2" name="default-radio" class="default-radio w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
						<label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak</label>
					</div>
                </div>
				

                <div class="flex items-center justify-between">
                  <button
                    class="
                      inline-flex
                      items-center
                      px-6
                      py-2
                      text-sm text-gray-800
                      rounded-lg
                      shadow
                      outline-none
                      gap-x-1
                      hover:bg-gray-100
                    "
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="w-4 h-4"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"
                      /></svg
                    >Sebelumnya
                  </button>
                  <button
                    class="
                      px-6
                      py-2
                      text-sm text-white
                      bg-indigo-500
                      rounded-lg
                      outline-none
                      hover:bg-indigo-600
                      ring-indigo-300
                    "
                  >
                    Selanjutnya
                  </button>
                </div>
              </form>
              <!-- form - end -->
            </div>
          </div>
        </div>
      </div>
    </div>
	
    <div class="hidden A1">
      <div class="container flex flex-col flex-wrap px-5 py-4 mx-auto">

        <div class="flex flex-wrap mx-auto">
          <a
            class="
              inline-flex
              items-center
              justify-center
              w-1/2
              py-3
              font-medium
              leading-none
              tracking-wider
              text-indigo-500
              bg-gray-100
              border-b-2 border-indigo-500
              rounded-t
              sm:px-6 sm:w-auto sm:justify-start
              title-font
            "
          >
            Pertanyaan 1
          </a>
          <a
            class="
              inline-flex
              items-center
              justify-center
              w-1/2
              py-3
              font-medium
              leading-none
              tracking-wider
              text-indigo-500
              border-b-2 border-gray-200
              sm:px-6 sm:w-auto sm:justify-start
              title-font
              hover:text-gray-900
            "
          >
		  Pertanyaan 2
          </a>
          <a
            class="
              inline-flex
              items-center
              justify-center
              w-1/2
              py-3
              font-medium
              leading-none
              tracking-wider
              border-b-2 border-gray-200
              sm:px-6 sm:w-auto sm:justify-start
              title-font
              hover:text-gray-900
            "
          >
		  Pertanyaan 3
          </a>
        </div>
        <div class="flex flex-col w-full text-center">
          <div class="py-6 bg-white sm:py-8 lg:py-12">
            <div class="px-4 mx-auto max-w-screen-2xl md:px-8">
              <!-- form - start -->
			  
              <form class="max-w-screen-md mx-auto">
                <div class="flex flex-col mb-4">
				<label for="name" class="inline-flex mb-2 text-sm text-gray-800">
                    PTA1</label>
				
					<div class="flex items-center mb-4">
						<input id="default-radio-1" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
						<label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ya</label>
					</div>
					<div class="flex items-center">
						<input checked id="default-radio-2" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
						<label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak</label>
					</div>
                </div>
				

                <div class="flex items-center justify-between">
                  <button
                    class="
                      inline-flex
                      items-center
                      px-6
                      py-2
                      text-sm text-gray-800
                      rounded-lg
                      shadow
                      outline-none
                      gap-x-1
                      hover:bg-gray-100
                    "
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="w-4 h-4"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"
                      /></svg
                    >Sebelumnya
                  </button>
                  <button
                    class="
                      px-6
                      py-2
                      text-sm text-white
                      bg-indigo-500
                      rounded-lg
                      outline-none
                      hover:bg-indigo-600
                      ring-indigo-300
                    "
                  >
                    Selanjutnya
                  </button>
                </div>
              </form>
              <!-- form - end -->
            </div>
          </div>
        </div>
      </div>
    </div>


</section>
</div>
@endsection

@section('script')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
      $(document).ready(function() {
        $('.default-radio').on('change', function() {
          if (this.value === "PTA1") {
            $(".A0").hide();
            $(".A1").show();
            $(".A2").hide();
          } else {
            $(".A0").hide();
            $(".A1").hide);
            $(".A2").show();
          }
        });
      });
    </script>
@endsection