<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use App\Models\User;

class JobController extends Controller
{
    public function index()
    {
        // index
        $jobs = Job::with('employer')->cursorPaginate(3);
        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }

    public function create()
    {
        // create jobs
        return view('jobs.create');
    }

    public function show(Job $job)
    {
        // show job page
        // $job = job::find($id);
        return view('jobs.show', ['job' => $job]);
    }

    public function store()
    {
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
    }

    public function edit(Job $job)
    {
        //$job = job::find($id);

        /*if (Auth::guest()) {
            return redirect('/login');
        }*/
        
        //Gate::authorize('edit-job', ['job' => $job]); // authorize auto aborts unless exception is defined

        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job)
    {
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
    }

    public function destroy(Job $job)
    {
        //authorize
        //delete
        //$job = Job::findOrFail($id)->delete();
        //$job->delete();
        Job::findOrFail($job->id)->delete();
        return redirect('/jobs');
    }
}
