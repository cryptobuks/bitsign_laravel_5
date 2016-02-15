
@extends('layouts.plain')

@section('body')

<!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header navbar shadow">
        <div class="mdl-layout__header-row">
            <!-- Hamburger -->
            <button class="c-hamburger c-hamburger--htla">
                <span>toggle menu</span>
            </button>
            <div class="responsive-logo">
                BitSign.it <br><span class="smaller">Dashboard</span>
            </div>
            <nav class="mdl-navigation mdl-layout--large-screen-only">
                <!-- Left aligned menu below button -->
                <button id="demo-menu-lower-left" class="mdl-button mdl-js-button mdl-button--icon">
                    <i class="mdi mdi-brightness-1 text-primary"></i>
                </button>
                <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect zero-padding"
                    for="demo-menu-lower-left">
                    <table class="color-picker">
                        <tr>
                            <td><a href="#" id="blue" class="theme-picker"><i class="mdi mdi-brightness-1"></i></a></td>
                            <td><a href="#" id="red" class="theme-picker"><i class="mdi mdi-brightness-1"></i></a></td>
                        </tr>
                        <tr>
                            <td><a href="#" id="grey" class="theme-picker"><i class="mdi mdi-brightness-1"></i></a></td>
                            <td><a href="#" id="green" class="theme-picker"><i class="mdi mdi-brightness-1"></i></a></td>
                        </tr>
                        <tr>
                            <td><a href="#" id="purple" class="theme-picker"><i class="mdi mdi-brightness-1"></i></a></td>
                            <td><a href="#" id="cyan" class="theme-picker"><i class="mdi mdi-brightness-1"></i></a></td>
                        </tr>
                    </table>               
                </ul>

            </nav>
            <!-- Add spacer, to align navigation to the right -->
            <div class="mdl-layout-spacer"></div>
            <!-- Navigation. We hide it in small screens. -->
            <a class="mdl-button mdl-js-button primary mdl-js-ripple-effect mdl-button--raised mdl-layout--large-screen-only" style="margin-right: 10px; margin-bottom: 5px;" href="http://www.strapui.com/themes/material-dashboard-admin-laravel/">
              Buy Now
            </a>
            <button class="thisRTL mdl-button mdl-js-button mdl-js-ripple-effect mdl-layout--large-screen-only" style="margin-right: 10px;">
              RTL
            </button>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable mdl-textfield--floating-label mdl-textfield--align-right mdl-layout--large-screen-only">
                <label class="mdl-button mdl-js-button mdl-button--icon"
                for="fixed-header-drawer-exp">
                <i class="mdi mdi-magnify"></i>
                </label>
                <div class="mdl-textfield__expandable-holder">
                    <input class="mdl-textfield__input" type="text" name="sample"
                    id="fixed-header-drawer-exp" />
                </div>
            </div>
            <nav class="mdl-navigation mdl-layout--large-screen-only">
                <span class="relative">
                    <button id="demo-menu-lower-right2" class="mdl-button mdl-js-button nav-button">
                        <div class="mdl-badge" data-badge="6"><i class="mdi mdi-email"></i></div>
                    </button>
                    <ul class="mdl-menu {{ \Session::get('rtl') == 'rtl' ? 'mdl-menu--bottom-left' : 'mdl-menu--bottom-right' }} mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right2">
                        <li class="mdl-menu__item"><a href="/inbox">Mail from Elsa</a></li>
                        <li class="mdl-menu__item"><a href="/inbox">Inbox</a></li>
                        <li class="mdl-menu__item"><a href="/inbox">Tickets confirmed</a></li>
                        <li class="mdl-menu__item"><a href="/inbox">Check here</a></li>
                    </ul>
                </span>
                <span class="relative">
                    <button id="demo-menu-lower-right3" class="mdl-button mdl-js-button nav-button">
                       <div class="mdl-badge" data-badge="4"><i class="mdi mdi-keyboard"></i></div>
                    </button>
                    <ul class="mdl-menu {{ \Session::get('rtl') == 'rtl' ? 'mdl-menu--bottom-left' : 'mdl-menu--bottom-right' }} mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right3">
                        <li class="mdl-menu__item" onclick="changeLanguage('en')">English</li>
                        <li class="mdl-menu__item" onclick="changeLanguage('de')">Dutch</li>
                        <li class="mdl-menu__item" onclick="changeLanguage('ur')">اردو</li>
                        <li class="mdl-menu__item" onclick="changeLanguage('hn')">हिन्दी</li>                   
                    </ul>
                </span>
                <span class="relative">
                    <button id="demo-menu-lower-right" class="mdl-button mdl-js-button nav-button">
                        <i class="mdi mdi-dots-vertical"></i>
                    </button>
                    <ul class="mdl-menu {{ \Session::get('rtl') == 'rtl' ? 'mdl-menu--bottom-left' : 'mdl-menu--bottom-right' }} mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right">
                        <li class="mdl-menu__item">Some Action</li>
                        <li class="mdl-menu__item"><a href="/login">Logout</a></li>
                        <li class="mdl-menu__item">Disabled Action</li>
                        <li class="mdl-menu__item">Yet Another Action</li>
                    </ul>
                </span>
            </nav>
        </div>
    </header>
    <!-- Side bar here -->
    <aside id="" class="sidebar">
        <div class="top-logo">
            B
        </div>
        <div class="top-logo-extended">
            BitSign.it <br/> <span class="smaller">dashboard</span>
        </div>
        <div class="scrollbar" id="scroll">
            <div class="user-info">
                <div class="opacity">
                    <a href="/profile"><img src="/images/profile.jpg" alt="" class="sidebar-profile"></a>
                    <div class="info">
                        Sankhadeep Roy <br /> <span class="smaller">Striker at Liverpool FC</span>
                    <div class="pen">
                        <a href="#" class=""><i class="mdi mdi-border-color"></i></a>
                    </div>
                    </div>
                </div>
            </div>
            <div class="dashboard-menu">
                <ul class="menu-list">
                    <li {{ (Request::is('/') ? 'class=active' : '') }}><a href="/" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-home"></i> &nbsp;<span class="text">{{ Lang::get((\Session::has('lang') ? \Session::get('lang') : 'en').'.dashboard') }} </span></a></li>
                    <li class="show-subnav" ><a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect show-menu"><i class="mdi mdi-arrange-bring-to-front"></i> &nbsp;<span class="text"> {{ Lang::get((\Session::has('lang') ? \Session::get('lang') : 'en').'.elements') }} </span><i class="mdi mdi-chevron-down"></i></a>
                        <ul class="sub-menu {{ (Request::is('*ui-elements*') ? 'visible' : '') }}">
                            <li {{ (Request::is('*button') ? 'class=active' : '') }}><a href="/ui-elements/button" class="mdl-button mdl-js-button mdl-js-ripple-effect"><span class="text">{{ Lang::get((\Session::has('lang') ? \Session::get('lang') : 'en').'.buttons') }}</span></a></li>
                            <li {{ (Request::is('*card') ? 'class=active' : '') }}><a href="/ui-elements/card" class="mdl-button mdl-js-button mdl-js-ripple-effect"><span class="text">{{ Lang::get((\Session::has('lang') ? \Session::get('lang') : 'en').'.cards') }}</span></a></li>
                            <li {{ (Request::is('*components') ? 'class=active' : '') }}><a href="/ui-elements/components" class="mdl-button mdl-js-button mdl-js-ripple-effect"><span class="text">{{ Lang::get((\Session::has('lang') ? \Session::get('lang') : 'en').'.components') }}</span></a></li>
                        </ul>
                    </li>
                    <li {{ (Request::is('*form') ? 'class=active' : '') }}><a href="/form" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-receipt"></i> &nbsp;<span class="text"> {{ Lang::get((\Session::has('lang') ? \Session::get('lang') : 'en').'.form') }}</span></a></li>
                    <li {{ (Request::is('*grid') ? 'class=active' : '') }}><a href="/grid" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-grid"></i> &nbsp;<span class="text"> {{ Lang::get((\Session::has('lang') ? \Session::get('lang') : 'en').'.grid') }}</span></a></li>
                    <li class="show-subnav"><a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect show-menu"><i class="mdi mdi-chart-areaspline"></i> &nbsp;<span class="text"> {{ Lang::get((\Session::has('lang') ? \Session::get('lang') : 'en').'.charts') }}</span><i class="mdi mdi-chevron-down"></i></a>
                        <ul class="sub-menu {{ (Request::is('*charts*') ? 'visible' : '') }}">
                            <li {{ (Request::is('*chartjs') ? 'class=active' : '') }}><a href="/charts/chartjs" class="mdl-button mdl-js-button mdl-js-ripple-effect"><span class="text">ChartJS</span></a></li>
                            <li {{ (Request::is('*c3chart') ? 'class=active' : '') }}><a href="/charts/c3chart" class="mdl-button mdl-js-button mdl-js-ripple-effect"><span class="text">C3 Charts</span></a></li>
                        </ul>
                    </li>
                    <li {{ (Request::is('*calendar') ? 'class=active' : '') }}><a href="/calendar" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-calendar"></i> &nbsp;<span class="text"> {{ Lang::get((\Session::has('lang') ? \Session::get('lang') : 'en').'.calendar') }}</span></a></li>
                    <li {{ (Request::is('*inbox') ? 'class=active' : '') }}><a href="/inbox" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-message"></i> &nbsp;<span class="text"> {{ Lang::get((\Session::has('lang') ? \Session::get('lang') : 'en').'.inbox') }}</span></a></li>
                    <li {{ (Request::is('*profile') ? 'class=active' : '') }}><a href="/profile" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-account"></i> &nbsp;<span class="text"> {{ Lang::get((\Session::has('lang') ? \Session::get('lang') : 'en').'.profilee') }}</span></a></li>
                     <li {{ (Request::is('*invoice') ? 'class=active' : '') }}><a href="/invoice" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-barcode"></i> &nbsp;<span class="text"> {{ Lang::get((\Session::has('lang') ? \Session::get('lang') : 'en').'.invoice') }}</span></a></li>
                    <li {{ (Request::is('*signup') ? 'class=active' : '') }}><a href="/signup" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-account-multiple-plus"></i> &nbsp;<span class="text"> {{ Lang::get((\Session::has('lang') ? \Session::get('lang') : 'en').'.signup') }}</span></a></li>
                    <li {{ (Request::is('*login') ? 'class=active' : '') }}><a href="/login" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-logout"></i> &nbsp;<span class="text"> {{ Lang::get((\Session::has('lang') ? \Session::get('lang') : 'en').'.login') }}</span></a></li>
                    <li {{ (Request::is('*404') ? 'class=active' : '') }}><a href="/404" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-alert-octagon"></i> &nbsp;<span class="text"> {{ Lang::get((\Session::has('lang') ? \Session::get('lang') : 'en').'.404page') }}</span></a></li>
                    <li {{ (Request::is('*blank') ? 'class=active' : '') }}><a href="/blank" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-content-paste"></i> &nbsp;<span class="text"> {{ Lang::get((\Session::has('lang') ? \Session::get('lang') : 'en').'.blankpage') }}</span></a></li>
                    <li {{ (Request::is('*docs') ? 'class=active' : '') }}><a href="/docs" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-texture"></i> &nbsp;<span class="text"> Documentation</span></a></li>
                </ul>
            </div>
        </div>
    </aside>
    <main class="mdl-layout__content content-holder">
        <div class="@yield('page_class') page-content remodal-bg animsition">
        <!-- Your content goes here -->
        @yield('dashboard-content')
        </div>
    </main>
</div>

@stop

@section('js')

    @parent

    <script>

        $(function () {

            if ($(window).width()<840) {

                if ($('body').hasClass('extended')==1) {
                    $('body').removeClass('extended')
                }     
            }
            
            var sessionLayout = "{{ \Session::get('layout') }}";

            if (!sessionLayout && $(window).width()>1600) {

                $('.c-hamburger').addClass('is-active');
                $('body').addClass('extended');        
                $('.sidebar').perfectScrollbar(); 

            };

            $( ".thisRTL" ).click(function() {
                $('body').toggleClass('rtl');
                var hasClass = $('body').hasClass('rtl');            
                $.get('/api/set-rtl?rtl='+ (hasClass ? 'rtl': ''));
                setTimeout(function() {
                    window.location.reload(true);                    
                }, 0);
            });

            

            $( ".c-hamburger" ).click(function() {

                $( this ).toggleClass('is-active');
                $('body').toggleClass('extended');

                var hasClass = $('body').hasClass('extended');

                $.get('/api/change-layout?layout='+ (hasClass ? 'extended': 'collapsed'));

            });

            if ($('body').hasClass('extended')==1) {
               $( ".c-hamburger" ).addClass('is-active') ;
               $('.sidebar').perfectScrollbar(); 
            };
            $( ".show-menu" ).click(function() {
                $( this ).parent().find('.sub-menu').toggleClass('visible');
            });

            $(".animsition").animsition({

                inClass               :   'zoom-in-sm',
                outClass              :   'zoom-out-sm',
                inDuration            :    350,
                outDuration           :    500,
                linkElement           :   '.animsition-link',
                // e.g. linkElement   :   'a:not([target="_blank"]):not([href^=#])'
                loading               :    0,
                loadingParentElement  :   'body', //animsition wrapper element
                loadingClass          :   'animsition-loading',
                unSupportCss          : [ 'animation-duration',
                '-webkit-animation-duration',
                '-o-animation-duration'
                ],
                //"unSupportCss" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
                //The default setting is to disable the "animsition" in a browser that does not support "animation-duration".

                overlay               :   false,
                overlayClass          :   'animsition-overlay-slide',
                overlayParentElement  :   'body'
            });
            

            $(window).resize(function  () {
              
                if ($(window).width()>1600) {
                    $('.c-hamburger').addClass('is-active');
                    $('body').addClass('extended');
                    $('.sidebar').perfectScrollbar();      

                };
                if ($(window).width()<1200) {
                    $('.c-hamburger').removeClass('is-active');
                    $('body').removeClass('extended');
                };  
                if ($('body').hasClass('extended')==1) {
                    $('.sidebar').addClass('ps-container');
                    $('.sidebar').perfectScrollbar();      
                    $('.sidebar').perfectScrollbar('update');
                }
                else if ($('body').hasClass('extended')==0) {
                    $('.sidebar').removeClass('ps-container');
                }               
            });      

            $( ".c-hamburger" ).click(function() {

            if ($('body').hasClass('extended')==1) {
                $('.sidebar').addClass('ps-container');
                 $('.sidebar').perfectScrollbar();      
                $('.sidebar').perfectScrollbar('update');
            }
            else if ($('body').hasClass('extended')==0) {
                    $('.sidebar').removeClass('ps-container');
                }
            });
            $('.theme-picker').click(function() {
                changeTheme($(this).attr('id'));
            });

            function changeTheme(theme) {

                $('<link>')
                .appendTo('head')
                .attr({type : 'text/css', rel : 'stylesheet'})
                .attr('href', '/css/app-'+theme+'.css');

                $.get('api/change-theme?theme='+theme);
            }


        });
        function changeLanguage(lang){
            console.log(lang);
            $.get('api/lang?lang='+lang);
            setTimeout(function() {
                window.location.reload(true);
                
            }, 550);
        }
    </script>

@endsection