<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        Project
    </x-slot:pageTitle>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->

        <!--  END CUSTOM STYLE FILE  -->
    </x-slot:headerFiles>
    <!-- END GLOBAL MANDATORY STYLES -->

    <div class="main-container container-xxl" id="container">
        <div class="middle-content container-xxl p-0">

            <!-- BREADCRUMB -->
            <x-widgets._w-breadcrumb>
                <li class="breadcrumb-item"><a href="{{ route('admin.project.index') }}">{{ __('general.menu.project_management.project') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('general.common.edit') }}</li>
            </x-widgets._w-breadcrumb>
            <!-- /BREADCRUMB -->

            <div class="row layout-top-spacing">

                <div class="col-lg-12 col-12  layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <form class="form-update" action="{{ route('admin.project.update', $project->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <a href="{{ route('admin.project.index') }}" class="btn btn-dark mt-4 ms-2 me-2">Back</a>
                                        <button type="submit" class="btn btn-primary mt-4 btn-update">Update</button>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div class="row form-group mb-4">
                                    <div class="col-7">
                                        <label for="sTitle">Title</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="sTitle" value="{{$project->title}}" >
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
                                                <option class="dropdown-item" value={{$project_type->id}} {{ ($project_type->id == $project->project_type_id) ? 'selected': ''}}>{{$project_type->name}}</option>
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
                                <div class="form-group">
                                    <label for="sImage">Images</label>
                                    @foreach($project->media as $image)
                                        <div>
                                        {{$image}}
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row form-group mb-4">
                                    <div class = "col-6">
                                    <label for="sPlatform">Platform</label>
                                    <select id="sPlatform" class="form-control platform-select" name = "platform">
                                        <option value="1" {{$project->platform==1 ? 'selected':''}}>Web</option>
                                        <option value="2" {{$project->platform==2 ? 'selected':''}}>App</option>
                                        <option value="3" {{$project->platform==3 ? 'selected':''}}>Web and app</option>
                                    </select>
                                    </div>
                                    <div class="col-6">
                                        <label or="sPlatform" for="sOrder">Order</label>
                                        <input id="sOrder" type="number" class="form-control" min="0" max="40" step="1" name="order" value="{{$project->order}}">
                                    </div>
                                </div>
                                <div class="link-web form-group mb-4" {{$project->platform==2 ? 'hidden':''}}>
                                    <label for="sLinkweb">Link Web</label>
                                    <input id="sLinkweb" class="form-control" name="link_web" value="{{$project->link_web}}">
                                    </input>
                                </div>
                                <div class="link-app form-group mb-4" {{$project->platform==1 ? 'hidden':''}}>
                                    <label for="sLinkapp">Link App</label>
                                    <input id="sLinkapp" class="form-control" name="link_app" value="{{$project->link_app}}">
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
        <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
        @vite([
            'resources/scss/dark/plugins/perfect-scrollbar/perfect-scrollbar.scss',
            'resources/scss/light/plugins/perfect-scrollbar/perfect-scrollbar.scss',
            'resources/rtl/scss/dark/plugins/perfect-scrollbar/perfect-scrollbar.scss',
            'resources/rtl/scss/light/plugins/perfect-scrollbar/perfect-scrollbar.scss',
            'resources/layouts/modern-light-menu/app.js',
            ])

        <script src="{{ asset('plugins/mousetrap/mousetrap.min.js') }}"></script>
        <script src="{{ asset('plugins/waves/waves.min.js') }}"></script>
        <script src="{{ asset('plugins/glightbox/glightbox.min.js') }}"></script>
        <script src="{{ asset('plugins/glightbox/custom-glightbox.min.js') }}"></script>

        <script>
            var selectedValue
            $(document).on('change', '.platform-select', function() {
                selectedValue = $(this).val();
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
        </script>
        <script>
            $(document).on('click','.btn-update', function() {
                var form = document.getElementById("form-update");
                form.submit;
            });
        </script>

        <!-- END GLOBAL MANDATORY SCRIPTS -->
    </x-slot:footerFiles>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
