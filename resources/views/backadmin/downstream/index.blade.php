@extends('backadmin.layouts.master')

@section('vendor-css')
    @include('backadmin.layouts.style_datatables')
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Downstream</a></li>
@endsection

@section('actions')
@can('store downstream')
<a href="{{ route('backadmin.downstreams.create') }}" class="btn btn-primary"><i data-feather="plus"></i> Downstream</a>
@endcan
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-text">
            <table id="table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nomor</th>
                        <th>Judul</th>
                        <th>Tanggal Dibuat</th>
                        <th>Tanggal Selesai</th>
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
        <select name="f_filter_status" class="custom-select w-100 filter_status">
            <option value="all" selected>Semua Status</option>
            @if(in_array(auth()->user()->type, ['ncp', 'superadmin']))
            <option value="draft">Draft</option>
            <option value="open">Dibuka</option>
            @endif
            <option value="ccp process">Proses CCP</option>
            <option value="done">Selesai</option>
        </select>
    </label>
</template>
@endsection

@section('vendor-js')
    @include('backadmin.layouts.script_datatables')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js" integrity="sha512-he8U4ic6kf3kustvJfiERUpojM8barHoz0WYpAUDWQVn61efpm3aVAD8RWL8OloaDDzMZ1gZiubF9OSdYBqHfQ==" crossorigin="anonymous"></script>
@endsection

@push('page-js')
{{-- <script src="{{ asset('backadmin/app/js/helper.js') }}"></script> --}}
<script>
    $(document).ready(function() {
        let url = "{{ route('backadmin.downstreams.edit', '__id') }}";
        let icon = feather.icons['edit-2'].toSvg();

        let table = $('#table').DataTable({
            ajax: {
                url: "{{ route('backadmin.downstreams.index') }}",
                data: function(data){
                    data.filter_status = $('.filter_status').val() ?? 'all' 
                }
            },
            serverSide: true,
            processing: true,
            columns: [
                { 
                    data: 'DT_RowIndex',
                    className: 'text-center',
                },
                { 
                    data: 'number',
                    defaultContent:'-'
                },
                { data: 'title' },
                {   
                    data: 'created_at' ,
                    searchable: false,
                    render: function(data, type, row, meta){
                        return moment(data).format('D MMMM YYYY HH:mm:ss')
                    }
                },
                {   
                    data: 'finished_at' ,
                    searchable: false,
                    render: function(data, type, row, meta){
                        if(data==null)
                            return '-'
                        return moment(data).format('D MMMM YYYY HH:mm:ss')
                    }
                },
                { 
                    data: 'status' ,
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: function(data,type,row,meta){
                        return '<span class="badge badge-pill badge-light-' + row.status_class + ' px-1 py-50">' + row.status_label + '</span>'
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
            order: [[0, 'asc']],
            language: dtLangId
        });

        $('#table_length').append($('#template').html());

        $('.filter_status').change(function(e) {
            table.draw();
        });
        
    })
</script>
@endpush

