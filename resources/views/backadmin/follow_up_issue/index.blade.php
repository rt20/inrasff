@extends('backadmin.layouts.master')

@section('vendor-css')
    @include('backadmin.layouts.style_datatables')
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Tindak Lanjut</a></li>
@endsection

@section('actions')
<a href="{{ route('backadmin.follow_up_issues.create') }}" class="btn btn-primary"><i data-feather="plus"></i> Tindak Lanjut</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-text">
            <table id="table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Judul Temuan</th>
                        <th>Penanggung Jawab</th>
                        <th>Penulis Laporan</th>
                        <th>Tanggal Penerbitan</th>
                        <th class="bi-table-col-action-1">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Isu Perikanan A</td>
                        <td>Kementrian Kelautan</td>
                        <td>Unit Kerja Kementrian Kelautan</td>
                        <td>3 Agustus 2021</td>
                        <td class=" text-center">
                            <a href="{{route('backadmin.follow_up_issues.create')}}" class="btn btn-primary btn-sm btn-icon rounded-circle"><i data-feather="edit-2"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Isu Pengolahan Makanan B</td>
                        <td>Kementrian Kesehatan</td>
                        <td>Kementrian Kesehatan</td>
                        <td>29 Agustus 2021</td>
                        <td class=" text-center">
                            <a href="{{route('backadmin.follow_up_issues.create')}}" class="btn btn-primary btn-sm btn-icon rounded-circle"><i data-feather="edit-2"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Isu Pengolahan Makanan B</td>
                        <td>BPOM</td>
                        <td>Unit Kerja 2 BPOM</td>
                        <td>20 Agustus 2021</td>
                        <td class=" text-center">
                            <a href="{{route('backadmin.follow_up_issues.create')}}" class="btn btn-primary btn-sm btn-icon rounded-circle"><i data-feather="edit-2"></i></a>
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

