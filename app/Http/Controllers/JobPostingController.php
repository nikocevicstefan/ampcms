<?php

namespace App\Http\Controllers;

use App\JobPosting;
use Exception as ExceptionAlias;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
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

    protected $jobPostingRepository;
    protected $jobPosting;

    public function __construct(JobPostingRepositoryInterface $jobPostings){
        $this->jobPostingRepository = $jobPostings;
        $this->jobPosting = new JobPosting;
    }

    public function index()
    {
        $jobPostings = $this->jobPostingRepository->all();
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
     * @param JobPostingStoreRequest $request
     * @return Response
     */
    public function store(JobPostingStoreRequest $request)
    {
        $attributes = $request->validated();
        $attributes['cover_image'] = $this->jobPosting->nameFile('job_posting', 'cover_image');
        $attributes['locale'] = session('locale');

        $this->jobPostingRepository->create($attributes);
        return redirect('/admin/job-postings')->with('success', __('Job Posting Successfully Added'));
    }


    public function search()
    {
        $jobPostingTitle = request('search_string');
        $jobPostings = $this->jobPostingRepository->find($jobPostingTitle);
        return view('admin.jobPosting.index', compact('jobPostings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param JobPosting $jobPosting
     * @return Response
     */
    public function edit($id)
    {
        $jobPosting = $this->jobPostingRepository->findById($id);
        return view('admin.jobPosting.editJobPosting', compact('jobPosting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param JobPosting $jobPosting
     * @return Response
     */
    public function update($id, JobPostingUpdateRequest $request)
    {
        $attributes = $request->validated();
        $jobPosting = $this->jobPostingRepository->findById($id);

        if($request->has('cover_image')){
            //delete old image
            $this->jobPosting->deleteOldImage($id);

            //upload new image
            $attributes['cover_image'] = $this->jobPosting->nameFile('job_posting','cover_image');
        }

        $this->jobPostingRepository->update($jobPosting, $attributes);

        return redirect('/admin/job-postings')->with('success', __('Job Posting Successfully Updated'));
    }

    public function status($id)
    {
        $this->jobPostingRepository->changeStatus($id);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param JobPosting $jobPosting
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $this->jobPostingRepository->delete($id);
        return redirect('/admin/job-postings')->with('success', __('Job Posting Successfully Deleted'));
    }

}
