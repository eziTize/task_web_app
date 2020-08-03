@php($page = Request::segment(2))

@php ($user = Auth::guard('admin')->user())


<aside id="left-sidebar-nav">

    <ul id="slide-out" class="side-nav fixed leftside-navigation">

        <li class="user-details cyan darken-2">

            <div class="row">

                <div class="col col s4 m4 l4">

                    @if($user->gender == 'Male')
                    <img src="{{ Asset('images/male.png') }}" alt="" class="circle responsive-img valign profile-image">
                    @elseif($user->gender == 'Female')
                    <img src="{{ Asset('images/female.png') }}" alt="" class="circle responsive-img valign profile-image">
                    @endif


                </div>

                <div class="col col s8 m8 l8">

                    <ul id="profile-dropdown" class="dropdown-content">

                        <li><a href="{{ Asset(env('admin').'/setting') }}"><i class="mdi-action-settings"></i> Settings</a></li>

                        <li><a href="{{ Asset(env('admin').'/logout') }}"><i class="mdi-hardware-keyboard-tab"></i> Logout</a></li>

                    </ul>

                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown">Welcome <i class="mdi-navigation-arrow-drop-down right"></i></a>

                    <p class="user-roal">{{ Auth::guard('admin')->user()->name }}</p>

                </div>

            </div>

        </li>



        <?php /*<li class="<?php if($page == "dashboard"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/dashboard') }}" class="waves-effect waves-cyan"><i class="fa fa-dashboard" style="font-size:16px"></i> Dashboard</a></li>*/ ?>



        <li>

            <ul class="collapsible collapsible-accordion">

                <li>

                    <a class="collapsible-header waves-effect waves-cyan <?php if($page == 'dashboard' || $page == 'settings' || $page == 'fee-settings'){ ?> active <?php } ?>"><i class="fa fa-dashboard"></i> Dashboard</a>

                    <div class="collapsible-body">

                        <ul>

                            <li class="<?php if($page == "dashboard"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/dashboard') }}"><i class="fa fa-dashboard" style="font-size:16px"></i> Dashboard</a></li>

                            <li class="<?php if($page == "settings"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/settings') }}"><i class="fa fa-cog" style="font-size:16px"></i> Profile Settings</a></li>

                        </ul>

                    </div>

                </li>

            </ul>

        </li>


         <li class="<?php if($page == "work-log"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/work-log') }}"><i class="fa fa-briefcase"></i> Work Log </a></li>


        <li>

            <ul class="collapsible collapsible-accordion">

                <li>

                    <a class="collapsible-header waves-effect waves-cyan <?php if($page =='student' || $page == 'team-members'){ ?> active <?php } ?>"><i class="fa fa-users"></i> Manage Users</a>

                    <div class="collapsible-body">

                        <ul>


                            <li class="<?php if($page == "team-members"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/team-members') }}"><i class="fa fa-user" style="font-size:16px"></i> Team Members </a></li>

                            <li class="<?php if($page == "student"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/student') }}"><i class="fa fa-user" style="font-size:16px"></i> Students </a></li>

                           

                        </ul>

                    </div>

                </li>

            </ul>

        </li>


         <li class="<?php if($page == "subjects"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/subjects') }}">
            <i class="fa fa-book"></i> Manage Subjects </a>
         </li>

         <li class="<?php if($page == "branch"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/branch') }}">
            <i class="fa fa-building-o"></i> Manage Branch </a>
         </li>


           <li>

            <ul class="collapsible collapsible-accordion">

                <li>

                    <a class="collapsible-header waves-effect waves-cyan <?php if($page == 'student-task' || $page == 'team-members-task'){ ?> active <?php } ?>"><i class="fa fa-clipboard"></i> Assign Tasks </a>

                    <div class="collapsible-body">

                        <ul>

                             <li class="<?php if($page == "team-members-task"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/team-members-task') }}"><i class="fa fa-file-text-o" style="font-size:16px"></i> To A Team Member </a></li>

                            <li class="<?php if($page == "student-task"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/student-task') }}"><i class="fa fa-file-text" style="font-size:16px"></i> To A Student </a></li>



                        </ul>

                    </div>

                </li>

            </ul>

        </li>



           <li>

            <ul class="collapsible collapsible-accordion">

                <li>

                    <a class="collapsible-header waves-effect waves-cyan <?php if( $page == 'approve-requests' ||  $page == 'extend-requests' || $page == 'assign-requests'){ ?> active <?php } ?>"><i class="fa fa-exclamation"></i> Check Requests </a>

                    <div class="collapsible-body">

                        <ul>

                           <li class="<?php if($page == "approve-requests"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/approve-requests') }}"><i class="fa fa-check" style="font-size:16px"></i> Approve Requests </a></li>


                            <li class="<?php if($page == "extend-requests"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/extend-requests') }}"><i class="fa fa-lightbulb-o" style="font-size:16px"></i> Extend Requests </a></li>


                            <li class="<?php if($page == "assign-requests"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/assign-requests') }}"><i class="fa fa-file-text" style="font-size:16px"></i> Assign Requests </a></li>



                        </ul>

                    </div>

                </li>

            </ul>

        </li>



         <li>

            <ul class="collapsible collapsible-accordion">

                <li>

                    <a class="collapsible-header waves-effect waves-cyan <?php if($page == 'g-task' || $page == 'g-task-requests' || $page == 'g-extend-requests' ){ ?> active <?php } ?>"><i class="fa fa-clone"></i> Global Tasks </a>

                    <div class="collapsible-body">

                        <ul>

                             <li class="<?php if($page == "g-task"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/g-task') }}"><i class="fa fa-file-text-o" style="font-size:16px"></i> Manage G-Tasks </a></li>


                            <li class="<?php if($page == "g-task-requests"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/g-task-requests') }}"><i class="fa fa-check" style="font-size:16px"></i> Approve Requests </a></li>


                             <li class="<?php if($page == "g-extend-requests"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/g-extend-requests') }}"><i class="fa fa-lightbulb-o" style="font-size:16px"></i> Extend Requests </a></li>



                        </ul>

                    </div>

                </li>

            </ul>

        </li>



      <li>
            <ul class="collapsible collapsible-accordion">

                <li>

                    <a class="collapsible-header waves-effect waves-cyan <?php if($page =='student-reports' || $page == 'team-member-reports' || $page == 'reports-all'){ ?> active <?php } ?>"><i class="fa fa-bar-chart"></i> Check Reports</a>

                    <div class="collapsible-body">

                        <ul>

                            <li class="<?php if($page == "team-member-reports"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/team-member-reports') }}"><i class="fa fa-area-chart" style="font-size:16px"></i> Team Member Reports </a></li>

                            <li class="<?php if($page == "student-reports"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/student-reports') }}"><i class="fa fa-area-chart" style="font-size:16px"></i> Student Reports </a></li>


                             <li class="<?php if($page == "reports-all"){ echo "active"; } ?>"><a href="{{ Asset(env('admin').'/reports-all') }}"><i class="fa fa-area-chart" style="font-size:16px"></i> All Reports </a></li>

                        </ul>

                    </div>

                </li>

            </ul>

        </li>



      
       

        <li><a href="{{ Asset(env('admin').'/logout') }}" class="waves-effect waves-cyan"><i class="fa fa-sign-out" style="font-size:16px"></i> Logout</a></li>

    </ul>



    <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>

</aside>