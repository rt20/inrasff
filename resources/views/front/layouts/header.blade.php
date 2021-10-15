<header class="fixed top-0 w-full bg-white shadow-md z-10">
    <div id="header-wrapper" class="hidden lg:block" x-data="{ showTopHeader: true }">
        <div class="top-header" 
            x-show="showTopHeader === true"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-500"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            >
            <div class="container mx-auto flex justify-between items-center px-6 lg:px-0">
                <div class="text-primary text-xs tracking-wider font-semibold">
                    Selamat datang di website INRASFF
                </div>
                <a href="{{ route('backadmin.auth.index') }}" target="_blank" class="inline-block mr-1 p-3 flex items-center bg-gray-100 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill h-4 mr-1" viewBox="0 0 16 16"><path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg>
                    <span class="text-xs font-semibold">Login to your account</span>
                </a>
            </div>
        </div>
        <hr>
        <div class="top-header" 
            x-show="showTopHeader === true"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-500"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            >
            <div class="container mx-auto flex justify-between items-center my-3 px-6 lg:px-0">
                <a href="{{ route('home') }}" class="flex-shrink-0">
                    <img src="{{ asset('images/logo_little_white.png') }}" class="h-12" style="filter: drop-shadow(1px 1px .5px black);" />
                </a>
                <div class="flex items-center">
                    <div class="text-sm mr-3 text-gray-400">
                        Follow our social media
                    </div>
                    <a href="https://www.facebook.com" target="_blank" class="inline-block p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook h-4 text-primary" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
                    </a>
                    <a href="https://www.instagram.com" target="_blank" class="inline-block p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram h-4 text-primary" viewBox="0 0 16 16"><path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/></svg>
                    </a>
                    <a href="https://www.twitter.com" target="_blank" class="inline-block p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter h-4 text-primary" viewBox="0 0 16 16"><path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/></svg>
                    </a>
                </div>
            </div>
        </div>
        <hr>
        <div class="bg-primary text-white">
            <div class="container mx-auto top-menu flex justify-between items-center py-1">
                <menu class="flex-grow flex justify-item-start px-0 my-2" x-data="{ showBisnis: false, showAbout: false }">
                    <a href="{{ route('home') }}" class="inline-block py-2 hover:text-gray-400 transition duration-300 uppercase text-sm mr-10">Home</a>
                    <a href="{{ route('news') }}" class="inline-block py-2 hover:text-gray-400 transition duration-300 uppercase text-sm mr-10">Berita</a>
                    <a href="{{ route('kementrian') }}" class="inline-block py-2 hover:text-gray-400 transition duration-300 uppercase text-sm mr-10">Kementrian</a>
                    <a href="{{ route('aboutus') }}" class="inline-block py-2 hover:text-gray-400 transition duration-300 uppercase text-sm mr-10">Tentang Kami</a>
                    <a href="{{ route('contactus') }}" class="inline-block py-2 hover:text-gray-400 transition duration-300 uppercase text-sm">Hubungi Kami</a>
                </menu>
                <form method="GET">
                    <div class="relative text-gray-600 focus-within:text-gray-400">
                        <input type="search" name="" class="py-2 text-sm text-white bg-white rounded-full pr-10 pl-5 focus:outline-none focus:bg-gray-100 focus:text-gray-900" placeholder="Search" autocomplete="off">
                        <span class="absolute inset-y-0 right-0 flex items-center pr-2">
                            <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-4 h-4"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="lg:hidden" x-data="{ showMobileMenu: false }">
        <div class="w-full flex justify-between items-center px-6 py-3" x-show="showMobileMenu === false">
            <a href="#" class="flex-shrink-0">
                <img src="{{ asset('images/logo_little_white.png') }}" class="h-12" style="filter: drop-shadow(1px 1px .5px black);"/>
            </a>
            <button class="text-gray-500 p-2" @click="showMobileMenu = true">
                <svg class="w-6 h-6 fill-current" width="384px" height="278px" viewBox="0 0 384 278"><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="menu" fill="#220080" fill-rule="nonzero"><path d="M258.31343,154.667969 L15.0428913,154.667969 C8.76386925,154.667969 0,147.5 0,138.667969 C0,129.835938 8.76386925,122.667969 15.0428913,122.667969 L258.31343,122.667969 C264.592452,122.667969 273,129.835938 273,138.667969 C273,147.5 264.592452,154.667969 258.31343,154.667969 Z" id="Shape"></path><path d="M368,32 L16,32 C7.167969,32 0,24.832031 0,16 C0,7.167969 7.167969,0 16,0 L368,0 C376.832031,0 384,7.167969 384,16 C384,24.832031 376.832031,32 368,32 Z" id="Shape"></path><path d="M368,277.332031 L16,277.332031 C7.167969,277.332031 0,270.164062 0,261.332031 C0,252.5 7.167969,245.332031 16,245.332031 L368,245.332031 C376.832031,245.332031 384,252.5 384,261.332031 C384,270.164062 376.832031,277.332031 368,277.332031 Z" id="Shape"></path></g></g></svg>
            </button>
        </div>
        <div class="w-full h-screen px-6 py-3 bg-white z-50" x-show="showMobileMenu === true">
            <div class="w-full flex justify-between items-center">
                <a href="{{ route('home') }}" class="flex-shrink-0">
                    <img src="{{ asset('images/logo_little_white.png') }}" class="h-12" style="filter: drop-shadow(1px 1px .5px black);"/>
                </a>
                <button class="text-gray-500 p-2" @click="showMobileMenu = false">
                    <svg class="w-4 h-4 fill-current" x="0px" y="0px"viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve"><g><g><path d="M300.188,246L484.14,62.04c5.06-5.064,7.852-11.82,7.86-19.024c0-7.208-2.792-13.972-7.86-19.028L468.02,7.872c-5.068-5.076-11.824-7.856-19.036-7.856c-7.2,0-13.956,2.78-19.024,7.856L246.008,191.82L62.048,7.872c-5.06-5.076-11.82-7.856-19.028-7.856c-7.2,0-13.96,2.78-19.02,7.856L7.872,23.988c-10.496,10.496-10.496,27.568,0,38.052L191.828,246L7.872,429.952c-5.064,5.072-7.852,11.828-7.852,19.032c0,7.204,2.788,13.96,7.852,19.028l16.124,16.116c5.06,5.072,11.824,7.856,19.02,7.856c7.208,0,13.968-2.784,19.028-7.856l183.96-183.952l183.952,183.952c5.068,5.072,11.824,7.856,19.024,7.856h0.008c7.204,0,13.96-2.784,19.028-7.856l16.12-16.116c5.06-5.064,7.852-11.824,7.852-19.028c0-7.204-2.792-13.96-7.852-19.028L300.188,246z"/></g></g></svg>
                </button>
            </div>
            <div class="w-full text-primary mt-8 h-full">
                <a href="{{ route('home') }}" class="block py-3 transition duration-300 uppercase font-bold">Home</a>
                <a href="{{ route('news') }}" class="block py-3 transition duration-300 uppercase font-bold">Berita</a>
                <a href="{{ route('kementrian') }}" class="block py-3 transition duration-300 uppercase font-bold">Kementrian</a>
                <a href="{{ route('aboutus') }}" class="block py-3 transition duration-300 uppercase font-bold">Tentang Kami</a>
                <a href="{{ route('contactus') }}" class="block py-3 transition duration-300 uppercase font-bold">Hubungi Kami</a>
            </div>
            <div class="bg-secondary_dark py-3 text-center fixed inset-x-0 bottom-0 w-full">
                <div class="container text-center lg:flex mx-auto px-6 px-0 lg:justify-between lg:items-center">
                    <span class="block mt-2 lg:mt-0 lg:inline-block flex-shrink-0 text-xs text-white">Copyrights © {{ date('Y') }} All Rights Reserved INRASFF</span>
                    <span class="block mt-2 lg:mt-0 lg:inline-block flex-shrink-0 text-xs text-white">Badan Pengawasan Obat dan Makanan Republik Indonesia</span>
                </div>
            </div>
        </div>
    </div>
</header>