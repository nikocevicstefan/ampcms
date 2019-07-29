<header class="main-header">

        <!-- Logo -->
        <a href="/admin" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>MP</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>AMP</b>CMS</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                    <li class="nav-item" style="text-align: right">
                        <!-- Menu Toggle Button -->
                        <a href="/admin/users/{{auth()->id()}}/profile" class="nav-link">
                            <!-- The user image in the navbar-->
                            <?php $imagePath = 'img/profile_images/' . auth()->user()->profile_image; ?>
                            <img src="{{asset($imagePath)}}" class="user-image img-circle"
                                 alt="User Image" style="width: 3%">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span
                                class="hidden-xs">{{auth()->user()->first_name. ' ' . auth()->user()->last_name}}</span>
                        </a>
                    </li>

                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a class="btn btn-info" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </header>