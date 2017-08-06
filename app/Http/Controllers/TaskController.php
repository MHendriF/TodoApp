<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use App\Http\Controllers\Controllers;
use App\Http\Requests\TaskRequest;
use Carbon\Carbon;
use App\Project;
use App\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Project $project, TaskRequest $request)
    {
        if($request->ajax())
        {
            $slug = Str::slug($request->name);
            $project->tasks()->create([
                'name' => $request->name,
                'slug' => $slug,
                'desc' => $request->desc,
                'duedate' => $request->duedate
            ]);

            // $project->tasks()->addTask(request(['name', 'slug', 'desc', 'duedate']));

            $response = [
                'msg' => 'Awesome! close this modal window by clicking top right corner.',
            ];

            return Response::json($response);
        }
        else
        {
            $slug = Str::slug($request->name);
            $project->tasks()->create([
                'name' => $request->name,
                'slug' => $slug,
                'desc' => $request->desc,
                'duedate' => $request->duedate
            ]);

            // $project->tasks()->addTask(
            //     new Task (request(['name', 'slug', 'desc', 'duedate']))
            // );
            // $list = Project::find($project->id);
            // $task = new Task;
            // $task->name = $request->name;
            // $task->slug = $slug;
            // $task->desc = $request->desc;
            // $task->duedate = $request->duedate;
            // $list->tasks()->save($task);

            return redirect()->back()->with('message', 'Task ' . ucwords($request->name) . ' has been successfully created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, Task $task, Request $request)
    {
        if($request->ajax())
        {
            $response = [
                'id' => $task->id,
                'projectslug' => $project->slug,
                'taskslug' => $task->slug,
                'name' => $task->name,
                'desc' => $task->desc,
                'duedate' => $task->duedate
            ];

            return Response::json($response);
        }
        else
        {
            $tasks =  $project->task()->orderby('created_at')->get();
            return view('pages.projects.home', compact('tasks', 'project', 'task'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Project $project, Task $task, TaskRequest $request)
    {
        if($request->ajax())
        {
            $slug = Str::slug($request->name);
            $task->update([
                'name' => $request->name,
                'slug' => $slug,
                'desc' => $request->desc,
                'duedate' => $request->duedate
            ]);

            $response = [
                'msg' => 'Awesome! close this modal window by clicking top right corner.',
            ];
            return Response::json($response);
        }
        else
        {
            $slug = Str::slug($request->name);
            $task->update([
                'name' => $request->name,
                'slug' => $slug,
                'desc' => $request->desc,
                'duedate' => $request->duedate
            ]);

            return redirect()->back()->with('success', 'Task ' . ucwords($request->name) . ' has been successfully updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }

    public function completed(Project $project, Task $task)
    {
        if($task->completed == false)
        {
            $task->completed = true;
            $task->update(['completed' => $task->completed]);
            return redirect()->back()->with('success', 'Good Job Task marked as done!');

        }
        else
        {
            $task->completed = false;
            $task->update(['completed' => $task->completed]);
            return redirect()->back()->with('success', 'Task status changed to panding!');
        }
    }

    public function hide(Project $project, Task $task)
    {
        $task->delete();
        return redirect()->back()->with('success', 'Task ' . $task->name . ' has been successfully hidden');
    }

    public function trashed(Project $project)
    {
        //return "teeeeee";
        return view('pages.projects.tasks.trashed');
    }

    public function restore(Task $task)
    {
        $task->restore();
        return redirect('tasks/trashed')->with('success', 'Task ' . $task->name . ' has been successfully restored');
    }

    public function deleteforever(Task $Task)
    {
        $task->forceDelete();
        return redirect('tasks/trashed')->with('success', 'Task ' . $task->name . ' has been successfully deleted');
    }
}
