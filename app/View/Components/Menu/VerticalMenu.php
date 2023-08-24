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
                'active' => Route::is(['admin.section.*']),
                'show' => checkPermissions([Acl::PERMISSION_SECTION_MANAGE]),
                'child' => [
                    [
                        'title' => __('general.menu.banner_management.section'),
                        'url' => route('admin.section.index'),
                        'icon' => 'image',
                        'active' => Route::is(['admin.section.*']),
                        'show' => checkPermissions([Acl::PERMISSION_SECTION_MANAGE])
                    ]
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
