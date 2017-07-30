<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use Carbon\Carbon;
use Auth;

class TestController extends Controller
{
    public function index()
    {
        
    }

    public function create()
    {	
    	$user = Auth::user();
    	$currenttime = Carbon::now()->format('h:i a');
        $today = Carbon::now()->formatlocalized('%a %d %b %y');
        return view('pages.test', compact('today', 'currenttime'));
    }

    public function store(Request $request)
    {   
        Test::create($request->all());
        return redirect()->back();   
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
            $post = new Test();
            $post->name = $request->name;
            $post->duedate = $request->duedate;
            $post->save();

            //Test::create($request->all());
            $response = [
                'msg' => 'Awesome! close this modal window by clicking top right corner.',
            ];
            return Response::json($response);
            // error_log($request->name);
            // error_log($request->duedate);
            
        }
        else
        {
           //Test::create($request->all());
            // return redirect('projects')->with('success', 'Project has been successfully created');

        }
    }
}
