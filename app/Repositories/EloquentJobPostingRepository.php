<?php
namespace App\Repositories;
use App\JobPosting;

class EloquentJobPostingRepository implements JobPostingRepositoryInterface{

	public function all(){
		$jobPostings = JobPosting::orderBy('created_at', 'desc')->paginate(10);
		return $jobPostings;
	}

	public function create($data){
		$jobPosting = JobPosting::create($data);
		return $jobPosting;
	}

	public function find($data){
		$jobPostings = JobPosting::where('title', 'LIKE', '%'.$data . '%')->paginate(10);
	}

	public function update($jobPosting, $data){
		$jobPosting->update($data);
	}

	public function delete($jobPosting){
		$jobPosting->delete();
	}

	public function changeStatus($jobPosting){
		$jobPosting->update();
	}
}