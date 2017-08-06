<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Task;

class Project extends Model
{
	use SoftDeletes;

	protected $table = 'projects';

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

	public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function subtasks()
    {
    	return $this->hasManyThrough(Subtask::class, Task::class);
    }

    public function addTask(Project $project)
    {
        // $this->tasks()->create(compact('name','slug','desc','duedate'));
        // Task::create([
        //     'name' => $name,
        //     'slug' => $name,
        //     'desc' => $desc,
        //     'duedate' => $duedate,
        //     'project_id' => $this->id
        // ]);
        $this->tasks()->save($project);
    }

    // public static function projects()
    // {
    //     return static Auth::user()->projects()->orderby('created_at')->get();
    // }
     
    // public static function projectsTrashed()
    // {
    //     return static Auth::user()->projects()->onlyTrashed()->get();
    // } 

}
