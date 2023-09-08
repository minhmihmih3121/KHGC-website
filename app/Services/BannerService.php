<?php

namespace App\Services;

use App\Models\Banner;
use App\Models\Section;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class BannerService extends BaseModelService
{
    protected $model;

    const PER_PAGE = 10;

    /**
     * @inheritdoc
     */
    public function __construct(Banner $model)
    {
        $this->model = $model;
        parent::__construct($model);
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
                $q->where('heading', 'LIKE', '%' . $keyword . '%');
            });
        }

        $query->latest();

        return $query->paginate($limit);
    }

    /**
     * Paginating, ordering and searching through pages for server side index table for the Admin.
     *
     * @param $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilteringForAdmin($searchParams): LengthAwarePaginator
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
                $q->where('heading', 'LIKE', '%' . $keyword . '%');
            });
        }

        $query->latest();

        return $query->paginate($limit);
    }
}
