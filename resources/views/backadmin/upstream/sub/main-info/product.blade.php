
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <h4>Produk</h4>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="product_name" class="form-label required">Nama Produk</label>
                            <input type="text" 
                                name="product_name"
                                v-model="upstream.product_name" 
                                class="form-control @error('product_name') {{ 'is-invalid' }} @enderror" 
                                placeholder="Masukkan Nama Produk" autocomplete="off">
                            @error('product_name')
                                <small class="text-danger">{{ $errors->first('product_name') }}</small>
                            @enderror
                        </div><!-- .col-md-6.form-group -->

                        <div class="col-12 col-md-6 form-group">
                            <label for="category_product_id" class="form-label">Kategori Produk</label>
                            <select 
                                v-model="upstream.category_product_id" 
                                name="category_product_id" 
                                class="form-control select2 @error('category_product_id') {{ 'is-invalid' }} @enderror">
                                <option value="" disabled selected>- Silahkan Kategori Produk -</option>
                                @foreach ($a_product_category as $category)
                                <option value="{{$category['value']}}">{{$category['label']}}</option>    
                                @endforeach
                            </select>
                            @error('category_product_id')
                                <small class="text-danger">{{ $errors->first('category_product_id') }}</small>
                            @enderror
                        </div><!-- .col-md-6.form-group -->
                        <div class="col-12 col-md-6 form-group">
                            <label for="brand_name" class="form-label required">Merk Produk</label>
                            <input type="text" 
                                name="brand_name"
                                v-model="upstream.brand_name" 
                                class="form-control @error('brand_name') {{ 'is-invalid' }} @enderror" 
                                placeholder="Masukkan Merk Produk" autocomplete="off">
                            @error('brand_name')
                                <small class="text-danger">{{ $errors->first('brand_name') }}</small>
                            @enderror
                        </div><!-- .col-md-6.form-group -->

                        <div class="col-12 col-md-6 form-group">
                            <label for="registration_number" class="form-label">Nomor Registrasi</label>
                            <input type="text" 
                                name="registration_number"
                                v-model="upstream.registration_number" 
                                class="form-control @error('registration_number') {{ 'is-invalid' }} @enderror" 
                                placeholder="Masukkan Nomor Registrasi" autocomplete="off">
                            @error('registration_number')
                                <small class="text-danger">{{ $errors->first('registration_number') }}</small>
                            @enderror
                        </div><!-- .col-md-6.form-group -->

                        <div class="col-12 col-md-6 form-group">
                            <label for="package_product" class="form-label">Kemasan Produk</label>
                            <input type="text" 
                                name="package_product"
                                v-model="upstream.package_product" 
                                class="form-control @error('package_product') {{ 'is-invalid' }} @enderror" 
                                placeholder="Masukkan Kemasan Produk" autocomplete="off">
                            @error('package_product')
                                <small class="text-danger">{{ $errors->first('package_product') }}</small>
                            @enderror
                        </div><!-- .col-md-6.form-group -->

                        {{-- <div class="col-12 col-md-6 form-group">
                            <label for="title" class="form-label">Berat Unit</label>
                            <input type="text" 
                                name="mass"
                                
                                class="form-control @error('mass') {{ 'is-invalid' }} @enderror" 
                                placeholder="Masukkan Berat Unit" autocomplete="off">
                            @error('mass')
                                <small class="text-danger">{{ $errors->first('mass') }}</small>
                            @enderror
                        </div><!-- .col-md-6.form-group --> --}}
                    </div>