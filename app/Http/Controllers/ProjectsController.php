<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\Groups;
use App\Models\Students;
use App\Http\Requests\StoreProjectsRequest;
use App\Http\Requests\UpdateProjectsRequest;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Store new project to database - start
        $projects = Projects::all();
        foreach ($projects as $project) {
            if ($request->project_title === $project->title) {
                return redirect()
                    ->back()
                    ->with('success_message', 'Such project allready exists.');
            }
        }
        $newProject = new Projects;
        $newProject->title = $request->project_title;
        $newProject->number_of_groups = $request->number_of_groups;
        $newProject->students_per_group = $request->students_per_group;
        $newProject->save();
        // Store new project to database - finish

        $project = Projects::where('title', $request->project_title)->first();

        // Initializing new groups - start:

        for ($i = 1; $i <= $project->number_of_groups; $i++) {
            $group = new Groups;
            $group->project_id = $project->id;
            $group->group_amount = $newProject->students_per_group;
            $group->save();
        }
        // Initializing new groups - finish

        $projects = Projects::all();

        return view('index', ['projects' => $projects]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function show(Projects $projects)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function edit(Projects $projects, $projectId)
    {
        $project = Projects::where('id', $projectId)->first();
        $groups = Groups::where('project_id', $projectId)->get();
        $freeStudents = Students::where('group_id', 0)->get();
        $projectStudents = Students::where('project_id', $projectId)->whereNot('group_id', 0)->get();

        return view('project_page', [
            'project' => $project,
            'groups' => $groups,
            'freeStudents' => $freeStudents,
            'projectStudents' => $projectStudents
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectsRequest  $request
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $project)
    {
        $changes = $request->All();
        array_pop($changes);
        foreach ($changes as $group_id => $student_id) {
            $group_id = substr($group_id, 0, strpos($group_id, '/'));

            if ($student_id > 0) {
                $student = Students::where('id', $student_id)->first();
                $student->project_id = $project;
                $student->group_id = $group_id;
                $student->save();
            }
        }
        return redirect()
            ->back()
            ->with('success_message', 'OK. Project was updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projects $projects)
    {
        //
    }
}
