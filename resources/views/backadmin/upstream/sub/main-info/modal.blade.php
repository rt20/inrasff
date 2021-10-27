<div class="modal fade" id="institution-modal" tabindex="-1" role="dialog" aria-labelledby="modalAddInstitution" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="institution-modal-form" action="#" method="GET">                    
                <div class="modal-header">
                    <h4 v-show="institutionModal.state !== 'delete'" class="modal-title" id="modalAddInstitution">Tambah Instansi</h4>
                    <h4 v-show="institutionModal.state === 'delete'" class="modal-title" id="modalAddInstitution">Hapus Instansi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" v-show="institutionModal.state !== 'delete'">
                        <input hidden readonly name="ds_id" value="{{$upstream->id}}">
                        <div class="col-12 col-md-12 form-group" >
                            <label class="form-label required">Nama Instansi</label>
                            <select id="f_institution_a" name="institution_id" class="form-control" autocomplete="off"></select>
                        </div>
                    </div>

                    <div v-show="institutionModal.state === 'delete'">
                        <p class="mb-0">Apakah Anda yakin akan menghapus Instansi ini?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Tutup</button>
                    <button v-if="institutionModal.state !== 'delete'" type="button" v-on:click="submitItem($event)" class="btn btn-primary">Tambahkan</button>
                    <button v-if="institutionModal.state === 'delete'" type="button" v-on:click="submitItem($event)" class="btn btn-primary">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>