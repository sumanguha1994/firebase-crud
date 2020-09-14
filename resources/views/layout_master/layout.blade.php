<!DOCTYPE html>
<html lang="en">
<head>
    <base href="">
    <meta charset="utf-8" />
    <title>Firebase | Admin</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
    <link href="{{ asset('public/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="{{ asset('public/assets/media/logos/favicon.ico') }}" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.10.3/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.3/FileSaver.min.js"></script>
</head>
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-aside--minimize kt-page--loading">
    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
        <div class="kt-header-mobile__logo">
            <a href="{{ url('dashboard') }}">
                <img alt="Logo" src="{{ asset('public/assets/media/logos/logo-6.png') }}" />
            </a>
        </div>
        <div class="kt-header-mobile__toolbar">
            <button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
            <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
            <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
        </div>
    </div>
    <div id="kt_scrolltop" class="kt-scrolltop">
        <i class="fa fa-arrow-up"></i>
    </div>
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            <button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
            <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
                <!-- begin:: Brand -->
                <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
                    <div class="kt-aside__brand-logo">
                        <a href="{{ url('dashboard') }}">
                            <img alt="Logo" src="{{ asset('public/assets/media/logos/logo-7.png') }}" />
                        </a>
                    </div>
                </div>
                <!-- end:: Brand -->
                <!-- begin:: Aside Menu -->
                <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
                    <div id="kt_aside_menu" class="kt-aside-menu  kt-aside-menu--dropdown " data-ktmenu-vertical="1" data-ktmenu-dropdown="1" data-ktmenu-scroll="0">
                        <ul class="kt-menu__nav ">
                            <!-- users Control start-->
                            @if(\Session::has('appname'))
                            <li title="Dynamic Table" class="kt-menu__item  kt-menu__item--submenu kt-menu__item--submenu-fullheight kt-menu__item--open kt-menu__item--here" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-dropdown-toggle-class="kt-aside-menu-overlay--on"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-layers"></i><span class="kt-menu__link-text">Table Create</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <div class="kt-menu__wrapper">
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item  kt-menu__item--parent kt-menu__item--submenu-fullheight" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Dynamic Table</span></span></li>
                                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{ url('create-table') }}" class="kt-menu__link "><span class="kt-menu__link-text">Table</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            @endif
                            @if(\Session::has('appname'))
                            <li title="File Upload" class="kt-menu__item  kt-menu__item--submenu kt-menu__item--submenu-fullheight kt-menu__item--open kt-menu__item--here" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-dropdown-toggle-class="kt-aside-menu-overlay--on"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-image-file"></i><span class="kt-menu__link-text">File Upload</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <div class="kt-menu__wrapper">
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item  kt-menu__item--parent kt-menu__item--submenu-fullheight" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">File Upload</span></span></li>
                                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{ url('file-upload') }}" class="kt-menu__link "><span class="kt-menu__link-text">Upload</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            @endif
                            @if(\Session::has('appname'))
                            <li title="Push Notification" class="kt-menu__item  kt-menu__item--submenu kt-menu__item--submenu-fullheight kt-menu__item--open kt-menu__item--here" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-dropdown-toggle-class="kt-aside-menu-overlay--on"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-responsive"></i><span class="kt-menu__link-text">Send Notification</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <div class="kt-menu__wrapper">
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item  kt-menu__item--parent kt-menu__item--submenu-fullheight" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Send Notification</span></span></li>
                                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{ url('web-send-notification') }}" class="kt-menu__link "><span class="kt-menu__link-text">Web Notification</span></a></li>
                                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{ url('send-notification') }}" class="kt-menu__link "><span class="kt-menu__link-text">Mobile Notification</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <!-- end:: Aside Menu -->
            </div>
            <div class="kt-aside-menu-overlay"></div>
            <!-- end:: Aside -->
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
                <!-- begin:: Header -->
                <div id="kt_header" class="kt-header kt-grid kt-grid--ver  kt-header--fixed ">
                    <!-- begin: Header Menu -->
                    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                    @if(\Session::has('appname'))
                    <div class="kt-header-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_header_menu_wrapper">
                        <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout- ">
                            <ul class="kt-menu__nav ">
                                <li class="kt-menu__item  kt-menu__item--active " aria-haspopup="true"><a href="{{ url('dashboard') }}" class="kt-menu__link "><span class="kt-menu__link-text">Dashboard</span></a></li>
                            </ul>
                        </div>
                    </div>
                    @endif
                    <!-- end: Header Menu -->
                    <!-- begin:: Header Topbar -->
                    <div class="kt-header__topbar">
                        <!--begin: Search -->
                        <!-- <div class="kt-header__topbar-item kt-header__topbar-item--search">
                            <div class="kt-header__topbar-wrapper">
                                <div class="kt-quick-search kt-quick-search--inline kt-quick-search--result-compact" id="kt_quick_search_inline">
                                    <form method="get" class="kt-quick-search__form">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="flaticon2-search-1"></i></span></div>
                                            <input type="text" class="form-control kt-quick-search__input" placeholder="Search...">
                                            <div class="input-group-append"><span class="input-group-text"><i class="la la-close kt-quick-search__close" style="display: none;"></i></span></div>
                                        </div>
                                    </form>
                                    <div id="kt_quick_search_toggle" data-toggle="dropdown" data-offset="0px,10px"></div>
                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-lg">
                                        <div class="kt-quick-search__wrapper kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!--end: Search -->
                        @if(\Session::has('appname'))
                        <div class="kt-header__topbar-item kt-header__topbar-item--user">
                            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                                <span class="kt-hidden kt-header__topbar-welcome">Hi,</span>
                                <span class="kt-hidden kt-header__topbar-username">Nick</span>
                                <img class="kt-hidden" alt="Pic" src="{{ asset('public/assets/media/users/300_21.jpg') }}" />
                                <span class="kt-header__topbar-icon"><i class="flaticon2-user-outline-symbol"></i></span>
                            </div>
                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
                                <div class="kt-user-card kt-user-card--skin-light kt-notification-item-padding-x">
                                    <div class="kt-user-card__avatar">
                                        <img class="kt-hidden-" alt="Pic" src="{{ asset('public/assets/media/users/300_25.jpg') }}" />
                                        <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold kt-hidden">S</span>
                                    </div>
                                    <div class="kt-user-card__name">
                                        {{ \Session::get('name') }}
                                    </div>
                                </div>
                                <div class="kt-notification">
                                    <a href="#!" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="flaticon2-calendar-3 kt-font-success"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                My Profile
                                            </div>
                                            <div class="kt-notification__item-time">
                                                Account settings and more
                                            </div>
                                        </div>
                                    </a>
                                    <div class="kt-notification__custom kt-space-between">
                                        <a href="{{ url('logout') }}" class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <!-- end:: Header -->
                <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                    <!-- begin:: Content -->
                    @yield('content')
                    <!-- end:: Content -->
                    </div>
                <!-- begin:: Footer -->
                <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
                    <div class="kt-container  kt-container--fluid ">
                        <div class="kt-footer__copyright">
                            2020&nbsp;&copy;&nbsp;<a href="#!" target="_blank" class="kt-link">Keenthemes</a>
                        </div>
                        <div class="kt-footer__menu">
                            <a href="#!" target="_blank" class="kt-footer__menu-link kt-link">About</a>
                            <a href="#!" target="_blank" class="kt-footer__menu-link kt-link">Team</a>
                            <a href="#!" target="_blank" class="kt-footer__menu-link kt-link">Contact</a>
                        </div>
                    </div>
                </div>
                <!-- end:: Footer -->
            </div>
        </div>
    </div>
    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#22b9ff",
                    "light": "#ffffff",
                    "dark": "#282a3c",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#36a3f7",
                    "warning": "#ffb822",
                    "danger": "#fd3995"
                },
                "base": {
                    "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                    "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                }
            }
        };
        $('#bookingadminli').on('click', function(){
            if($(this).hasClass('kt-menu__item--open-dropdown kt-menu__item--hover')){
                $(this).removeClass('kt-menu__item--open-dropdown kt-menu__item--hover');
            }else{
                $(this).addClass('kt-menu__item  kt-menu__item--submenu kt-menu__item--here kt-menu__item--open-dropdown kt-menu__item--hover');
            }
        })
    </script>
    <script src="{{ asset('public/assets/js/scripts.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript"></script>
    <script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
    <script src="{{ asset('public/assets/plugins/custom/gmaps/gmaps.js') }}" type="text/javascript"></script>
    <!-- datatable -->
    <script src="{{ asset('public/assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
</body>
</html>
