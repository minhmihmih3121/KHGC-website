<?php

namespace App\Services;

use App\Models\Section;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class SectionService extends BaseModelService
{
    /**
     * @inheritdoc
     */
    protected $model;

    /**
     * @inheritdoc
     */
    public function __construct(Section $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }
}