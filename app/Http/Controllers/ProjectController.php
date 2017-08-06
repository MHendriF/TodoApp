<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

use App\Http\Controllers\Controllers;
use App\Http\Requests\ProjectRequest;
use App\Project; 
use App\Test;
use App\User;
use Carbon\Carbon;

class ProjectController extends Controller
{
    // protected $currenttime;
    // protected $today;

    // public function __construct()
    // {
    //     $this->currenttime = Carbon::now()->format('h:i a');
    //     $this->today = Carbon::now()->formatlocalized('%a %d %b %y');

    //     View::share('currenttime', $this->currenttime);
    //     View::share('today', $this->today);
    // }

    public function index()
    {
        return view('pages.projects.home');
        //return view('pages.projects.home', compact('projects', 'today', 'currenttime', 'user', 'projectsTrashed'));
    }

    public function create()
    {

    }

    public function store(ProjectRequest $request)
    {
        if($request->ajax())
        {
            $slug = Str::slug($request->name);
            Auth::user()->projects()->create([
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
            $date = Carbon::now()->toDateString();
            Auth::user()->projects()->create([
                'name' => $request->name,
                'slug' => $slug,
                'desc' => $request->desc,
                'duedate' => $request->duedate
            ]);

            return redirect('projects')->with('success', 'Project ' . ucwords($request->name) . ' has been successfully created');

        }

    }

    public function show(Project $project)
    {
        $tasks = $project->tasks()->orderby('created_at')->get();
        return view('pages.projects.show', compact('project', 'tasks'));
        //return view('pages.projects.show', compact('project','tasks','projects', 'today', 'currenttime', 'user', 'projectsTrashed'));
    }

    public function edit(Project $project, Request $request)
    {
        if($request->ajax())
        {
            $response = [
                'id' => $project->id,
                'projectslug' => $project->id,
                'name' => $project->name,
                'desc' => $project->desc,
                'duedate' => $project->duedate
            ];

            return Response::json($response);
        }
        else
        {
            //$projects = Auth::user()->projects()->orderby('created_at')->get();
            //$currenttime = Carbon::now()->format('h:i a');
            //$today = Carbon::now()->formatlocalized('%a %d %b %y');
            return view('pages.projects.home');
        }
    }

    public function update(Project $project, ProjectRequest $request)
    {
        if($request->ajax())
        {
            $slug = Str::slug($request->name);
            $project->update([
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
            // $project =  Project::find($request->id);
            // $project->name = $request->name;
            // $project->slug = $slug;
            // $project->desc = $request->desc;
            // $project->duedate = $request->duedate;
            // $project->save();
            $project->update([
                'name' => $request->name,
                'slug' => $slug,
                'desc' => $request->desc,
                'duedate' => $request->duedate
            ]);

            return redirect('projects')->with('success', 'Project ' . ucwords($request->name) . ' has been successfully updated');
        }
    }

    public function completed(Project $project)
    {
        if($project->completed == false)
        {
            $project->completed = true;
            $project->update(['completed' => $project->completed]);
            return redirect('projects')->with('success', 'Good Job Project marked as done!');

        }
        else
        {
            $project->completed = false;
            $project->update(['completed' => $project->completed]);
            return redirect('projects')->with('success', 'Project status changed to panding!');
        }
    }

    public function hide(Project $project)
    {
        $project->delete();
        return redirect()->back()->with('success', 'Project ' . $project->name . ' has been successfully hidden');
    }

    public function trashed()
    {
        return view('pages.projects.trashed');
        //$tasktrashed = Auth::user()->tasks()->onlyTrashed()->get();
        //return $tasktrashed;
    }

    public function restoreall()
    {
        Auth::user()->projects()->onlyTrashed()->restore();
        return redirect('projects')->with('success', 'All trashed projects restored.');
    }

    public function restore(Project $project)
    {
        $project->restore();
        return redirect('projects/trashed')->with('success', 'Project ' . $project->name . ' has been successfully restored');
    }

    public function deleteforever(Project $project)
    {
        $project->forceDelete();
        return redirect('projects/trashed')->with('success', 'Project ' . $project->name . ' has been successfully deleted');
    }

    public function destroy(Project $project)
    {
        
    }

    public function simpan(Request $request)
    {
        if($request->ajax())
        {
            Test::create($request->all());
            $response = [
                'msg' => 'Awesome! close this modal window by clicking top right corner.',
            ];
            return Response::json($response);
            // error_log($request->name);
            // error_log($request->duedate);
            
        }
        else
        {
           Test::create($request->all());
            return redirect()->back(); 

        }
    }

    public function test()
    {
        //return "teeeeee";
        return view('pages.projects.trashed');
    }
}
