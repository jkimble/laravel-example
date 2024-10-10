<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SessionController;


Route::get('/', function () {
    return view('home');
});

/*
Route::resource('jobs', JobController::class); // one liner, can work but cannot efficiently use middleware this way
Route::resource('jobs', JobController::class)->except(['index', 'show'])->middleware('auth'); // auths all pages except these two, efficient but may be too limiting 
*/

Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create']);
Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');
Route::get('/jobs/{job}', [JobController::class, 'show']);
// Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->middleware(['auth'])->can('edit-job', 'job'); use this when using Gates
Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->middleware(['auth'])->can('edit', 'job'); //use this when using policy related to model (policy function is names edit)
Route::patch('/jobs/{job}', [JobController::class, 'update']);
Route::delete('/jobs/{job}', [JobController::class, 'destroy']);

/*
// index
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->cursorPaginate(3);
    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

// create jobs
Route::get('/jobs/create', function () {
    return view('jobs.create');
});

// show job page
Route::get('/jobs/{job}', function (Job $job) {
    // $job = job::find($id);
    return view('jobs.show', ['job' => $job]);
});

// stores job to db
Route::post('/jobs', function () {
    //dd(request()->all());
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});

// edit job
Route::get('/jobs/{job}/edit', function (Job $job) {
    //$job = job::find($id);
    return view('jobs.edit', ['job' => $job]);
});

// update job
Route::patch('/jobs/{job}', function (Job $job) {
    //authorize (on hold)
    //validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
    ]);

    
    //update job
    //$job = job::findOrFail($id);

    // $job->title = request('title');
    // $job->salary = request('salary');
    // $job->save();

    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);

    //persist
    //redirect to the job page

    return redirect('/jobs/' . $job->id);
});

// delete job
Route::delete('/jobs/{job}', function (Job $job) {
    //authorize
    //delete
    //$job = Job::findOrFail($id)->delete();
    //$job->delete();
    //Job::findOrFail($id)->delete();
    //301
    return redirect('/jobs');
});
*/

//Auth
Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

Route::get('/contact', function () {
    return view('contact');
});
