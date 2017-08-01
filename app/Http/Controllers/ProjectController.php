<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use App\Http\Controllers\Controllers;
use App\Http\Requests\ProjectRequest;
use App\Project; 
use App\Test;
use App\User;
use Carbon\Carbon;

class ProjectController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $projects = Auth::user()->projects()->orderby('created_at')->get();
        $currenttime = Carbon::now()->format('h:i a');
        $today = Carbon::now()->formatlocalized('%a %d %b %y');
        $projectsTrashed = Auth::user()->projects()->onlyTrashed()->get();
        return view('pages.projects.home', compact('projects', 'today', 'currenttime', 'user', 'projectsTrashed'));
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
        // $user = Auth::user();
        // $projects = Auth::user()->projects()->orderby('created_at')->get();
        // $currenttime = Carbon::now()->format('h:i a');
        // $today = Carbon::now()->formatlocalized('%a %d %b %y');
        // $projectsTrashed = Auth::user()->projects()->onlyTrashed()->get();
        // $tasks = $project->tasks()->orderby('created_at')->get();
        // return view('pages.projects.show', compact('projects', 'today', 'currenttime', 'tasks', 'user'));
        return "testis";
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
            $projects = Auth::user()->projects()->orderby('created_at')->get();
            $currenttime = Carbon::now()->format('h:i a');
            $today = Carbon::now()->formatlocalized('%a %d %b %y');
            return view('pages.projects.home', compact('projects', 'today', 'currenttime', 'user'));
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
            $project =  Project::find($request->id);
            $project->name = $request->name;
            $project->slug = $slug;
            $project->desc = $request->desc;
            $project->duedate = $request->duedate;
            $project->save();

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
        $user = Auth::user();
        $projects = Auth::user()->projects()->orderby('created_at')->get();
        $currenttime = Carbon::now()->format('h:i a');
        $today = Carbon::now()->formatlocalized('%a %d %b %y');
        $projectsTrashed = Auth::user()->projects()->onlyTrashed()->get();
        
        return view('pages.projects.trashed', compact('projects', 'today', 'currenttime', 'user', 'projectsTrashed'));
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
}
