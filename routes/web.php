<?php
use Illuminate\Support\Facades\Route;
use App\Models\Job;




// Home route
Route::get('/', function () {
    return view('home');
});

// Jobs listing route
Route::get('/jobs', function (){
    return view('jobs', [
        'jobs' => Job::all()
    ]);
});

// Specific job details route (corrected)
Route::get('/jobs/{id}', function ($id){
    $job = Job::find($id);
    
    return view('job', ['job' => $job]);
});

// Contact page route
Route::get('/contact', function () {
    return view('contact');
});
