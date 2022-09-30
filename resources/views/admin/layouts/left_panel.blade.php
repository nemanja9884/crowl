
    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
{{--                <a class="navbar-brand" href="./"><img src="{{ asset('images/logo-blue.svg') }}" alt="Logo"></a>--}}
{{--                <a class="navbar-brand hidden" href="./"><img src="{{ asset('images/logo-blue.svg') }}" alt="Logo"></a>--}}
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="{{route('admin.index')}}"> <i class="menu-icon fa fa-dashboard"></i>Admin dashboard </a>
                        <a href="{{route('index')}}"> <i class="menu-icon fa fa-sitemap"></i>Website </a>
                    </li>
                    <h3 class="menu-title">Admin tools</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Components</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-language"></i><a href="{{route('admin.languages.index')}}">Languages</a></li>

{{--                            <li><i class="fa fa-puzzle-piece"></i><a href="#">Članci</a></li>--}}
{{--                            <li><i class="fa fa-puzzle-piece"></i><a href="#">Dodaj članak</a></li>--}}
{{--                            <li><i class="fa fa-folder"></i><a href="#">Proizvodi</a></li>--}}
{{--                            <li><i class="fa fa-folder"></i><a href="#">Dodaj proizvod</a></li>--}}
{{--                            <li><i class="fa fa-puzzle-piece"></i><a href="#">Kategorije</a></li>--}}
{{--                            <li><i class="fa fa-puzzle-piece"></i><a href="#">Boje</a></li>--}}
{{--                            <li><i class="fa fa-puzzle-piece"></i><a href="#">Veličine</a></li>--}}
{{--                            <li><i class="fa fa-puzzle-piece"></i><a href="#">Tagovi</a></li>--}}
{{--                            <li><i class="fa fa-money"></i><a href="#">Kuponi</a></li>--}}
                            <!--

                            <li><i class="fa fa-bars"></i><a href="ui-tabs.html">Tabs</a></li>
                            <li><i class="fa fa-share-square-o"></i><a href="ui-social-buttons.html">Social Buttons</a></li>
                            <li><i class="fa fa-id-card-o"></i><a href="ui-cards.html">Cards</a></li>
                            <li><i class="fa fa-exclamation-triangle"></i><a href="ui-alerts.html">Alerts</a></li>
                            <li><i class="fa fa-spinner"></i><a href="ui-progressbar.html">Progress Bars</a></li>
                            <li><i class="fa fa-fire"></i><a href="ui-modals.html">Modals</a></li>
                            <li><i class="fa fa-book"></i><a href="ui-switches.html">Switches</a></li>
                            <li><i class="fa fa-th"></i><a href="ui-grids.html">Grids</a></li>
                            <li><i class="fa fa-file-word-o"></i><a href="ui-typgraphy.html">Typography</a></li>-->
                        </ul>
                    </li>
                    <li>
                        <a href="/admin/file-manager"> <i class="menu-icon fa fa-files-o"></i>File manager</a>
                    </li>
{{--                    <li class="menu-item-has-children dropdown">--}}
{{--                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Interakcija korisnika</a>--}}
{{--                        <ul class="sub-menu children dropdown-menu">--}}
{{--                            <li><i class="fa fa-money"></i><a href="#">Transakcije</a></li>--}}
{{--                            <li><i class="fa fa-user"></i><a href="#">Korisnici</a></li>--}}
{{--                            <li><i class="fa fa-user"></i><a href="#">Pretplatnici</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
                    <h3 class="menu-title">Settings</h3><!-- /.menu-title -->
                    <li>
                        <a href="{{route('admin.translations.index')}}"> <i class="menu-icon fa fa-language"></i>Translations</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

