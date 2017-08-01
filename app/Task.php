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
        'project_id', 'name', 'slug', 'desc', 'duedate', 'completed',
    ];

    // public function setDuedateAttribute($date)
    // {
    // 	$this->attribute['duedate'] = Carbon::parse($date);
    // }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function project()
    {
    	return $this->belongsTo('App\Project');
    }

	public function subtasks()
    {
    	return $this->hasMany('App\Subtask');
    }
}
