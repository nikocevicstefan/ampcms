<?php

namespace App\Http\Controllers;

use App\JobPosting;
use Illuminate\Http\Request;

class JobPostingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobPostings = JobPosting::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.jobPosting.index', compact('jobPostings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jobPosting.addJobPosting');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $attributes = request([
            'cover_photo',
            'alt_tag',
            'title',
            'job_title',
            'job_description',
            'beginning_date',
            'ending_date'
        ]);

        $jobPosting = JobPosting::create($attributes);
        return redirect('/admin/job-postings')->with('success', 'Job Posting Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobPosting  $jobPosting
     * @return \Illuminate\Http\Response
     */
    public function show(JobPosting $jobPosting)
    {
        //
    }

    public function search(){
        $jobPostingTitle = request('search_string');
        $jobPostings = JobPosting::where('title', 'LIKE', '%'.$jobPostingTitle.'%')->paginate(10);
        return view('admin.jobPosting.index', compact('jobPostings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobPosting  $jobPosting
     * @return \Illuminate\Http\Response
     */
    public function edit(JobPosting $jobPosting)
    {
        return view('admin.jobPosting.editJobPosting', compact('jobPosting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobPosting  $jobPosting
     * @return \Illuminate\Http\Response
     */
    public function update(JobPosting $jobPosting)
    {
        $attributes = request([
            'cover_photo',
            'alt_tag',
            'title',
            'job_title',
            'job_description',
            'beginning_date',
            'ending_date'
        ]);
        $jobPosting->update($attributes);

        return redirect('/admin/job-postings');
    }

    public function status(JobPosting $jobPosting){
        $jobPosting->status = !$jobPosting->status;
        $jobPosting->update();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\JobPosting $jobPosting
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(JobPosting $jobPosting)
    {
        $jobPosting->delete();
        return redirect('/admin/job-postings');
    }
}
