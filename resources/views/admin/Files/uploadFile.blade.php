@extends('admin.common.main')

@section('containes')


<div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
</div>
</div>
</div>
</div>
</div>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />


<main class="py-4">
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="toolbar" id="kt_toolbar">

            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">

                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">


                    <div class="d-flex align-items-center gap-2 gap-lg-3">

                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">


                        </div>

                        <a style="display:none" href="../../demo1/dist/.html" class="btn btn-sm btn-primary"
                            data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Create</a>
                    </div>
                </div>

                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                </div>
                <a style="display:none" href="../../demo1/dist/.html" class="btn btn-sm btn-primary"
                    data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Create</a>
            </div>
        </div>
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="card">
                <div class="card-header border-2 pt-6">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            &nbsp;
                            <span>Upload Files</span>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">

                    <div class="col-xl-12">
                        <div class="card card-flush h-lg-100" id="kt_contacts_main">

                            <div style="display:none" class="card-header pt-7" id="kt_chat_contacts_header">

                                <div style="display:none" class="card-title">


                                </div>
                            </div>

                            <div class="card-body pt-5">
                                <form method="POST" id="form" action="{{route('upload-file')}}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row row-cols-1 row-cols-sm-3 rol-cols-md-1 row-cols-lg-3">

                                        <div class="field_wrapper">
                                            <div class="col">
                                                <div class="fv-row mb-2">
                                                    <label class="fs-6 fw-bold form-label mt-3">
                                                        <span class="">FILE UPLOAD</span><span
                                                            style="color: red;">*</span>
                                                    </label>
                                                    <input type="file" name="name[]" id="organisation_code"
                                                        class="form-control" autocomplete="off"
                                                        oninput="removeBorderStyle(this)">
                                                    <span id="errorDiv" style="color:red;"></span>
                                                    <a href="javascript:void(0);" class="add_button" title="Add"><img
                                                            src="/images/plus.png"
                                                            style="height:30px; width:30px;padding-top: 0px;padding-right: 1px;padding-bottom: 3px;padding-left: -13px;margin-top: -55px;margin-right: -26px;margin-left: 370px;"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" name="email" class="form-control"
                                                placeholder="Enter Email Address  :" autocomplete="off"
                                                style="margin-left:10px;width: 345px;" required>
                                        </div>
                                    </div>

                                    <br>
                                    <div style="float:right;">

                                        <div class="d-flex justify-content-end">

                                            <button type="reset" onclick="history.back()" id="cancel_btn"
                                                class="btn btn-outline-danger"
                                                style="margin-right:10px;">Cancel</button>
                                            <button type="submit" id="submit" data-kt-contacts-type="submit"
                                                class="btn btn-primary">
                                                <span class="indicator-label">Save</span>


                                            </button>
                                        </div>

                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="marquee-container" style="width:100%">
                        <div class="marquee-content" style="padding-top:20px; color:red">

                            Note<span style="padding-left:8px;"> <span style="padding-right:4px;">:</span> You can
                                upload maximum 10 files and multiple emails at a Time.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>
    </div>
    </div>
    </div>


    <style>
    #organisation_code-error {
        color: red;
        padding-top: 15px;

    }

    #Errormsg {
        color: red;
        margin-top: 10px;

    }

    @keyframes marquee {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(-100%);
        }
    }

    .marquee-container {
        overflow: hidden;
        white-space: nowrap;
        width: 100%;
    }

    .marquee-content {
        display: inline-block;
        width: 100%;
        animation: marquee 20s linear infinite;
    }
    </style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#form').validate({
                rules: {
                    'name[]': {
                        required: true,
                        extension: 'jpg,jpeg,png,gif,xlsx,exe',
                        filesize: 2097152,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                },
                messages: {
                    'name[]': {
                        required: 'Please select at least one file.',
                        extension: 'Please select a valid file type (jpg, jpeg, png, gif, xlsx, exe).',
                        filesize: 'File size must not exceed 2 MB.',
                    },
                    email: {
                        required: 'Please enter your email address.',
                        email: 'Please enter a valid email address.',
                    },
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });

            $.validator.addMethod('filesize', function (value, element, param) {
                return this.optional(element) || (element.files[0].size <= param);
            }, 'File size must not exceed {0} bytes.');
        });
    </script>
    @endsection