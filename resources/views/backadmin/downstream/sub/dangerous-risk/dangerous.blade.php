<div class="d-flex justify-content-between align-items-center mb-1">
    <h4>3. Bahaya</h4>
</div>
<div class="row">
    <div class="col-12 col-md-6 form-group">
        <label for="name_dangerous" class="form-label required">Jenis Bahaya yang Diidentifikasi</label>
        <input
            autocomplete="disabled"
            type="text" 
            name="name_dangerous"
            v-model="dangerous_risk.name_dangerous" 
            class="form-control @error('name_dangerous') {{ 'is-invalid' }} @enderror" 
            placeholder="Masukkan Jenis Bahaya" autocomplete="off">
        @error('name_dangerous')
            <small class="text-danger">{{ $errors->first('name_dangerous') }}</small>
        @enderror
    </div><!-- .col-md-6.form-group -->

    <div class="col-12 col-md-6 form-group">
        <label for="category_dangerous" class="form-label required">Kategori Bahaya</small></label>
            <select
                name="category_dangerous" 
                v-model="dangerous_risk.category_dangerous" 
                class="form-control select2-dr @error('category_dangerous') {{ 'is-invalid' }} @enderror">
                <option value="" selected>- Silahkan Pilih Kategori Bahaya -</option>
                @foreach ($a_dangerous_category as $status)
                <option value="{{$status['value']}}">{{$status['label']}}</option>    
                @endforeach

            </select>
        @error('category_dangerous')
            <small class="text-danger">{{ $errors->first('category_dangerous') }}</small>
        @enderror
    </div><!-- .col-md-6.form-group -->

    <div class="col-12 col-md-6 form-group">
        <label for="name_result" class="form-label">Hasil Uji <small>(Kosongkan apabila negatif)</small></label>
        <input type="text" 
            autocomplete="disabled"
            name="name_result"
            v-model="dangerous_risk.name_result" 
            class="form-control @error('name_result') {{ 'is-invalid' }} @enderror" 
            placeholder="Masukkan Jenis Bahaya" autocomplete="off">
        @error('name_result')
            <small class="text-danger">{{ $errors->first('name_result') }}</small>
        @enderror
    </div><!-- .col-md-6.form-group -->

    <div class="col-12 col-md-6 form-group">
        <label for="uom_result" class="form-label">Satuan Hasil Uji <small>(Kosongkan apabila negatif)</small></label>
            <select
                name="uom_result" 
                v-model="dangerous_risk.uom_result" 
                class="form-control select2-dr @error('uom_result') {{ 'is-invalid' }} @enderror">
                <option value="" selected>- Silahkan Pilih Satuan Hasil Uji -</option>
                @foreach ($a_uom_result as $status)
                <option value="{{$status['value']}}">{{$status['label']}}</option>    
                @endforeach

            </select>
        @error('uom_result')
            <small class="text-danger">{{ $errors->first('uom_result') }}</small>
        @enderror
    </div><!-- .col-md-6.form-group -->


    <div class="col-12 col-md-12 form-group">
        <label for="laboratorium" class="form-label ">Sampling</label>
        <table id="table-sampling" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jumlah Sampel</th>
                    <th>Metode</th>
                    <th>Tempat Pengambilan</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div><!-- .col-md-6.form-group -->


    <div class="divider divider-left col-12">
        <div class="divider-text">Analisis</div>
    </div>

    <div class="col-12 col-md-6 form-group">
        <label for="laboratorium" class="form-label ">Laboratorium</label>
        <input type="text" 
            name="laboratorium"
            v-model="dangerous_risk.laboratorium" 
            class="form-control @error('laboratorium') {{ 'is-invalid' }} @enderror" 
            placeholder="Masukkan Analisis Laboratorium" autocomplete="off">
        @error('laboratorium')
            <small class="text-danger">{{ $errors->first('laboratorium') }}</small>
        @enderror
    </div><!-- .col-md-6.form-group -->

    <div class="col-12 col-md-6 form-group">
        <label for="matrix" class="form-label ">Matriks</label>
        <input type="text" 
            name="matrix"
            v-model="dangerous_risk.matrix" 
            class="form-control @error('matrix') {{ 'is-invalid' }} @enderror" 
            placeholder="Masukkan Analisis Matriks" autocomplete="off">
        @error('matrix')
            <small class="text-danger">{{ $errors->first('matrix') }}</small>
        @enderror
    </div><!-- .col-md-6.form-group -->
    
    <div class="divider divider-left col-12">
        <div class="divider-text">Standar yang Berlaku</div>
    </div>
    <div class="col-12 col-md-6 form-group">    
        <label for="scope" class="form-label ">Scope</label>
        <input type="text" 
            name="scope"
            v-model="dangerous_risk.scope" 
            class="form-control @error('scope') {{ 'is-invalid' }} @enderror" 
            placeholder="Masukkan Analisis Laboratorium" autocomplete="off">
        @error('scope')
            <small class="text-danger">{{ $errors->first('scope') }}</small>
        @enderror
    </div><!-- .col-md-6.form-group -->

    <div class="col-12 col-md-6 form-group">
        <label for="max_tollerance" class="form-label ">Maksimum Batas yang Diijinkan</label>
        <input type="text" 
            name="max_tollerance"
            v-model="dangerous_risk.max_tollerance" 
            class="form-control @error('max_tollerance') {{ 'is-invalid' }} @enderror" 
            placeholder="Masukkan Analisis Matriks" autocomplete="off">
        @error('max_tollerance')
            <small class="text-danger">{{ $errors->first('max_tollerance') }}</small>
        @enderror
    </div><!-- .col-md-6.form-group -->
</div>