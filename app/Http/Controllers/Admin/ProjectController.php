<?php

namespace App\Http\Controllers\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProjectResource;
use App\Models\Project;
use App\Models\ProjectType;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projectService;
    public function __construct(ProjectService $projectService) {
        $this->middleware('permission:' . Acl::PERMISSION_SECTION_LIST)->only('index');
        $this->middleware('permission:' . Acl::PERMISSION_SECTION_ADD)->only(['create', 'store']);
        $this->middleware('permission:' . Acl::PERMISSION_SECTION_EDIT)->only(['edit', 'update']);
        $this->middleware('permission:' . Acl::PERMISSION_SECTION_DELETE)->only('destroy');

        $this->projectService = $projectService;
    }

    public function index(Request $request) {
        if ($request->ajax()) {
            $projects = $this->projectService->serverPaginationFilteringForAdmin($request->all());
            return ProjectResource::collection($projects);
        }
        return view('admin.project.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project_types = ProjectType::get()->all();
        return view('admin.project.create',['project_types' => $project_types]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request);
        $this->projectService->create($request->all());

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
    public function edit(Project $project)
    {
        $project_types = ProjectType::get()->all();
        return view('admin.project.edit', compact('project','project_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $this->projectService->update($project,$request->all());
        return to_route('admin.project.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $this->projectService->delete($project);
        return to_route('admin.project.index');
    }

    public function toggleStatus(Project $project)
    {
        return $this->projectService->toggleStatus($project);
    }
}
