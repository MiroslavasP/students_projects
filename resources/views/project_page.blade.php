@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <h1>{{$project->title}}</h1>
                <hr>
                <div class="card-header">
                    <a href="{{route('front_index')}}" class="btn btn-warning m-1">GO BACK TO THE PROJECTS LIST</a>
                </div>
                <div class="card-header">
                    <h2>Groups</h2>
                </div>
                <form class="project-groups-list" action="{{ route('project_update', $project) }}" method="post">
                    @foreach($groups as $group)
                    <table class="group">
                        <tr class="card-header">
                            <th class="card-header">Group #{{$group->id}}</th>
                        </tr>
                        @php $groupStudentsAmount = 0
                        @endphp
                        @foreach($projectStudents as $projectStudent)
                        @if($group->id === $projectStudent->group_id)
                        <tr class="group">
                            <td class="">{{$projectStudent->full_name}}</td>
                        </tr>
                        @php $groupStudentsAmount++
                        @endphp
                        @endif
                        @endforeach

                        @for ($i = 1; $i <= ($group->group_amount - $groupStudentsAmount); $i++)
                            <tr class="group-body">
                                <td>
                                    <div class="col-6 form-group">
                                        <select name="{{$group->id}}/{{$i}}" class="group-body">
                                            <option value="0">Assign student</option>
                                            @foreach ($freeStudents as $freeStudent)
                                            <option value="{{$freeStudent->id}}" @if(old('student_id')==$freeStudent->id) selected @endif>
                                                {{$freeStudent->full_name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            @endfor

                    </table>
                    @endforeach
                    <button type="submit" class="btn btn-success mt-2">Edit Project</button>
                    @csrf
                </form>
                <div class="card-header">
                    <a href="{{route('front_index')}}" class="btn btn-warning m-1">GO BACK TO THE PROJECTS LIST</a>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
