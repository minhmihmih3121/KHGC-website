<?php

namespace App\Services;

use App\Models\Section;

class SectionService
{
    private $model;

    public function __construct(Section $section)
    {
        $this->model = $section;
    }

    public function create($data)
    {

    }
}