<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\StudentsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [FrontController::class, 'index'])->name('front_index');
Route::post('/store', [ProjectsController::class, 'store'])->name('projects_store');
Route::get('/project/edit/{project}', [ProjectsController::class, 'edit'])->name('project_edit');
Route::post('/project/update/{project}', [ProjectsController::class, 'update'])->name('project_update');
Route::get('/students', [StudentsController::class, 'index'])->name('students');
// Route::get('/students/{student}', [StudentsController::class, 'destroy'])->name('student_delete');
Route::delete('/students/delete/{student}', [StudentsController::class, 'destroy'])->name('student_delete');

Route::post('/students/new_student', [StudentsController::class, 'store'])->name('add_new_student');
