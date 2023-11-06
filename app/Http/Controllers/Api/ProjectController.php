<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProjectResource;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\Request;

/**
 * @group Project Endpoints
 */
class ProjectController extends Controller
{

    private $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * Get a list of projects.
     * This endpoint lets you get a list of projects
     * @unauthenticated
     *
     * @queryParam limit integer The number of resource that will show and then paginate. Example: 50
     * @queryParam search string The keyword for the title of the projects. No-example
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $projects = $this->projectService->serverPaginationFilteringForApi($request->all());
        return ProjectResource::collection($projects);
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
     * Get the specific project by its id.
     *
     * This endpoint lets you get the specific product by using its slug
     * @unauthenticated
     *
     * @urlParam project int required The id of the project. No-example
     *
     * @apiResource App\Http\Resources\Api\ProjectResource
     * @apiResourceModel App\Models\Project
     *
     * @return \Illuminate\Http\JsonResponse | ProjectResource
     */
    public function show($projectId)
    {
        $project = Project::find($projectId);
        if ($project) {
            $project->load(['projectType']);
            return new ProjectResource($project);
        }
        return response()->json(new JsonResponse([], __('No project found.')), Response::HTTP_NOT_FOUND);
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