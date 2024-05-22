<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/core-img/favicon.png') }}">

    <!-- Plugins css -->
    <link rel="stylesheet" href="{{ asset('css/default-assets/mini-event-calendar.min.css') }}">

    <!-- Master Stylesheet CSS -->
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <!-- These plugins only need for the run this page -->
    <link rel="stylesheet" href="{{ asset('css/default-assets/datatables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('css/default-assets/responsive.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('css/default-assets/buttons.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('css/default-assets/select.bootstrap4.css') }}">

    <link rel="stylesheet" href="{{ asset('css/touchSpin.css') }}">

    {{-- wizard form css --}}
    <link rel="stylesheet" href="css/default-assets/smartwizard.css">

    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <!-- Styles -->
    {{-- @livewireStyles --}}
</head>

<body class="font-sans antialiased">
    <!-- Preloader -->
    <div id="preloader-area">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    {{-- <x-banner /> --}}

    <div class="flapt-page-wrapper">
        {{-- Side Bar --}}
        <div class="flapt-sidemenu-wrapper">
            <!-- Desktop Logo -->
            <div class="flapt-logo">
                <a href="/home">
                    {{-- <img class="desktop-logo" src="img/core-img/logo.png" alt="Desktop Logo">  --}}
                    <img class="desktop-logo" src="{{ asset('img/core-img/MYT_logo.png') }}" alt="Desktop Logo">
                    <img class="small-logo" src="{{ asset('img/core-img/MYT-small-logo.png') }}" alt="Mobile Logo">
                </a>
            </div>

            <!-- Side Nav -->
            <div class="flapt-sidenav" id="flaptSideNav">
                <!-- Side Menu Area -->
                <div class="side-menu-area">
                    <!-- Sidebar Menu -->
                    <nav>
                        <ul class="sidebar-menu" data-widget="tree">
                            <li class="menu-header-title">Accueil</li>
                            <li @class(['active' => request()->is('dashboard')]) class=""><a href="/home"><i
                                        class='bx bx-home-heart'></i><span>Dashboard</span></a></li>

                            <li class="menu-header-title">Personnes</li>
                            <li @class(['active' => request()->is('clients')])><a href="/clients"><i
                                        class='pe-7s-users '></i><span>Clients</span></a></li>
                            <li @class(['active' => request()->is('suppliers')])><a href="/suppliers"><i
                                        class='icon_toolbox_alt'></i><span>Fournisseurs</span></a></li>
                            <li @class(['active' => request()->is('employee')])><a href="/employee"><i
                                        class="ti-user"></i><span>Employés</span></a></li>


                            <li class="menu-header-title">Articles</li>
                            <li @class(['active' => request()->is('articles')])><a href="/articles"><i
                                        class="icon_tag_alt"></i><span>Articles</span></a></li>
                            <li @class(['active' => request()->is('articlesEnKits')])><a href="/articlesEnKits"><i
                                        class="icon_tags_alt"></i><span>Articles en kits</span></a>
                            </li>
                            <li><a href="/error"><i class="icon_gift_alt"></i><span>Carte cadeau</span></a></li>


                            <li class="menu-header-title">Services</li>
                            <li @class(['active' => request()->is('vente')])><a href="/vente"><i
                                        class="fa fa-shopping-cart"></i><span>Ventes</span></a></li>
                            <li @class(['active' => request()->is('entrerStock')])><a href="/entrerStock"><i
                                        class="zmdi zmdi-widgets"></i><span>Entrer stock</span></a>
                            </li>

                            {{-- <li @class(['active' => request()->is('vente','listVente','vente3')]) class="treeview" >
                                <a href="javascript:void(0)"><i class="bx bx-envelope"></i> <span>Ventes</span> <i
                                        class="fa fa-angle-right"></i></a>
                                <ul class="treeview-menu">
                                    <li @class(['active' => request()->is('vente')])><a href="/vente">ajouter vente</a></li>
                                    <li @class(['active' => request()->is('listVente')])><a href="/listVente">list des ventes</a></li>
                                    <li @class(['active' => request()->is('vente3')])><a href="/vente3">vente 3</a></li>
                                </ul>
                            </li> --}}

                            <li @class(['active' => request()->is('encaissement')])><a href="/encaissement"><i class="zmdi zmdi-widgets"></i><span>Encaissement</span></a>
                            </li>
                            <li @class(['active' => request()->is('depenses')])><a href="/depenses"><i
                                        class="zmdi zmdi-widgets"></i><span>Depense</span></a></li>
                            <li @class(['active' => request()->is('depenseCategory')])><a href="/depenseCategory"><i
                                        class="zmdi zmdi-widgets"></i><span>Depense categorie</span></a></li>

                            {{-- <li class="menu-header-title">Rapports</li>
                            <li><a href="/error"><i class="icon_document_alt"></i><span>Rapport</span></a></li> --}}
                            
                            <li class="menu-header-title">Parameters</li>
                            <li class=""><a href="/error"><i
                                        class="zmdi zmdi-settings"></i><span>Parameters</span></a>
                            </li>
{{-- 
                            <li class="menu-header-title">Services</li>
                            <li><a href="/error"><i class="fa-solid fa-brackets-curly"></i><span>Ventes</span></a></li> --}}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>


        {{-- @livewire('navigation-menu') --}}

        <!-- Page Heading -->
        {{-- @if (isset($header))

    <head>
        <!-- Metadonnées, styles et scripts -->
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            <!-- En-tête de page -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>

            @endif --}}

        <!-- Page Content -->


        <!-- Top Header Area -->
        <header class="top-header-area d-flex align-items-center justify-content-between">
            <div class="left-side-content-area d-flex align-items-center">
                <!-- Mobile Logo -->
                <div class="mobile-logo">
                    <a href="index.html"><img src="{{ asset('img/core-img/small-logo.png" alt="Mobile Logo') }}"></a>
                </div>

                <!-- Triggers -->
                <div class="flapt-triggers">
                    <div class="menu-collasped" id="menuCollasped">
                        <i class='bx bx-grid-alt'></i>
                    </div>
                    <div class="mobile-menu-open" id="mobileMenuOpen">
                        <i class='bx bx-grid-alt'></i>
                    </div>
                </div>

                <!-- Left Side Nav -->
                <ul class="left-side-navbar d-flex align-items-center">
                    <li class="hide-phone app-search">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="bx bx-search-alt"></span>
                    </li>
                </ul>
            </div>

            <div class="right-side-navbar d-flex align-items-center justify-content-end">
                <!-- Mobile Trigger -->
                <div class="right-side-trigger" id="rightSideTrigger">
                    <i class='bx bx-menu-alt-right'></i>
                </div>

                <!-- Top Bar Nav -->
                <ul class="right-side-content d-flex align-items-center">

                    {{-- Language button --}}
                    <li class="nav-item dropdown">
                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"><span><i
                                    class='bx bx-world'></i></span></button>
                        <div class="dropdown-menu language-dropdown dropdown-menu-right">
                            <div class="user-profile-area">
                                <a href="#" class="dropdown-item mb-15"><img
                                        src="{{ asset('img/core-img/f1.jpg') }}" alt="Image">
                                    <span>Ind</span></a>
                                <a href="#" class="dropdown-item mb-15"><img
                                        src="{{ asset('img/core-img/f2.jpg') }}" alt="Image">
                                    <span>German</span></a>
                                <a href="#" class="dropdown-item mb-15"><img
                                        src="{{ asset('img/core-img/f3.jpg') }}" alt="Image">
                                    <span>Italian</span></a>
                                <a href="#" class="dropdown-item"><img
                                        src="{{ asset('img/core-img/f4.jpg') }}" alt="Image">
                                    <span>Russian</span></a>
                            </div>
                        </div>
                    </li>

                    {{-- messages button --}}
                    <li class="nav-item dropdown">
                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"><i class='bx bx-envelope'></i></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- Message Area -->
                            <div class="top-message-area">
                                <!-- Heading -->
                                <div class="message-heading">
                                    <div class="heading-title">
                                        <h6 class="mb-0">All Messages</h6>
                                    </div>
                                    <span>10</span>
                                </div>

                                <div class="message-box" id="messageBox">
                                    <a href="#" class="dropdown-item">
                                        <i class='bx bx-dollar-circle'></i>
                                        <div>
                                            <span>Did you know?</span>
                                            <p class="mb-0 font-12">Adipisicing elit. Ipsa, porro!</p>
                                        </div>
                                    </a>

                                    <a href="#" class="dropdown-item">
                                        <i class='bx bx-shopping-bag'></i>
                                        <div>
                                            <span>Congratulations!
                                            </span>
                                            <p class="mb-0 font-12">Consectetur adipisicing elit.</p>
                                        </div>
                                    </a>

                                    <a href="#" class="dropdown-item">
                                        <i class='bx bx-wallet-alt'></i>
                                        <div>
                                            <span>Hello Obeta</span>
                                            <p class="mb-0 font-12">Consectetur adipisicing elit.</p>
                                        </div>
                                    </a>

                                    <a href="#" class="dropdown-item">
                                        <i class='bx bx-border-all'></i>
                                        <div>
                                            <span>Your order is placed</span>
                                            <p class="mb-0 font-12">Consectetur adipisicing elit.</p>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class='bx bx-wallet-alt'></i>
                                        <div>
                                            <span>Haslina Obeta</span>
                                            <p class="mb-0 font-12">Consectetur adipisicing elit.</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>

                    {{-- Notification area --}}
                    <li class="nav-item dropdown">
                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"><i class='bx bx-bell bx-tada'></i> <span
                                class="active-status"></span></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- Top Notifications Area -->
                            <div class="top-notifications-area">
                                <!-- Heading -->
                                <div class="notifications-heading">
                                    <div class="heading-title">
                                        <h6>Notifications</h6>
                                    </div>
                                    <span>11</span>
                                </div>

                                <div class="notifications-box" id="notificationsBox">
                                    <a href="#" class="dropdown-item">
                                        <i class='bx bx-shopping-bag'></i>
                                        <div>
                                            <span>Your order is placed</span>
                                            <p class="mb-0 font-12">Consectetur adipisicing elit. Ipsa, porro!</p>
                                        </div>
                                    </a>

                                    <a href="#" class="dropdown-item">
                                        <i class='bx bx-wallet-alt'></i>
                                        <div>
                                            <span>Haslina Obeta</span>
                                            <p class="mb-0 font-12">Consectetur adipisicing elit. Ipsa, porro!</p>
                                        </div>
                                    </a>

                                    <a href="#" class="dropdown-item">
                                        <i class='bx bx-dollar-circle'></i>
                                        <div>
                                            <span>Your order is Dollar</span>
                                            <p class="mb-0 font-12">Consectetur adipisicing elit. Ipsa, porro!</p>
                                        </div>
                                    </a>

                                    <a href="#" class="dropdown-item">
                                        <i class='bx bx-border-all'></i>
                                        <div>
                                            <span>Your order is placed</span>
                                            <p class="mb-0 font-12">Consectetur adipisicing elit. Ipsa, porro!</p>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class='bx bx-wallet-alt'></i>
                                        <div>
                                            <span>Haslina Obeta</span>
                                            <p class="mb-0 font-12">Consectetur adipisicing elit. Ipsa, porro!</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    {{-- Profile area --}}
                    <li class="nav-item dropdown">
                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"><img
                                src="{{ asset('img/bg-img/person_1.jpg') }}" alt=""></button>
                        <div class="dropdown-menu profile dropdown-menu-right">
                            <!-- User Profile Area -->
                            <div class="user-profile-area">
                                <a href="#" class="dropdown-item"><i class="bx bx-user font-15"
                                        aria-hidden="true"></i> My profile</a>
                                <a href="#" class="dropdown-item"><i class="bx bx-wallet font-15"
                                        aria-hidden="true"></i> My wallet</a>
                                <a href="#" class="dropdown-item"><i class="bx bx-wrench font-15"
                                        aria-hidden="true"></i> settings</a>
                                <form action="{{ route('logout') }}" method="POST" id="logoutform">
                                    @csrf

                                </form>
                                {{-- <a href="{{ route('logout') }}" class="dropdown-item" ><i class="bx bx-power-off font-15"
                                        aria-hidden="true"></i> Sign-out</a> --}}


                                <a class="dropdown-item ai-icon" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                    <i class="text-red-500 fi fi-br-sign-out-alt"></i>
                                    <span class="ml-2">Sign-out</span>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </header>

        @stack('modals')

        @livewireScripts
        <main>
            <div class="flapt-page-wrapper">
                <!-- Page Content -->
                <div class="flapt-page-content">
                    <div class="main-panel">
                        <div class="content-wrapper">
                            <div class="data-table-area">
                                <div class="container-fluid">
                                    {{ $slot }}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Footer Area -->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <!-- Footer Area -->
                                <footer
                                    class="footer-area d-sm-flex justify-content-center align-items-center justify-content-between">
                                    <!-- Copywrite Text -->
                                    <div class="copywrite-text">
                                        <p>Created by @<a
                                                href="https://www.linkedin.com/company/med-you-in/mycompany/">MedYouIn</a>
                                        </p>
                                    </div>
                                    <div class="fotter-icon text-center">
                                        <a href="https://www.facebook.com/med.you.in/"
                                            class="action-item mr-2" data-bs-toggle="tooltip"
                                            title="Facebook">
                                            <i class="fa fa-facebook" aria-hidden="true"></i>
                                        </a>
                                        <a href="https://www.x.com" class="action-item mr-2"
                                            data-bs-toggle="tooltip" title="Twitter">
                                            <i class="fa fa-twitter" aria-hidden="true"></i>
                                        </a>
                                        <a href="https://www.instagram.com/med.you.in/"
                                            class="action-item mr-2" data-bs-toggle="tooltip"
                                            title="Instagram">
                                            <i class="fa fa-instagram" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </footer>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>


    </div>





    @stack('modals')

    @livewireScripts

    <!-- Inject JS -->
    <script src="{{ asset('js/default-assets/mini-event-calendar.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/mini-calendar-active.js') }}"></script>
    <script src="{{ asset('js/default-assets/apexchart.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/dashboard-active.js') }}"></script>


    <!-- Plugins Js -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bundle.js') }}"></script>

    <!-- Active JS -->
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/scrool-bar.js') }}"></script>
    <script src="{{ asset('js/todo-list.js') }}"></script>
    <script src="{{ asset('js/default-assets/active.js') }}"></script>

    <!-- Inject JS -->
    <script src="{{ asset('js/default-assets/jquery.datatables.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/datatables.bootstrap4.js') }}"></script>
    <script src="{{ asset('js/default-assets/datatable-responsive.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/datatable-button.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/button.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/button.html5.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/button.flash.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/button.print.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/datatables.keytable.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/datatables.select.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/demo.datatable-init.js') }}"></script>


    <script src="{{ asset('js/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('js/jquery.form-validator.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/wizard-form.js') }}"></script>
    <script src="{{ asset('js/default-assets/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/sweetalert-init.js') }}"></script>


    <script src="{{ asset('js/default-assets/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/form-validation-custom.js') }}"></script>
    <script src="{{ asset('js/default-assets/bootstrap-maxlength-active.js') }}"></script>

    {{-- <script src="{{ asset('js/touchSpin.js') }}"></script> --}}

    {{-- <script src="js/default-assets/file-upload.js"></script>
    <script src="js/default-assets/basic-form.js"></script>
    <script src="js/default-assets/jquery.bootstrap-touchspin.min.js"></script>
    <script src="js/default-assets/jquery.bootstrap-touchspin.custom.js"></script>
    <script src="js/bootstrap-colorpicker.min.js"></script>
    <script src="js/default-assets/colorpicker-bootstrap.js"></script>
    <script src="js/default-assets/jquey.tagsinput.min.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
    <script src="js/default-assets/daterange-picker.js"></script>
    <script src="js/default-assets/form-picker.js"></script>
    <script src="js/default-assets/select2.min.js"></script>
    <script src="js/default-assets/select2-custom.js"></script> --}}
</body>

</html>


</body>

</html>
