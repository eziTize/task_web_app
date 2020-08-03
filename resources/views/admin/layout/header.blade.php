<header id="header" class="page-topbar">
    <!-- start header nav-->
    <div class="navbar-fixed">
        <nav class="navbar-color">
            <div class="nav-wrapper">
                <ul class="left">                      
                    <li>
                        <h1 class="logo-wrapper">
                            <a href="{{ Asset(env('admin').'/dashboard') }}" class="brand-logo darken-1">
                                <img src="{{ Asset('images/logo.png') }}" alt="IMS logo">
                            </a>
                            <span class="logo-text">Materialize</span>
                        </h1>
                    </li>
                </ul>
                <div class="header-search-wrapper hide-on-med-and-down">
                    <form action="{{ Asset(env('admin').'/search') }}">
                        <i class="mdi-action-search"></i>
                        <input type="text" name="q" class="header-search-input z-depth-2" placeholder="Search here with Branch Name..." value="@isset($_GET['q']) {{ $_GET['q'] }} @endif"/>
                    </form>
                </div>
                <ul class="right hide-on-med-and-down">
                    <li>
                        <a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen">
                            <i class="mdi-action-settings-overscan"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- end header nav-->
</header>