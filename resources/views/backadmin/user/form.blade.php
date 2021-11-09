@extends('backadmin.layouts.master')

@section('vendor-css')
<link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/select/select2.min.css') }}">    
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('backadmin.users.index') }}">Pengguna</a></li>
@endsection

@section('actions')
    <button type="submit" form="form-main" formaction="{{ $user->id ? route('backadmin.users.update', $user->id) : route('backadmin.users.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
    @if ($user->id)
        <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</a>
    @endif
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

                            <div class="col-12 col-md-6 form-group">
                                <label for="type" class="form-label required">Tipe</label>
                                <select 
                                    name="type"
                                    v-model="user.type" 
                                    class="form-control @error('type') {{ 'is-invalid' }} @enderror">
                                    <option value="" disabled selected>Pilih Tipe User</option>
                                    @foreach ($user_types as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <small class="text-danger">{{ $errors->first('type') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            @if (!$user->id)
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
                            @endif
                        </div><!-- .row -->
                    </section><!-- .bi-form-main -->
                    <section class="bi-form-main">
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
                                    placeholder="Masukan Alamat"
                                    name="responsible_address"
                                    v-model="user.responsible_address" 
                                    class="form-control @error('email') {{ 'is-invalid' }} @enderror"
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
    {{-- <script src="{{ asset('backadmin/theme/vendors/js/forms/select/select2.full.min.js') }}"></script> --}}
    <script src="{{ asset('backadmin/vendors/vue/vue.global.js') }}"></script>
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
                activeTab: null
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
            }

            console.log(this.user)
        },
        mounted() {
            
        },
        computed: {

        },
        methods: {
            
        }
    }).mount('#app');
</script>
@endpush