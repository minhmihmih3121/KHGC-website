<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BannerResource;
use App\Models\Banner;
use App\Services\BannerService;
use Illuminate\Http\Request;

/**
 * @group Banner Endpoints
 */
class BannerController extends Controller
{
    private $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    /**
     * Get a list of banners.
     *
     * This endpoint lets you get a list of banners
     * @unauthenticated
     *
     * @queryParam fixed_key string The fixed key of the section. Default get banners all sections. No-example
     * @queryParam limit integer The number of resource that will show and then paginate. Example: 50
     * @queryParam search string The keyword for the name of the banners. No-example
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $banners = $this->bannerService->serverPaginationFilteringForApi($request->all());
        return BannerResource::collection($banners);
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
     * Get the specific banner by its id.
     *
     * This endpoint lets you get the specific product by using its slug
     * @unauthenticated
     *
     * @urlParam banner int required The id of the banner. No-example
     *
     * @apiResource App\Http\Resources\Api\BannerResource
     * @apiResourceModel App\Models\Banner
     *
     * @return \Illuminate\Http\JsonResponse | BannerResource
     */
    public function show($bannerId)
    {
        $banner = Banner::find($bannerId);
        if ($banner) {
            $banner->load(['section']);
            return new BannerResource($banner);
        }
        return response()->json(new JsonResponse([], __('No banner found.')), Response::HTTP_NOT_FOUND);
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
    public function destroy(string $id)
    {
        //
    }
}
