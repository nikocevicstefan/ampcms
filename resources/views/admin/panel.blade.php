@extends('admin.layout')
@section('content')
    <div class="row">
        <!-- ./col -->
        <div class="col-lg-6 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{App\Product::all()->count()}}</h3>

                    <p>@lang('sentence.products')</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-basket"></i>
                </div>
                <a href="/admin/products" class="small-box-footer">More info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-6 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{App\JobPosting::all()->count()}}</h3>

                    <p>@lang('sentence.jobPostings')</p>
                </div>
                <div class="icon">
                    <i class="fa fa-suitcase"></i>
                </div>
                <a href="/admin/job-postings" class="small-box-footer">More info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="row"><!-- ./col -->
        <!-- ./col -->

        <div class="col-lg-6 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{App\Post::all()->count()}}</h3>

                    <p>@lang('sentence.posts')</p>
                </div>
                <div class="icon">
                    <i class="fa fa-list"></i>
                </div>
                <a href="/admin/posts" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        @if(auth()->user()->is_admin)
            <div class="col-lg-6 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{App\User::all()->count()}}</h3>

                        <p>@lang('sentence.users')</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="/admin/users" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endif
    </div>
@endsection
