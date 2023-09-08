<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        Banner
    </x-slot:pageTitle>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link rel="stylesheet" href="{{asset('plugins/table/datatable/datatables.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('plugins/notification/snackbar/snackbar.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('plugins/sweetalerts2/sweetalerts2.css')}}">

        @vite([
            'resources/scss/light/plugins/table/datatable/dt-global_style.scss',
            'resources/scss/dark/plugins/table/datatable/dt-global_style.scss',

            'resources/scss/light/assets/elements/color_library.scss',
            'resources/scss/dark/assets/elements/color_library.scss',

            'resources/scss/light/plugins/notification/snackbar/custom-snackbar.scss',
            'resources/scss/dark/plugins/notification/snackbar/custom-snackbar.scss',

            'resources/rtl/scss/light/plugins/notification/snackbar/custom-snackbar.scss',
            'resources/rtl/scss/dark/plugins/notification/snackbar/custom-snackbar.scss',

            'resources/scss/light/plugins/sweetalerts2/custom-sweetalert.scss',
            'resources/scss/dark/plugins/sweetalerts2/custom-sweetalert.scss',
        ])
        <!--  END CUSTOM STYLE FILE  -->
    </x-slot:headerFiles>
    <!-- END GLOBAL MANDATORY STYLES -->

    <div class="main-container container-xxl" id="container">
        <div class="middle-content container-xxl p-0">

            <!-- BREADCRUMB -->
            <x-widgets._w-breadcrumb>
                <li class="breadcrumb-item active"
                    aria-current="page">{{ __('general.menu.banner_management.banner') }}</li>
            </x-widgets._w-breadcrumb>
            <!-- /BREADCRUMB -->

            <div class="row layout-top-spacing">

                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-8">
                        <div class="row">
                            @can(Acl::PERMISSION_BANNER_ADD)
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <a href="{{ route('admin.banner.create') }}" class="btn btn-secondary mt-4 ms-4 me-4">New</a>
                                </div>
                            @endcan
                        </div>
                        <x-widgets._w-table-datatable-basic>
                            <x-slot:thead>
                                <tr>
                                    <th class="text-center" style="width:5%">ID</th>
                                    <th style="width:20%">Image</th>
                                    <th class="text-center" style="width:5%">Color cover</th>
                                    <th style="width:15%">Title</th>
                                    <th style="width:30%">Content</th>
                                    <th class="text-center" style="width:15%">Show</th>
                                    <th class="no-content text-center" style="width:10%">Action</th>
                                </tr>
                            </x-slot:thead>
                        </x-widgets._w-table-datatable-basic>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script src="{{ asset('plugins/table/datatable/datatables.js') }} "></script>
        <script src="{{ asset('plugins/notification/snackbar/snackbar.min.js') }}"></script>
        <script src="{{ asset('plugins/sweetalerts2/sweetalerts2.min.js') }}"></script>
        @include('includes.toggle-status')
        @include('includes.delete-item')
        <script>
            let drawDT = 0;

            const bannerTable = $('#zero-config').DataTable({
                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                    "<'table-responsive'tr>" +
                    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                "oLanguage": {
                    "oPaginate": {
                        "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                    },
                    "sEmptyTable": "{{ __('general.common.empty_table_message') }}",
                    "sInfo": "{{ __('general.common.showing_page', ['page' => '_PAGE_', 'pages' => '_PAGES_']) }}",
                    "sInfoEmpty": "{{ __('general.common.showing_page', ['page' => '_PAGE_', 'pages' => '_PAGES_']) }}",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "{{ __('general.common.search') }}...",
                    "sLengthMenu": "{{ __('general.common.result') }} :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [5, 10, 20, 50],
                "pageLength": 5,
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [[0, 'desc']],
                "ajax": {
                    "url": "{{ route('admin.banner.index') }}",
                    "data": function (d) {
                        drawDT = d.draw;
                        d.limit = d.length;
                        d.page = d.start / d.length + 1;
                    },
                    "dataSrc": function (res) {
                        res.draw = drawDT;
                        res.recordsTotal = res.meta.total;
                        res.recordsFiltered = res.meta.total;
                        return res.data;
                    }
                },
                "columns": [
                    {
                        "data": "id",
                        "class": "text-center",
                        "orderable": true
                    },
                    {
                        "data": "image_url",
                        "orderable": false,
                        "render": function (data, type, full) {
                            return `<img class="w-100" src="${data}" alt="${full.alt}">`
                        }
                    },
                    {
                        "data": "cover_color",
                        "orderable": false,
                        "render": function (data, type, full) {
                            return `<div class="color-box">
                            <span class="cl-example"
                                style="width: 64px; height: 64px; margin-right: 12px; background-color: ${data};"></span>
                            <div class="cl-info">
                                <h5 class="cl-title">Hex</h5>
                                <span>${data}</span>
                            </div>
                          </div>`
                        }
                    },
                    {
                        "data": "heading",
                        "orderable": false,
                        "render": function (data, type, full) {
                            return `
                            <p class="mb-0 pt-1 pb-1">
                                <span>{{ __('general.common.heading') }}:</span>
                                <span style="white-space: normal">${full.heading}</span>
                            </p>
                            <p class="mb-0 pt-1 pb-1">
                                <span>{{ __('general.common.sub_heading') }}:</span>
                                <span style="white-space: normal">${full.sub_heading}</span>
                            </p>`;
                        }
                    },
                    {
                        "data": "alt",
                        "orderable": false,
                        "render": function (data, type, full) {
                            return `<p class="mb-0 pt-1 pb-1 style="white-space: normal">
                                Alt: ${full.alt ? full.alt : 'N/A'}
                                </p>
                              <p class="mb-0 pt-1 pb-1" style="white-space: normal">
                                  Link: ${full.link ? full.link : 'N/A'}
                              </p>`
                        }
                    },
                    {
                        "data": "status",
                        "class": "text-center",
                        "orderable": true,
                        "render": function (data, type, full) {
                            let isChecked = data ? 'checked' : '';
                            return `<div class="form-check form-switch">
                                    <input role="button" class="form-check-input bg-primary border-0 toggle-status" type="checkbox" ${isChecked} data-id="${full.id}">
                                </div>`;
                        }
                    },
                    {
                        "data": "id",
                        "class": "text-center",
                        "orderable": false,
                        "render": function (data, type, full) {
                            let showUrl = "{{ route('admin.banner.show', ':id') }}";
                            showUrl = showUrl.replace(':id', data);

                            let editUrl = "{{ route('admin.banner.edit', ':id') }}";
                            editUrl = editUrl.replace(':id', data);

                            let destroyUrl = "{{ route('admin.banner.destroy', ':id') }}";
                            destroyUrl = destroyUrl.replace(':id', data);

                            return `
                            <div class="action-btns">
                                <a href="javascript:void(0);" class="action-btn btn-view bs-tooltip me-2"
                                   data-toggle="tooltip" data-placement="top" title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>

                                @can(Acl::PERMISSION_BANNER_EDIT)
                                <a href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2" data-url="${editUrl}" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-edit-2">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                    </svg>
                                </a>
                                @endcan

                                @can(Acl::PERMISSION_BANNER_DELETE)
                                <a href="javascript:void(0);" class="action-btn btn-delete bs-tooltip" data-url="${destroyUrl}"
                                   data-toggle="tooltip" data-placement="top" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-trash-2">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                </a>
                                @endcan
                            </div>`;
                        }
                    }
                ]
            });
        </script>

        <script>
            $(document).on('change', '.toggle-status', function(e) {
                e.preventDefault();
                let banner = $(this).data('id');
                let url = '{{ route('admin.banner.toggle_status', ':id') }}';
                url = url.replace(':id', banner);

                toggleStatus(url);
            });

            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                let url = $(this).data('url');

                console.log(url)
                deleteItem(bannerTable, url);
            });
        </script>
    </x-slot:footerFiles>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
