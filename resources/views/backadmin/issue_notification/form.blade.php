@extends('backadmin.layouts.master')

@section('vendor-css')
<link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/wizard/bs-stepper.min.css') }}">    
<link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/forms/select/select2.min.css') }}">    
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{ asset('backadmin/theme/css/plugins/forms/form-validation.css') }}">    
    <link rel="stylesheet" href="{{ asset('backadmin/theme/css/plugins/forms/form-wizard.css') }}">    
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('backadmin.issue_notifications.index') }}">Isu Notifikasi</a></li>
@endsection

@section('actions')
    <button type="submit" form="form-main" formaction="{{ $issue_notification->id ? route('backadmin.issue_notifications.update', $issue_notification->id) : route('backadmin.issue_notifications.store') }}" class="btn btn-primary" id="btn-save"><i class="mr-75" data-feather="save"></i>Simpan</button>
    @if ($issue_notification->id)
        <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-delete"><i class="mr-75" data-feather="trash"></i>Hapus</a>
    @endif
@endsection

@section('content')
{{-- <div class="card">
    <div class="card-body"> --}}
        <!-- Vertical Wizard -->
        <section class="vertical-wizard">
            <div class="bs-stepper vertical vertical-wizard-example">
                <div class="bs-stepper-header">
                    <div class="step" data-target="#general-information">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">1</span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">General Information</span>
                                <span class="bs-stepper-subtitle">Informasi Umum</span>
                            </span>
                        </button>
                    </div>
                    <div class="step" data-target="#product">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">2</span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Product</span>
                                <span class="bs-stepper-subtitle">Informasi Produk</span>
                            </span>
                        </button>
                    </div>
                    <div class="step" data-target="#hazard">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">3</span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Hazard</span>
                                <span class="bs-stepper-subtitle">Informasi Bahan Berbahaya</span>
                            </span>
                        </button>
                    </div>
                    <div class="step" data-target="#risk-measures">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">4</span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Risk/Measures</span>
                                <span class="bs-stepper-subtitle">Informasi Ukuran Risiko</span>
                            </span>
                        </button>
                    </div>
                    <div class="step" data-target="#traceability-of-the-lots">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">5</span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Traceability of the Lots</span>
                                <span class="bs-stepper-subtitle">Informasi Volume</span>
                            </span>
                        </button>
                    </div>
                    <div class="step" data-target="#border-control">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">6</span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Border Control</span>
                                <span class="bs-stepper-subtitle">Informasi Kontrol</span>
                            </span>
                        </button>
                    </div>
                    <div class="step" data-target="#other-information">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">7</span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Other Information</span>
                                <span class="bs-stepper-subtitle">Informasi Lainnya</span>
                            </span>
                        </button>
                    </div>
                    <div class="step" data-target="#attached-document">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">8</span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Attached Document</span>
                                <span class="bs-stepper-subtitle">Lampiran Dokumen</span>
                            </span>
                        </button>
                    </div>

                </div>
                <div class="bs-stepper-content">
                    <div id="general-information" class="content">
                        <div class="content-header">
                            <h5 class="mb-0">Account Details</h5>
                            <small class="text-muted">Enter Your Account Details.</small>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-username">Username</label>
                                <input type="text" id="vertical-username" class="form-control" placeholder="johndoe" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-email">Email</label>
                                <input type="email" id="vertical-email" class="form-control" placeholder="john.doe@email.com" aria-label="john.doe" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group form-password-toggle col-md-6">
                                <label class="form-label" for="vertical-password">Password</label>
                                <input type="password" id="vertical-password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                            </div>
                            <div class="form-group form-password-toggle col-md-6">
                                <label class="form-label" for="vertical-confirm-password">Confirm Password</label>
                                <input type="password" id="vertical-confirm-password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-outline-secondary btn-prev" disabled>
                                <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </button>
                            <button class="btn btn-primary btn-next">
                                <span class="align-middle d-sm-inline-block d-none">Next</span>
                                <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                            </button>
                        </div>
                    </div>
                    <div id="product" class="content">
                        <div class="content-header">
                            <h5 class="mb-0">Personal Info</h5>
                            <small>Enter Your Personal Info.</small>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-first-name">First Name</label>
                                <input type="text" id="vertical-first-name" class="form-control" placeholder="John" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-last-name">Last Name</label>
                                <input type="text" id="vertical-last-name" class="form-control" placeholder="Doe" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-country">Country</label>
                                <select class="select2 w-100" id="vertical-country">
                                    <option label=" "></option>
                                    <option>UK</option>
                                    <option>USA</option>
                                    <option>Spain</option>
                                    <option>France</option>
                                    <option>Italy</option>
                                    <option>Australia</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-language">Language</label>
                                <select class="select2 w-100" id="vertical-language" multiple>
                                    <option>English</option>
                                    <option>French</option>
                                    <option>Spanish</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary btn-prev">
                                <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </button>
                            <button class="btn btn-primary btn-next">
                                <span class="align-middle d-sm-inline-block d-none">Next</span>
                                <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                            </button>
                        </div>
                    </div>
                    <div id="hazard" class="content">
                        <div class="content-header">
                            <h5 class="mb-0">Address</h5>
                            <small>Enter Your Address.</small>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-address">Address</label>
                                <input type="text" id="vertical-address" class="form-control" placeholder="98  Borough bridge Road, Birmingham" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-landmark">Landmark</label>
                                <input type="text" id="vertical-landmark" class="form-control" placeholder="Borough bridge" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="pincode2">Pincode</label>
                                <input type="text" id="pincode2" class="form-control" placeholder="658921" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="city2">City</label>
                                <input type="text" id="city2" class="form-control" placeholder="Birmingham" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary btn-prev">
                                <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </button>
                            <button class="btn btn-primary btn-next">
                                <span class="align-middle d-sm-inline-block d-none">Next</span>
                                <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                            </button>
                        </div>
                    </div>
                    <div id="risk-measures" class="content">
                        <div class="content-header">
                            <h5 class="mb-0">Social Links</h5>
                            <small>Enter Your Social Links.</small>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-twitter">Twitter</label>
                                <input type="text" id="vertical-twitter" class="form-control" placeholder="https://twitter.com/abc" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-facebook">Facebook</label>
                                <input type="text" id="vertical-facebook" class="form-control" placeholder="https://facebook.com/abc" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-google">Google+</label>
                                <input type="text" id="vertical-google" class="form-control" placeholder="https://plus.google.com/abc" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-linkedin">Linkedin</label>
                                <input type="text" id="vertical-linkedin" class="form-control" placeholder="https://linkedin.com/abc" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary btn-prev">
                                <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </button>
                            <button class="btn btn-primary btn-next">
                                <span class="align-middle d-sm-inline-block d-none">Next</span>
                                <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                            </button>
                            {{-- <button class="btn btn-success btn-submit">Submit</button> --}}
                        </div>
                    </div>
                    <div id="traceability-of-the-lots" class="content">
                        <div class="content-header">
                            <h5 class="mb-0">Account Details</h5>
                            <small class="text-muted">Enter Your Account Details.</small>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-username">Username</label>
                                <input type="text" id="vertical-username" class="form-control" placeholder="johndoe" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-email">Email</label>
                                <input type="email" id="vertical-email" class="form-control" placeholder="john.doe@email.com" aria-label="john.doe" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group form-password-toggle col-md-6">
                                <label class="form-label" for="vertical-password">Password</label>
                                <input type="password" id="vertical-password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                            </div>
                            <div class="form-group form-password-toggle col-md-6">
                                <label class="form-label" for="vertical-confirm-password">Confirm Password</label>
                                <input type="password" id="vertical-confirm-password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary btn-prev">
                                <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </button>
                            <button class="btn btn-primary btn-next">
                                <span class="align-middle d-sm-inline-block d-none">Next</span>
                                <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                            </button>
                        </div>
                    </div>
                    <div id="border-control" class="content">
                        <div class="content-header">
                            <h5 class="mb-0">Account Details</h5>
                            <small class="text-muted">Enter Your Account Details.</small>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-username">Username</label>
                                <input type="text" id="vertical-username" class="form-control" placeholder="johndoe" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-email">Email</label>
                                <input type="email" id="vertical-email" class="form-control" placeholder="john.doe@email.com" aria-label="john.doe" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group form-password-toggle col-md-6">
                                <label class="form-label" for="vertical-password">Password</label>
                                <input type="password" id="vertical-password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                            </div>
                            <div class="form-group form-password-toggle col-md-6">
                                <label class="form-label" for="vertical-confirm-password">Confirm Password</label>
                                <input type="password" id="vertical-confirm-password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary btn-prev">
                                <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </button>
                            <button class="btn btn-primary btn-next">
                                <span class="align-middle d-sm-inline-block d-none">Next</span>
                                <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                            </button>
                        </div>
                    </div>
                    <div id="other-information" class="content">
                        <div class="content-header">
                            <h5 class="mb-0">Account Details</h5>
                            <small class="text-muted">Enter Your Account Details.</small>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-username">Username</label>
                                <input type="text" id="vertical-username" class="form-control" placeholder="johndoe" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-email">Email</label>
                                <input type="email" id="vertical-email" class="form-control" placeholder="john.doe@email.com" aria-label="john.doe" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group form-password-toggle col-md-6">
                                <label class="form-label" for="vertical-password">Password</label>
                                <input type="password" id="vertical-password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                            </div>
                            <div class="form-group form-password-toggle col-md-6">
                                <label class="form-label" for="vertical-confirm-password">Confirm Password</label>
                                <input type="password" id="vertical-confirm-password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary btn-prev">
                                <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </button>
                            <button class="btn btn-primary btn-next">
                                <span class="align-middle d-sm-inline-block d-none">Next</span>
                                <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                            </button>
                        </div>
                    </div>
                    <div id="attached-document" class="content">
                        <div class="content-header">
                            <h5 class="mb-0">Account Details</h5>
                            <small class="text-muted">Enter Your Account Details.</small>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-username">Username</label>
                                <input type="text" id="vertical-username" class="form-control" placeholder="johndoe" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="vertical-email">Email</label>
                                <input type="email" id="vertical-email" class="form-control" placeholder="john.doe@email.com" aria-label="john.doe" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group form-password-toggle col-md-6">
                                <label class="form-label" for="vertical-password">Password</label>
                                <input type="password" id="vertical-password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                            </div>
                            <div class="form-group form-password-toggle col-md-6">
                                <label class="form-label" for="vertical-confirm-password">Confirm Password</label>
                                <input type="password" id="vertical-confirm-password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary btn-prev">
                                <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </button>
                            {{-- <button class="btn btn-primary btn-next">
                                <span class="align-middle d-sm-inline-block d-none">Next</span>
                                <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                            </button> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Vertical Wizard -->
        {{-- <div class="card-text">
            <div id="app">
                <form id="form-main" method="post">
                    @csrf
                    @if ($issue_notification->id)
                        @method('PUT')
                    @endif
                    <section class="bi-form-main">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h4>Informasi Umum</h4>
                        </div>
                    </section><!-- .bi-form-main -->
                </form>
            </div>
        </div> --}}
    {{-- </div>
</div> --}}
@endsection

@push('modal')
    @if ($issue_notification->id)
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backadmin.issue_notifications.destroy', $issue_notification->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalDelete">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan menghapus Isu Notifikasi ini?</p>
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
    {{-- <script src="../../../app-assets/vendors/js/forms/wizard/bs-stepper.min.js"></script> --}}
    <script src="{{ asset('backadmin/theme/vendors/js/forms/wizard/bs-stepper.min.js') }}"></script>
    <script src="{{ asset('backadmin/theme/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('backadmin/vendors/vue/vue.global.js') }}"></script>
@endsection

@push('page-js')
    <script src="{{ asset('backadmin/theme/js/scripts/forms/form-wizard.js') }}"></script>
    
<script>


    let form = Vue.createApp({
        data() {
            return {
                issue_notification: {
                },
                availableTabs: [],
                activeTab: null
            }
        },
        created() {
            old = {!! json_encode(old()) !!};
            issue_notification = {!! json_encode($issue_notification) !!};
            console.log(issue_notification)
            
        },
        mounted() {
            
        },
        computed: {

        },
        methods: {
            
        }
    }).mount('#app');
</script>
@endpush