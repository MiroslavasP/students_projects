@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('front_index')}}" class="btn btn-warning m-1">GO BACK TO THE PROJECTS LIST</a>
                </div>

                <h2>Students</h2>
                <form action="{{route('add_new_student')}}" method="post">
                    <div class="col-4 form-group">
                        Student Name:<input type="text" class="form-control" name="student_name" value="">
                        Student Surname:<input type="text" class="form-control" name="student_surname" value="">
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Add new student</button>
                    @csrf
                </form>
                <hr>

                {{-- Students list start --}}
                <table>
                    <tr class="card-header table-head">
                        <th>Student</th>
                        <th>Group</th>
                        <th>Actions</th>
                    </tr>
                    @foreach($students as $student)
                    <tr class="group">
                        <td>{{$student->full_name}}</td>
                        <td>
                            @if(0 !== $student->group_id)
                            Group #{{$student->group_id}}
                            @else -
                            @endif
                        </td>
                        <td>
                            <button type="submit" class="delete--button btn btn-danger m-2" data-action="{{route('student_delete', $student->id)}}">DELETE</button>
                        </td>
                    </tr>
                    @endforeach
                </table>
                {{-- Students list finish --}}

                <div class="card-header">
                    <a href="{{route('front_index')}}" class="btn btn-warning m-1">GO BACK TO THE PROJECTS LIST</a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Student delete confirm modal start --}}
<div id="confirm-modal" style="display: none;">
    <div class="card">
        <h5 class="card-header">Confirmation</h5>
        <div class="card-body">
            <h5 class="card-title">Confirm student delete</h5>
            <div class="buttons">
                <form action="" class="m-1" method="post">
                    <button type="submit" class="btn btn-danger">DELETE</button>
                    @method('DELETE')
                    @csrf
                </form>
                <button type="button" class="cancel--confirm--button btn btn-info m-1">Cancel</button>
            </div>
        </div>
    </div>
</div>
{{-- Student delete confirm modal finish --}}

@endsection
