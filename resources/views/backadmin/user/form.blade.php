@extends('backadmin.layouts.master')

@section('vendor-css')
<link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/select/select2.min.css') }}">    
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('backadmin.users.index') }}">Pengguna</a></li>
@endsection

@section('actions')
    <button type="submit" form="form-main" formaction="{{ $user->id ? route('backadmin.users.update', $user->id) : route('backadmin.users.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
    <div class="btn-group">
        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Aksi Lain <i class="ml-75" data-feather="chevron-down"></i>
        </button>    
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">  
            <a href="{{route('backadmin.users.index')}}" class="dropdown-item" ><i class="mr-75" data-feather="arrow-left"></i>Kembali</a>
            @if ($user->id)
                <a class="dropdown-item" data-toggle="modal" data-target="#modal-activate"><i class="mr-75" data-feather="power"></i>{{ $user->is_active ? 'Non Aktifkan' : 'Aktifkan'}}</a>
                {{-- <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</a> --}}
            @endif
        </div>
    </div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-text">
            <div id="app">
                <form id="form-main" method="post">
                    @csrf
                    @if ($user->id)
                        @method('PUT')
                    @endif
                    <section class="bi-form-main">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h4>Informasi Umum</h4>
                            <span class="badge badge-pill badge-light-{{ $user->status_class }} px-2 py-50">{{ $user->status_label }}</span>
                        </div>
    
                        <div class="row">

                            <div class="col-12 col-md-6 form-group">
                                <label for="username" class="form-label required">Username</label>
                                <input type="text" 
                                    name="username"
                                    v-model="user.username" 
                                    class="form-control @error('username') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Username" autocomplete="off">
                                @error('username')
                                    <small class="text-danger">{{ $errors->first('username') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-6 form-group">
                                <label for="email" class="form-label required">Email</label>
                                <input type="text" 
                                    name="email"
                                    v-model="user.email" 
                                    class="form-control @error('email') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Email" autocomplete="off">
                                @error('email')
                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-6 form-group">
                                <label for="fullname" class="form-label required">Nama</label>
                                <input type="text" 
                                    name="fullname"
                                    v-model="user.fullname" 
                                    class="form-control @error('fullname') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan nama" autocomplete="off">
                                @error('fullname')
                                    <small class="text-danger">{{ $errors->first('fullname') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                            
                        </div><!-- .row -->

                        @if (!$user->id)
                        <div class="row">
                            <div class="col-12 col-md-6 form-group">
                                <label for="password" class="form-label required">Password</label>
                                <input type="password" 
                                    name="password"
                                    class="form-control @error('password') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan password" 
                                    autocomplete="off">
                                @error('password')
                                    <small class="text-danger">{{ $errors->first('password') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-6 form-group">
                                <label for="password_confirmation" class="form-label required">Ketik Ulang Password</label>
                                <input type="password" 
                                    name="password_confirmation"
                                    class="form-control @error('password_confirmation') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Ketik ulang password" 
                                    autocomplete="off">
                                @error('password_confirmation')
                                    <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->                           
                        </div>
                        @endif
                    </section><!-- .bi-form-main -->
                    
                    <section class="bi-form-main mt-1">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h4>Informasi Lembaga Terkait</h4>
                        </div>
                        
                        <input hidden id="only_ccp" v-model="only_ccp" class="only_class" >
                        <input hidden id="only_lccp" v-model="only_lccp" class="only_class" >

                        <div class="row">
                            <div class="col-12 col-md-6 form-group">
                                <label for="type" class="form-label required">Tipe</label>
                                <select 
                                    id="f_type"
                                    name="type"
                                    v-model="user.type" 
                                    class="form-control @error('type') {{ 'is-invalid' }} @enderror">
                                    <option value="" disabled selected>Pilih Tipe Pengguna</option>
                                    @foreach ($user_types as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <small class="text-danger">{{ $errors->first('type') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div v-show="user.type !== 'ncp' && user.type !==''" class="col-12 col-md-6 form-group">
                                <label for="institution_id" class="form-label required">Lembaga Terkait</label>
                                <select 
                                    id="f_institution_id"
                                    name="institution_id"
                                    v-model="user.institution_id" 
                                    class="form-control @error('institution_id') {{ 'is-invalid' }} @enderror">
                                    <option value="" disabled selected>Pilih Lembaga Terkait</option>
                                </select>
                                @error('institution_id')
                                    <small class="text-danger">{{ $errors->first('institution_id') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                        </div><!-- .row -->
                    </section><!-- .bi-form-main -->

                    <section class="bi-form-main mt-1">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h4>Informasi Penanggung Jawab</h4>
                        </div>
    
                        <div class="row">
                            <div class="col-12 col-md-6 form-group">
                                <label for="responsible_name" class="form-label required">Nama</label>
                                <input type="text" 
                                    name="responsible_name"
                                    v-model="user.responsible_name" 
                                    class="form-control @error('responsible_name') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Nama" autocomplete="off">
                                @error('responsible_name')
                                    <small class="text-danger">{{ $errors->first('responsible_name') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-6 form-group">
                                <label for="responsible_phone" class="form-label required">Telepon</label>
                                <input type="text" 
                                    name="responsible_phone"
                                    v-model="user.responsible_phone" 
                                    class="form-control @error('responsible_phone') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan Telepon" autocomplete="off">
                                @error('responsible_phone')
                                    <small class="text-danger">{{ $errors->first('responsible_phone') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-12 col-md-12 form-group">
                                <label for="responsible_address" class="form-label required">Alamat</label>
                                <textarea
                                    autocomplete="off"
                                    placeholder="Masukan Alamat"
                                    name="responsible_address"
                                    v-model="user.responsible_address" 
                                    class="form-control @error('responsible_address') {{ 'is-invalid' }} @enderror"
                                ></textarea>
                                @error('responsible_address')
                                    <small class="text-danger">{{ $errors->first('responsible_address') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                        </div><!-- .row -->
                    </section><!-- .bi-form-main -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('modal')
    @if ($user->id)
    <div class="modal fade" id="modal-activate" tabindex="-1" role="dialog" aria-labelledby="modalActivate" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalActivate">Konfirmasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin akan {{ $user->is_active ? 'menon-aktifkan' : 'mengaktifkan'}} Pengguna ini?</p>
                </div>
                <div class="modal-footer">
                    <a href="{{route('backadmin.users.toggle_active', $user->id)}}" class="btn btn-outline-primary">Ya, {{ $user->is_active ? 'Non-aktifkan' : 'Aktifkan'}}</a>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.users.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalDelete">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan menghapus Pengguna ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary">Ya, Hapus</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
@endpush

@section('vendor-js')
    <script src="{{ asset('backadmin/theme/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/vue/vue.global.js') }}"></script>
    <script src="{{ asset('backadmin/app/js/helper.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script> --}}
@endsection

@push('page-js')
<script>


    let form = Vue.createApp({
        data() {
            return {
                user: {
                },
                availableTabs: [],
                activeTab: null,
                only_ccp: false,
                only_lccp: false,
            }
        },
        created() {
            old = {!! json_encode(old()) !!};
            user = {!! json_encode($user) !!};
            console.log(user)
            this.user = {
                fullname: old.fullname ?? user.fullname ?? '',
                username: old.username ?? user.username ?? '',
                email: old.email ?? user.email ?? '',
                type: old.type ?? user.type ?? '',
                responsible_name: old.responsible_name ?? user.responsible_name ?? '',
                responsible_phone: old.responsible_phone ?? user.responsible_phone ?? '',
                responsible_address: old.responsible_address ?? user.responsible_address ?? '',    
                institution_id : old.institution_id ?? user.institution_id ?? '',            
            }

            this.user.responsible_phone = this.user.responsible_phone.replace(/ /g,"")
            this.user.responsible_phone = this.user.responsible_phone.replace("(+62)","0")
            // console.log(this.user)
            if(this.user.type !== ''){
                console.log(this.user.type)
                switch (this.user.type) {
                    case 'ccp':
                        this.only_ccp = true
                        break;
                    case 'lccp': 
                        this.only_lccp = true
                        break;
                    default:
                        break;
                }                
            }

            if(this.user.institution_id !== ''){
                initS2FieldWithAjax(
                    '#f_institution_id',
                    '{{route("backadmin.s2Init.institutions")}}',
                    {id: this.user.institution_id},
                    ['name']
                )
            }
        },
        mounted() {
            $('input[name="responsible_phone"]').keyup(function(e) {
                var regex = /^[0-9]+$/;
                console.log(e.target.value)
                if (regex.test(e.target.value) !== true)
                    e.target.value = e.target.value.replace(/[^0-9]+/, '');
            });  
            
            $('#f_type').on('change', function(e){
                switch (e.target.value) {
                    case 'ccp':
                        // $('.only_class').val(false)
                        // $('#only_ccp').val(true)
                        form.only_lccp = false
                        form.only_ccp = true
                        break;
                    case 'lccp': 
                        // $('.only_class').val(false)
                        // $('#only_lccp').val(true)
                        form.only_ccp = false
                        form.only_lccp = true
                        break;
                    default:
                        // $('.only_class').val(false)
                        form.only_ccp = false
                        form.only_lccp = false
                        break;
                }
                $('#f_institution_id').val(null).trigger('change')
                form.user.institution_id = null
            })
            $('#f_institution_id').select2({
               ajax: {
                    url: "{{ route('backadmin.s2Opt.institutions') }}",
                    data: function(params){
                        let req = {
                            q:params.term,
                            only_ccp: $('#only_ccp').val() ?? false,
                            only_lccp: $('#only_lccp').val() ?? false,
                        };
                        return req;
                    },
                    processResults: function(data){
                        return {results: data};
                    },
               },
               minimumInputLength:1,
               placeholder: 'Silahkan Pilih Lembaga Terkait',
               templateResult:function(data){
                   return data.loading ? 'Mencari...' : data.name; 
               },
               templateSelection: function(data) {
                    return data.text || data.name;
                }

            }).on('select2:select', function(e){
                // selected = e.params.data
                form.institution.institution_id = e.target.value
                
            })
        },
        computed: {

        },
        methods: {
            number_only(text){
                return number_only(text)
            }
        }
    }).mount('#app');
</script>
@endpush