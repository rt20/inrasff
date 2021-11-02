@extends('front.layouts.app')

@section('style')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<link href="https://fonts.googleapis.com/css?family=Source+Code+Pro|Roboto&display=swap" rel="stylesheet">
@endsection

@section('body')
<section class="px-3 bg-cover lg:mx-auto mt-16 lg:mt-44" style="background-image: url({{ asset('seeder/slider_1.jpg') }});">
	<div class="container mx-auto pt-16 pb-8 lg:py-16">
		<div class="text-center lg:text-left lg:flex lg:justify-between lg:items-center">
			<div>
				<div class="text-xl text-white font-bold uppercase tracking-wide mb-5">Tentang Kami</div>
			</div>
			<div class="text-sm text-white tracking-wide">
				<a href="#">Home</a> / <a href="javascript:void(0)" class="font-semibold">Tentang Kami</a>
			</div>
		</div>
	</div>
</section>

<section class="container px-3 py-12 lg:mx-auto">
	<div class="text-xl font-bold mb-5 leading-normal">Indonesia Rapid Alert System For Food And Feed</div>
	<div class="leading-normal mb-5">
		<p>Indonesia Rapid Alert System For Food And Feed (INRASFF) Adalah Suatu Sistem Komunikasi Cepat Yang Melibatkan Instansi Terkait Keamanan Pangan Di Indonesia Untuk Melaksanakan Kewaspadaan Dan Penanggulangan Kasus Keamanan Pangan Dan Pakan. INRASFF Melakukan Pengumpulan Dan Analisis Data Permasalahan Keamanan Pangan Melalui Competent Contact Point (CCP) INRASFF Di Dalam Negeri Dan Jejaring Keamanan Pangan Internasional (European Union RASFF, ASEAN RASFF, International Food Safety Authority Network (INFOSAN), Dsb.). Instansi Yang Berperan Sebagai CCP Dalam Jejaring INRASFF Adalah Kementerian Pertanian, Kementerian Kelautan Dan Perikanan, Kementerian Kesehatan, Kementerian Perdagangan, Kementerian Perindustrian, Kementerian Keuangan, Serta Badan POM. Selain Sebagai CCP, Badan POM Juga Berperan Sebagai National Contact Point (NCP) Bagi Indonesia.</p>
	</div>
	<div class="mx-auto text-center w-full lg:w-3/4">
		<img src="http://inrasff.net/images/32/INRASFF.png" class="w-full">
	</div>
</section>

<section class="bg-gray-100">
	<div class="container px-3 py-12 lg:mx-auto">
		<div x-data={show:false}>
			<div class="flex justify-between items-center mb-5 py-4 border-b border-gray-200 leading-normal cursor-pointer" 
				@click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'border-b': !show }">
				<div class="font-semibold text-base lg:text-lg">
					LATAR BELAKANG PENERAPAN SISTEM INRASFF
				</div>
				<div class="font-semibold text-base lg:text-lg mx-3">
					
					<svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/></svg>

					<svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
				
				</div>
			</div> 
			<div x-show="show" class="border-b text-sm lg:text-base border-gray-200 pb-4 leading-normal">
				<p>Menjamin Keamanan Pangan yang dikonsumsi masyarakat Indonesia</p>
				<br>
				<p>European Union Rapid Alert System for Food and Feed (EU RASFF) merupakan sistem kewaspadaan dini/ cepat (rapid alert system) yang dikembangkan oleh Uni Eropa sebagai sistem notifikasi pangan dan pakan yang berisiko langsung atau tidak langsung bagi kesehatan manusia dan tindakan penanganan/ penanggulangan yang perlu diambil oleh pihak berwenang untuk mencegah risiko tersebut masuk ke rantai pangan.</p>
				<br>
				<p>Saat ini, RASFF yang pada awalnya dikembangkan di Eropa selama kurang lebih 30 tahun telah menjadi isyu global. Hal ini dikarenakan, mendapatkan pangan yang bermutu dan aman telah menjadi prioritas berbagai bangsa di setiap Negara, tak terkecuali, Indonesia.</p>
				<br>
				<p>Setiap individu berhak untuk mengonsumsi pangan yang aman dan bermutu. Pemerintah selaku otoritas kompeten berkewajiban untuk melindungi kesehatan masyarakat dengan cara menjamin keamanan pangan yang beredar terhadap kemungkinan tercemarnya pangan oleh bahaya fisik, kimia, atau biologi. Dengan diaplikasikannya RASFF secara tidak langsung dapat meminimalisir risiko konsumen dari mengkonsumsi pangan yang telah teridentifikasi bahaya.</p>
				<br>
				<p>Komitmen Indonesia terhadap kesepakatan di tingkat Regional ASEAN</p>
				<br>
				<p>Pada workshop regional ASEAN Rapid Alert System for Food and Feed (ASEAN RASFF) yang diselenggarakan di Jakarta pada 3 – 5 Juni 2008, Indonesia telah menunjukkan komitmennya untuk mulai mengembangkan national alert system yang selaras dengan ASEAN RASFF. Untuk itu, diperlukan persiapan yang komprehensif dalam rangka penerapan Indonesia Rapid Alert System for Food and Feed (INRASFF).</p>
				<br>
				<p>Selain itu, berdasarkan rekomendasi dalam 3rd EU-ASEAN Workshop on RASFF, Hanoi, 3 – 5 Nopember 2009 disepakati bahwa negara – negara anggota ASEAN harus concern dalam pengembangan dan penerapan RASFF di tingkat nasional maupun regional, untuk itu Indonesia, selaku negara anggota ASEAN merasa perlu memperkuat tim nasional RASFF terlebih dahulu sebelum bergabung dengan ASEAN RASFF.</p>
			</div>
		</div>
		<div x-data={show:false}>
			<div class="flex justify-between items-center mb-5 py-4 border-b border-gray-200 leading-normal cursor-pointer" 
				@click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'border-b': !show }">
				<div class="font-semibold text-base lg:text-lg">
					TUJUAN DAN STRATEGI PENERAPAN INRASFF
				</div>
				<div class="font-semibold text-base lg:text-lg mx-3">
					
					<svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/></svg>

					<svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
				
				</div>
			</div> 
			<div x-show="show" class="border-b text-sm lg:text-base border-gray-200 pb-4 leading-normal">
				<div class="font-bold text-sm lg:text-base mb-3"> TUJUAN </div>
				<ul class="mb-5 list-disc list-inside space-y-3 mb-8">
					<li>Meningkatkan kecepatan dalam pertukaran informasi terkait permasalahan keamanan pangan antar otoritas kompeten keamanan pangan di Indonesia</li>
					<li>Meningkatkan keamanan pangan, khususnya produk impor, yang beredar di Indonesia.</li>
					<li>Meminimalisasi penolakan terhadap produk ekspor asal Indonesia</li>
					<li>Meningkatkan kepercayaan masyarakat regional dan internasional terhadap produk – produk Indonesia</li>
				</ul>

				<div class="font-bold text-sm lg:text-base mb-3">STRATEGI</div>
				<ul class="mb-5 list-disc list-inside space-y-3 mb-8">
					<li>Membuat komitmen bersama antar institusi terkait keamanan pangan di Indonesia untuk koordinasi dan penyelarasan terkait penerapan RASFF.</li>
					<li>Melakukan kolaborasi sistem RASFF pada instansi pemerintah terkait keamanan pangan sebagai upaya percepatan proses notifikasi produk pangan yang berbahaya.</li>
					<li>Menyempurnakan dan melengkapi perangkat hukum & kelengkapan persyaratan legal lainnya, guna mendukung terwujudnya INRASFF.</li>
					<li>Meningkatkan kapasitas dan integritas Sumber Daya Manusia (SDM) untuk mendukung penerapan INRASFF.</li>
				</ul>
			</div>
		</div>
		<div x-data={show:false}>
			<div class="flex justify-between items-center mb-5 py-4 border-b border-gray-200 leading-normal cursor-pointer" 
				@click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'border-b': !show }">
				<div class="font-semibold text-base lg:text-lg">
					DUKUNGAN UNI EROPA TERHADAP PELAKSANAAN RASFF DI INDONESIA
				</div>
				<div class="font-semibold text-base lg:text-lg mx-3">
					
					<svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/></svg>

					<svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
				
				</div>
			</div> 
			<div x-show="show" class="border-b text-sm lg:text-base border-gray-200 pb-4 leading-normal">
				<p class="leading-normal">Uni Eropa memberikan bantuan dalam bentuk technical assistance guna mendukung diterapkannya RASFF di Indonesia. Technical assistance tersebut dilaksanakan sebanyak 2 (dua) kali, yaitu pada tanggal 5 – 15 Oktober 2009 dan 12 – 24 Juli 2010. Tim EU Expert on RASFF tersebut yaitu:</p>
				<br>
				<ul class="mb-5 list-disc list-inside space-y-3 mb-8">
					<li>Mrs. Paola Picotto (NCP of Italy)</li>
					<li>Mr. Dedi Fardiaz (Senior Indonesian Expert)</li>
					<li>Mr. Sebastien Rahoux (IT Expert)</li>
				</ul>
				<p class="leading-normal">Selama berada di Indonesia, tim EU expert bekerjasama dengan tim dari Badan POM RI dan instansi terkait lainnya, guna mendapatkan “potret kesiapan Indonesia dalam pelaksanaan RASFF” yang merupakan tujuan dari kunjungan pertama. Sedangkan kunjungan kedua bertujuan untuk melihat kemajuan Indonesia sejak kunjungan pertama dan membantu menyiapkan hal – hal teknis dalam rangka persiapan penerapan RASFF, yaitu membantu membuat rancangan guideline INRASFF, serta rancangan SOP NCP.</p>
			</div>
		</div>
		<div x-data={show:false}>
			<div class="flex justify-between items-center mb-5 py-4 border-b border-gray-200 leading-normal cursor-pointer" 
				@click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'border-b': !show }">
				<div class="font-semibold text-base lg:text-lg">
					KESIAPAN INDONESIA DALAM RANGKA PENERAPAN INRASFF
				</div>
				<div class="font-semibold text-base lg:text-lg mx-3">
					
					<svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/></svg>

					<svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
				
				</div>
			</div> 
			<div x-show="show" class="border-b text-sm lg:text-base border-gray-200 pb-4 leading-normal">
				<p>Beberapa hal yang telah dilakukan Indonesia dalam rangka penerapan INRASFF, yaitu:</p>
				<br>
				<ul class="mb-5 list-decimal list-inside space-y-3 mb-8">
					<li>Identifikasi Competence Contact Point (CCP) di Instansi terkait</li>
					<li>Pembentukan Working Group INRASFF pada tanggal 30 Juni 2010</li>
					<li>Pembuatan roadmap pelaksanaan INRASFF</li>
					<li>Adanya Rancangan guideline INRASFF</li>
					<li>Adanya rancangan TOR / Proposal INRASFF</li>
					<li>Pembuatan roadmap pelaksanaan INRASFF</li>
					<li>Adanya aplikasi untuk pertukaran informasi dalam INRASFF</li>
				</ul>

				<ul class="mb-5 list-decimal list-inside space-y-3 mb-8">
					<li>
						<span class="font-semibold">Identifikasi Competence Contact Point (CCP) di Instansi terkait</span><br>
						<p>Rekomendasi tim EU expert on RASFF pada kunjungan pertama adalah agar segera dilakukan identifikasi NCP dan CCP di Indonesia, maka sebagai tindak lanjutnya, Badan POM RI mengirimkan surat kepada sekretaris jenderal di kementerian terkait perihal permintaan RASFF Competence Contact Point (CCP) dan penentuan National Contact Point (NCP) di masing – masing kementerian terkait.</p>
						<p>Berdasarkan formulir isian yang dikembalikan ke Badan POM RI,  4 dari 6 instansi memberikan dukungannya untuk mendukung Badan POM sebagai NCP. Selain itu, telah teridentifikasi CCP di Kementerian terkait.</p>
					</li>

					<li>
						<span class="font-semibold">Pembentukan Working Group INRASFF</span><br>
						<p>Working Group on RASFF telah terbentuk pada tanggal 30 Juni 2010, yang beranggotakan perwakilan dari beberapa instansi terkait keamanan pangan di tingkat pusat. Working Group terdiri dari CCP di Kementerian terkait dan juga staf yang diberi tanggung jawab khusus untuk menangani RASFF. Payung hukum working group INRASFF sedang disiapkan dengan mengacu pada legal aspek Jejaring Keamanan Pangan Nasional, yaitu Keputusan Menko Kesra No. 23 Tahun 2011.</p>
					</li>

					<li>
						<span class="font-semibold">Pembuatan roadmap pelaksanaan INRASFF</span><br>
						<p>Kegiatan RASFF harus terprogram dan terintegrasi dengan baik. Implementasi national RASFF harus berjalan dengan baik dan lancar terlebih dahulu sebelum Indonesia menjadi anggota/ berperan serta dalam ASEAN RASFF. Untuk itu diperlukan arahan kegiatan RASFF lima tahun kedepan</p>
						<div class="overflow-x-scroll">
							<table class="table-auto border-collapse border my-8">
								<thead>
									<tr class="text-center bg-gray-200">
										<th class="border py-2">2010</th>
										<th class="border py-2">2011</th>
										<th class="border py-2">2012</th>
										<th class="border py-2">2013</th>
										<th class="border py-2">2014</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="border p-5">1. Penguatan SKPKP di Badan POM RI</td>
										<td class="border p-5">1. Pemetaan Tugas dan Fungsi antar instansi terkait RASFF</td>
										<td rowspan="3" class="border p-5">1. Aplikasi sistem National RASFF di Indonesia</td>
										<td rowspan="3" class="border p-5">1. Revisi dan perbaikan aplikasi sistem nasional RASFF di Indonesia</td>
										<td rowspan="3" class="border p-5">Indonesia berperan serta dalam ASEAN RAPID ALERT SYSTEM FOR FOOD AND FEED</td>
									</tr>
									<tr>
										<td class="border p-5">2. Inisiasi pertemuan2 dengan lintas sektor terkait untuk membicarakan mengenai NATIONAL RASFF</td>
										<td class="border p-5">2. Tata cara dan alur yang jelas untuk pelaporan dan pertukaran informasi</td>
									</tr>
									<tr>
										<td class="border p-5">3. Pembuatan  rancangan TOR NATIONAL RASFF</td>
										<td class="border p-5">3. Peresmian TOR NATIONAL RASFF</td>
									</tr>
								</tbody>
							</table>
						</div>
					</li>

					<li>
						<span class="font-semibold">Adanya rancangan Guideline INRASFF</span><br>
						<p>Rancangan pedoman INRASFF telah dibahas oleh INRASFF Working Group pada tanggal 30 Nopember 2010. Salah satu rekomendasi dalam pertemuan tersebut adalah perlunya legal aspect  dalam penerapan INRASFF. Untuk itu legal aspect INRASFF akan segera dibuat dengan mengacu kepada legal aspect Jejaring Keamanan Pangan Nasional (JKPN) yang sedang dalam proses peresmian di Kementerian Koordinasi Bidang Kesejahteraan Rakyat. Hal tersebut dikarenakan INRASFF merupakan salah satu program unggulan dalam JKPN</p>
					</li>

					<li>
						<span class="font-semibold">Adanya Draft Rencana Aksi INRASFF</span><br>
						<p>Draft Rencana Aksi INRASFF berisi mengenai latar belakang, tujuan, kegiatan, model dan konsep dasar INRASFF, time frame pelaksanaan, dan logical framework penerapan INRASFF. Draft Rencana aksi tersebut bertujuan untuk mengkoordinasikan kegiatan – kegiatan terkait INRASFF di setiap kementerian terkait dalam rangka meningkatkan sistem kewaspadaan dini dan penanggulangan cepat keamanan pangan guna meningkatkan keamanan produk pangan yang beredar dalam rangka perlindungan konsumen dan berperan serta dalam fair trade di dalam maupun luar negeri. Kekurangan proposal tersebut adalah tidak adanya sumber dana yang tetap guna melaksanaan kegiatan – kegiatan yang telah dijabarkan dalam proposal tersebut.</p>
					</li>

					<li>
						<span class="font-semibold">Adanya aplikasi untuk pertukaran informasi dalam INRASFF</span><br>
						<p>Aplikasi INRASFF telah dibuat pada tahun 2009. Aplikasi dibuat berdasarkan web-based application, sehingga dapat digunakan dimana saja dengan syarat harus memiliki jaringan internet dan user ID. Alamat aplikasi INRASFF tersebut adalah rasff.pom.go.id. Setiap operator di Competence Contact Point (CCP) telah diberikan user ID dan password untuk dapat login ke dalam aplikasi. Penggunaan aplikasi INRASFF diharapkan dapat mempercepat pertukaran informasi antar otoritas kompeten keamanan pangan dalam menindaklanjuti permasalahan keamanan pangan. Pemutakhiran aplikasi INRASFF akan dilakukan pada Tahun 2011. Pemutakhiran aplikasi meliputi revisi formulir dan laporan, email notification, dsb. Pemutakhiran aplikasi INRASFF membutuhkan biaya dan kosultasi yang cukup besar, untuk itu kegiatan pemutakhiran diusulkan dalam kegiatan Trade Support Program (TSP) II dengan dukungan technical assistance dari Uni Eropa.</p>
					</li>
				</ul>   

			</div>
		</div>
		<div x-data={show:false}>
			<div class="flex justify-between items-center mb-5 py-4 border-b border-gray-200 leading-normal cursor-pointer" 
				@click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'border-b': !show }">
				<div class="font-semibold text-base lg:text-lg">
					PELAKSANAAN RASFF DI INDONESIA
				</div>
				<div class="font-semibold text-base lg:text-lg mx-3">
					
					<svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/></svg>

					<svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
				
				</div>
			</div> 
			<div x-show="show" class="border-b text-sm lg:text-base border-gray-200 pb-4 leading-normal">
				<p>Sepanjang tahun 2020, NCP INRASFF menerima 20 notifikasi downstream yang berasal dari EURASFF, INFOSAN, Food Standards Australia New Zealand, dan Taiwan Food and Drug Administration. Sebanyak 16 notifikasi merupakan informasi kasus terkait keamanan pangan atau pakan ekspor asal Indonesia, sedangkan 4 notifikasi terkait produk asal luar negeri yang diimpor ke Indonesia. Seluruh notifikasi tersebut telah diteruskan ke CCP terkait untuk ditindaklanjuti dengan menelusuri akar masalah dan melakukan tindakan perbaikan agar kasus serupa tidak terulang maupun mencegah produk impor yang tidak memenuhi syarat beredar di masyarakat. Selain 20 notifikasi tersebut, terdapat 2 notifikasi downstream dari EURASFF dan ARASFF yang sedang dimintakan klarifikasinya. Jumlah notifikasi downstream tahun 2020 ini menurun jika dibandingkan dengan tahun 2019. Akan tetapi penurunan jumlah ini belum dapat digunakan sebagai indikator semakin baiknya kualitas keamanan pangan di Indonesia karena penurunan tersebut mungkin juga disebabkan oleh volume ekspor yang mengalami penurunan akibat pandemi Covid-19 yang melanda seluruh dunia. Pada tahun 2020 terdapat 1 notifikasi upstream yang disampaikan melalui INRASFF terkait produk jamur enoki asal Korea Selatan yang terkontaminasi Listeria monocytogenes.</p>
				<br>
				<p>Pada tahun 2020, informasi tindak lanjut notifikasi yang disampaikan dari CCP ke NCP mencapai 90% dari 20 notifikasi. Dalam hal ini terjadi peningkatan persentase feedback dari tahun 2019 yang hanya mencapai 64%. Namun, persentase notifikasi yang sudah diselesaikan menurun dari 39% di tahun 2019 menjadi 30% di tahun 2020. Hal ini menunjukkan komunikasi dan kerja sama antar anggota jejaring INRASFF di Indonesia dalam merespon kasus keamanan pangan dan pakan yang semakin meningkat namun masih mengalami kendala dalam penyelesaiannya. Kendala penyelesaian ini antara lain keterbatasan dalam melakukan penelusuran akar penyebab masalah yang disebabkan situasi pandemi Covid-19, yang mengakibatkan petugas harus melakukan penyesuaian dengan kebijakan PSBB.</p>
				<br>
				<p>Dalam rangka penguatan jejaring INRASFF, pada tahun 2020 telah diadakan 3 kali pertemuan INRASFF working group. Perwakilan INRASFF juga terlibat dalam pertemuan tingkat ASEAN terkait penyusunan ASEAN Guidelines on Food and Feed Traceability dan ASEAN Capacity Building on Rapid Response in Food Safety Issues and Crisis, serta pertemuan lintas sektor tingkat nasional untuk membahas rencana nasional tanggap darurat keamanan pangan. Selain itu, telah diadakan 1 kali pertemuan internal BPOM dalam rangka sosialisasi INRASFF ke UPT BPOM sebagai LCCP INRASFF (dirangkaikan dengan sosialisasi World Food Safety Day (WFSD) 2020 dan penanganan dan pelaporan kejadian luar biasa keracunan pangan (KLB KP) di BPOM). Pertemuan tahunan ARASFF NCP ke-8 & ARASFF Steering Committee ke-6 yang sedianya dilaksanakan pada tahun 2020 diundur pelaksanaannya ke Maret 2021 karena kondisi pandemi Covid-19.</p>
			</div>
		</div>
		<div x-data={show:false}>
			<div class="flex justify-between items-center mb-5 py-4 border-b border-gray-200 leading-normal cursor-pointer" 
				@click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'border-b': !show }">
				<div class="font-semibold text-base lg:text-lg">
					KEGIATAN LAIN YANG PERLU DILAKUKAN GUNA MENDUKUNG PENERAPAN INRASFF
				</div>
				<div class="font-semibold text-base lg:text-lg mx-3">
					
					<svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/></svg>

					<svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
				
				</div>
			</div> 
			<div x-show="show" class="border-b text-sm lg:text-base border-gray-200 pb-4 leading-normal">
				<ul class="mb-5 list-disc list-inside space-y-3 mb-8">
					<li>Memperkuat  INRASFF National Contact Point di Badan POM dalam bentuk penyediaan sarana dan prasarana yang memadai.</li>
					<li>Membentuk Komisi RASFF Nasional beranggotakan perwakilan seluruh otoritas kompeten terkait  yang dapat mengarahkan, mensupervisi dan memberikan saran strategik terhadap INRASF</li>
					<li>Menyusun daftar kontak yang lengkap untuk seluruh otoritas kompeten di semua tingkat baik pusat maupun daerah</li>
					<li>Menyusun dan menerapkan kegiatan INRASFF dalam bentuk Pilot  IT  dengan mengikutsertakan semua instansi terkait dalam INRASFF</li>
					<li>Menyusun SOP untuk semua tahapan yang diperlukan dalam INRASFF</li>
					<li>CCP terkait perlu Menyusun dan menerapkan skema traceability yang sederhana, terutama untuk ingredien yang masuk dan produk yang keluar dari industri rumah tangga</li>
					<li>CCP terkait perlu Menyusun dan menerapkan skema traceability di antara lots (di pasar) dan kontainer yang datang di pelabuhan</li>
					<li>Menyusun dan melaksanakan program pelatihan tentang INRASFF dan manajemen kewaspadaan pangan untuk semua personel otoritas kompeten dalam INRASFF</li>
				</ul>
			</div>
		</div>
		<div x-data={show:false}>
			<div class="flex justify-between items-center mb-5 py-4 border-b border-gray-200 leading-normal cursor-pointer" 
				@click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'border-b': !show }">
				<div class="font-semibold text-base lg:text-lg">
					PARTISIPASI INDONESIA KE DALAM ASEAN RASFF
				</div>
				<div class="font-semibold text-base lg:text-lg mx-3">
					
					<svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/></svg>

					<svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
				
				</div>
			</div> 
			<div x-show="show" class="border-b text-sm lg:text-base border-gray-200 pb-4 leading-normal">
				<p class="font-semibold">(Instruksi Presiden No. 11 Tahun 2011 tentang Pelaksanaan Komitmen Cetak Biru Masyarakat Ekonomi ASEAN 2011)</p>
				<br>
				<p>Pilot project ASEAN Rapid Alert System for Food and Feed (RASFF) merupakan pilot project yang mengadopsi sistem EURASFF untuk dikembangkan di tingkat ASEAN.  Pilot project ini dilaksanakan di Thailand pada kurun waktu 1 Desember 2006 – 31 Desember 2007 dengan pembiayaan dari European Comission dan Pemerintah Thailand.  Tujuan proyek ini adalah mengembangkan program piranti lunak untuk pertukaran informasi berdasarkan model EU RASFF, membangun jejaring pertukaran informasi keamanan pangan di antara instansi berwenang di Thailand serta di antara pejabat berwenang di sejumlah negara anggota ASEAN.</p>
				<br>
				<p>Negara ASEAN yang bergabung dalam jejaring ARASFF ini adalah Kamboja, Malaysia, Myanmar, Philipina, Thailand, dan Vietnam.  Sedangkan negara ASEAN yang menjadi pengamat adalah Brunei, Indonesia, Laos, dan Singapura.  Perwakilan Indonesia dalam pertemuan ARASFF dari Badan POM adalah Direktorat Surveilan dan Penyuluhan Keamanan Pangan (SPKP).Keanggotaan Indonesia dalam ARASFF adalah sebagai observer, hal tersebut dikarenakan Indonesia ingin memperkuat terlebih dahulu system rapid response antar instansi terkait di Indonesia. Dengan adanya Instruksi Presiden No. 11 Tahun 2011 diharapkan pelaksanaan INRASFF di Indonesia menjadi lebih terkoordinasi dan terintegrasi. Beberapa kegiatan yang diidentifikasi guna memperkuat INRASFF sebelum Indonesia bergabung dengan ARASFF antara lain:</p>
				<br>
				<p>Dalam rangka penguatan jejaring INRASFF, pada tahun 2020 telah diadakan 3 kali pertemuan INRASFF working group. Perwakilan INRASFF juga terlibat dalam pertemuan tingkat ASEAN terkait penyusunan ASEAN Guidelines on Food and Feed Traceability dan ASEAN Capacity Building on Rapid Response in Food Safety Issues and Crisis, serta pertemuan lintas sektor tingkat nasional untuk membahas rencana nasional tanggap darurat keamanan pangan. Selain itu, telah diadakan 1 kali pertemuan internal BPOM dalam rangka sosialisasi INRASFF ke UPT BPOM sebagai LCCP INRASFF (dirangkaikan dengan sosialisasi World Food Safety Day (WFSD) 2020 dan penanganan dan pelaporan kejadian luar biasa keracunan pangan (KLB KP) di BPOM). Pertemuan tahunan ARASFF NCP ke-8 & ARASFF Steering Committee ke-6 yang sedianya dilaksanakan pada tahun 2020 diundur pelaksanaannya ke Maret 2021 karena kondisi pandemi Covid-19.</p>
				<br>
				<ul class="mb-5 list-disc list-inside space-y-3 mb-8">
					<li>Workshop dan Penguatan infrastruktur nasional</li>
					<li>Sistem Tekhnologi Informasi dan Pedoman untuk INRASFF</li>
					<li>Pelaksanaan pilot project INRASFF</li>
				</ul>
			</div>
		</div>
		<div x-data={show:false}>
			<div class="flex justify-between items-center mb-5 py-4 border-b border-gray-200 leading-normal cursor-pointer" 
				@click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'border-b': !show }">
				<div class="font-semibold text-base lg:text-lg">
					KESIMPULAN
				</div>
				<div class="font-semibold text-base lg:text-lg mx-3">
					
					<svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/></svg>

					<svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
				
				</div>
			</div> 
			<div x-show="show" class="border-b text-sm lg:text-base border-gray-200 pb-4 leading-normal">
				<ul class="mb-5 list-disc list-inside space-y-3 mb-8">
					<li>Indonesia telah berkomitmen untuk menerapkan RASFF di Indonesia, yaitu sebagai sistem early warning untuk mencegah bertambah besarnya risiko yang ditimbulkan akibat adanya produk pangan yang memiliki masalah keamanan pangan, baik itu pangan impor, ekspor, atau pangan lokal.</li>
					<li>Penerapan RASFF di Indonesia saat ini menggunakan sistem email based (inrasff@pom.go.id) dan web based (inrasff.net) dalam pengiriman dan penerimaan notifikasi maupun informasi lainnya kepada CCP di instansi terkait.</li>
					<li>Kelengkapan perangkat hukum dan persyaratan legal lainnya guna mendukung terwujudnya INRASFF masih perlu disusun. Koordinasi dan kolaborasi dengan instansi terkait perlu terus ditingkatkan.</li>
					<li>Peningkatan kapasitas dan integritas Sumber Daya Manusia (SDM) untuk mendukung penerapan INRASFF harus terus dilakukan dan menjadi prioritas, terutama dalam bentuk pemberian pelatihan dalam rangka penggunaan aplikasi INRASFF dan sistem informasi INRASFF kepada operator CCP di instansi terkait.</li>
					<li>Sistem INRASFF, yang merupakan early warning sistem harus didukung oleh kegiatan inspeksi dan monitoring yang terencana dan terintegrasi serta proses traceability yang memadai.</li>
				</ul>
			</div>
		</div>
	</div>
</section>
@endsection

@section('script')
@endsection