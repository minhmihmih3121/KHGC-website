<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        Section
    </x-slot:pageTitle>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link rel="stylesheet" type="text/css" href="{{asset('plugins/notification/snackbar/snackbar.min.css')}}">
        @vite([
            'resources/scss/light/plugins/notification/snackbar/custom-snackbar.scss',
            'resources/scss/dark/plugins/notification/snackbar/custom-snackbar.scss',

            'resources/rtl/scss/light/plugins/notification/snackbar/custom-snackbar.scss',
            'resources/rtl/scss/dark/plugins/notification/snackbar/custom-snackbar.scss'
        ])
        <!--  END CUSTOM STYLE FILE  -->
    </x-slot:headerFiles>
    <!-- END GLOBAL MANDATORY STYLES -->

    <div class="main-container container-xxl" id="container">
        <div class="middle-content container-xxl p-0">

            <!-- BREADCRUMB -->
            <x-widgets._w-breadcrumb>
                <li class="breadcrumb-item active" aria-current="page">{{ __('general.menu.banner_management.section') }}</li>
            </x-widgets._w-breadcrumb>
            <!-- /BREADCRUMB -->

            <div class="row layout-top-spacing">
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                @can(Acl::PERMISSION_SECTION_ADD)
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <a href="{{ route('admin.section.create') }}" class="btn btn-secondary mt-4 ms-2 me-4">New</a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <x-widgets._w-table-basic>
                                <x-slot:thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Fixed key</th>
                                        <th class="text-center" scope="col">Status</th>
                                        <th class="text-center" scope="col">Action</th>
                                    </tr>
                                </x-slot:thead>

                                @foreach($sections as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->fixed_key }}</td>
                                        <td class="text-center">
                                            <div class="form-check form-switch">
                                                <input role="button" class="form-check-input bg-primary border-0 toggle-status" type="checkbox" @checked($item->status) data-id="{{ $item->id }}">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="action-btns">
                                                @can(Acl::PERMISSION_SECTION_EDIT)
                                                    <a href="{{ route('admin.section.edit', $item->id) }}" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                    </a>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </x-widgets._w-table-basic>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script src="{{ asset('plugins/notification/snackbar/snackbar.min.js') }}"></script>
        @include('includes.toggle-status')
        <script>
            $(document).on('change', '.toggle-status', function(e) {
                e.preventDefault();
                let section = $(this).data('id');
                let url = '{{ route('admin.section.toggle_status', ':id') }}';
                url = url.replace(':id', section);

                toggleStatus(url);
            });
        </script>
    </x-slot:footerFiles>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
