@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('students')}}" class="btn btn-warning m-1">STUDENTS LIST</a>
                </div>

                <div class="card-header">
                    <h1>Create New Project</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('projects_store')}}" method="post">
                        <div class="row">
                            <div class="col-12 form-group">
                                Project Title:<input type="text" class="form-control" name="project_title" value="">
                            </div>
                            <div class="col-12 form-group">
                                Number of groups: <input type="number" class="form-control" name="number_of_groups" value="">
                            </div>
                            <div class="col-12 form-group">
                                Students per group: <input type="number" class="form-control" name="students_per_group" value="">
                            </div>

                            <div class="col-12">

                                <button type="submit" class="btn btn-success mt-2">Create New Project</button>
                            </div>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                @foreach($projects as $project)
                <form action="{{route('project_edit', $project)}}" method="get">
                    <div class="projects-list">
                        {{$project->title}}
                        <button type="submit" class="btn btn-success mt-2">Edit Project</button>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
