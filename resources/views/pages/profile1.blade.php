
@extends('layouts.plain')

@section('body')

@section('page_title')
    Profile
@stop

@section('page_class')
    expanded-container
@stop

<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header navbar shadow">
        <div class="mdl-layout__header-row">
            <!-- Hamburger -->
            <button class="c-hamburger c-hamburger--htla">
                <span>toggle menu</span>
            </button>
            <!-- Add spacer, to align navigation to the right -->
            <div class="mdl-layout-spacer"></div>
            <!-- Navigation. We hide it in small screens. -->
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
                <button id="demo-menu-lower-right2" class="mdl-button mdl-js-button nav-button">
                    <div class="mdl-badge" data-badge="3"><i class="mdi mdi-email"></i></div>
                </button>
                <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right2">
                    <li class="mdl-menu__item"><a href="/inbox">Mail from Elsa</a></li>
                    <li class="mdl-menu__item"><a href="/inbox">Inbox</a></li>
                    <li class="mdl-menu__item"><a href="/inbox">Tickets confirmed</a></li>
                    <li class="mdl-menu__item"><a href="/inbox">Check here</a></li>
                </ul>
                <button id="demo-menu-lower-right3" class="mdl-button mdl-js-button nav-button">
                   <div class="mdl-badge" data-badge="7"><i class="mdi mdi-bell"></i></div>
                </button>
                <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right3">
                    <li class="mdl-menu__item">2 new friends</li>
                    <li class="mdl-menu__item">4 new messages</li>
                    <li class="mdl-menu__item">Friend request accepted</li>
                    <li class="mdl-menu__item">No new notifs.</li>  
                </ul>
                <button id="demo-menu-lower-right" class="mdl-button mdl-js-button nav-button">
                    <i class="mdi mdi-dots-vertical"></i>
                </button>
                <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right">
                    <li class="mdl-menu__item">Some Action</li>
                    <li class="mdl-menu__item"><a href="/login">Logout</a></li>
                    <li class="mdl-menu__item">Disabled Action</li>
                    <li class="mdl-menu__item">Yet Another Action</li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- Side bar here -->
    <aside id="" class="sidebar">
        <div class="top-logo">
            M
        </div>
        <div class="top-logo-extended">
            Material <br/> <span class="smaller">dashboard</span>
        </div>
        <div class="scrollbar" id="scroll">
            <div class="user-info">
                <div class="opacity">
                    <a href="/profile"><img src="images/profile.jpg" alt="" class="sidebar-profile"></a>
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
                    <li><a href="/" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-home"></i><span class="text"> Home</span></a></li>
                    <li class="show-subnav"><a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect show-menu"><i class="mdi mdi-arrange-bring-to-front"></i><span class="text"> UI-Elements<i class="mdi mdi-chevron-down"></i></span></a>
                        <ul class="sub-menu">
                            <li><a href="/button" class="mdl-button mdl-js-button mdl-js-ripple-effect"><span class="text">Buttons</span></a></li>
                            <li><a href="/card" class="mdl-button mdl-js-button mdl-js-ripple-effect"><span class="text">Cards</span></a></li>
                            <li><a href="/components" class="mdl-button mdl-js-button mdl-js-ripple-effect"><span class="text">Components</span></a></li>
                        </ul>
                    </li>
                    <li><a href="/form" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-receipt"></i><span class="text"> Form</span></a></li>
                    <li><a href="/grid" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-grid"></i><span class="text"> Grid</span></a></li>
                    <li class="show-subnav"><a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect show-menu"><i class="mdi mdi-chart-areaspline"></i><span class="text"> Charts<i class="mdi mdi-chevron-down"></i></span></a>
                        <ul class="sub-menu">
                            <li><a href="/c3chart" class="mdl-button mdl-js-button mdl-js-ripple-effect"><span class="text">C3 Charts</span></a></li>
                            <li><a href="/chartjs" class="mdl-button mdl-js-button mdl-js-ripple-effect"><span class="text">ChartJS</span></a></li>
                        </ul>
                    </li>
                    <li><a href="/calendar" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-calendar"></i><span class="text"> Calendar</span></a></li>
                    <li><a href="/inbox" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-message"></i><span class="text"> Inbox</span></a></li>
                     <li><a href="/invoice" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-barcode"></i><span class="text"> Invoice</span></a></li>
                    <li><a href="/signup" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-account-multiple-plus"></i><span class="text"> Signup</span></a></li>
                    <li><a href="/login" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-logout"></i><span class="text"> Login</span></a></li>
                    <li><a href="/404" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-alert-octagon"></i><span class="text"> 404 Page</span></a></li>
                    <li><a href="/blank" class="mdl-button mdl-js-button mdl-js-ripple-effect"><i class="mdi mdi-content-paste"></i><span class="text"> Blank Page</span></a></li>
                </ul>
            </div>
        </div>
    </aside>
    <main class="mdl-layout__content content-holder">
        <div class="profile-content">
            <div class="cover-photo">
                <div class="opacity-overlay relative">
                    <div class="profile-info absolute">
                        <div class="profile-photo">
                            <img src="images/profile.jpg" alt="">
                        </div>
                        <div class="profile-desc">
                            Sankhadeep Roy <span class="smaller">&nbsp;  @rishi</span>
                            <br>
                            <span class="location"><i class="mdi mdi-map-marker"></i> Liverpool, Merseyside </span>
                            <br>
                            <div class="social-icons">
                                <a href="#"><i class="mdi mdi-facebook-box"></i>&nbsp;</a>
                                <a href="#"><i class="mdi mdi-twitter-box"></i>&nbsp;</a>
                                <a href="#"><i class="mdi mdi-instagram"></i>&nbsp;</a>
                            </div>
                        </div>
                    </div>
                    <div class="numbers absolute">
                        <div class="detail">
                            29
                            <br>
                            <div class="desc">
                                Photos
                            </div>
                        </div>
                        <div class="detail">
                            342
                            <br>
                            <div class="desc">
                                Followers
                            </div>
                        </div>
                        <div class="detail">
                            5k
                            <br>
                            <div class="desc">
                                Friends
                            </div>
                        </div>
                        <div class="detail">
                            12
                            <br>
                            <div class="desc">
                                Relationships
                            </div>
                        </div>
                    </div>
                    <div class="buttons absolute">
                        <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" id="profile-button">
                            <i class="mdi mdi-settings"></i>
                        </button>
                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                        for="profile-button">
                        <li class="mdl-menu__item">Some Action</li>
                        <li class="mdl-menu__item">Another Action</li>
                        <li disabled class="mdl-menu__item">Disabled Action</li>
                        <li class="mdl-menu__item">Yet Another Action</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="profile-body">
            <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                <div class="mdl-tabs__tab-bar">
                <a href="#starks-panel" class="mdl-tabs__tab is-active">Photos</a>
                    <a href="#lannisters-panel" class="mdl-tabs__tab">Info</a>
                </div>
                <div class="mdl-tabs__panel is-active" id="starks-panel">  
                    <div class="lightbox-container">                 
                        <a href="images/portrait8.jpg" data-lightbox="image-1" data-title="My caption"><img class="shadow" src="images/portrait8.jpg" alt=""></a>
                        <a href="images/portrait1.jpg" data-lightbox="image-1" data-title="My caption"><img class="shadow" src="images/portrait1.jpg" alt=""></a>
                        <a href="images/portrait2.jpg" data-lightbox="image-1" data-title="My caption"><img class="shadow" src="images/portrait2.jpg" alt=""></a>
                        <a href="images/portrait3.jpg" data-lightbox="image-1" data-title="My caption"><img class="shadow" src="images/portrait3.jpg" alt=""></a>
                        <a href="images/portrait4.jpg" data-lightbox="image-1" data-title="My caption"><img class="shadow" src="images/portrait4.jpg" alt=""></a>
                        <a href="images/portrait5.jpg" data-lightbox="image-1" data-title="My caption"><img class="shadow" src="images/portrait5.jpg" alt=""></a>
                        <a href="images/portrait6.jpg" data-lightbox="image-1" data-title="My caption"><img class="shadow" src="images/portrait6.jpg" alt=""></a>
                        <a href="images/portrait7.jpg" data-lightbox="image-1" data-title="My caption"><img class="shadow" src="images/portrait7.jpg" alt=""></a>
                        <a href="images/portrait9.jpg" data-lightbox="image-1" data-title="My caption"><img class="shadow" src="images/portrait9.jpg" alt=""></a>
                    </div>
                </div>
                <div class="mdl-tabs__panel" id="lannisters-panel">
                    <div class="info-container">
                        <div class="cell">
                            <table class="mdl-data-table mdl-js-data-table shadow">
                                <thead>
                                    <tr>
                                        <th class="mdl-data-table__cell--non-numeric" colspan="2">Personal <i class="mdi mdi-account left"></i> <i class="mdi mdi-pencil right"></i></th>                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric">Name</td>
                                        <td class="mdl-data-table__cell--non-numeric">Sankhadeep Roy</td>                                    
                                    </tr>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric">Address</td>
                                        <td class="mdl-data-table__cell--non-numeric">Liverpool, Merseyside</td>                                    
                                    </tr>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric">Relationship status</td>
                                        <td class="mdl-data-table__cell--non-numeric">Single</td>                                    
                                    </tr>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric">Phone</td>
                                        <td class="mdl-data-table__cell--non-numeric">+91 8874122148</td>                                    
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="cell">
                            <table class="mdl-data-table mdl-js-data-table shadow">
                                <thead>
                                    <tr>
                                        <th class="mdl-data-table__cell--non-numeric" colspan="2">Work <i class="mdi mdi-briefcase-check left"></i> <i class="mdi mdi-pencil right"></i></th>                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric">Club</td>
                                        <td class="mdl-data-table__cell--non-numeric">Liverpool FC</td>                                    
                                    </tr>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric">Position</td>
                                        <td class="mdl-data-table__cell--non-numeric">Centre Forward</td>                                    
                                    </tr>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric">Wages</td>
                                        <td class="mdl-data-table__cell--non-numeric">250k</td>                                    
                                    </tr>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric">Market Value</td>
                                        <td class="mdl-data-table__cell--non-numeric">$32m</td>                                    
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="cell">
                            <table class="mdl-data-table mdl-js-data-table shadow">
                                <thead>
                                    <tr>
                                        <th class="mdl-data-table__cell--non-numeric" colspan="2">Social <i class="mdi mdi-thumb-up-outline left"></i> <i class="mdi mdi-pencil right"></i></th>                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric"><i class="mdi mdi-facebook"></i></td>
                                        <td class="mdl-data-table__cell--non-numeric">Sankhadeep Roy</td>                                    
                                    </tr>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric"><i class="mdi mdi-twitter"></i></td>
                                        <td class="mdl-data-table__cell--non-numeric">Liverpool, Merseyside</td>                                    
                                    </tr>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric"><i class="mdi mdi-pinterest"></i></td>
                                        <td class="mdl-data-table__cell--non-numeric">Single</td>                                    
                                    </tr>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric"><i class="mdi mdi-instagram"></i></td>
                                        <td class="mdl-data-table__cell--non-numeric">+91 8874122148</td>                                    
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    </main>
</div>

@stop

@section('js')

    @parent

    <script>
        $(function () {
            if ($(window).width()>1600) {
                $('.c-hamburger').addClass('is-active');
                $('body').addClass('extended');
                $('.scrollbar').perfectScrollbar();      

            };
            $( ".c-hamburger" ).click(function() {
                $( this ).toggleClass('is-active');
                $('body').toggleClass('extended');
                $('body').toggleClass('small-sidebar');
            });
            $( ".show-menu" ).click(function() {
                $( this ).parent().find('.sub-menu').toggleClass('visible');
            });
        });
        $(window).resize(function  () {

            if ($(window).width()>1600) {
                $('.c-hamburger').addClass('is-active');
                $('body').addClass('extended');
                $('.scrollbar').perfectScrollbar();      

            };
            if ($(window).width()<1200) {
                $('.c-hamburger').removeClass('is-active');
                $('body').removeClass('extended');
            };  
            if ($('body').hasClass('extended')==1) {
                $('#scroll').addClass('ps-container');
                $('.scrollbar').perfectScrollbar();      
                $('.scrollbar').perfectScrollbar('update');
            }
            else if ($('body').hasClass('extended')==0) {
                $('#scroll').removeClass('ps-container');
            }               
        });      

        $( ".c-hamburger" ).click(function() {

            if ($('body').hasClass('extended')==1) {
                $('#scroll').addClass('ps-container');
                $('.scrollbar').perfectScrollbar();      
                $('.scrollbar').perfectScrollbar('update');
            }
            else if ($('body').hasClass('extended')==0) {
                $('#scroll').removeClass('ps-container');
            }
        });

        lightbox.option({
            positionFromTop: 70
        })


    </script>

@endsection