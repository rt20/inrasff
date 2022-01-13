<div class="row" id="risk-section">
    <div class="col-12 col-md-12 form-group">
        
        <div class="d-flex justify-content-between align-items-center">
            <h4>Kontrol Perbatasan</h4>
            @if($downstream->id !== null && !in_array($downstream->status, ['ccp process', 'ext process', 'done']))
            @can('store u_border_control')
            <a href="{{ route('backadmin.border_control_infos.create', ["notification_type" => "downstream", "notification_id" => $downstream->id]) }}" type="button" class="btn btn-icon btn-primary"><i data-feather="plus"></i></a>
            @endcan
            @endif
        </div>
        <table id="table-border-control" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Titik Keberangkatan</th>
                    <th>Titik Masuk</th>
                    <th>Titik Pengawasasn</th>
                    <th>Negara Tujuan</th>
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
    let url5 = "{{ route('backadmin.border_control_infos.edit', '__id') }}";
    let icon5 = feather.icons['eye'].toSvg();
     $('#table-border-control').DataTable({
            ajax:{
                url:"{{route('backadmin.border_control_infos.index')}}",
                data: function(data) {
                    data.for_downstream = 1
                    data.bci_id = '{{$downstream->id}}'
                }
            },
            serverSide: true,
            processing: true,
            columns: [
                { data: 'start_point' },
                { data: 'entry_point' },
                { data: 'supervision_point' },
                { 
                    data: 'destination_country.name' ,
                    render: function(data, type, row, meta){
                        if(data!=null)
                            return data
                        return "-"
                    }
                },               
                {
                    data: 'id',
                    className: 'text-center',
                    orderable: false,
                    searchable: false, 
                    render: function(data, type, row, meta) {
                        return `<a href="`+url5.replace("__id", data)+`" class="btn btn-primary btn-sm btn-icon rounded-circle">` + icon5 + `</a>`
                    } 
                }
            ],
            order: [[0, 'desc']],
            language: dtLangId
        })
</script>
@endpush