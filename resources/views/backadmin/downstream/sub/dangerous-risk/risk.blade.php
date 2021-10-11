<div class="d-flex justify-content-between align-items-center mb-1">
    <h4>4. Resiko</h4>
</div>
<div class="row">
    <div class="col-12 col-md-6 form-group">
        <label for="distribution_status" class="form-label">Status Distribusi</label>
        <select 
            v-model="dangerous_risk.distribution_status" 
            name="distribution_status" 
            class="form-control select2-dr @error('status_notif') {{ 'is-invalid' }} @enderror">
            <option value="" disabled selected>- Silahkan Pilih Status Distribusi -</option>
            @foreach ($a_distribution_status as $status)
            <option value="{{$status['value']}}">{{$status['label']}}</option>    
            @endforeach
        </select>
        @error('distribution_status')
            <small class="text-danger">{{ $errors->first('distribution_status') }}</small>
        @enderror
    </div><!-- .col-md-6.form-group -->


    <div class="col-12 col-md-6 form-group">
        <label for="serious_risk" class="form-label ">Resiko Serius</label>
        <input type="text" 
            name="serious_risk"
            v-model="dangerous_risk.serious_risk" 
            class="form-control @error('serious_risk') {{ 'is-invalid' }} @enderror" 
            placeholder="Masukkan Resiko Serius" autocomplete="off">
        @error('serious_risk')
            <small class="text-danger">{{ $errors->first('serious_risk') }}</small>
        @enderror
    </div><!-- .col-md-6.form-group -->

    <div class="col-12 col-md-6 form-group">
        <label for="victim" class="form-label ">Jumlah Korban</label>
        <input type="number" 
            name="victim"
            v-model="dangerous_risk.victim" 
            class="form-control @error('victim') {{ 'is-invalid' }} @enderror" 
            placeholder="Masukkan Jumlah Korban" autocomplete="off">
        @error('victim')
            <small class="text-danger">{{ $errors->first('victim') }}</small>
        @enderror
    </div><!-- .col-md-6.form-group -->
    
    <div class="col-12 col-md-6 form-group">
        <label for="symptom" class="form-label ">Sakit yang di derita/gejala</label>
        <input type="text" 
            name="symptom"
            v-model="dangerous_risk.symptom"
            class="form-control @error('symptom') {{ 'is-invalid' }} @enderror" 
            placeholder="Masukkan Gejala" autocomplete="off">
        @error('symptom')
            <small class="text-danger">{{ $errors->first('symptom') }}</small>
        @enderror
    </div><!-- .col-md-6.form-group -->
    
    
    
</div>