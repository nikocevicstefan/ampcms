<?php

namespace App\Http\Controllers;

use App\JobPosting;
use App\Traits\UploadTrait;
use Exception as ExceptionAlias;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;

class JobPostingController extends Controller
{

    use UploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $jobPostings = JobPosting::orderBy('created_at', 'desc')->paginate(10);
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
    public function store()
    {
        $attributes = request()->validate([
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'alt_tag' => 'required|alpha_dash|min:3|max:255',
            'title' => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:200',
            'job_title' => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:200',
            'job_description' => 'required|min:5',
            'beginning_date' => 'required',
            'ending_date' => 'required'
        ]);


        $filePath = $this->getImagePath(request('job'));
        $attributes['cover_image'] = $filePath;

        $jobPosting = JobPosting::create($attributes);
        return redirect('/admin/job-postings')->with('success', 'Job Posting Successfully Added');
    }


    public function search()
    {
        $jobPostingTitle = request('search_string');
        $jobPostings = JobPosting::where('title', 'LIKE', '%' . $jobPostingTitle . '%')->paginate(10);
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
    public function update(JobPosting $jobPosting)
    {
        $attributes = request()->validate([
            'alt_tag' => 'required|alpha_dash|min:3|max:255',
            'title' => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:200',
            'job_title' => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:200',
            'job_description' => 'required|min:5',
            'beginning_date' => 'required',
            'ending_date' => 'required'
        ]);

        if(request('cover_image')){
            //delete old image
        $filePath = 'img/job_posting_images/';
        $coverImageName = $jobPosting->cover_image;
        Storage::disk('public')->delete($filePath . $coverImageName);
        //upload new image
        $filePath = $this->getImagePath('job');
        $attributes['cover_image'] = $filePath;
        }
        
        $jobPosting->update($attributes);

        return redirect('/admin/job-postings');
    }

    public function status(JobPosting $jobPosting)
    {
        $jobPosting->status = !$jobPosting->status;
        $jobPosting->update();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param JobPosting $jobPosting
     * @return RedirectResponse|Redirector
     * @throws ExceptionAlias
     */
    public function destroy(JobPosting $jobPosting)
    {
        $jobPosting->delete();
        return redirect('/admin/job-postings')->with('success', 'Job Posting Successfully Deleted');
    }

    protected function getImagePath($name)
    {

        $imageName = $name . '_' . time();
        $image = request()->file('cover_image');
        $folder = '/img/job_posting_images/';
        $filePath = $imageName . '.' . $image->getClientOriginalExtension();
        $this->uploadOne($image, $folder, 'public', $imageName);

        return $filePath;
    }
}
