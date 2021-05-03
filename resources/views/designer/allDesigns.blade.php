<div class="row align-items-center h-100">

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
                                <div class="card-img projectImg">
                                @if($design->collectionImages()->count() == 0)

                                <img alt="Cover" class="card-img cover-photo" src="{{  asset('default/design1.jpg') }}" />
                                @else
                                <img alt="Cover" class="card-img cover-photo" src="{{  asset('uploads/collection/'.$design->id.'/'.$design->collectionImages()->first()->img_src) }}">

                                @endif
                                </div>
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center mb-2">
                                        @if($design->designer()->display_picture)
                                        <div class="author-img">
                <img alt="Person" class="img-fluid rounded-circle mr-1" src="{{ asset('default/user.png') }}" style="width:35px">
                                        </div>
                @else
                <div class="author-img">
                    <img alt="Person" class="img-fluid rounded-circle mr-1" src="{{ asset('uploads/designer/display_picture/'.$design->designer->display_picture) }}" style="width:35px">
                </div>
                @endif
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
