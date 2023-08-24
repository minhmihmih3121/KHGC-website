<?php

namespace App\Http\Controllers\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Requests\Section\StoreSectionRequest;
use App\Http\Requests\Section\UpdateSectionRequest;
use App\Models\Section;
use App\Services\SectionService;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    private $sectionService;

    public function __construct(SectionService $sectionService)
    {
        $this->middleware('permission:' . Acl::PERMISSION_SECTION_LIST)->only('index');
        $this->middleware('permission:' . Acl::PERMISSION_SECTION_ADD)->only(['create', 'store']);
        $this->middleware('permission:' . Acl::PERMISSION_SECTION_EDIT)->only(['edit', 'update']);
        $this->middleware('permission:' . Acl::PERMISSION_SECTION_DELETE)->only('destroy');

        $this->sectionService = $sectionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
     *
     * @param StoreSectionRequest $request
     * @return void
     */
    public function store(StoreSectionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Section $section
     * @return void
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Section $section
     * @return void
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSectionRequest $request
     * @param Section $section
     * @return void
     */
    public function update(UpdateSectionRequest $request, Section $section)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Section $section
     * @return void
     */
    public function destroy(Section $section)
    {
        //
    }
}
