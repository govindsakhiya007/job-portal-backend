<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Models\Job;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth()->user();
        return \Cache::remember('job_lists', 60, function () {

            if($user->role == 'employer') {
                return Job::where('employer_id', Auth()->user()->id)->latest()->get();
            } else {
                return Job::where('employer_id', Auth()->user()->id)->latest()->get();
            }
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        try {
            if (Gate::denies('create-job')) {
                return response()->json(['message' => 'Forbidden! You do not have permission to access this resource.'], 403);
            }

            $inputs = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'company_name' => 'required|string|max:255',
                'salary' => 'required|numeric',
                'location' => 'required|string|max:255',
            ]);

            $job = Job::create(array_merge($inputs, ['employer_id' => auth()->id()]));

            \Cache::forget('job_lists');

            return response()->json([
                'message' => 'Job created successfully',
                'data' => $job
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json(Job::with('employer')->findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }
}
