
<div class="row">
    <div class="col-12 mb-1">
        <div class="d-flex justify-content-between align-items-center">
            <label for="image" class="form-label required">Daftar Gambar</label>
            <button type="button" class="btn btn-sm btn-icon btn-primary" v-on:click="openImageModal('add')"><i data-feather="plus"></i></button>            
        </div>
    </div>
    <div class="col-12 mb-1">
        <div class="demo-spacing-0" v-if="slider?.slider_image?.length == 0">
            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">Gambar Slider belum ditambahkan</h4>
                <div class="alert-body">
                    Silahkan menambahkan dengan klik tombol + di pojok kanan atas
                </div>
            </div>
        </div>
    </div>
    <div v-for="(item, index) in slider.slider_image" class="col-md-6 col-lg-4" v-if="slider?.slider_image?.length > 0">
        <div class="card">
            <a :href="item.ref" data-lightbox="image-1">
                <img class="card-img-top card-image-v1" :src="item.ref_thumb" alt="Card image cap" />
            </a>
            <button 
                style="position: absolute"
                type="button" 
                class="btn btn-sm btn-icon rounded-circle btn-primary m-1 "
                v-on:click="openImageModal('delete', index)">
                <i data-feather="trash"></i> 
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-image" tabindex="-1" role="dialog" aria-labelledby="modalImage" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form-image" action="#" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                    <div class="modal-header">
                        <h4 v-show="imageModal.state !== 'delete'" class="modal-title" id="modalImage">Tambah Slider</h4>
                        <h4 v-show="imageModal.state === 'delete'" class="modal-title" id="modalImage">Hapus Slider</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div v-show="imageModal.state !== 'delete'">
                            <div class="alert alert-danger mb-50" v-if="imageModal.error != ''">
                                <div class="alert-body">@{{ imageModal.error }}</div>
                            </div>
                            <div class="form-group">
                                <label class="form-label required" for="image">Gambar</label>
                                {{-- <select name="province" id="f_province" class="form-control"></select> --}}
                                <input name="image" id="image" class="form-control f-image" type="file">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="title">Judul</label>
                                <input name="title" id="title" class="form-control f-image" autocomplete="off" type="text">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="subtitle">Sub Judul</label>
                                <input name="subtitle" id="subtitle" class="form-control f-image" autocomplete="off" type="text">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="link">Tautan</label>
                                <input name="link" id="link" class="form-control f-image" autocomplete="off" type="text">
                            </div>
                        </div>
                        <div v-show="imageModal.state === 'delete'">
                            <p class="mb-0">Apakah Anda yakin akan menghapus Slider ini?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button v-show="imageModal.state !== 'delete'" type="button" class="btn btn-outline-primary" data-dismiss="modal">Tutup</button>
                        
                        
                        <button type="submit" class="btn btn-outline-primary" form="form-address" v-if="imageModal.state === 'delete'" v-on:click="submitImageForm($event)">Ya, Hapus</button>
                        <button v-show="imageModal.state === 'delete'" type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                        <button 
                            type="submit" 
                            class="btn btn-primary" 
                            form="form-address" 
                            v-if="imageModal.state === 'add'" 
                            v-on:click="submitImageForm($event)">
                            Tambah
                        </button>
                        

                    </div>
            </div>
        </form>
    </div>
</div> 

