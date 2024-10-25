<?php
use Illuminate\Support\Facades\Route;
use App\Models\Job;




// Home route
Route::get('/', function () {
    return view('home');
});



//Index

// Jobs listing route
Route::get('/jobs', function (){
    $jobs = Job::with('employer')->latest()->Simplepaginate(3);

    return view('jobs/index', [
        'jobs' => $jobs
    ]);
});

//Create
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

Route::get('/jobs/{id}/edit', function ($id){
    $job = Job::find($id);
    
    return view('jobs.edit', ['job' => $job]);
});

//Update
Route::patch('/jobs/{id}', function ($id){
    //dd(request()->all());
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required', 'numeric'] // voeg 'numeric' toe om ervoor te zorgen dat het een geldig getal is
    ]);
  


    $job = Job::findOrFail($id);

    $job->title = request('title');
    $job->salary = request('salary'); 
    $job->save();

    $job->update ([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);

    return redirect('/jobs/' . $job->id);
});

//Destroy
Route::delete('/jobs/{id}', function ($id){







    Job::findOrFail($id)->delete();

    return redirect('/jobs');
});


// Contact page route
Route::get('/contact', function () {
    return view('contact');
});
