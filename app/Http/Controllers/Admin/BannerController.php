<?php

namespace App\Http\Controllers\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\BannerResource;
use App\Models\Banner;
use App\Services\BannerService;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    private $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->middleware('permission:' . Acl::PERMISSION_BANNER_LIST)->only('index');
        $this->middleware('permission:' . Acl::PERMISSION_BANNER_ADD)->only(['create', 'store']);
        $this->middleware('permission:' . Acl::PERMISSION_BANNER_EDIT)->only(['edit', 'update']);
        $this->middleware('permission:' . Acl::PERMISSION_BANNER_DELETE)->only('destroy');

        $this->bannerService = $bannerService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $banners = $this->bannerService->serverPaginationFilteringForAdmin($request->all());
            return BannerResource::collection($banners);
        }
        return view('admin.banner.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        return $this->bannerService->delete($banner);
    }

    /**
     * Toggle status of the banner
     *
     * @param Banner $banner
     */
    public function toggleStatus(Banner $banner)
    {
        return $this->bannerService->toggleStatus($banner);
    }
}
