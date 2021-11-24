<footer class="text-white w-full">
    <div class="bg-secondary py-6">
        <div class="container mx-auto py-12 px-4 sm:px-6">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="xl:col-span-1">
                    <img class="w-1/2 pb-8" src="{{ asset('images/logo_little_white.png') }}" style="filter: drop-shadow(1px 1px .5px black);">
                    <p class="text-white pb-5 leading-normal">
                        Jalan Percetakan Negara Nomor 23 <br>
                        Jakarta - 10560 - Indonesia
                    </p>
                    <div class="text-white font-bold pb-2">
                        Phone
                    </div>
                    <div class="text-white pb-5">
                        +6221 426333
                    </div>
                    <div class="text-white font-bold pb-2">
                        Email
                    </div>
                    <div class="text-white pb-5">
                        halobpom@pom.go.gid
                    </div>
                </div>
                <div class="mt-12 grid grid-cols-1 gap-8 xl:mt-0 xl:col-span-2">
                    <div class="md:grid md:grid-cols-3 md:gap-8">
                        <div>
                            <h3 class="text-xl font-bold text-white tracking-wider uppercase">
                                Menu
                            </h3>
                            <ul role="list" class="mt-4 space-y-4">
                                <li>
                                    <a href="{{ route('home') }}" class="text-base text-white hover:text-gray-400">
                                    Home
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('news') }}" class="text-base text-white hover:text-gray-400">
                                    Berita
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('kementrian') }}" class="text-base text-white hover:text-gray-400">
                                    Kementerian
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('contactus') }}" class="text-base text-white hover:text-gray-400">
                                    Hubungi Kami
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-span-2 mt-12 md:mt-0">
                            <h3 class="text-xl font-bold text-white tracking-wider uppercase">
                                Tentang Kami
                            </h3>
                            <ul role="list" class="mt-4 space-y-4">
                                <li>
                                    <a href="{{ route('aboutus') }}" class="text-base text-white hover:text-gray-400">
                                    Indonesia Rapid Alert System For Food And Feed
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('baganalir') }}" class="text-base text-white hover:text-gray-400">
                                    Bagan Alir Penerapan INRASFF
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logical') }}" class="text-base text-white hover:text-gray-400">
                                    Logical Framework INRASFF
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-secondary_dark py-3">
        <div class="container text-center lg:flex mx-auto px-6 px-0 lg:justify-between lg:items-center">
            <span class="block mt-2 lg:mt-0 lg:inline-block flex-shrink-0 text-xs text-white">Copyrights © {{ date('Y') }} All Rights Reserved INRASFF</span>
            {{-- <span class="block mt-2 lg:mt-0 lg:inline-block flex-shrink-0 text-xs text-white">Badan Pengawasan Obat dan Makanan Republik Indonesia</span> --}}
        </div>
    </div>
</footer>