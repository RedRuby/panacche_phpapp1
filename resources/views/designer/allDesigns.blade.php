<div class="row align-items-center h-100">

    <div class="leftSideNav h-100 position-fixed">
        <ul class="drawer-menu px-3 pb-5 mb-5 text-center" id="dasboardMenu" data-children=".drawer-submenu">
            <li class="drawer-menu-item mt-4">
                <a href="{{ env('Shop_URL') }}/account/">
                    <i class="fas fa-th" data-toggle="tooltip" data-placement="right" title="Dashboard"></i>
                    <!--<span class="drawer-menu-text">Dashboard</span>-->
                </a>
            </li>
            <li class="drawer-menu-item mt-3">
                <a href="{{ env('Shop_URL') }}">
                    <i class="fas fa-home" data-toggle="tooltip" data-placement="right" title="Home"></i>
                    <!--<span class="drawer-menu-text">Home</span>-->
                </a>
            </li>
            <li class="drawer-menu-item mt-3">
                <a href="{{ env('Shop_URL') }}/pages/gallery">
                    <i class="fas fa-images" data-toggle="tooltip" data-placement="right" title="Gallery"></i>
                    <!--<span class="drawer-menu-text"></span>-->
                </a>
            </li>
            <li class="drawer-menu-item mt-3">
                <a href="{{ env('Shop_URL') }}/pages/our-designers">
                    <i class="fas fa-drafting-compass" data-toggle="tooltip" data-placement="right"
                        title="Our Designers"></i>
                    <!--<span class="drawer-menu-text"></span>-->
                </a>
            </li>
            <li class="drawer-menu-item mt-3">
                <a href="#">
                    <i class="fab fa-blogger-b" data-toggle="tooltip" data-placement="right" title="Blogs"></i>
                    <!--<span class="drawer-menu-text"></span>-->
                </a>
            </li>
            <li class="drawer-menu-item mt-3">
                <a href="#">
                    <i class="fas fa-crosshairs" data-toggle="tooltip" data-placement="right" title="Our Mission"></i>
                    <!--<span class="drawer-menu-text"></span>-->
                </a>
            </li>
            <li class="drawer-menu-item mt-3">
                <a href="#">
                    <i class="fas fa-phone-alt" data-toggle="tooltip" data-placement="right" title="Contact"></i>
                    <!--<span class="drawer-menu-text"></span>-->
                </a>
            </li>
            <li class="drawer-menu-item mt-3">
                <a href="#">
                    <svg height="17pt" viewBox="0 -26 512 512" width="17pt" xmlns="http://www.w3.org/2000/svg"
                        data-toggle="tooltip" data-placement="right" title="FAQ">
                        <path
                            d="m377.429688 138.984375c-11.46875 0-20.800782 9.339844-20.800782 20.808594v73.246093c0 11.46875 9.332032 20.808594 20.800782 20.808594h20.808593v-94.054687c0-11.46875-9.328125-20.808594-20.808593-20.808594zm0 0" />
                        <path
                            d="m256.179688 138.984375c-11.46875 0-20.800782 9.339844-20.800782 20.808594v41.628906h41.609375v-41.628906c0-11.46875-9.328125-20.808594-20.808593-20.808594zm0 0" />
                        <path
                            d="m422.261719 0h-331.441407c-50.082031 0-90.820312 40.648438-90.820312 90.605469v338.867187c0 11.996094 7.28125 22.957032 18.558594 27.925782 3.980468 1.75 8.210937 2.601562 12.402344 2.601562 7.5 0 14.890624-2.738281 20.617187-7.949219 41.550781-37.589843 95.320313-58.289062 151.421875-58.289062h.019531l219.300781.011719c49.449219 0 89.679688-40.320313 89.679688-89.878907v-214.359375c0-49.367187-40.261719-89.535156-89.738281-89.535156zm-246.023438 202.242188c8.28125 0 15 6.707031 15 14.996093 0 8.28125-6.71875 15-15 15h-56.609375v36.609375c0 8.28125-6.71875 15-15 15-8.289062 0-15-6.722656-15-15v-121.683594c0-21.050781 17.121094-38.179687 38.171875-38.179687h48.4375c8.28125 0 15 6.722656 15 15 0 8.289063-6.71875 15-15 15h-48.4375c-4.511719 0-8.171875 3.667969-8.171875 8.179687v55.078126zm130.75 66.605468c0 8.28125-6.71875 15-15 15-8.277343 0-15-6.71875-15-15v-37.425781h-41.609375v37.425781c0 8.28125-6.71875 15-15 15-8.289062 0-15-6.71875-15-15v-109.054687c0-28.007813 22.792969-50.808594 50.800782-50.808594 28.019531 0 50.808593 22.800781 50.808593 50.808594zm133.132813 15h-62.691406c-28.007813 0-50.800782-22.789062-50.800782-50.808594v-73.246093c0-28.007813 22.792969-50.808594 50.800782-50.808594 28.019531 0 50.808593 22.800781 50.808593 50.808594v94.054687h11.882813c8.277344 0 15 6.710938 15 15 0 8.28125-6.722656 15-15 15zm0 0" />
                    </svg>
                    <!--<span class="drawer-menu-text"></span>-->
                </a>
            </li>
            <li class="drawer-menu-item active mt-3">
                <a href="#">
                    <i class="fas fa-file-invoice-dollar" data-toggle="tooltip" data-placement="right"
                        title="Payment"></i>
                    <!--<span class="drawer-menu-text"></span>-->
                </a>
            </li>
            <li class="drawer-menu-item mt-3">
                <a href="{{ env('Shop_URL') }}/pages/settings">
                    <i class="fas fa-cog" data-toggle="tooltip" data-placement="right" title="Settings"></i>
                    <!--<span class="drawer-menu-text">Setting</span>-->
                </a>
            </li>
            <li class="drawer-menu-item mt-3 mb-5 pb-5">
                <a href="{{ env('Shop_URL') }}/pages/account/logout">
                    <i class="fas fa-sign-out-alt" data-toggle="tooltip" data-placement="right" title="Logout"></i>
                    <!--<span class="drawer-menu-text">Logout</span>-->
                </a>
            </li>
        </ul>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 pl-5 mx-auto mt-5 pt-5">

        <div class="col-md-12 float-left galleryBack">
            <a href="javascript&colon; history.go(-1)"><span><i class="fas fa-arrow-left"></i></span></a>
        </div>

        <div class="leftPart col-md-8 col-xs-12 float-left pl-3 pr-0 mt-2">
            <div class="row px-3 mt-2 mb-0 mb-md-3">
                <div class="col-12 px-0 landingHeading">
                    <h4 class="mb-4">
                        <span>My Designs</span>
                    </h4>
                </div>

                <div class="col-12 px-0 mb-4">
                    <div class="row px-0 designCards">
                        @foreach ($designs as $design )
                        <div class="col-sm-4">
                            <div class="card">
                                @if($design->collectionImages()->count() == 0)

                                <img alt="Cover" class="card-img cover-photo" src="{{  asset('uploads/collection/images/design1.jpg') }}" />
                                @else
                                <img alt="Cover" class="card-img cover-photo" src="{{  asset('uploads/collection/'.$design->id.'/'.$design->collectionImages()->first()->img_src) }}">

                                @endif
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="author-img">
                                            <img src="images/person-2.jpg" alt="Person"
                                                class="img-fluid rounded-circle mr-1" style="width:35px">
                                        </div>
                                        <div class="author-info">
                                            <p class="mb-0">{{ $design->design_name }}</p>
                                            <span class="newDesinIcon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="42.015" height="33.612"
                                                    viewBox="0 0 42.015 33.612">
                                                    <path id="Icon_material-fiber-new"
                                                        data-name="Icon material-fiber-new"
                                                        d="M40.813,6H7.2a4.169,4.169,0,0,0-4.18,4.2L3,35.41a4.187,4.187,0,0,0,4.2,4.2H40.813a4.187,4.187,0,0,0,4.2-4.2V10.2A4.187,4.187,0,0,0,40.813,6ZM16.655,29.108H14.134L8.777,21.756v7.353H6.151V16.5H8.777l5.252,7.353V16.5h2.626Zm10.5-9.958H21.907V21.5h5.252V24.15H21.907v2.332h5.252v2.626h-8.4V16.5h8.4v2.647Zm14.705,7.857a2.107,2.107,0,0,1-2.1,2.1h-8.4a2.107,2.107,0,0,1-2.1-2.1V16.5h2.626v9.474h2.374V18.583h2.626v7.374h2.353V16.5h2.626Z"
                                                        transform="translate(-3 -6)" fill="#ff7f00" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <p class="card-text">$ {{ $design->room_budget }}</p>
                                </div>
                                <div class="card-footer d-flex">
                                    <a href="#" class="social social-instagram mr-3"><i
                                            class="fab fa-instagram"></i></a>
                                    <a href="#" class="social social-facebook text-facebook mr-3"><i
                                            class="fab fa-facebook"></i></a>
                                    <a href="#" class="social social-twitter mr-3"><i class="fab fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                        @endforeach


                    </div>
                </div>


            </div>

        </div>

        <div class="rightPart col-md-4 col-xs-12 float-left pr-0 mb-4">
            <div class="card chatBoxWrap noteBoxWrap mt-4">
                <div class="card-header d-flex align-items-center justify-content-between bg-white">
                    <div class="card-title mb-0">Notifications</div>
                </div>
                <ul class="list-group list-group-flush">

                </ul>
            </div>


            <div class="card chatBoxWrap mt-4">
                <div class="card-header d-flex align-items-center justify-content-between bg-white">
                    <div class="card-title mb-0">Chat</div>
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Refresh">
                        <i class="fas fa-sync align-middle md-18"></i>
                    </a>
                </div>
                <ul class="list-group list-group-flush">



                </ul>
            </div>
        </div>

    </div>
</div>

<div class="row footerWrap">
    <footer></footer>
</div>
