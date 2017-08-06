<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Task extends Model
{
	use SoftDeletes;

    protected $table = 'tasks';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'slug', 'desc', 'duedate', 'completed',
    ];

    // public function setDuedateAttribute($date)
    // {
    // 	$this->attribute['duedate'] = Carbon::parse($date);
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
        // return $this->belongsTo('App\Project', 'project_id');
    }

    public function subtasks()
    {
        return $this->hasMany(Subtask::class);
    }

}
