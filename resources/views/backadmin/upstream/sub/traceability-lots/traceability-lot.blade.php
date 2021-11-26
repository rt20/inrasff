<div class="row" id="risk-section">
    <div class="col-12 col-md-12 form-group">
        
        <div class="d-flex justify-content-between align-items-center">
            <h4>Daftar Keterlusuran Lot</h4>
            @if($upstream->id !== null && !in_array($upstream->status, ['ccp process', 'ext process', 'done']))
                @can('store u_traceability')
                <a href="{{ route('backadmin.traceability_lot_infos.create', ["notification_type" => "upstream", "notification_id" => $upstream->id]) }}" type="button" class="btn btn-icon btn-primary"><i data-feather="plus"></i></a>
                @endcan
            @endif
        </div>
        <table id="table-traceability-lot" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nomor Batch/Lot/Consignment</th>
                    <th>Negara Asal</th>
                    <th class="bi-table-col-action-1">Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

@push('page-js')
<script>
    let url3 = "{{ route('backadmin.traceability_lot_infos.edit', '__id') }}";
    let icon3 = feather.icons['eye'].toSvg();
     $('#table-traceability-lot').DataTable({
            ajax:{
                url:"{{route('backadmin.traceability_lot_infos.index')}}",
                data: function(data) {
                    data.for_upstream = 1
                    data.tli_id = '{{$upstream->id}}'
                }
            },
            serverSide: true,
            processing: true,
            columns: [
                { data: 'number' },
                { data: 'source_country.name' },
                {
                    data: 'id',
                    className: 'text-center',
                    orderable: false,
                    searchable: false, 
                    render: function(data, type, row, meta) {
                        return `<a href="`+url3.replace("__id", data)+`" class="btn btn-primary btn-sm btn-icon rounded-circle">` + icon3 + `</a>`
                    } 
                }
            ],
            order: [[0, 'desc']],
            language: dtLangId
        })
</script>
@endpush