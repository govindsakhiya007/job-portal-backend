<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Models\Application;
use App\Models\Job;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if (Gate::denies('get-applications')) {
                return response()->json(['message' => 'Forbidden! You do not have permission to access this resource.'], 403);
            }

            $applications = Application::whereHas('job', function ($query) {
                    $query->where('employer_id', Auth::id());
                })->with('applicant')->get();

            return response()->json([
                'message' => 'Application Lists',
                'data' => $applications
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        //
    }

    public function applyJob(Request $request, $jobId)
    {
        try {
            if (Gate::denies('apply-job')) {
                return response()->json(['message' => 'Forbidden! You do not have permission to access this resource.'], 403);
            }

            $request->validate([
                'cover_letter' => 'required',
            ]);

            $application = Application::create([
                'job_id' => $jobId,
                'user_id' => Auth::id(),
                'cover_letter' => $request->cover_letter,
            ]);
            
            return response()->json([
                'message' => 'Application submitted successfully',
                'data' => $application
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

	public function updateStatus(Request $request, $id)
    {
        try {
            if (Gate::denies('update-status')) {
                return response()->json(['message' => 'Forbidden! You do not have permission to access this resource.'], 403);
            }

            $request->validate([
				'status' =>'required|in:pending,accepted,rejected',
            ]);

            $application = Application::find($id);
            $application->status = $request->status;
            $application->save();
            
            return response()->json([
                'message' => 'Application status updated successfully',
                'data' => $application
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
				'message' => $e->getMessage()
            ], 500);
        }
    }
}
