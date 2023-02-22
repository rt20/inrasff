@extends('backadmin.layouts.master')

@section('vendor-css')
<link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/select/select2.min.css') }}">    
<link rel="stylesheet" href="{{ asset('backadmin/vendors/lightbox2/dist/css/lightbox.css') }}"> 
<style>
    .card-image-v1{
        object-fit: cover; 
        max-height:200px
    }
</style>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('backadmin.sliders.index') }}">Slider</a></li>
@endsection

@section('actions')
    {{-- <button type="submit" form="form-main" formaction="{{ $slider->id ? route('backadmin.sliders.update', $slider->id) : route('backadmin.sliders.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button> --}}
    @if ($slider->id)
        {{-- <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</a> --}}
        <a href="{{ route('backadmin.sliders.index')}}" class="btn btn-outline-primary"><i class="mr-75" data-feather="arrow-left"></i>Kembali</a>
    @endif
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-text">
            <div id="app">
                <form id="form-main" method="post">
                    @csrf
                    @if ($slider->id)
                        @method('PUT')
                    @endif
                    <section class="bi-form-main">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h4>Informasi Umum</h4>
                        </div>
    
                        <div class="row">
                            
                            <div class="col-12 col-md-12 form-group">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" 
                                    name="name"
                                    v-model="slider.name" readonly="" 
                                    class="form-control @error('name') {{ 'is-invalid' }} @enderror" 
                                    placeholder="Masukkan nama" autocomplete="off">
                                @error('name')
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div><!-- .col-md-6.form-group -->
                        </div><!-- .row -->
                    </section><!-- .bi-form-main -->
                    <hr>
                    
                    <section class="bi-form-additional">
                        <ul class="nav nav-tabs mb-2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" 
                                    :class="activeTab === 'slider_image' ? 'active' : ''"
                                    v-on:click="setActiveTab('slider_image')" 
                                    id="tab-nav-slider_image" 
                                    data-toggle="tab" 
                                    href="#tab-slider_image" 
                                    role="tab" 
                                    aria-controls="tab-slider_image" 
                                    aria-selected="true">Gambar Slider</a>
                            </li>
                        </ul><!-- .nav.nav-tabs.mb-2 -->
    
                        <div class="tab-content">
                            <div 
                                class="tab-pane" 
                                :class="activeTab === 'slider_image' ? 'active' : ''"
                                id="tab-slider_image" 
                                aria-labelledby="tab-slider_image" 
                                role="tabpanel">
                                @include('backadmin.slider.form_tab_slider_image')
                            </div>
                        </div>
                    </section>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('modal')
    @if ($slider->id)
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.sliders.destroy', $slider->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalDelete">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan menghapus Slider ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary">Ya, Hapus</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
@endpush

@section('vendor-js')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{ asset('backadmin/theme/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/lightbox2/dist/js/lightbox.js') }}"> </script>
    <script src="{{ asset('backadmin/vendors/vue/vue.global.js') }}"></script>
    <script src="{{ asset('backadmin/app/js/network.js') }}"></script>
@endsection

@push('page-js')
<script>
    function openImageModal(mode, index){
        $('#form-image').trigger('reset')
        form.openImageModal(mode, index)
    }
    let form = Vue.createApp({
        data() {
            return {
                slider: {
                },
                availableTabs: [],
                activeTab: null,
                imageModal: {
                    state: 'add',
                    index: null,
                    item:{
                        id:null,
                        name:'',
                    },
                    error: '',
                    loading: 0
                },
                validatorImage : [
                    {
                        title: 'image',
                        input: 'input',
                        active: true,
                    },
                    {
                        title: 'title',
                        input: 'input',
                        active: false,
                    },
                    {
                        title: 'subtitle',
                        input: 'input',
                        active: false,
                    },
                    {
                        title: 'link',
                        input: 'input',
                        active: false,
                    },
                ],
            }
        },
        created() {
            old = {!! json_encode(old()) !!};
            slider = {!! json_encode($slider) !!};
            console.log(slider)
            this.slider = {
                name: old.name ?? slider.name ?? '',
                slider_image: slider.slider_image ?? [],
                // code: old.code ?? slider.code ?? '',
                
            }
            console.log(this.slider)
            this.setAvailableTab('slider_image')
            this.setActiveTab('slider_image')
        },
        mounted() {
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true
            })
        },
        computed: {

        },
        methods: {
            setAvailableTab(tab) {
                if (this.availableTabs.includes(tab)) {
                    this.availableTabs.splice(this.availableTabs.indexOf(tab), 1);
                    this.activeTab = (this.availableTabs.length > 0) ? this.availableTabs[0] : null;
                } else {
                    this.availableTabs.push(tab);
                    this.activeTab = tab;
                }
            },

            getIcon(name) {
                return feather.icons[name].toSvg();
            },

            setActiveTab(tab) {
                this.activeTab = tab;
            },
            openImageModal(state, index=null){
                console.log("open")
                // console.log($('#form-image'))
                $('.f-image').val(null)
                $('.text-danger').remove();
                this.imageModal.state = state;
                this.imageModal.index = index;
                this.imageModal.error = '';
                this.imageModal.loading = 0
                
                switch (this.imageModal.state) {
                    case 'add':
                        this.imageModal.item = {
                            id: null,
                            name: '',
                        }                     
                        break;                    
                    
                    case 'delete':
                        this.imageModal.item = Object.assign({}, this.slider.slider_image[index]);
                        console.log(this.imageModal)
                        break;
                    
                    default:
                        break;
                }

                $('#modal-image').modal({ backdrop: 'static', keyboard: false })
            },
            async submitImageForm(e) {
                e.preventDefault();
                // return
                
                $('.text-danger').remove();
                this.imageModal.loading = 1
                let invalid;
                
                switch (this.imageModal.state) {
                    case 'add':
                        this.validatorImage.forEach(el => {                    
                            if(!$(el.input+'[name="'+el.title+'"]').val()){
                                if(el.active){
                                    $(el.input+'[name="'+el.title+'"]').parent().append(`
                                        <small class="text-danger">Field ini harus diisi</small>
                                    `);
                                    invalid = true;
                                }
                            }
                        });
                        if(invalid){
                            this.imageModal.loading = 0
                            return;
                        }
                        var url = `{{ route('backadmin.sliders.slider_image.store') }}`
                        // var formData = new FormData($('#form-image').get(0));
                        var formData = new FormData()
                        formData.append('slider_id', {{$slider->id}})
                        formData.append('title', $('input[name="title"]').val())
                        formData.append('subtitle', $('input[name="subtitle"]').val())
                        formData.append('link', $('input[name="link"]').val())
                        formData.append('image', $('input[name="image"]')[0].files[0])
                        // formData.append('distribution_area_id', $('input[name="distribution_area_id"]').val())
                        var resp = await post(
                            url,
                            formData,
                            {
                                headers:{   
                                'Content-Type': 'multipart/form-data'
                            }})
                        
                        if(resp.data.status.localeCompare('ok')==0){
                            $('#modal-image').modal('hide')
                            
                            this.slider.slider_image.push(resp.data.data)
                        }else{
                            alert(resp.data.message)
                        }
                        $('#modal-image').modal('hide')
                        
                        break;

                    case 'delete':
                        var url = `{{ route('backadmin.sliders.slider_image.destroy', ':id') }}`
                        url = url.replace(":id", this.imageModal.item.id)
                        // console.log(url)
                        // return
                        var resp = await destroy(url)
                        console.log(resp)
                        // return 
                         this.slider.slider_image.splice(this.imageModal.index, 1);

                        if(resp.data.status.localeCompare('ok')==0){
                            $('#modal-image').modal('hide').on('hidden.bs.modal', function(){
                                form.imageModal.loading = 0    
                            })
                        }else{
                            this.imageModal.loading = 0
                            alert(resp.data.message)
                        }          
                                      
                        break;
                
                    default:
                        break;
                }
                
                setTimeout(() => {
                   console.log("Wait time out")
                //    $('#form-image').trigger("reset")
                   
                    feather.replace({
                        width: 14,
                        height: 14
                    });    
                    // $('#form-image').trigger("reset");
                    
                }, 200);
                
            },
        }
    }).mount('#app');
</script>
@endpush