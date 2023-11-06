<?php

namespace App\View\Components\Menu;

use App\Acl\Acl;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class VerticalMenu extends Component
{
    public $menuItems;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->generateMenu();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.menu.vertical-menu');
    }

    private function generateMenu()
    {
        $this->menuItems = [
            [
                'title' => __('general.menu.dashboard'),
                'url' => route('admin.dashboard'),
                'icon' => 'home',
                'active' => Route::is(['admin.dashboard']),
                'show' => checkPermissions([Acl::PERMISSION_VIEW_MENU_DASHBOARD]),
                'child' => []
            ],
            [
                'title' => __('general.menu.banner_management.title'),
                'url' => '',
                'icon' => 'image',
                'active' => Route::is(['admin.section.*', 'admin.banner.*']),
                'show' => checkPermissions([Acl::PERMISSION_SECTION_MANAGE, Acl::PERMISSION_BANNER_MANAGE]),
                'child' => [
                    [
                        'title' => __('general.menu.banner_management.section'),
                        'url' => route('admin.section.index'),
                        'active' => Route::is(['admin.section.*']),
                        'show' => checkPermissions([Acl::PERMISSION_SECTION_MANAGE])
                    ],
                    [
                        'title' => __('general.menu.banner_management.banner'),
                        'url' => route('admin.banner.index'),
                        'active' => Route::is(['admin.banner.*']),
                        'show' => checkPermissions([Acl::PERMISSION_BANNER_MANAGE])
                    ]
                ]
            ],
            [
                'title' => __('general.menu.project_management.title'),
                'url' => '',
                'icon' => 'folder',
                'active' => Route::is(['admin.project.*', 'admin.project_type.*']),
                'show' => checkPermissions([Acl::PERMISSION_PROJECT_MANAGE, Acl::PERMISSION_PROJECT_TYPE_MANAGE]),
                'child' => [
                    [
                        'title' => __('general.menu.project_management.project'),
                        'url' => route('admin.project.index'),
                        'active' => Route::is(['admin.project.*']),
                        'show' => checkPermissions([Acl::PERMISSION_SECTION_MANAGE]),
                    ],
                    [
                        'title' => __('general.menu.project_type_management.project_type'),
                        'url' => route('admin.project_type.index'),
                        'active' => Route::is(['admin.projecttype.*']),
                        'show' => checkPermissions([Acl::PERMISSION_SECTION_MANAGE]),
                    ],
                ]
            ],
            [
                'title' => __('general.menu.api-docs'),
                'url' => '/docs',
                'icon' => 'file-text',
                'active' => Route::is(['scribe']),
                'show' => checkPermissions([Acl::PERMISSION_VIEW_API_DOCUMENTATION]),
                'child' => [],
            ]
        ];
    }
}
