<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Job extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'job_listings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'salary',
        'description',  // New field for job description
        'location',     // New field for job location
        'company_id',   // Foreign key for the company
        'posted_at',    // When the job was posted
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'posted_at' => 'datetime', // Ensure 'posted_at' is cast as a datetime
    ];

    /**
     * Accessor to format the salary.
     */
    public function getSalaryAttribute($value)
    {
        return number_format($value, 2) . ' USD';  // Format salary as currency
    }

    /**
     * Mutator to store the salary as an integer in cents (optional).
     */
    public function setSalaryAttribute($value)
    {
        $this->attributes['salary'] = $value * 100;  // Store salary in cents (optional)
    }

    /**
     * Scope to filter jobs by location.
     */
    public function scopeLocatedAt($query, $location)
    {
        return $query->where('location', $location);
    }

    /**
     * Scope to filter jobs with a minimum salary.
     */
    public function scopeWithMinimumSalary($query, $minSalary)
    {
        return $query->where('salary', '>=', $minSalary * 100);  // Assume salary stored in cents
    }

    /**
     * Get the company that posted the job.
     * Define a belongsTo relationship.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Determine if the job is posted recently.
     */
    public function isRecentlyPosted()
    {
        return $this->posted_at->greaterThan(Carbon::now()->subDays(30));
    }

    /**
     * Calculate the number of days since the job was posted.
     */
    public function daysSincePosted()
    {
        return Carbon::now()->diffInDays($this->posted_at);
    }

    /**
     * Scope to filter jobs posted in the last X days.
     */
    public function scopePostedWithinDays($query, $days)
    {
        return $query->where('posted_at', '>=', Carbon::now()->subDays($days));
    }
}
