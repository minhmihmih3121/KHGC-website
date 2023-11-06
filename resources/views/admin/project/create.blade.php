<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        Project
    </x-slot:pageTitle>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link rel="stylesheet" href="{{asset('plugins/filepond/filepond.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/filepond/FilePondPluginImagePreview.min.css')}}">
        @vite([
            'resources/scss/light/plugins/filepond/custom-filepond.scss',
            'resources/scss/dark/plugins/filepond/custom-filepond.scss',

            'resources/rtl/scss/light/plugins/filepond/custom-filepond.scss',
            'resources/rtl/scss/dark/plugins/filepond/custom-filepond.scss',
        ])
        <!--  END CUSTOM STYLE FILE  -->
    </x-slot:headerFiles>
    <!-- END GLOBAL MANDATORY STYLES -->

    <div class="main-container container-xxl" id="container">
        <div class="middle-content container-xxl p-0">

            <!-- BREADCRUMB -->
            <x-widgets._w-breadcrumb>
                <li class="breadcrumb-item"><a href="{{ route('admin.project.index') }}">{{ __('general.menu.project_management.project') }}</a></li>
                <li id="btn-create" class="breadcrumb-item active" aria-current="page">{{ __('general.common.create') }}</li>
            </x-widgets._w-breadcrumb>
            <!-- /BREADCRUMB -->
            <div class="row layout-top-spacing">

                <div class="col-lg-12 col-12  layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <form id="form-create" action="{{ route('admin.project.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <a href="{{ route('admin.project.index') }}" class="btn btn-dark mt-4 ms-2 me-2">Back</a>
                                        <button type="submit" class="btn btn-primary mt-4">Create</button>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div class="row form-group mb-4">
                                    <div class="col-7">
                                        <label for="sTitle">Title</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="sTitle" placeholder="Title">
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-5">
                                        <label for="sProjectType">Project Type</label>
                                        <select id="sProjectType" class="form-control project-type-select" name="project_type_id">
                                            @foreach ($project_types as $project_type)
                                                <option class="dropdown-item" value={{$project_type->id}}>{{$project_type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="sDescription">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" rows="3" name="description" id="sDescription" placeholder="Description"></textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="multiple-file-upload form-group mb-4">
                                    <label for="sImage">Images</label>
                                    <input type="file"
                                        class="filepond file-upload-multiple"
                                        id = "sImage"
                                        name = "media"
                                        multiple
                                        accept="image/*"
                                        data-allow-reorder="true"
                                        data-max-file-size="5MB"
                                        data-max-files="5">
                                    </div>
                                <div class="row form-group mb-4">
                                    <div class = "col-6">
                                    <label for="sPlatform">Platform</label>
                                    <select id="sPlatform" class="form-control platform-select" name = "platform">
                                        <option value="1" selected>Web</option>
                                        <option value="2">App</option>
                                        <option value="3">Web and app</option>
                                    </select>
                                    </div>
                                    <div class="col-6">
                                        <label or="sPlatform" for="sOrder">Order</label>
                                        <input id="sOrder" type="number" class="form-control" min="0" max="40" step="1" name="order" placeholder=0>
                                    </div>
                                </div>
                                <div class="link-web form-group mb-4">
                                    <label for="sLinkweb">Link Web</label>
                                    <input id="sLinkweb" class="form-control" name="link_web" placeholder="Link web">
                                    </input>
                                </div>
                                <div class="link-app form-group mb-4" hidden>
                                    <label for="sLinkapp">Link App</label>
                                    <input id="sLinkapp" class="form-control" name="link_app" placeholder="Link app">
                                    </input>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script src="{{ asset('plugins/filepond/filepond.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/FilePondPluginFileValidateType.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/FilePondPluginImageExifOrientation.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/FilePondPluginImagePreview.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/FilePondPluginImageCrop.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/FilePondPluginImageResize.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/FilePondPluginImageTransform.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/filepondPluginFileValidateSize.min.js') }}"></script>
        <script>
            /**
             * ====================
             * Multiple File Upload
             * ====================
            */

            // We want to preview images, so we register
            // the Image Preview plugin, We also register
            // exif orientation (to correct mobile image
            // orientation) and size validation, to prevent
            // large files from being added
            FilePond.registerPlugin(
                FilePondPluginImagePreview,
                FilePondPluginImageExifOrientation,
                FilePondPluginFileValidateSize,
                // FilePondPluginImageEdit
            );

            // Select the file input and use
            // create() to turn it into a pond
            FilePond.create(
                document.querySelector('.file-upload-multiple')
            );

            $(document).on('change', '.platform-select', function() {
                var selectedValue = $(this).val();
                if (selectedValue && selectedValue == "2") {
                    $('.link-web').attr('hidden', true);
                    $('.link-app').attr('hidden', false);
                } else {
                    if (selectedValue && selectedValue == "1") {
                        $('.link-app').attr('hidden', true);
                        $('.link-web').attr('hidden', false);
                    } else {
                        $('.link-app').attr('hidden', false);
                        $('.link-web').attr('hidden', false);
                    }
                }
            });

            $(document).on('click', '.btn-create', function(e) {
                var form = document.getElementById("form-create");
                form.submit;
            });
        </script>
    </x-slot:footerFiles>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
