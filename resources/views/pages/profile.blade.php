
@extends('partials.dashboard')

@section('page_title')
    Profile
@stop

@section('page_class')
    expanded-container
@stop
@section('dashboard-content')

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
    

@stop