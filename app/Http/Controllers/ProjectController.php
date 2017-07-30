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
        return view('pages.projects.home', compact('projects', 'today', 'currenttime', 'user'));
    }

    public function create()
    {
        // $user = Auth::user();
        // $projects = Auth::user()->projects()->orderby('created_at')->get();
        // $currenttime = Carbon::now()->format('h:i a');
        // $today = Carbon::now()->formatlocalized('%a %d %b %y');
        // return view('pages.projects.home', compact('projects', 'today', 'currenttime', 'user'));
    }

    public function store(ProjectRequest $request)
    {
        if($request->ajax())
        {
            $slug = Str::slug($request->name);
            //$date = Carbon::now()->toDateString();

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
            //dd($request->all());
            
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

            return redirect('projects')->with('success', 'Project' . ucwords($request->name) . ' has been successfully created');

        }

    }

    public function show(Project $project)
    {
        //
    }

    public function edit(Project $project)
    {
        //
    }

    public function update(Request $request, Project $project)
    {
        //
    }

    public function destroy(Project $project)
    {
        //
    }

    public function simpan(Request $request)
    {
        //Test::create($request->all());
        // $input = Request::all();
        // Test::create($input);
        // return redirect('projects');

         // $post = new Test();
         //    $post->name = $request->name;
         //    $post->slug = $request->slug;
         //    $post->duedate = $request->duedate;
         //    $post->save();
         //    return response()->json($post);

        //return Response::json($request->all());

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
