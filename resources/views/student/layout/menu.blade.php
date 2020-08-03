@php($page = Request::segment(2))
@php ($user = Auth::guard('student')->user())


<aside id="left-sidebar-nav">
    <ul id="slide-out" class="side-nav fixed leftside-navigation">
        <li class="user-details cyan darken-2">
            <div class="row">
                <div class="col col s4 m4 l4">
                     @if($user->gender == 'Male')
                    <img src="{{ Asset('images/student-boy.png') }}" alt="" class="circle responsive-img valign profile-image">
                    @elseif($user->gender == 'Female')
                    <img src="{{ Asset('images/student-girl.png') }}" alt="" class="circle responsive-img valign profile-image">
                    @endif
                </div>
                <div class="col col s8 m8 l8">
                    <ul id="profile-dropdown" class="dropdown-content">
                        <li><a href="{{ Asset(env('student').'/setting') }}"><i class="mdi-action-settings"></i> Settings</a></li>
                        <li><a href="{{ Asset(env('student').'/logout') }}"><i class="mdi-hardware-keyboard-tab"></i> Logout</a></li>
                    </ul>
                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown">Welcome <i class="mdi-navigation-arrow-drop-down right"></i></a>
                    <p class="user-roal">{{ Auth::guard('student')->user()->name }}</p>
                </div>
            </div>
        </li>

        <?php /*<li class="<?php if($page == "dashboard"){ echo "active"; } ?>"><a href="{{ Asset(env('student').'/dashboard') }}" class="waves-effect waves-cyan"><i class="fa fa-dashboard" style="font-size:16px"></i> Dashboard</a></li>*/ ?>

        <li>
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header waves-effect waves-cyan <?php if($page == 'dashboard' || $page == 'settings'){ ?> active <?php } ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                    <div class="collapsible-body">
                        <ul>
                            <li class="<?php if($page == "dashboard"){ echo "active"; } ?>"><a href="{{ Asset(env('student').'/dashboard') }}"><i class="fa fa-dashboard" style="font-size:16px"></i> Dashboard</a></li>
                            <li class="<?php if($page == "settings"){ echo "active"; } ?>"><a href="{{ Asset(env('student').'/settings') }}"><i class="fa fa-cog" style="font-size:16px"></i> Profile Settings</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </li>


        <li class="<?php if($page == "self-task"){ echo "active"; } ?>"><a href="{{ Asset(env('student').'/self-task') }}" class="waves-effect waves-cyan"><i class="fa fa-file-text" style="font-size:16px"></i> My Tasks </a></li>

        <li class="<?php if($page == "student-task"){ echo "active"; } ?>"><a href="{{ Asset(env('student').'/student-task') }}" class="waves-effect waves-cyan"><i class="fa fa-clipboard" style="font-size:16px"></i> Student Tasks </a></li>


         <li class="<?php if($page == "reports"){ echo "active"; } ?>"><a href="{{ Asset(env('student').'/reports') }}" class="waves-effect waves-cyan"><i class="fa fa-bar-chart " style="font-size:16px"></i> Reports </a></li>


        <li><a href="{{ Asset(env('student').'/logout') }}" class="waves-effect waves-cyan"><i class="fa fa-sign-out" style="font-size:16px"></i> Logout</a></li>
    </ul>

    <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
</aside>