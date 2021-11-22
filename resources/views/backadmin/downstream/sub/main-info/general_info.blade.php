<div class="d-flex justify-content-between align-items-center mb-1">
    <h4>Informasi Umum</h4>
</div>
<div class="row">
    <div class="col-12 col-md-12 form-group">
        <label for="title" class="form-label required">Judul Notifikasi</label>
        <input type="text" 
            name="title"
            v-model="downstream.title" 
            class="form-control @error('title') {{ 'is-invalid' }} @enderror" 
            placeholder="Masukkan Judul Notifikasi" autocomplete="off">
        @error('title')
            <small class="text-danger">{{ $errors->first('title') }}</small>
        @enderror
    </div><!-- .col-md-6.form-group -->

    {{-- <div class="col-12 col-md-6 form-group">
        <label for="number_ref" class="form-label required">Nomor Referensi</label>
        <input type="text" 
            name="number_ref"
            v-model="downstream.number_ref" 
            class="form-control @error('number_ref') {{ 'is-invalid' }} @enderror" 
            placeholder="Masukkan Nomor Referensi" autocomplete="off">
        @error('number_ref')
            <small class="text-danger">{{ $errors->first('number_ref') }}</small>
        @enderror
    </div><!-- .col-md-6.form-group --> --}}

    <div class="col-12 col-md-6 form-group">
        <label for="status_notif_id" class="form-label required">Status Notifikasi</label>
        <select 
            id="f_status_notif_id"
            v-model="downstream.status_notif_id" 
            name="status_notif_id" 
            class="form-control  @error('status_notif_id') {{ 'is-invalid' }} @enderror">
        </select>
        @error('status_notif_id')
            <small class="text-danger">{{ $errors->first('status_notif_id') }}</small>
        @enderror
    </div><!-- .col-md-6.form-group -->

    <div class="col-12 col-md-6 form-group">
        <label for="type_notif_id" class="form-label">Tipe Notifikasi</label>
        <select 
            id="f_type_notif_id"
            v-model="downstream.type_notif_id" 
            name="type_notif_id" class="form-control @error('type_notif_id') {{ 'is-invalid' }} @enderror">
        </select>
        @error('type_notif_id')
            <small class="text-danger">{{ $errors->first('type_notif_id') }}</small>
        @enderror
    </div><!-- .col-md-6.form-group -->

    <div class="col-12 col-md-6 form-group">
        <label for="country_id" class="form-label">Negara yang Menotifikasi</label>
        <select
            id="country_id"
            name="country_id"            
            class="form-control @error('country_id') {{ 'is-invalid' }} @enderror">
        </select>
        @error('country_id')
            <small class="text-danger">{{ $errors->first('country_id') }}</small>
        @enderror
    </div><!-- .col-md-6.form-group -->

    <div class="col-12 col-md-6 form-group">
        <label for="based_notif_id" class="form-label">Dasar Notifikasi</label>
        <select 
            id="f_based_notif_id"
            v-model="downstream.based_notif_id" 
            name="based_notif_id" 
            class="form-control  @error('based_notif_id') {{ 'is-invalid' }} @enderror">
        </select>
        @error('based_notif_id')
            <small class="text-danger">{{ $errors->first('based_notif_id') }}</small>
        @enderror
    </div><!-- .col-md-6.form-group -->

    <div class="col-12 col-md-6 form-group">
        <label for="origin_source_notif" class="form-label required">Sumber Asal Notifikasi</label>
            <select 
                name="origin_source_notif"
                v-model="downstream.origin_source_notif" 
                class="form-control select2 @error('origin_source_notif') {{ 'is-invalid' }} @enderror"
                >
                <option value="" disabled selected>- Silahkan pilih sumber asal notifikasi -</option>
                <option value="local">Dalam Negeri</option>
                <option value="interlocal">Luar Negeri</option>
            </select>
        @error('origin_source_notif')
            <small class="text-danger">{{ $errors->first('origin_source_notif') }}</small>
        @enderror
    </div><!-- .col-md-6.form-group -->
    <div class="col-12 col-md-6 form-group">
        <label for="source_notif" class="form-label required" >Sumber Notifikasi</label>
        <div v-show="downstream.origin_source_notif === '' ">
            <input class="form-control" disabled value="Silahkan pilih sumber asal notifikasi terlebih dahulu">
        </div>
        <div v-show="downstream.origin_source_notif === 'local' ">
            <select 
                v-cloak
                v-model="downstream.source_notif" 
                :disabled="downstream.origin_source_notif !== 'local'" 
                name="source_notif" 
                class="form-control select2 @error('source_notif') {{ 'is-invalid' }} @enderror">
                <option value="" disabled selected>- Silahkan pilih sumber notifikasi dalam negeri -</option>
                @foreach ($a_notification_source_local as $status)
                <option value="{{$status['value']}}">{{$status['label']}}</option>    
                @endforeach
            </select>
        </div>
        <div v-show="downstream.origin_source_notif === 'interlocal' ">
            <select 
                v-cloak
                v-model="downstream.source_notif" 
                :disabled="downstream.origin_source_notif !== 'interlocal'"
                name="source_notif" 
                class="form-control select2 @error('source_notif') {{ 'is-invalid' }} @enderror">
                <option value="" disabled selected>- Silahkan pilih sumber notifikasi luar negeri -</option>
                @foreach ($a_notification_source_interlocal as $status)
                <option value="{{$status['value']}}">{{$status['label']}}</option>    
                @endforeach
            </select>
        </div>
        @error('source_notif')
            <small class="text-danger">{{ $errors->first('source_notif') }}</small>
        @enderror
    </div><!-- .col-md-6.form-group -->

    <div class="col-12 col-md-6 form-group">
        <label for="date_notif" class="form-label">Tanggal Notifikasi</label>
        <input type="text" 
            name="date_notif"
            v-model="downstream.date_notif" 
            class="form-control date {{ in_array($downstream->status, ['draft', 'open']) ? 'read-only-white' : ''}} @error('date_notif') {{ 'is-invalid' }} @enderror" 
            placeholder="Masukkan Tanggal Notifikasi" autocomplete="off">
        @error('date_notif')
            <small class="text-danger">{{ $errors->first('date_notif') }}</small>
        @enderror
    </div><!-- .col-md-6.form-group -->
{{--     
    <div class="col-12 col-md-12 form-group">
        <hr>
        <div class="d-flex justify-content-between align-items-center">
            <label for="title" class="form-label">Lembaga yang perlu menindaklanjuti</label>
            @if($downstream->id !== null && !in_array($downstream->status, ['ccp process', 'ext process', 'done']))
                <button type="button" v-on:click="openInstitutionModal('add', null , null, true)" class="btn btn-icon btn-primary"><i data-feather="plus"></i></button>
            @endif
        </div>
        
        
        <div v-cloak v-if="downstream.id === ''" class="demo-spacing-0">
            <div class="alert alert-warning" role="alert">
                <div class="alert-body"><strong>Silahkan simpan terlebih dahulu downstream ini untuk menambahkan instansi</strong></div>
            </div>
        </div>
        <table v-cloak v-if="downstream.id !== ''" id="table-permission-rw" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Lembaga</th>
                    <th class="bi-table-col-action-1">Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    
    <div class="col-12 col-md-12 form-group">
        <hr>
        <div class="d-flex justify-content-between align-items-center">
            <label for="title" class="form-label"> Lembaga lain yang terkait</label>
            @if($downstream->id !== null && !in_array($downstream->status, ['ccp process', 'ext process', 'done']))
                <button type="button" v-on:click="openInstitutionModal('add')" class="btn btn-icon btn-primary"><i data-feather="plus"></i></button>
            @endif
        </div>
        
        <div v-cloak v-if="downstream.id === ''" class="demo-spacing-0">
            <div class="alert alert-warning" role="alert">
                <div class="alert-body"><strong>Silahkan simpan terlebih dahulu downstream ini untuk menambahkan instansi</strong></div>
            </div>
        </div>
        <table v-cloak v-if="downstream.id !== ''" id="table-permission-r" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Lembaga</th>
                    <th class="bi-table-col-action-1">Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div> --}}

</div>