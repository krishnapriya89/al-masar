<div class="ltBx">
    <div class="userBx">
        <div class="imgBx">
            <img src="{{asset('frontend/images/user.jpg')}}" alt="">
        </div>
        <div class="name">{{ Auth::guard('web')->user()->name }}</div>
        <div class="mail">{{ Auth::guard('web')->user()->email }}</div>
    </div>
    <ul>
        <li>
            <a href="{{ route('user.dashboard')}} "
                class="lnk {{ Nav::isRoute('user.dashboard')}}">
                <div class="icon">
                    <svg viewBox="0 0 17.7 17.7">
                        <g id="Layer_1" transform="translate(-1.9 -1.9)">
                            <g id="Group_21803" data-name="Group 21803" transform="translate(11.375 10.125)">
                                <path id="Path_102042" data-name="Path 102042" class="cls-1"
                                    d="M23.582,24.375H18.543A1.545,1.545,0,0,1,17,22.832V16.543A1.545,1.545,0,0,1,18.543,15h5.039a1.545,1.545,0,0,1,1.543,1.543v6.289A1.545,1.545,0,0,1,23.582,24.375ZM18.543,16.25a.293.293,0,0,0-.293.293v6.289a.293.293,0,0,0,.293.293h5.039a.293.293,0,0,0,.293-.293V16.543a.293.293,0,0,0-.293-.293Z"
                                    transform="translate(-17 -15)" />
                            </g>
                            <g id="Group_21804" data-name="Group 21804" transform="translate(11.375 2)">
                                <path id="Path_102043" data-name="Path 102043" class="cls-1"
                                    d="M23.582,8.875H18.543A1.545,1.545,0,0,1,17,7.332V3.543A1.545,1.545,0,0,1,18.543,2h5.039a1.545,1.545,0,0,1,1.543,1.543V7.332A1.545,1.545,0,0,1,23.582,8.875ZM18.543,3.25a.293.293,0,0,0-.293.293V7.332a.293.293,0,0,0,.293.293h5.039a.293.293,0,0,0,.293-.293V3.543a.293.293,0,0,0-.293-.293Z"
                                    transform="translate(-17 -2)" />
                            </g>
                            <g id="Group_21805" data-name="Group 21805" transform="translate(2 2)">
                                <path id="Path_102044" data-name="Path 102044" class="cls-1"
                                    d="M8.582,11.375H3.543A1.545,1.545,0,0,1,2,9.832V3.543A1.545,1.545,0,0,1,3.543,2H8.582a1.545,1.545,0,0,1,1.543,1.543V9.832A1.545,1.545,0,0,1,8.582,11.375ZM3.543,3.25a.293.293,0,0,0-.293.293V9.832a.293.293,0,0,0,.293.293H8.582a.293.293,0,0,0,.293-.293V3.543a.293.293,0,0,0-.293-.293Z"
                                    transform="translate(-2 -2)" />
                            </g>
                            <g id="Group_21806" data-name="Group 21806" transform="translate(2 12.625)">
                                <path id="Path_102045" data-name="Path 102045" class="cls-1"
                                    d="M8.582,25.875H3.543A1.545,1.545,0,0,1,2,24.332V20.543A1.545,1.545,0,0,1,3.543,19H8.582a1.545,1.545,0,0,1,1.543,1.543v3.789A1.545,1.545,0,0,1,8.582,25.875ZM3.543,20.25a.293.293,0,0,0-.293.293v3.789a.293.293,0,0,0,.293.293H8.582a.293.293,0,0,0,.293-.293V20.543a.293.293,0,0,0-.293-.293Z"
                                    transform="translate(-2 -19)" />
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="txt">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="{{ route('user.order') }}" class="lnk {{ Nav::isRoute('user.order')}}">
                <div class="icon">
                    <svg viewBox="0 0 21.667 21.667">
                        <g id="_x33_1_x2C__order_x2C__box_x2C__delivery_x2C__logistics_x2C__receiving"
                            transform="translate(-16 -16)">
                            <g id="Group_21433" data-name="Group 21433" transform="translate(16 16)">
                                <g id="Group_21422" data-name="Group 21422" transform="translate(0 0)">
                                    <path id="Path_101928" data-name="Path 101928"
                                        d="M28.42,35.861H16V21.731L19.821,16h4.3v.9H20.3L16.9,22V34.958H28.42Z"
                                        transform="translate(-16 -16)" />
                                </g>
                                <g id="Group_21423" data-name="Group 21423" transform="translate(11.285 0)">
                                    <path id="Path_101929" data-name="Path 101929"
                                        d="M272.771,27.826V22l-3.4-5.1H266V16h3.853l3.821,5.731v6.095Z"
                                        transform="translate(-266 -16)" />
                                </g>
                                <g id="Group_21424" data-name="Group 21424" transform="translate(12.187 5.417)">
                                    <path id="Path_101930" data-name="Path 101930" d="M286,136h6.319v.9H286Z"
                                        transform="translate(-286 -136)" />
                                </g>
                                <g id="Group_21425" data-name="Group 21425" transform="translate(0.451 5.417)">
                                    <path id="Path_101931" data-name="Path 101931" d="M26,136h6.319v.9H26Z"
                                        transform="translate(-26 -136)" />
                                </g>
                                <g id="Group_21426" data-name="Group 21426" transform="translate(6.333 0)">
                                    <path id="Path_101932" data-name="Path 101932"
                                        d="M157.175,21.978l-.876-.219L157.739,16h3.895l.966,5.794-.891.148-.84-5.039h-2.425Z"
                                        transform="translate(-156.299 -16)" />
                                </g>
                                <g id="Group_21427" data-name="Group 21427" transform="translate(1.806 11.736)">
                                    <path id="Path_101933" data-name="Path 101933"
                                        d="M62.319,282.319H56V276h6.319Zm-5.417-.9h4.514V276.9H56.9Z"
                                        transform="translate(-56 -276)" />
                                </g>
                                <g id="Group_21428" data-name="Group 21428" transform="translate(3.611 13.542)">
                                    <path id="Path_101934" data-name="Path 101934" d="M96,316h2.708v.9H96Z"
                                        transform="translate(-96 -316)" />
                                </g>
                                <g id="Group_21429" data-name="Group 21429" transform="translate(3.611 15.347)">
                                    <path id="Path_101935" data-name="Path 101935" d="M96,356h2.708v.9H96Z"
                                        transform="translate(-96 -356)" />
                                </g>
                                <g id="Group_21430" data-name="Group 21430" transform="translate(10.833 10.833)">
                                    <path id="Path_101936" data-name="Path 101936"
                                        d="M261.417,266.833a5.417,5.417,0,0,1,0-10.833,5.358,5.358,0,0,1,2.462.591h0a5.418,5.418,0,0,1-2.462,10.243Zm0-9.931a4.511,4.511,0,1,0,2.051.492h0A4.463,4.463,0,0,0,261.417,256.9Z"
                                        transform="translate(-256 -256)" />
                                </g>
                                <g id="Group_21431" data-name="Group 21431" transform="translate(6.319 5.417)">
                                    <path id="Path_101937" data-name="Path 101937"
                                        d="M162.319,141.357l-1.806-1.2-1.354.9-1.354-.9-1.806,1.2V136h6.319Zm-4.514-2.289,1.354.9,1.354-.9.9.6V136.9H156.9v2.768Z"
                                        transform="translate(-156 -136)" />
                                </g>
                                <g id="Group_21432" data-name="Group 21432" transform="translate(13.674 14.577)">
                                    <path id="Path_101938" data-name="Path 101938"
                                        d="M320.6,342.595l-1.673-1.673.638-.638,1.035,1.035,2.389-2.389.638.638Z"
                                        transform="translate(-318.929 -338.929)" />
                                </g>
                            </g>
                        </g>
                    </svg>

                </div>
                <div class="txt">My Orders</div>
            </a>
        </li>
        <li>
            <a href="{{ route('user.quotation') }}" class="lnk {{ Nav::isRoute('user.quotation') }}">
                <div class="icon">
                    <svg viewBox="0 0 18.979 19.3">
                        <g id="Group_22543" data-name="Group 22543" transform="translate(-1155.849 -57.85)">
                            <g id="cart" transform="translate(1155.999 58)">
                                <path id="Path_102143" data-name="Path 102143" class="cls-1"
                                    d="M20.71,5.738a1.706,1.706,0,0,0-1.267-.565H7.41L7.049,4.082A2.684,2.684,0,0,0,4.506,2.25H3.191a.731.731,0,1,0,0,1.462H4.506a1.218,1.218,0,0,1,1.159.828l.507,1.52.77,6.957A2.671,2.671,0,0,0,9.6,15.4h8.2a2.671,2.671,0,0,0,2.66-2.387l.663-5.953A1.7,1.7,0,0,0,20.7,5.738Zm-1.686,7.123a1.214,1.214,0,0,1-1.208,1.082h-8.2A1.214,1.214,0,0,1,8.4,12.861L7.712,6.635H19.443a.253.253,0,0,1,.185.078.234.234,0,0,1,.058.185l-.663,5.953Z"
                                    transform="translate(-2.46 -2.25)" />
                                <path id="Path_102144" data-name="Path 102144" class="cls-1"
                                    d="M9.442,17.25a2.192,2.192,0,1,0,2.192,2.192A2.2,2.2,0,0,0,9.442,17.25Zm0,2.923a.731.731,0,1,1,.731-.731A.736.736,0,0,1,9.442,20.173Z"
                                    transform="translate(-2.583 -2.635)" />
                                <path id="Path_102145" data-name="Path 102145" class="cls-1"
                                    d="M18.442,17.25a2.192,2.192,0,1,0,2.192,2.192A2.2,2.2,0,0,0,18.442,17.25Zm0,2.923a.731.731,0,1,1,.731-.731A.736.736,0,0,1,18.442,20.173Z"
                                    transform="translate(-2.814 -2.635)" />
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="txt">My Quotation</div>
            </a>
        </li>
        <li>
            <a href="{{ route('address') }}" class="lnk {{ Nav::isRoute('address') }}">
                <div class="icon">
                    <svg viewBox="0 0 19.57 22.431">
                        <path id="location"
                            d="M13.285,8.589a3.453,3.453,0,1,1-3.453,3.453,3.453,3.453,0,0,1,3.453-3.453m0-1.151a4.6,4.6,0,1,0,4.6,4.6A4.6,4.6,0,0,0,13.285,7.438ZM15.32,23.845l3.219-3.218a.576.576,0,1,0-.814-.814l-3.219,3.218a1.768,1.768,0,0,1-2.442,0L7.18,18.147a8.634,8.634,0,1,1,12.21,0,.576.576,0,1,0,.814.814,9.785,9.785,0,1,0-13.838,0l4.884,4.884a2.877,2.877,0,0,0,4.07,0Z"
                            transform="translate(-3.5 -2.257)" />
                    </svg>

                </div>
                <div class="txt">Address</div>
            </a>
        </li>
        <li>
            <a href="profileSettings.php" class="lnk">
                <div class="icon">
                    <svg viewBox="0 0 19.833 17.996">
                        <path id="setting"
                            d="M14.038,20.008H6.962a3.129,3.129,0,0,1-2.487-1.436L.938,12.446a3.089,3.089,0,0,1,0-2.872L4.476,3.448A3.129,3.129,0,0,1,6.963,2.012h7.075a3.129,3.129,0,0,1,2.487,1.436l3.538,6.126a3.089,3.089,0,0,1,0,2.872l-3.538,6.126A3.128,3.128,0,0,1,14.038,20.008ZM6.962,3.3A1.837,1.837,0,0,0,5.59,4.09L2.051,10.217a1.841,1.841,0,0,0,0,1.586l3.538,6.126a1.837,1.837,0,0,0,1.373.792h7.076a1.837,1.837,0,0,0,1.373-.792L18.949,11.8a1.841,1.841,0,0,0,0-1.586L15.411,4.09A1.837,1.837,0,0,0,14.038,3.3ZM10.5,14.815a3.805,3.805,0,1,1,3.806-3.805A3.81,3.81,0,0,1,10.5,14.815Zm0-6.324a2.519,2.519,0,1,0,2.52,2.519A2.522,2.522,0,0,0,10.5,8.491Z"
                            transform="translate(-0.583 -2.012)" />
                    </svg>

                </div>
                <div class="txt">Profile Settings</div>
            </a>
        </li>
        <li>
            <a href="javascript:void(0)" class="lnk logout-form-btn">
                <div class="icon">
                    <svg viewBox="0 0 17.5 17.5">
                        <g id="layer1" transform="translate(-0.279 -290.929)">
                            <path id="path52" class="cls-1"
                                d="M9.02,291.179a.852.852,0,0,0-.842.864v6.832a.851.851,0,1,0,1.7,0v-6.832a.852.852,0,0,0-.86-.864Zm4.959,1.713q-.042,0-.083,0a.855.855,0,0,0-.471,1.508,6.8,6.8,0,1,1-8.816.025.857.857,0,0,0,.095-1.2.848.848,0,0,0-1.2-.1,8.563,8.563,0,0,0,5.529,15.052A8.563,8.563,0,0,0,14.524,293.1a.848.848,0,0,0-.545-.21Z"
                                transform="translate(0 0)" />
                        </g>
                    </svg>
                </div>
                <div class="txt">Logout</div>
            </a>
        </li>
    </ul>
</div>
