@extends('backadmin.layouts.master')

@section('vendor-css')
    @include('backadmin.layouts.style_datatables')
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('backadmin.sliders.index') }}">Slider</a></li>
@endsection

@section('actions')

@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-text">
            <table id="table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th>Lokasi</th>
                        <th class="bi-table-col-action-1">Aksi</th>
                    </tr>
                </thead>
                <tbody>
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
        let url = "{{ route('backadmin.sliders.edit', '__id') }}";
        let icon = feather.icons['eye'].toSvg();

        let table = $('#table').DataTable({
            ajax: {
                url: "{{ route('backadmin.sliders.index') }}",
            },
            serverSide: true,
            processing: true,
            columns: [
                { data: 'DT_RowIndex', className: 'text-center' },
                { 
                    data: 'name',
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

        
    })
</script>
@endpush

