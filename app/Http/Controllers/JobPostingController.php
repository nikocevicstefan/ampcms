<?php

namespace App\Http\Controllers;

use App\JobPosting;
use Exception as ExceptionAlias;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\JobPostingStoreRequest;
use App\Http\Requests\JobPostingUpdateRequest;
use App\Repositories\JobPostingRepositoryInterface;



class JobPostingController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    protected $jobPostings;
    protected $jobPostingInstance;

    public function __construct(JobPostingRepositoryInterface $jobPostings){
        $this->jobPostings = $jobPostings;
        $this->jobPostingInstance = new JobPosting;
    }

    public function index()
    {
        $jobPostings = $this->jobPostings->all();
        return view('admin.jobPosting.index', compact('jobPostings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.jobPosting.addJobPosting');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(JobPostingStoreRequest $request)
    {
        $attributes = $request->validated();
        $attributes['cover_image'] = $this->jobPostingInstance->nameFile('job_posting', 'cover_image');
        $attributes['locale'] = session('locale'); 
        
        $this->jobPostings->create($attributes);
        return redirect('/admin/job-postings')->with('success', __('Job Posting Successfully Added'));
    }


    public function search()
    {
        $jobPostingTitle = request('search_string');
        $jobPostings = $this->jobPostings->find($jobPostingTitle);
        return view('admin.jobPosting.index', compact('jobPostings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param JobPosting $jobPosting
     * @return Response
     */
    public function edit(JobPosting $jobPosting)
    {
        return view('admin.jobPosting.editJobPosting', compact('jobPosting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param JobPosting $jobPosting
     * @return Response
     */
    public function update(JobPosting $jobPosting, JobPostingUpdateRequest $request)
    {
        $attributes = $request->validated();

        if(request('cover_image')){
            //delete old image
            $filePath = 'img/job_posting_images/';
            Storage::disk('public')->delete($filePath .  $jobPosting->cover_image);

            //upload new image
            $attributes['cover_image'] = $this->jobPostingInstance->nameFile('job_posting','cover_image');
        }
        
        $this->jobPostings->update($jobPosting, $attributes);

        return redirect('/admin/job-postings')->with('success', __('Job Posting Successfully Updated'));
    }

    public function status(JobPosting $jobPosting)
    {
        $jobPosting->status = !$jobPosting->status;
        $this->jobPostings->changeStatus($jobPosting);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param JobPosting $jobPosting
     * @return RedirectResponse|Redirector
     */
    public function destroy(JobPosting $jobPosting)
    {
        $this->jobPostings->delete($jobPosting);
        return redirect('/admin/job-postings')->with('success', __('Job Posting Successfully Deleted'));
    }

}
