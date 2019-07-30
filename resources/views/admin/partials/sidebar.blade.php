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
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">PAGES</li>
            @if(auth()->user()->is_admin)
                <li><a href="/admin"><i class="fa fa-dashboard"></i> <span>Dashboard</span> </a></li>
                <!-- Optionally, you can add icons to the links -->
                <li><a href="/admin/users"><i class="fa fa-users"></i> <span>Users</span></a></li>
            @endif
            <li><a href="/admin/products"><i class="fa fa-shopping-basket"></i> <span>Products</span></a></li>
            <li><a href="/admin/job-postings"><i class="fa fa-suitcase"></i> <span>Job Postings</span></a></li>
            <li><a href="/admin/posts"><i class="fa fa-list"></i> <span>Posts</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
