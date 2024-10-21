<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job_listings';

    protected $guarded = [];

    // Define the relationship with Employer
    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function tags() 
{
    return $this->belongsToMany(Tag::class, 'job_listing_tag', 'job_listing_id', 'tag_id');
}

}
