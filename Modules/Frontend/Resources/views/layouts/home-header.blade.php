<header id="HomeHeader" class="">
    <div class="Background"></div>
    <div class="topHead">
        <div class="container">
            <a href="tel:{{@$site_common_content->header_phone_number}}" class="call">
                <svg viewBox="0 0 12 12">
                    <g id="Group_21150" data-name="Group 21150" transform="translate(-1105 -48.101)">
                        <g id="telephone-call" transform="translate(1105 48.101)">
                            <path id="Path_101824" data-name="Path 101824" class="cls-1"
                                d="M13.74,11.154A11.635,11.635,0,0,0,10.8,9.513c-.171.03-.3.177-.654.6a5.009,5.009,0,0,1-.533.577A4.61,4.61,0,0,1,8.6,10.308,6.3,6.3,0,0,1,5.692,7.4a4.61,4.61,0,0,1-.377-1.017,5.009,5.009,0,0,1,.577-.533c.418-.351.565-.481.6-.654A11.66,11.66,0,0,0,4.846,2.259C4.715,2.1,4.6,2,4.443,2,4,2,2,4.474,2,4.794c0,.026.043,2.6,3.3,5.91C8.6,13.957,11.18,14,11.206,14,11.526,14,14,12,14,11.557c0-.153-.1-.272-.26-.4Z"
                                transform="translate(-2 -2)" />
                            <path id="Path_101825" data-name="Path 101825" class="cls-1"
                                d="M19.571,10.429h.857A3.432,3.432,0,0,0,17,7v.857a2.574,2.574,0,0,1,2.571,2.571Z"
                                transform="translate(-10.571 -4.857)" />
                            <path id="Path_101826" data-name="Path 101826" class="cls-1"
                                d="M21.714,7.571h.857A5.578,5.578,0,0,0,17,2v.857A4.72,4.72,0,0,1,21.714,7.571Z"
                                transform="translate(-10.571 -2)" />
                        </g>
                    </g>
                </svg>
                {{@$site_common_content->header_phone_number}}
            </a>
        </div>
    </div>
    <div class="container">
        <div class="MainFlx">
            <div class="lSide">
                <button type="button" class="MenuBtn" id="menuOpen">
                    <div class="shape">
                        <span class="line1"></span>
                        <span class="line2"></span>
                        <span class="line3"></span>
                    </div>
                </button>
                <a href="{{ route('home')}}" class="logo">
                    <img src="{{ Storage::disk('public')->exists(\App\Helpers\AdminHelper::getValueByKey('website_logo')) ? Storage::url(\App\Helpers\AdminHelper::getValueByKey('website_logo')) : asset(\App\Helpers\AdminHelper::getValueByKey('website_logo')) }}" alt="{{ \App\Helpers\AdminHelper::getValueByKey('website_name') }}">
                </a>
            </div>
            <div class="RSide">
                <ul class="QckMenu">
                    <li>
                        <a href="{{ Route::currentRouteName() == 'home' ?'#AboutSec':route('home').'/#AboutSec'}}"
                            class="fliplink">
                            <div class="Link" data-after="Who We Are">
                                <span>
                                    Who We Are
                                </span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ Route::currentRouteName() == 'home' ? '#WhyChooseSec':route('home').'/#WhyChooseSec'}}" class="fliplink">
                            <div class="Link" data-after="Why Us">
                                <span>
                                    Why Us
                                </span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ Route::currentRouteName()=='home'? '#HowToBuy':route('home').'/#HowToBuy'}}" class="fliplink">
                            <div class="Link" data-after="How to Buy?">
                                <span>
                                    How to Buy?
                                </span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ Route::currentRouteName()=='home' ? '#contactSec':route('home').'/#contactSec'}}" class="fliplink">
                            <div class="Link" data-after="Clients">
                                <span>
                                    Clients
                                </span>
                            </div>
                        </a>
                    </li>
                </ul>
                <a href="{{ route('user.login.form') }}" class="login hoveranim"><span>Login</span></a>
            </div>
        </div>
    </div>
    <div id="MainMenu">
        <div class="grid">
            <div class="mainItm">
                <ul class="MainMenuLinks">
                    <li><a href="{{ Route::currentRouteName() == 'home' ?'#AboutSec':route('home').'/#AboutSec'}}"> Who We Are</a></li>
                    <li><a href="{{ Route::currentRouteName() == 'home' ? '#WhyChooseSec':route('home').'/#WhyChooseSec'}}">Why Us</a></li>
                    <li><a href="{{ Route::currentRouteName()=='home'? '#HowToBuy':route('home').'/#HowToBuy'}}">How to Buy?</a></li>
                    <li><a href="{{ Route::currentRouteName()=='home' ? '#contactSec':route('home').'/#contactSec'}}">Clients</a></li>
                </ul>
            </div>
            <div class="MenuBtn">
                <span>Close Menu</span>
                <button type="button" id="closeMenu" class="btn btn-primary" data-toggle="modal"
                    data-target="#header_pop">
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </div>
</header>
@if ($site_common_content->whatsapp_number)
<div class="fixedRit">
    <ul>
        <li>
            <a class="whatsapp" target="_blank" href="https://wa.me/{{$site_common_content->whatsapp_number}}" target="_blank">
                <div class="align">
                    <img src="{{ asset('frontend/images/whatsapp.svg') }}" alt="">
                </div>
            </a>
        </li>
    </ul>
</div>
@endif
