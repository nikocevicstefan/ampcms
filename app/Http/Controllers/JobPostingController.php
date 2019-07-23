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
            'cover_photo' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'alt_tag' => 'required|alpha_dash|min:3|max:255',
            'title' => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:200',
            'job_title' => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:200',
            'job_description' => 'required|min:5',
            'beginning_date' => 'required',
            'ending_date' => 'required'
        ]);


        $filePath = $this->getPhotoPath(request('job'));
        $attributes['cover_photo'] = $filePath;

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
            'cover_photo' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'alt_tag' => 'required|alpha_dash|min:3|max:255',
            'title' => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:200',
            'job_title' => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:200',
            'job_description' => 'required|min:5',
            'beginning_date' => 'required',
            'ending_date' => 'required'
        ]);

        //delete old photo
        $filePath = 'img/job_posting_photos/';
        $coverPhotoName = $jobPosting->cover_photo;
        Storage::disk('public')->delete($filePath . $coverPhotoName);
        //upload new photo
        $filePath = $this->getPhotoPath('job');
        $attributes['cover_photo'] = $filePath;

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

    protected function getPhotoPath($name)
    {

        $photoName = $name . '_' . time();
        $photo = request()->file('cover_photo');
        $folder = '/img/job_posting_photos/';
        $filePath = $photoName . '.' . $photo->getClientOriginalExtension();
        $this->uploadOne($photo, $folder, 'public', $photoName);

        return $filePath;
    }
}
