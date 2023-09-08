<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        Section
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
                <li class="breadcrumb-item"><a href="{{ route('admin.section.index') }}">{{ __('general.menu.banner_management.section') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('general.common.edit') }}</li>
            </x-widgets._w-breadcrumb>
            <!-- /BREADCRUMB -->

            <div class="row layout-top-spacing">

                <div class="col-lg-12 col-12  layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <form action="{{ route('admin.section.update', $section->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <a href="{{ route('admin.section.index') }}" class="btn btn-dark mt-4 ms-2 me-2">Back</a>
                                        <button type="submit" class="btn btn-primary mt-4">Update</button>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div class="form-group mb-4">
                                    <label for="sName">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="sName" placeholder="Name" value="{{ old('name', $section->name) }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <label for="sFixedKey">Fixed key</label>
                                    <input type="text" class="form-control @error('fixed_key') is-invalid @enderror" name="fixed_key" id="sFixedKey" placeholder="Fixed key" value="{{ old('fixed_key', $section->fixed_key) }}">
                                    @error('fixed_key')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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

    </x-slot:footerFiles>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
