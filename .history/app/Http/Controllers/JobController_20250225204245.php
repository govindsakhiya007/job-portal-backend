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
        return \Cache::remember('job_lists', 60, function () {
            return Job::latest()->get();
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
        
        $this->authorize('create', Job::class);
        
        try {
            if (Gate::denies('apply-job')) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $inputs = $request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'company_name' => 'required|string',
                'salary' => 'required|numeric',
                'location' => 'required|string',
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
    public function show(Job $job)
    {
        return $job->load('employer');
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
