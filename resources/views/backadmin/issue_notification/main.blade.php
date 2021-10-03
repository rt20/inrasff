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