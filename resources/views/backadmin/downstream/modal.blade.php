<div class="modal fade" id="institution-modal" tabindex="-1" role="dialog" aria-labelledby="modalAddInstitution" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="institution-modal-form" action="#" method="GET">                    
                <div class="modal-header">
                    <h4 class="modal-title" id="modalAddInstitution">Tambahkan Instansi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input hidden readonly name="ds_id" value="{{$downstream->id}}">
                        <input hidden readonly name="write" value="true">
                        <div class="col-12 col-md-12 form-group">
                            <label class="form-label required">Nama Instansi</label>
                            <select id="f_institution" name="institution_id" class="form-control" autocomplete="off"></select>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Tutup</button>
                    <button type="button" v-on:click="submitItem($event)" class="btn btn-primary">Tambahkan</button>
                </div>
            </form>
        </div>
    </div>
</div>