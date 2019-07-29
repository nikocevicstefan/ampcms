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

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                  <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                  </button>
              </span>
          </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li>
        @if(auth()->user()->is_admin)
        <li><a href="/admin"><i class="fa fa-dashboard"></i> <span>Dashboard</span> </a></li>
        <!-- Optionally, you can add icons to the links -->
        <li class="treeview">
            <a href="#"><i class="fa fa-users"></i> <span>Users</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-down pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="/admin/users">All users</a></li>
                <li><a href="/admin/users/create">Add a user</a></li>
            </ul>
        </li>
        @endif
        <li class="treeview">
            <a href="#"><i class="fa fa-shopping-basket"></i> <span>Products</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-down pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="/admin/products">All products</a></li>
                <li><a href="/admin/products/create">Add a product</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#"><i class="fa fa-suitcase"></i> <span>Job Postings</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-down pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="/admin/job-postings">All Job Postings</a></li>
                <li><a href="/admin/job-postings/create">Add Job Posting</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#"><i class="fa fa-list"></i> <span>Posts</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-down pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="/admin/posts">All Posts</a></li>
                <li><a href="/admin/posts/create">Add a Post</a></li>
            </ul>
        </li>
    </ul>
    <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>
