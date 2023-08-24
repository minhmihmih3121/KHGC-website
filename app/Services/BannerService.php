<?php

namespace App\Services;

use App\Models\Banner;
use App\Models\Section;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class BannerService
{
    private $model;

    const PER_PAGE = 10;

    public function __construct(Banner $banner)
    {
        $this->model = $banner;
    }

    /**
     * Paginating, ordering and searching through pages for server side index table for the API.
     *
     * @param $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilteringForApi($searchParams): LengthAwarePaginator
    {
        $limit = Arr::get($searchParams, 'limit', self::PER_PAGE);
        $keyword = Arr::get($searchParams, 'search', '');
        $sectionFixedKey = Arr::get($searchParams, 'fixed_key', '');

        $query = $this->model->query();
        $query->active();

        if ($sectionFixedKey) {
            $section = Section::where('fixed_key', $sectionFixedKey)->first();
            if ($section) {
                $query->where('section_id', $section->id);
            }
        }

        if ($keyword) {
            if (is_array($keyword)) {
                $keyword = $keyword['value'];
            }
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', '%' . $keyword . '%');
            });
        }

        $query->latest();

        return $query->paginate($limit);
    }
}
