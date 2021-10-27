
<div class="d-flex justify-content-between align-items-center mb-1">
    <h4>Informasi Lainnya</h4>
</div>
<div class="row">
    <div class="col-12 col-md-6 form-group">
        <label for="institution" class="form-label">Instansi</label>
        <input type="text" 
            name="institution"
            v-model="upstream.institution" 
            class="form-control @error('institution') {{ 'is-invalid' }} @enderror" 
            placeholder="Masukkan Nama Produk" autocomplete="off">
        @error('institution')
            <small class="text-danger">{{ $errors->first('institution') }}</small>
        @enderror
    </div><!-- .col-md-6.form-group -->

    <div class="col-12 col-md-6 form-group">
        <label for="contact_person" class="form-label required">Narahubung</label>
        <input type="text" 
            name="contact_person"
            v-model="upstream.contact_person" 
            class="form-control @error('contact_person') {{ 'is-invalid' }} @enderror" 
            placeholder="Masukkan Narahubung" autocomplete="off">
        @error('contact_person')
            <small class="text-danger">{{ $errors->first('contact_person') }}</small>
        @enderror
    </div><!-- .col-md-6.form-group -->

    <div class="col-12 col-md-12 form-group">
        <label for="others" class="form-label">Informasi Lainnya</label>
        <textarea 
            autocomplete="off"
            placeholder="Masukkan Informasi Lainnya"
            name="others"
            rows="5"
            v-model="upstream.others" 
            class="form-control @error('others') {{ 'is-invalid' }} @enderror"></textarea>
        @error('others')
            <small class="text-danger">{{ $errors->first('others') }}</small>
        @enderror
    </div><!-- .col-md-6.form-group -->

</div>