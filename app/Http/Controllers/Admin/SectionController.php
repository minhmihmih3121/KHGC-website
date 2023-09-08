<?php

namespace App\Http\Controllers\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Requests\Section\StoreSectionRequest;
use App\Http\Requests\Section\UpdateSectionRequest;
use App\Http\Resources\Admin\SectionResource;
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
    public function index(Request $request)
    {
        $sections = Section::all();
        return view('admin.section.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.section.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSectionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSectionRequest $request)
    {
        $section = $this->sectionService->create($request->validated());
        if ($section) {
            session()->flash(NOTIFICATION_SUCCESS, __('success.section.create'));
            return to_route('admin.section.index');
        }
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit(Section $section)
    {
        return view('admin.section.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSectionRequest $request
     * @param Section $section
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSectionRequest $request, Section $section)
    {
        $section = $this->sectionService->update($section, $request->validated());
        if ($section) {
            session()->flash(NOTIFICATION_SUCCESS, __('success.section.update'));
            return to_route('admin.section.index');
        }
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

    /**
     * Toggle status of the section
     *
     * @param Section $section
     */
    public function toggleStatus(Section $section)
    {
        return $this->sectionService->toggleStatus($section);
    }
}
