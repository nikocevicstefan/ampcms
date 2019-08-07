<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php $photoPath = 'img/profile_images/' . auth()->user()->profile_image; ?>
                <img src="{{asset($photoPath)}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{auth()->user()->first_name. ' ' . auth()->user()->last_name}}</p>
                <!-- Status -->
                <a href="/admin/panel"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">PAGES</li>
            <li><a href="/admin/panel"><i class="fa fa-dashboard"></i> <span>@lang('sentence.dashboard')</span> </a></li>
            @if(auth()->user()->is_admin)
                <!-- Optionally, you can add icons to the links -->
                <li><a href="/admin/users"><i class="fa fa-users"></i> <span>@lang('sentence.users')</span></a></li>
            @endif
            <li><a href="/admin/products"><i class="fa fa-shopping-basket"></i> <span>@lang('sentence.products')</span></a>
            </li>
            <li><a href="/admin/job-postings"><i class="fa fa-suitcase"></i> <span>@lang('sentence.jobPostings')</span></a>
            </li>
            <li><a href="/admin/posts"><i class="fa fa-list"></i> <span>@lang('sentence.posts')</span></a></li>
            <li style="text-align: center; padding-top: 100%">
                @if(session('locale') === 'me')
                    <div class="row">
                        <a href="/admin/lang/en"><img src="{{asset('img/flags/en.svg')}}" alt="english flag icon"
                                                 style="width: 20%" class="grey-out"></a>
                        <a href="#"><img src="{{asset('img/flags/me.svg')}}" alt="montenegrin flag icon"
                                         style="width: 20%"></a>
                    </div>
                @elseif(session('locale') === 'en')
                <div class="row">
                    <a href="#"><img src="{{asset('img/flags/en.svg')}}" alt="english flag icon" style="width: 20%"></a>
                    <a href="/admin/lang/me"><img src="{{asset('img/flags/me.svg')}}" alt="montenegrin flag icon"
                                             style="width: 20%" class="grey-out"></a>
                </div>
                @endif
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
