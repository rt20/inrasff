@extends('backadmin.layouts.master')

@section('vendor-css')
    @include('backadmin.layouts.style_datatables')
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Isu Notifikasi</a></li>
@endsection

@section('actions')
<a href="{{ route('backadmin.issue_notifications.create') }}" class="btn btn-primary"><i data-feather="plus"></i> Isu Notifikasi</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-text">
            <table id="table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Lembaga Pemangku</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Tindak Lanjut</th>
                        <th class="bi-table-col-action-1">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Isu Pangan A</td>
                        <td>BPOM</td>
                        <td>1 Agustus 2021</td>
                        <td>3 Agustus 2021</td>
                        <td class=" text-center">
                            <a href="{{route('backadmin.issue_notifications.create')}}" class="btn btn-primary btn-sm btn-icon rounded-circle"><i data-feather="edit-2"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('vendor-js')
    @include('backadmin.layouts.script_datatables')
@endsection

@push('page-js')
{{-- <script src="{{ asset('backadmin/app/js/helper.js') }}"></script> --}}
<script>
    $(document).ready(function() {
        let url = "#";
        let icon = feather.icons['edit-2'].toSvg();

        let table = $('#table').DataTable({
            // ajax: {
            //     url: "#",
            // },
            // serverSide: true,
            // processing: true,
            // columns: [
            //     { data: 'name' },
            //     { data: 'code' },
            //     {
            //         data: 'id',
            //         className: 'text-center',
            //         orderable: false,
            //         searchable: false, 
            //         render: function(data, type, row, meta) {
            //             return '<a href="' + url.replace('__id', data) + '" class="btn btn-primary btn-sm btn-icon rounded-circle">' + icon + '</a>'
            //         } 
            //     }
            // ],
            // order: [[0, 'desc']],
            // language: dtLangId
        });
        
    })
</script>
@endpush

