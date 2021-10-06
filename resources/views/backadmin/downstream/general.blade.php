<div class="card">
    <div class="card-body">
        <div class="card-text">
            <div id="app">
                <section class="bi-form-main">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <h4>1. Informasi Umum</h4>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="title" class="form-label">Judul Notifikasi</label>
                            <input type="text" 
                                name="title"
                                {{-- v-model="news.title"  --}}
                                class="form-control @error('title') {{ 'is-invalid' }} @enderror" 
                                placeholder="Masukkan Nomor Referensi" autocomplete="off">
                            @error('title')
                                <small class="text-danger">{{ $errors->first('title') }}</small>
                            @enderror
                        </div><!-- .col-md-6.form-group -->

                        <div class="col-12 col-md-6 form-group">
                            <label for="number_ref" class="form-label">Nomor Referensi</label>
                            <input type="text" 
                                name="number_ref"
                                {{-- v-model="news.title"  --}}
                                class="form-control @error('number_ref') {{ 'is-invalid' }} @enderror" 
                                placeholder="Masukkan Nomor Referensi" autocomplete="off">
                            @error('number_ref')
                                <small class="text-danger">{{ $errors->first('number_ref') }}</small>
                            @enderror
                        </div><!-- .col-md-6.form-group -->

                        <div class="col-12 col-md-6 form-group">
                            <label for="status_notif" class="form-label">Status Notifikasi</label>
                            <select name="status_notif" class="form-control @error('status_notif') {{ 'is-invalid' }} @enderror">
                                <option>- Silahkan pilih status notifikasi -</option>
                                <option>Border Rejection</option>
                                <option>Alert</option>
                                <option>Information</option>
                                <option>News</option>
                            </select>
                            @error('status_notif')
                                <small class="text-danger">{{ $errors->first('status_notif') }}</small>
                            @enderror
                        </div><!-- .col-md-6.form-group -->

                        <div class="col-12 col-md-6 form-group">
                            <label for="type_notif" class="form-label">Tipe Notifikasi</label>
                            <select name="type_notif" class="form-control @error('type_notif') {{ 'is-invalid' }} @enderror">
                                <option>- Silahkan pilih tipe notifikasi -</option>
                                <option>Food</option>
                                <option>Feed</option>
                                <option>Food Contact Material</option>
                            </select>
                            @error('type_notif')
                                <small class="text-danger">{{ $errors->first('type_notif') }}</small>
                            @enderror
                        </div><!-- .col-md-6.form-group -->

                        <div class="col-12 col-md-6 form-group">
                            <label for="country_notif" class="form-label">Negara yang Menotifikasi</label>
                            <input type="text" 
                                name="country_notif"
                                {{-- v-model="news.title"  --}}
                                class="form-control @error('country_notif') {{ 'is-invalid' }} @enderror" 
                                placeholder="Masukkan Negara Penotifikasi" autocomplete="off">
                            @error('country_notif')
                                <small class="text-danger">{{ $errors->first('country_notif') }}</small>
                            @enderror
                        </div><!-- .col-md-6.form-group -->

                        <div class="col-12 col-md-6 form-group">
                            <label for="based_notif" class="form-label">Dasar Notifikasi</label>
                            <input type="text" 
                                name="based_notif"
                                {{-- v-model="news.title"  --}}
                                class="form-control @error('based_notif') {{ 'is-invalid' }} @enderror" 
                                placeholder="Masukkan Dasar Notifikasi" autocomplete="off">
                            @error('based_notif')
                                <small class="text-danger">{{ $errors->first('based_notif') }}</small>
                            @enderror
                        </div><!-- .col-md-6.form-group -->

                        <div class="col-12 col-md-6 form-group">
                            <label for="source_notif" class="form-label">Sumber Notifikasi</label>
                            <input type="text" 
                                name="source_notif"
                                {{-- v-model="news.title"  --}}
                                class="form-control @error('source_notif') {{ 'is-invalid' }} @enderror" 
                                placeholder="Masukkan Sumber Notifikasi" autocomplete="off">
                            @error('source_notif')
                                <small class="text-danger">{{ $errors->first('source_notif') }}</small>
                            @enderror
                        </div><!-- .col-md-6.form-group -->

                        <div class="col-12 col-md-6 form-group">
                            <label for="date_notif" class="form-label">Tanggal Notifikasi</label>
                            <input type="text" 
                                name="date_notif"
                                {{-- v-model="news.title"  --}}
                                class="form-control @error('date_notif') {{ 'is-invalid' }} @enderror" 
                                placeholder="Masukkan Tanggal Notifikasi" autocomplete="off">
                            @error('date_notif')
                                <small class="text-danger">{{ $errors->first('date_notif') }}</small>
                            @enderror
                        </div><!-- .col-md-6.form-group -->

                        <div class="col-12 col-md-12 form-group">
                            <label for="title" class="form-label">Instansi yang perlu menindaklanjuti</label>
                            <table id="table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Instansi</th>
                                        <th class="bi-table-col-action-1">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-12 col-md-12 form-group">
                            <label for="title" class="form-label"> Instansi lain yang terkait</label>
                            <table id="table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Instansi</th>
                                        <th class="bi-table-col-action-1">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <h4>2. Produk</h4>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="product_name" class="form-label">Nama Produk</label>
                            <input type="text" 
                                name="product_name"
                                {{-- v-model="news.title"  --}}
                                class="form-control @error('product_name') {{ 'is-invalid' }} @enderror" 
                                placeholder="Masukkan Nama Produk" autocomplete="off">
                            @error('product_name')
                                <small class="text-danger">{{ $errors->first('product_name') }}</small>
                            @enderror
                        </div><!-- .col-md-6.form-group -->

                        <div class="col-12 col-md-6 form-group">
                            <label for="category_product_name" class="form-label">Kategori Produk</label>
                            <input type="text" 
                                name="category_product_name"
                                {{-- v-model="news.title"  --}}
                                class="form-control @error('category_product_name') {{ 'is-invalid' }} @enderror" 
                                placeholder="Masukkan Kategori Produk" autocomplete="off">
                            @error('category_product_name')
                                <small class="text-danger">{{ $errors->first('category_product_name') }}</small>
                            @enderror
                        </div><!-- .col-md-6.form-group -->
                        <div class="col-12 col-md-6 form-group">
                            <label for="brand_name" class="form-label">Merk Produk</label>
                            <input type="text" 
                                name="brand_name"
                                {{-- v-model="news.title"  --}}
                                class="form-control @error('brand_name') {{ 'is-invalid' }} @enderror" 
                                placeholder="Masukkan Merk Produk" autocomplete="off">
                            @error('brand_name')
                                <small class="text-danger">{{ $errors->first('brand_name') }}</small>
                            @enderror
                        </div><!-- .col-md-6.form-group -->

                        <div class="col-12 col-md-6 form-group">
                            <label for="package_product" class="form-label">Kemasan Produk</label>
                            <input type="text" 
                                name="package_product"
                                {{-- v-model="news.title"  --}}
                                class="form-control @error('package_product') {{ 'is-invalid' }} @enderror" 
                                placeholder="Masukkan Kemasan Produk" autocomplete="off">
                            @error('package_product')
                                <small class="text-danger">{{ $errors->first('package_product') }}</small>
                            @enderror
                        </div><!-- .col-md-6.form-group -->
                        <div class="col-12 col-md-6 form-group">
                            <label for="registration_number" class="form-label">Nomor Registrasi</label>
                            <input type="text" 
                                name="registration_number"
                                {{-- v-model="news.title"  --}}
                                class="form-control @error('registration_number') {{ 'is-invalid' }} @enderror" 
                                placeholder="Masukkan Nomor Registrasi" autocomplete="off">
                            @error('registration_number')
                                <small class="text-danger">{{ $errors->first('registration_number') }}</small>
                            @enderror
                        </div><!-- .col-md-6.form-group -->

                        <div class="col-12 col-md-6 form-group">
                            <label for="title" class="form-label">Berat Unit</label>
                            <input type="text" 
                                name="mass"
                                {{-- v-model="news.title"  --}}
                                class="form-control @error('mass') {{ 'is-invalid' }} @enderror" 
                                placeholder="Masukkan Berat Unit" autocomplete="off">
                            @error('mass')
                                <small class="text-danger">{{ $errors->first('mass') }}</small>
                            @enderror
                        </div><!-- .col-md-6.form-group -->
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>