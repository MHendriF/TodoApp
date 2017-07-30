<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Project extends Model
{
	use SoftDeletes;

	protected $table = 'projects';

	protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id', 'name', 'slug', 'desc', 'duedate', 'completed',
    ];

    // public function setDuedateAttribute($date)
    // {
    // 	$this->attribute['duedate'] = Carbon::parse($date);
    // }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

	public function tasks()
    {
    	return $this->hasMany('App\Task');
    }

    public function subtasks()
    {
    	return $this->hasManyThrough('App\Subtask', 'App\Task');
    }

}
