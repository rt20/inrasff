<div class="row" id="risk-section">
    <div class="col-12 col-md-12 form-group">
        
        <div class="d-flex justify-content-between align-items-center">
            <h4>6. Kontrol Perbatasan</h4>
            {{-- <label for="table-risk" class="form-label ">Daftar Resiko</label> --}}
            <a href="{{ route('backadmin.risk_infos.create', ["notification_type" => "downstream", "notification_id" => $downstream->id]) }}" type="button" class="btn btn-icon btn-primary"><i data-feather="plus"></i></a>
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
    let url4 = "{{ route('backadmin.border_control_infos.edit', '__id') }}";
    let icon4 = feather.icons['eye'].toSvg();
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
                { data: 'destination_country_id' },                
                {
                    data: 'id',
                    className: 'text-center',
                    orderable: false,
                    searchable: false, 
                    render: function(data, type, row, meta) {
                        return `<a href="`+url4.replace("__id", data)+`" class="btn btn-primary btn-sm btn-icon rounded-circle">` + icon4 + `</a>`
                    } 
                }
            ],
            order: [[0, 'desc']],
            language: dtLangId
        })
</script>
@endpush