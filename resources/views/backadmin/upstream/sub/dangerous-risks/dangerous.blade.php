<div class="row" id="dangerous-section">
    <div class="col-12 col-md-12 form-group">
        
        <div class="d-flex justify-content-between align-items-center">
            <h4>Daftar Bahaya</h4>
            @if($upstream->id !== null && !in_array($upstream->status, ['ccp process', 'ext process', 'done']))
                @can('store u_dangerous')
                <a href="{{ route('backadmin.dangerous_infos.create', ["notification_type" => "upstream", "notification_id" => $upstream->id]) }}" type="button" class="btn btn-icon btn-primary"><i data-feather="plus"></i></a>
                @endcan
            @endif
        </div>
        <table id="table-dangerous" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kategori</th>
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
    let url1 = "{{ route('backadmin.dangerous_infos.edit', '__id') }}";
    let icon1 = feather.icons['eye'].toSvg();
    $('#table-dangerous').DataTable({
            ajax:{
                url:"{{route('backadmin.dangerous_infos.index')}}",
                data: function(data) {
                    data.for_upstream = 1
                    data.di_id = '{{$upstream->id}}'
                }
            },
            serverSide: true,
            processing: true,
            columns: [
                { data: 'name' },
                { 
                    data: 'category.name' ,
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
                        return `<a href="`+url1.replace("__id", data)+`" class="btn btn-primary btn-sm btn-icon rounded-circle">` + icon1 + `</a>`
                    } 
                }
            ],
            order: [[0, 'desc']],
            language: dtLangId
        })
</script>
@endpush