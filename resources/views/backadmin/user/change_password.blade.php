@extends('backadmin.layouts.master')

@section('vendor-css')
<link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/select/select2.min.css') }}">    
@endsection

@section('breadcrumb')
@if($profile)
<li class="breadcrumb-item"><a href="{{ route('backadmin.users.edit_profile', auth()->user()->id) }}">Profil</a></li>
@else
<li class="breadcrumb-item"><a href="{{ route('backadmin.users.edit', $user->id) }}">Profil</a></li>
@endif
@endsection

@section('actions')
    <button type="submit" form="form-main" formaction="{{ route('backadmin.users.update_password', $user->id) }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
    <div class="btn-group">
        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <b class="d-none d-md-inline">Aksi Lain</b><i class="ml-md-75" data-feather="chevron-down"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            @if($profile)
            <a href="{{route('backadmin.users.edit_profile', auth()->user()->id)}}" class="dropdown-item"><i class="mr-75" data-feather="arrow-left"></i>Kembali</a>
            @else
            <a href="{{route('backadmin.users.edit', $user->id)}}" class="dropdown-item"><i class="mr-75" data-feather="arrow-left"></i>Kembali</a>
            @endif
        </div>
    </div>
@endsection

@section('content')
<div class="card">
    <div class="card-body pb-4">
        <div class="card-text">
            <div id="app">
                <form id="form-main" method="post">
                    @csrf
                    @if ($user->id)
                        @method('PUT')
                    @endif
                    <section class="el-form-main">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h4>Ubah Password Anda di Sini</h4>
                        </div>
    
                        <div class="row">
                            @if($profile)
                            <input hidden name="profile" value="{{$profile}}">
                            @endif
                            <div class="col-md-6 form-group">
                                <label for="name" class="form-label required">Password Baru</label>
                                <input type="password" 
                                    name="password"
                                    class="form-control @error('password') {{ 'is-invalid' }} @enderror"
                                    placeholder="Masukkan password"
                                    autocomplete="off" >
                                @error('password')
                                    <small class="text-danger">{{ $errors->first('password') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->

                            <div class="col-md-6 form-group">
                                <label for="name" class="form-label required">Ketik Ulang Password</label>
                                <input type="password" 
                                    name="password_confirmation"
                                    class="form-control @error('password_confirmation') {{ 'is-invalid' }} @enderror"
                                    placeholder="Ketik ulang password"
                                    autocomplete="off" >
                                @error('password_confirmation')
                                    <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                        </div>
                    </section><!-- .el-form-main -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('modal')
@endpush

@section('vendor-js')
    <script src="{{ asset('backadmin/theme/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/vue/vue.global.js') }}"></script>
    <script src="{{ asset('backadmin/app/js/helper.js') }}"></script>
@endsection

@push('page-js')
<script>
    
</script>
@endpush