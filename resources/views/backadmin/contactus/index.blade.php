@extends('backadmin.layouts.master')

@section('vendor-css')
    @include('backadmin.layouts.style_datatables')
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('backadmin.contactus.index') }}">Hubungi Kami</a></li>
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
                        <th>Nama</th>
                        <th>Email</th>
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
        let url = "{{ route('backadmin.contactus.edit', '__id') }}";
        let icon = feather.icons['edit-2'].toSvg();

        let table = $('#table').DataTable({
            ajax: {
                url: "{{ route('backadmin.contactus.index') }}",
            },
            serverSide: true,
            processing: true,
            columns: [
                { data: 'name' },
                { data: 'email' },
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

        
    })
</script>
@endpush
