<?php

namespace App\Http\Controllers\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProjectTypeResource;
use App\Models\ProjectType;
use App\Services\ProjectTypeService;
use Illuminate\Http\Request;

class ProjectTypeController extends Controller
{

    protected $projectTypeService;
    public function __construct(ProjectTypeService $projectTypeService) {
        $this->middleware('permission:' . Acl::PERMISSION_PROJECT_TYPE_LIST)->only('index');
        $this->middleware('permission:' . Acl::PERMISSION_PROJECT_TYPE_ADD)->only(['create', 'store']);
        $this->middleware('permission:' . Acl::PERMISSION_PROJECT_TYPE_EDIT)->only(['edit', 'update']);
        $this->middleware('permission:' . Acl::PERMISSION_PROJECT_TYPE_DELETE)->only('destroy');


        $this->projectTypeService = $projectTypeService;
    }

    public function index() {
        $project_types = ProjectType::all();
        return view('admin.project-type.index', compact('project_types'));
    }

    public function show(ProjectType $projectType)
    {

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('admin.project-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->projectTypeService->create($request->all());
        return redirect()->back()->with('success','Project type was created!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectType $projectType)
    {
        return view('admin.project-type.edit',['project_type'=>$projectType]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectType $projectType)
    {
        $this->projectTypeService->update($projectType,$request->all());
        return to_route('admin.project_type.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectType $projectType)
    {
        $this->projectTypeService->delete($projectType);
        return redirect()->back()->with('success','Project type was deleted!');
    }
}
