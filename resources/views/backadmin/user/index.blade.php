@extends('backadmin.layouts.master')

@section('vendor-css')
    @include('backadmin.layouts.style_datatables')
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('backadmin.users.index') }}">Pengguna</a></li>
@endsection

@section('actions')
<a href="{{ route('backadmin.users.create') }}" class="btn btn-primary"><i data-feather="plus"></i> Pengguna</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-text">
            <table id="table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Lembaga</th>
                        <th>Penanggung Jawab</th>
                        <th>Username</th>
                        <th>Tipe</th>
                        <th>Status</th>
                        <th class="bi-table-col-action-1">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<template id="template">
    <label>
        <select name="f_filter_type" class="custom-select w-100 filter_type">
            <option value="all" selected>Semua Tipe User</option>
            <option value="ncp">National Contact Point</option>
            <option value="ccp">Competent Contact Point</option>
            <option value="lccp">Local Competent Contact Point</option>
        </select>
    </label>
</template>
@endsection

@section('vendor-js')
    @include('backadmin.layouts.script_datatables')
@endsection

@push('page-js')
{{-- <script src="{{ asset('backadmin/app/js/helper.js') }}"></script> --}}
<script>
    $(document).ready(function() {
        let url = "{{ route('backadmin.users.edit', '__id') }}";
        let icon = feather.icons['edit-2'].toSvg();

        let table = $('#table').DataTable({
            ajax: {
                url: "{{ route('backadmin.users.index') }}",
                data: function(data){
                    data.filter_type = $('.filter_type').val() ?? 'all' ;
                }
            },
            serverSide: true,
            processing: true,
            columns: [
                { data: 'fullname' },
                { 
                    data: 'institution.name',
                    defaultContent: '-'
                },
                { data: 'responsible_name' },
                { data: 'username' },
                { 
                    data: 'role_name_label' ,
                    orderable: false,
                    searchable: false, 
                
                },
                {
                    data: 'status_label',
                    className: 'text-center',
                    orderable: false,
                    searchable: false, 
                    render: function(data, type, row, meta) {
                        return '<span class="badge badge-pill badge-light-' + row.status_class + ' px-2 py-50">' + row.status_label + '</span>'
                    }
                },
                {
                    data: 'id',
                    className: 'text-center',
                    orderable: false,
                    searchable: false, 
                    render: function(data, type, row, meta) {
                        return '<a href="' + url.replace('__id', data) + '" class="btn btn-primary btn-sm btn-icon rounded-circle">' + icon + '</a>'
                    } 
                }
            ],
            order: [[0, 'desc']],
            language: dtLangId
        });

        $('#table_length').append($('#template').html());

        $('.filter_type').change(function(e) {
            table.draw();
        });
        
    })
</script>
@endpush

