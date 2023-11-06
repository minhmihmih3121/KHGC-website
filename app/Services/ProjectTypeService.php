<?php

namespace App\Services;
use App\Models\ProjectType;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class ProjectTypeService extends BaseModelService{

    /**
     * @inheritdoc
     */
    protected $model;

    /**                                                                                                                             
     * @inheritdoc
     */
    public function __construct(ProjectType $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }
}
