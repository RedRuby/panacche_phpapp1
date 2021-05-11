<div class="col-md-12 col-sm-12 col-xs-12 pl-5 mx-auto mt-4 pt-3">
    <div class="col-md-12 float-left backBtn">
       <div class="col-6 px-0 landingHeading">
                <h4 class="mb-2 mt-lg-2 mt-md-0 col-12 float-left px-0">
                   <span>My Projects</span>
                </h4>
             </div>
       <div class="float-right lastLogin">
          <p class="mb-0">Your Last Login was</p>
          <p class="mb-0">01/01/2021. 12:00 PM</p>
       </div>
    </div>
    <div class="leftPart col-xl-8 col-lg-8 col-md-12 col-12 float-left pl-3 pr-0 mt-4">
       <div class="row px-3">
            <div class="col-12 px-0 float-left">
                <div class="row px-0 designCards">
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 mb-4">
                        <div class="card addCancelDesignBox h-100">
                            <div class="card-body addCancelDesignBtns">
                                    <p class="card-text addNewDesign w-100">
                                        <span><i class="fas fa-plus-circle"></i></span>
                                        <span>Add new design</span>
                                    </p>
                                    <p class="card-text cancelNewDesign w-100" style="display: none;">
                                        <span><i class="fas fa-times-circle"></i></span>
                                        <span>Cancel</span>
                                    </p>
                            </div>
                            <div class="packageSelect w-100 px-3 PanaccheService" style="display: none;">
                                <p class="mb-2">Select the Panacche Service Type</p>
                                <a href="{{ env('Shop_URL') }}/pages/gallery"><button type="button" class="btn btn-primary loyalPkg text-left p-2 w-100 mb-3 rounded-0">LOYAL <i class="fas fa-angle-right ml-1 mt-1 float-right"></i></button></a>
                                <button type="button" class="btn btn-primary lavishPkg text-left p-2 w-100 mb-3 rounded-0">LAVISH <i class="fas fa-angle-right ml-1 mt-1 float-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 mb-4"></div>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 mb-4"></div>

                    @forelse ($myProjects as $value)
                        <a href="{{ env('Shop_URL') }}/pages/buy-design?id={{ $value->id }}">
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 mb-4">
                                <div class="card">
                                    <div class="completedTag">
                                        @if($value->my_project_design_guide_type == 1)
                                            <span>Draft</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="179.763" height="42.804" viewBox="0 0 179.763 42.804">
                                                <g id="Group_1816" data-name="Group 1816" transform="translate(-346.237 -231.196)">
                                                    <path id="Path_4277" data-name="Path 4277" d="M0,0H179.763V33H0L10.445,17.236Z" transform="translate(346.237 241)" fill="#FF930E"/>
                                                    <path id="Path_4276" data-name="Path 4276" d="M-125-9538.873v9.8h18Z" transform="translate(633 9770.069)" fill="#2e7038"/>
                                                </g>
                                            </svg>
                                        @else
                                            <span>Completed</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="179.763" height="42.804" viewBox="0 0 179.763 42.804">
                                                <g id="Group_1816" data-name="Group 1816" transform="translate(-346.237 -231.196)">
                                                    <path id="Path_4277" data-name="Path 4277" d="M0,0H179.763V33H0L10.445,17.236Z" transform="translate(346.237 241)" fill="#00b41c"/>
                                                    <path id="Path_4276" data-name="Path 4276" d="M-125-9538.873v9.8h18Z" transform="translate(633 9770.069)" fill="#2e7038"/>
                                                </g>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="card-img projectImg">
                                        <img src="{{ ($value->image_src != '') ? $value->image_src : 'https://panacchedev2.pagekite.me/uploads/collection/vendor_logo/altumcode-dC6Pb2JdAqs-unsplash.jpg'}}" class="card-img cover-photo" alt="Cover">
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="author-info">
                                                <p class="mb-0">
                                                    @if($value->my_project_design_guide_type == 1)
                                                        {{ "Draft Order - ".$value->design_name }}
                                                    @else
                                                        {{ $value->design_name }}
                                                    @endif
                                                    <i class="fas fa-edit ml-1"></i>
                                                    <i class="fas fa-exclamation-circle ml-1"></i>
                                                </p>
                                            </div>
                                        </div>
                                        <p class="card-text">$ {{ ($value->design_price != '') ? number_format($value->design_price, 2) : 'NA' }}</p>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="align-items-center mb-2">
                                            <div class="author-info">
                                                    @if($value->my_project_design_guide_type != 1)
                                                        <p class="mb-0 float-left"><i class="fas fa-check-square mr-1"></i> {{ $value->design_name }}</p>
                                                        {{--  <button type="button" class="btn btn-primary projectEditBtn float-right px-2 py-1"><i class="fas fa-pen mr-1"></i> Edit</button>  --}}
                                                    @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex float-left">
                                        <a href="{{ $value->twitter }}" class="social social-twitter mr-3"><i class="fab fa-twitter"></i></a>
                                        <a href="{{ $value->facebook }}" class="social social-facebook text-facebook mr-3"><i class="fab fa-facebook"></i></a>
                                        <a href="{{ $value->whatsapp }}" class="social social-whatsapp mr-3"><i class="fab fa-whatsapp"></i></a>
                                        </div>
                                        {{--  <button type="button" class="btn btn-primary projectEditBtn float-right px-2 py-1"><i class="fas fa-pen mr-1"></i> Edit</button>  --}}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="rightPart col-xl-4 col-lg-4 col-md-12 col-12 float-left pr-0">
       <div class="card chatBoxWrap noteBoxWrap mt-4">
          <div class="card-header d-flex align-items-center justify-content-between bg-white">
             <div class="card-title mb-0">Notifications</div>
          </div>
          <ul class="list-group list-group-flush">
             <li class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                <div class="media align-items-center">
                   <img src="https://panacchedev2.pagekite.me/uploads/collection/vendor_logo/altumcode-dC6Pb2JdAqs-unsplash.jpg" class="img-fluid mr-3" width="45" alt="User1">
                   <div class="media-body lh-1">
                      <a href="#">Beautiful Boy Room</a>
                      <div>
                         <small class="text-muted">I am rejecting this. Make this and this change</small>
                      </div>
                   </div>
                </div>
                <div class="noteDetails">
                   <p class="mb-0 text-right">01-01-2021</p>
                   <p class="mb-2 text-right">11:00 am</p>
                   <a href="#" class="viewMore text-right">View Details</a>
                </div>
             </li>
             <li class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                <div class="media align-items-center">
                   <img src="https://panacchedev2.pagekite.me/uploads/collection/vendor_logo/altumcode-dC6Pb2JdAqs-unsplash.jpg" class="img-fluid mr-3" width="45" alt="User2">
                   <div class="media-body lh-1">
                      <a href="#">New Design Approved</a>
                      <div>
                         <small class="text-muted">The New Design “Boy Room” is approved.</small>
                      </div>
                   </div>
                </div>
                <div class="noteDetails">
                   <p class="mb-0 text-right">01-01-2021</p>
                   <p class="mb-2 text-right">11:00 am</p>
                   <a href="#" class="viewMore text-right">View Details</a>
                </div>
             </li>
             <li class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                <div class="media align-items-center">
                   <img src="https://panacchedev2.pagekite.me/uploads/collection/vendor_logo/altumcode-dC6Pb2JdAqs-unsplash.jpg" class="img-fluid mr-3" width="45" alt="User3">
                   <div class="media-body lh-1">
                      <a href="#">New Design</a>
                      <div>
                         <small class="text-muted">I am rejecting this. Make this and this change</small>
                      </div>
                   </div>
                </div>
                <div class="noteDetails">
                   <p class="mb-0 text-right">01-01-2021</p>
                   <p class="mb-2 text-right">11:00 am</p>
                   <a href="#" class="viewMore text-right">View Details</a>
                </div>
             </li>
          </ul>
       </div>
    </div>


    @if(!empty($ratings))
        <div class="col-md-12 float-left pl-3 pr-0 mt-3">
            <div class="row px-3 mb-md-5">
                <div class="col-12 px-0 landingHeading">
                    <h4 class="mb-4 mt-4 mt-lg-0 col-12 float-left px-0">
                    <span>Panacche Recommended Designs just for you!</span>
                    </h4>
                </div>
                <div class="col-12 px-0 float-left">
                    <div class="row px-0 designCards">

                        @forelse ($ratings as $value)
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
                                <div class="card">
                                    <a href="{{ env('Shop_URL') }}/pages/buy-design?id={{ $value->id }}">
                                        <div class="card-img projectImg">
                                            <img src="{{ ($value->image_src != '') ? $value->image_src : 'https://panacchedev2.pagekite.me/uploads/collection/vendor_logo/altumcode-dC6Pb2JdAqs-unsplash.jpg' }}" class="card-img cover-photo" alt="{{ ($value->image_alt != '') ? $value->image_alt : 'Recommended Design' }}">
                                        </div>
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="author-info">
                                                    <p class="mb-0">{{ ($value->design_name != '') ? $value->design_name : 'Design' }}</p>
                                                </div>
                                            </div>
                                            <p class="card-text">$ {{ ($value->design_price != '') ? number_format($value->design_price, 2) : 'NA' }}</p>
                                        </div>
                                        <div class="card-footer d-flex">
                                            <a href="{{ $value->twitter }}" class="social social-twitter mr-3"><i class="fab fa-twitter"></i></a>
                                            <a href="{{ $value->facebook }}" class="social social-facebook text-facebook mr-3"><i class="fab fa-facebook"></i></a>
                                            <a href="{{ $value->whatsapp }}" class="social social-whatsapp mr-3"><i class="fab fa-whatsapp"></i></a>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @empty

                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<script type="text/javascript" src="{{ asset('js/share.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".addNewDesign").on("click", function() {
            $(".PanaccheService").toggle();
            $(".cancelNewDesign").toggle();
            $(".addNewDesign").toggle();
        });

        $(".cancelNewDesign").on("click", function() {
            $(".PanaccheService").toggle();
            $(".cancelNewDesign").toggle();
            $(".addNewDesign").toggle();
        });
    });
</script>
