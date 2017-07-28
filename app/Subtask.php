<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Subtask extends Model
{
	use SoftDeletes;

    protected $table = 'subtasks';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'task_id', 'name', 'slug', 'desc', 'duedate', 'completed',
    ];

    public function setDuedateAttribute($date)
    {
    	$this->attribute['duedate'] = Carbon::parse($date);
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function task()
    {
    	return $this->belongsTo('App\Task');
    }
}
