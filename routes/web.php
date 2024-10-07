<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;




Route::get('/', function () {
    return view('home');
});
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


Route::get('/contact', function () {
    return view('contact');
});
