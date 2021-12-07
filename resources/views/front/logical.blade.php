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
				<div class="text-xl text-white font-bold uppercase tracking-wide mb-5">Logical Framework INRASFF</div>
			</div>
			<div class="text-sm text-white tracking-wide">
				<a href="#">Home</a> / <a href="javascript:void(0)" class="font-semibold">Logical Framework INRASFF</a>
			</div>
		</div>
	</div>
</section>

<section class="bg-gray-100">
	<div class="container px-3 py-12 lg:mx-auto">
		<div class="text-xl font-bold mb-5">Logical Framework INRASFF</div>
		<div class="overflow-x-scroll">
			<table class="table-auto border-collapse border my-8 leading-normal">
				<thead>
					<tr class="text-center bg-gray-200">
						<th class="border py-2">Deskripsi Proyek</th>
						<th class="border py-2">Indikator Kinerja</th>
						<th class="border py-2">Alat Verifikasi</th>
						<th class="border py-2">Asumsi</th>
					</tr>
				</thead>
				<tbody class="bg-white">
					<tr>
						<td class="border p-5">
							<div class="text-base font-bold mb-5">Tujuan Umum</div>
							<p>Meningkatnya perdagangan pangan dalam negeri maupun luar negeri melalui perbaikan sistem keamanan pangan dan perlindungan konsumen di Indonesia</p>
						</td>
						<td class="border p-5">
							<ul class="mb-5 list-disc list-inside space-y-3 mb-8">
								<li>Keharusan dilakukannya pengujian ketat bagi produk pangan yang diekspor ke luar negeri</li>
								<li>Akses produk pangan Indonesia untuk masuk ke pasar yang lain</li>
							</ul>
						</td>
						<td class="border"></td>
						<td class="border"></td>
					</tr>
					<tr>
						<td class="border p-5">
							<div class="text-base font-bold mb-5">Manfaat</div>
							<p>Manajemen kewaspadaan pangan (Food Alert) di Indonesia lebih baik</p>
						</td>
						<td class="border p-5">
							<ul class="mb-5 list-disc list-inside space-y-3 mb-8">
								<li>Jumlah kewaspadaan pangan yang dinotifikasi</li>
								<li>Jumlah tindak lanjut yang dilakukan atas dasar notifikasi alert internasional</li>
							</ul>
						</td>
						<td class="border p-5">
							<ul class="mb-5 list-disc list-inside space-y-3 mb-8">
								<li>Laporan INRASF (Sistem Kewaspadaan Cepat Indonesia)</li>
								<li>Laporan EU-RASFF</li>
								<li>Laporan ARASFF (ASEAN)</li>
							</ul>
						</td>
						<td class="border p-5">
							<p>Perbaikan manajemen kewaspadaan pangan akan menstimulasi otoritas kompeten untuk melakukan lebih banyak pengawasan dan pelaku bisnis untuk mengaplikasikan standar-stdnadr keamanan pangan.</p>
							<br>
							<p>Pengambil keputusan dan pembuat kebijakan akan mendukung pengembangan kapasitas manajemen kewaspadaan karena dampak positif dari pendapat masyarakat terhadap insiden keamanan pangan yang terjadi di Asia</p>				
						</td>
					</tr>
					<tr>
						<td class="border p-5">
							<div class="text-base font-bold mb-5">Luaran 1</div>
							<p>Alat dan prosedur untuk menelusuri peyebab kejadian luar biasa penyakit karena pangan dan untuk mendeteksi produk pangan yang tidak sesuai dengan ketentuan di pasar (surveillan) lebih baik</p>
						</td>
						<td class="border p-5">
							<ul class="mb-5 list-disc list-inside space-y-3 mb-8">
								<li>Jumlah kejadian luar biasa penyakit karena pangan yang dapat ditelusuri</li>
								<li>Jumlah kasus produk pangan yang tidak sesuai dengan ketentuan terdeteksi di pabean</li>
								<li>Jumlah kasus produk pangan yang tidak sesuai dengan ketentuan terdeteksi di pasar</li>
								<li>Jumlah staf yang dilatih terkait dengan penerapan alat dan prosedur penelusuran kasus luar biasa karena pangan dan pendeteksian produk pangan yang tidak sesuai dengan ketentuan</li>
							</ul>
						</td>
						<td class="border p-5">
							<ul class="mb-5 list-disc list-inside space-y-3 mb-8">
								<li>Laporan monitoring kegiatan</li>
								<li>Laporan hasil pengujian laboratorium</li>
								<li>Laporan pelaksanaan pelatihan</li>
							</ul>
						</td>
						<td class="border p-5">
							<p>Otoritas kompeten melakukan tindak lanjut yang diperlukan terkait dengan kejadian luar biasa karena pangan dan deteksi produk pangan yang tidak sesuai dengan ketentuan dalam bentuk penarikan produk dari pasar atau penindakan secara hukum</p>
							<br>
							<p>Informasi dari monitoring digunakan untuk menetapkan program pelatihan yang diperlukan, program pengawasan termasuk mengalokasikan sumberdaya yang diperlukan</p>
						</td>
					</tr>
					<tr>
						<td class="border p-5">
							<div class="text-base font-bold mb-5">Kegiatan</div>
							<ul class="mb-5 list-disc list-inside space-y-3 mb-8">
								<li>Mengembangkan rencana monitoring dan surveilans untuk produk pangan yang diimpor maupun  yang dipasarkan dalam negeri, terutama untuk komoditas pangan yang diprioritaskan</li>
								<li>Menyusun template untuk sistem pelaporan kejadian luar biasa karena pangan dan penelusuran penyebabnya</li>
								<li>Mengharmonisasikan template untuk pelaporan hasil pengujian laboratorium serta pelaporan masalah keamanan pangan terkait baik di tingkat pusat maupun di tingkat daerah (propinsi/ kabupaten/kota)</li>
								<li>Menyusun dan melaksanakan program pelatihan dan peningkatan kesadaran atas keuntungan dari kerjasama otoritas kompeten di tingkat pusat maupun daerah (propinsi/ kabupaten/kota)</li>
							</ul>
						</td>
						<td class="border"></td>
						<td class="border"></td>
						<td class="border"></td>
					</tr>
					<tr>
						<td class="border p-5">
							<div class="text-base font-bold mb-5">Luaran 2</div>
							<p>Manajemen penanggulangan kewaspadaan pangan (Rapid Food Alert Response) di Indonesia lebih baik</p>
						</td>
						<td class="border p-5">
							<ul class="mb-5 list-disc list-inside space-y-3 mb-8">
								<li>INRASF (Indonesian RASF) Contact Point terbentuk di Badan POM</li>
								<li>INRASF Contact Point berfungsi dan sudah menerima permintaan informasi dari otoritas kompeten terkait di Indonesia dan RASF dari luar negeri</li>
								<li>Jumlah notifikasi alert yang terdaftar di INRASF</li>
								<li>Jumlah staf yang dilatih terkait dengan penerapan INRASF di Indonesia</li>
							</ul>
						</td>
						<td class="border p-5">
							<ul class="mb-5 list-disc list-inside space-y-3 mb-8">
								<li>Laporan Keamanan Pangan di Indonesia</li>
								<li>Laporan INRASF Contact Point</li>
								<li>Database dari INRASF</li>
								<li>Laporan pelaksanaan pelatihan</li>
							</ul>
						</td>
						<td class="border p-5">
							<p>Otoritas kompeten mendeteksi adanya alert dan menginformasikannya ke INRASF Contact Point seperlunya</p>
							<br>
							<p>Otoritas kompeten nasional mendukung kerjasama dalam  peningkatan keamanan pangan di Indonesia</p>
						</td>
					</tr>
					<tr>
						<td class="border p-5">
							<div class="text-base font-bold mb-5">Kegiatan</div>
							<ul class="mb-5 list-disc list-inside space-y-3 mb-8">
								<li>Membentuk  dan memperkuat  INRASF Contact Point di Badan POM</li>
								<li>Membentuk Komisi RASF Nasional beranggotakan perwakilan seluruh otoritas kompeten terkait  yang dapat mengarahkan, mensupervisi dan memberikan saran strategik terhadap INRASF</li>
								<li>Menyusun daftar kontak yang lengkap untuk seluruh otoritas kompeten di semua tingkat baik pusat maupun daerah</li>
								<li>Menyusun dan menerapkan kegiatan INRASF dalam bentuk Pilot IT  dengan mengikutsertakan semua instansi terkait dalam INRASF</li>
								<li>Menyusun SOP untuk semua tahapan yang diperlukan dalam INRASF</li>
								<li>Menyusun dan menerapkan skema traceability yang sederhana, terutama untuk ingredien yang masuk dan produk yang keluar dari industri pangan rumah tangga (P-IRT)</li>
								<li>Menyusun dan menerapkan skema traceability di antara lots (di pasar) dan kontainer yang datang di pelabuhan</li>
								<li>Menyusun dan melaksanakan program pelatihan tentang INRASF dan manajemen kewaspadaan pangan untuk semua personel otoritas kompeten dalam INRASF</li>
							</ul>
						</td>
						<td class="border"></td>
						<td class="border"></td>
						<td class="border"></td>
					</tr>
					<tr>
						<td class="border p-5">
							<div class="text-base font-bold mb-5">Luaran 3</div>
							<p>Kemampuan laboratorium pengujian keamanan pangan di Indonesia meningkat</p>
						</td>
						<td class="border p-5">
							<ul class="mb-5 list-disc list-inside space-y-3 mb-8">
								<li>Jumlah pengujian yang dilakukan laboratorium resmi pemerintah</li>
								<li>Rencana monitoring yang sudah dikembangkan</li>
							</ul>
						</td>
						<td class="border p-5">
							<ul class="mb-5 list-disc list-inside space-y-3 mb-8">
								<li>Laporan pengujian laboratorium</li>
								<li>Laporan rencana monitoring</li>
								<li>Laporan pelaksanaan pelatihan</li>
							</ul>
						</td>
						<td class="border p-5">
							<p>Pengambilan sampel dan pengujian dilaksanakan secara  dan hasil pengawasan serta hasil monitoring dikomunikasikan ke otoritas kompeten nasional</p>
						</td>
					</tr>
					<tr>
						<td class="border p-5">
							<div class="text-base font-bold mb-5">Kegiatan</div>
							<ul class="mb-5 list-disc list-inside space-y-3 mb-8">
								<li>Menyusun rencana pengujian dan monitoring</li>
								<li>Membangun sarana penyimpanan sampel yang memadai intuk kegiatan inspeksi</li>
								<li>Menyusun SOP untuk sampling dan pengujian dalam rangka kegiatan INRASF</li>
								<li>Menyusun dan melaksanakan program pelatihan pengujian keamanan pangan di laboratorium yang memadai termasuk sistem QA untuk program INRASF</li>
							</ul>
						</td>
						<td class="border"></td>
						<td class="border"></td>
						<td class="border"></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</section>
@endsection

@section('script')
@endsection