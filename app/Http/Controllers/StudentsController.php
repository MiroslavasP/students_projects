<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Http\Requests\StoreStudentsRequest;
use App\Http\Requests\UpdateStudentsRequest;
use Illuminate\Http\Request;
use Http;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Http::acceptJson()->get('http://localhost/students_projects/public/api/students')->json();

        $data = array_map(
            fn ($b) => (object) $b,
            $data['data']
        );
        $students = collect($data)->sortBy('full_name');

        return view('students', ['students' => $students]);
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
     * @param  \App\Http\Requests\StoreStudentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newStudent = new Students;
        $newStudent->full_name = $request->student_name . ' ' . $request->student_surname;
        $newStudent->group_id = 0;
        $newStudent->project_id = 0;
        $newStudent->save();

        return redirect()
            ->back()
            ->with('success_message', 'OK. New student was created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function show(Students $students)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function edit(Students $students)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentsRequest  $request
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentsRequest $request, Students $students)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Students $students, $studentId)
    {
        $student = Students::where('id', $studentId)->first();

        $student->delete();

        return redirect()
            ->back()
            ->with('success_message', 'OK. Student was deleted.');
    }
}
