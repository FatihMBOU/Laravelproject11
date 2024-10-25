<?php
use Illuminate\Support\Facades\Route;
use App\Models\Job;




// Home route
Route::get('/', function () {
    return view('home');
});



// Jobs listing route
Route::get('/jobs', function (){
    $jobs = Job::with('employer')->latest()->Simplepaginate(3);

    return view('jobs/index', [
        'jobs' => $jobs
    ]);
});


Route::get('/jobs/create', function () {
    return view('jobs.create');
});


// Specific job details route (corrected)
Route::get('/jobs/{id}', function ($id){
    $job = Job::find($id);
    
    return view('jobs.show', ['job' => $job]);
});


Route::post('/jobs', function() {
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']


    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});

// Contact page route
Route::get('/contact', function () {
    return view('contact');
});
