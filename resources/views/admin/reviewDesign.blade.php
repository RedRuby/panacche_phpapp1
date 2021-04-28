@foreach($design as $design)

<div class="row align-items-center h-100">
    <div class="leftSideNav h-100 position-fixed">
        <ul class="drawer-menu px-3 pb-5 mb-5 text-center" id="dasboardMenu" data-children=".drawer-submenu">
            <li class="drawer-menu-item mt-4">
                <a href="{{ env('shop.url') }}/account/">
                    <i class="fas fa-th" data-toggle="tooltip" data-placement="right" title="Dashboard"></i>
                    <!--<span class="drawer-menu-text">Dashboard</span>-->
                </a>
            </li>
            <li class="drawer-menu-item mt-3">
                <a href="{{ env('shop.url') }}">
                    <i class="fas fa-home" data-toggle="tooltip" data-placement="right" title="Home"></i>
                    <!--<span class="drawer-menu-text">Home</span>-->
                </a>
            </li>
            <li class="drawer-menu-item mt-3">
                <a href="{{ env('shop.url') }}/pages/gallery">
                    <i class="fas fa-images" data-toggle="tooltip" data-placement="right" title="Gallery"></i>
                    <!--<span class="drawer-menu-text"></span>-->
                </a>
            </li>
            <li class="drawer-menu-item mt-3">
                <a href="{{ env('shop.url') }}/pages/our-designers">
                    <i class="fas fa-drafting-compass" data-toggle="tooltip" data-placement="right" title="Our Designers"></i>
                    <!--<span class="drawer-menu-text"></span>-->
                </a>
            </li>
            <li class="drawer-menu-item mt-3">
                <a href="{{ env('shop.url') }}/pages/blog">
                    <i class="fab fa-blogger-b" data-toggle="tooltip" data-placement="right" title="Blogs"></i>
                    <!--<span class="drawer-menu-text"></span>-->
                </a>
            </li>
            <li class="drawer-menu-item mt-3">
                <a href="{{ env('shop.url') }}/pages/our-mission">
                    <i class="fas fa-crosshairs" data-toggle="tooltip" data-placement="right" title="Our Mission"></i>
                    <!--<span class="drawer-menu-text"></span>-->
                </a>
            </li>
            <li class="drawer-menu-item mt-3">
                <a href="{{ env('shop.url') }}/pages/contact-us">
                    <i class="fas fa-phone-alt" data-toggle="tooltip" data-placement="right" title="Contact"></i>
                    <!--<span class="drawer-menu-text"></span>-->
                </a>
            </li>
            <li class="drawer-menu-item mt-3">
                <a href="{{ env('shop.url') }}/pages/faq">
                    <svg height="17pt" viewBox="0 -26 512 512" width="17pt" xmlns="http://www.w3.org/2000/svg" data-toggle="tooltip" data-placement="right" title="FAQ">
                        <path d="m377.429688 138.984375c-11.46875 0-20.800782 9.339844-20.800782 20.808594v73.246093c0 11.46875 9.332032 20.808594 20.800782 20.808594h20.808593v-94.054687c0-11.46875-9.328125-20.808594-20.808593-20.808594zm0 0"/>
                        <path d="m256.179688 138.984375c-11.46875 0-20.800782 9.339844-20.800782 20.808594v41.628906h41.609375v-41.628906c0-11.46875-9.328125-20.808594-20.808593-20.808594zm0 0"/>
                        <path d="m422.261719 0h-331.441407c-50.082031 0-90.820312 40.648438-90.820312 90.605469v338.867187c0 11.996094 7.28125 22.957032 18.558594 27.925782 3.980468 1.75 8.210937 2.601562 12.402344 2.601562 7.5 0 14.890624-2.738281 20.617187-7.949219 41.550781-37.589843 95.320313-58.289062 151.421875-58.289062h.019531l219.300781.011719c49.449219 0 89.679688-40.320313 89.679688-89.878907v-214.359375c0-49.367187-40.261719-89.535156-89.738281-89.535156zm-246.023438 202.242188c8.28125 0 15 6.707031 15 14.996093 0 8.28125-6.71875 15-15 15h-56.609375v36.609375c0 8.28125-6.71875 15-15 15-8.289062 0-15-6.722656-15-15v-121.683594c0-21.050781 17.121094-38.179687 38.171875-38.179687h48.4375c8.28125 0 15 6.722656 15 15 0 8.289063-6.71875 15-15 15h-48.4375c-4.511719 0-8.171875 3.667969-8.171875 8.179687v55.078126zm130.75 66.605468c0 8.28125-6.71875 15-15 15-8.277343 0-15-6.71875-15-15v-37.425781h-41.609375v37.425781c0 8.28125-6.71875 15-15 15-8.289062 0-15-6.71875-15-15v-109.054687c0-28.007813 22.792969-50.808594 50.800782-50.808594 28.019531 0 50.808593 22.800781 50.808593 50.808594zm133.132813 15h-62.691406c-28.007813 0-50.800782-22.789062-50.800782-50.808594v-73.246093c0-28.007813 22.792969-50.808594 50.800782-50.808594 28.019531 0 50.808593 22.800781 50.808593 50.808594v94.054687h11.882813c8.277344 0 15 6.710938 15 15 0 8.28125-6.722656 15-15 15zm0 0"/>
                    </svg>
                    <!--<span class="drawer-menu-text"></span>-->
                </a>
            </li>
            <li class="drawer-menu-item active mt-3">
                <a href="#">
                    <i class="fas fa-file-invoice-dollar" data-toggle="tooltip" data-placement="right" title="Payment"></i>
                    <!--<span class="drawer-menu-text"></span>-->
                </a>
            </li>
            <li class="drawer-menu-item mt-3">
                <a href="{{ env('shop.url') }}/pages/settings">
                    <i class="fas fa-cog" data-toggle="tooltip" data-placement="right" title="Settings"></i>
                    <!--<span class="drawer-menu-text">Setting</span>-->
                </a>
            </li>
            <li class="drawer-menu-item mt-3 mb-5 pb-5">
                <a href="{{ env('shop.url') }}/account/logout">
                    <i class="fas fa-sign-out-alt" data-toggle="tooltip" data-placement="right" title="Logout"></i>
                    <!--<span class="drawer-menu-text">Logout</span>-->
                </a>
            </li>
        </ul>
    </div>


    <div class="col-md-12 col-sm-12 col-xs-12 mx-auto pl-5 createNewForm createNewFormView pt-5">



        < class="col-12 px-3 landingHeading float-left">
            <h4 class="mb-4">
                <span class="float-left mr-4">New Design Approval</span>
            </h4>
        </>
        <div class="col-12 px-3 float-left">
            <h6 class="mb-4">
                <span class="float-left mr-4 mt-3 mb-3"><strong>Design Name:</strong>
                    {{ $design->design_name }}</span>
                <div class="float-left float-sm-right float-md-right mb-4 mb-mb-0 d-block d-sm-flex">
                    <form id="add-remark-form">
                        <input type="hidden" name="shop" value="{{ env('Shop_NAME')}}" />
                    <a class="" href="#" id="remerkDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <button type="button"
                            class="btn btn-primary cancelBtn float-none float-sm-left float-md-right mr-0 mr-sm-3 pr-3 mb-3" id="add-remark-btn" data="{{ $design->id }}">Comments
                            for the Designer
                            <i class="fas fa-flag ml-2"></i>
                        </button>
                    </a>
                    <div class="dropdown-menu viewRemarkdrop remarkAdddrop p-2" aria-labelledby="remerkDropdown">

                            <p class="mb-0">
                                <textarea class="form-control textarea" rows="4" placeholder="Type here" name="remark" id="remark"></textarea>
                                <button type="button" class="btn btn-primary cancelBtn float-right mt-2 p-1" id="submit-remark-btn" data="{{ $design->id }}">Submit</button>
                            </p>


                    </div>
                </form>
                    <a href="#">
                        <button type="button"
                            class="btn btn-primary approveBtn float-none float-sm-left float-md-right pr-3 mr-0 mr-sm-3 mb-3" id="approve-design-btn" data="{{ $design->id }}">Approve
                            this design
                            <i class="fas fa-check-circle ml-2"></i>
                        </button>
                    </a>
                    <a href="#">
                        <button type="button"
                            class="btn btn-primary rejectBtn float-none float-sm-left float-md-right pr-3 mb-3" id="reject-design-btn" data="{{ $design->id }}">Reject
                            this design
                            <i class="fas fa-times-circle ml-2"></i>
                        </button>
                    </a>
                    <a href="#">
                        <button type="button"
                            class="btn btn-primary cancelBtn float-none float-sm-left float-md-right pr-3 mr-0 ml-sm-3 mb-3" id="reassign-design-btn" data="{{ $design->id }}">Reassign
                            Designer</button>
                    </a>
                </div>
            </h6>
        </div>

        <div class="col-12 px-3 stepsWrap float-left mb-4">
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-6 float-left">
                    <p class="stepsCount mb-1 pl-4 ml-1">Step 1</p>
                    <p class="stepsName">
                        <span class="notComplated mr-2 greenActive"></span>
                        <span class="greenActiveText">Add Room Details</span>
                    </p>
                </div>
                <div class="col-lg-1 float-left px-0 d-none d-lg-block">
                    <p class="stepArrow mb-0">
                        <i class="fas fa-caret-right"></i>
                    </p>
                    <p class="stepLine mb-0 mt-4"></p>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6 float-left">
                    <p class="stepsCount mb-1 pl-4 ml-1">Step 2</p>
                    <p class="stepsName">
                        <span class="notComplated mr-2 greenActive"></span>
                        <span class="greenActiveText">Add Merchandise</span>
                    </p>
                </div>
                <div class="col-lg-1 float-left px-0 d-none d-lg-block">
                    <p class="stepArrow mb-0">
                        <i class="fas fa-caret-right"></i>
                    </p>
                    <p class="stepLine mb-0 mt-4"></p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 float-left">
                    <p class="stepsCount mb-1 pl-4 ml-1">Step 3</p>
                    <p class="stepsName">
                        <span class="notComplated mr-2 greenActive"></span>
                        <span class="greenActiveText">Submit Design For Approval</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="leftPart col-md-5 col-xs-12 float-left px-3">
            <div class="registerForm col-md-12 col-xs-12 float-left px-0">
                <form class="mx-0">
                    <div class="col-12 px-0 float-left mb-3">
                        <div class="form-group col-6 float-left pl-0">
                            <label for="">Design Name</label>
                            <p class="mb-0">{{ $design->design_name }}</p>
                        </div>
                        <div class="form-group col-6 float-left pr-0">
                            <label for="">Due Date</label>
                            <p class="mb-0"></p>
                        </div>
                    </div>

                    <div class="col-12 px-0 float-left mb-3">
                        <div class="form-group col-6 float-left pl-0">
                            <label for="">Design Price</label>
                            <p class="mb-0">$ {{ $design->design_price }}</p>
                        </div>
                        <div class="form-group col-6 float-left pr-0">
                            <label for="">Room Budget</label>
                            <p class="mb-0">$ {{ $design->room_budget }}</p>
                        </div>
                    </div>

                    <div class="col-12 px-0 float-left mb-3">
                        <div class="form-group col-6 float-left pl-0">
                            <label for="">Room Type</label>
                            <p class="mb-0">{{ $design->room_type }}</p>
                        </div>
                        <div class="form-group col-6 float-left pr-0">
                            <label for="">Room Style</label>
                            <p class="mb-0">{{ $design->room_style }}</p>
                        </div>
                    </div>

                    <div class="col-12 px-0 mb-3 float-left mb-3">
                        <label for="" class="mr-3">Is this a Pet Friendly Design?</label>
                        <span>{{ $design->pet_friendly_design }}</span>
                    </div>

                    <div class="col-12 px-0 float-left mb-3">
                        <label for="" class="w-100">Approximate Room Size </label>
                        <div class="form-group col-12 float-left px-0 mb-0">
                            <p class="col-12 float-left pl-0">
                                <span>{{ $design->room_width_in_feet }} feet {{ $design->room_width_in_inches }}
                                    inches </span>
                                <span class="mx-4 pt-2"><i class="fas fa-times"></i></span>
                                <span>{{ $design->room_height_in_feet }} feet {{ $design->room_height_in_inches }}
                                    inches </span>
                            </p>
                        </div>
                    </div>

                    <div class="col-12 px-0 float-left mb-3">
                        <label for="">Design Description</label>
                        <p>{{ $design->implementation_guide_description }}</p>
                    </div>

                    <div class="col-12 px-0 float-left">
                        <label for="" class="w-100">Design Implementation Guide</label>
                    <span><a href="{{ asset('/uploads/'.$design->id) }}/{{ $design->design_implementation_guide }}"></a></span>
                    </div>

                </form>
            </div>

        </div>

        <div class="rightPart col-md-7 col-xs-12 float-left px-sm-3 mt-md-0 mt-4">
            <label for="" class="col-12 px-0">Media</label>
            <p>3D rendered Images</p>
            <div class="col-md-12 col-xs-12 float-left px-0 mb-3">
                <div class="row">
                    @if ($design->collectionImages->count() == 0)
                        <p class="col-md-3 col-sm-6 col-6 uploadedImagesView">
                            <img alt="Cover" class="img-fluid"
                                src="{{ asset('default/design.jpg') }}" />
                        </p>
                    @else

                        @foreach ($design->collectionImages as $collectionImage)
                            <p class="col-md-3 col-sm-6 col-6 uploadedImagesView"><img class="img-fluid"
                                    src="{{ asset('uploads/collection/'.$design->id.'/' . $collectionImage->img_src) }}"></p>
                        @endforeach

                    @endif
                </div>
            </div>

            <p>Concept Board</p>
            <div class="col-md-12 col-xs-12 float-left px-0 mb-3">
                <div class="row">
                    @if ($design->bluePrintImages->count() == 0)
                      <p class="col-md-3 col-sm-6 col-6 uploadedImagesView">
                            <img alt="Cover" class="img-fluid"
                                src="{{ asset('default/concept_board.jpg') }}" />
                        </p>
                    @else

                        @foreach ($design->bluePrintImages as $bluePrintImage)
                            <p class="col-md-3 col-sm-6 col-6 uploadedImagesView"><img class="img-fluid"
                                    src="{{ asset('uploads/collection/'.$design->id.'/' . $bluePrintImage->img_src) }}"></p>
                        @endforeach

                    @endif
                </div>
            </div>

            <label for="" class="col-12 px-0">Paint Pallette</label>
            @if($design->colorPallettes->count() == 0)
            <div class="dragandDropWrap col-md-12 col-xs-12 float-left px-3"></div>
            @else
            <div class="dragandDropWrap col-md-12 col-xs-12 float-left px-3">
                <table class="table colorPaintTable colorPaintTableView mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Color</th>
                            <th scope="col">Color Name</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Finish</th>
                            <th scope="col">Application</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($design->colorPallettes as $colorPallette)

                            <tr>
                                <td>
                                    <div class="col-12 float-left px-0">
                                        <p class="custom-file addColor brownColor"
                                            style="background-image: url('{{ asset('uploads/collection/'.$design->id.'/' . $colorPallette->color_img) }}'); background-size:cover; background-position:center;">

                                        </p>
                                    </div>
                                </td>
                                <td>{{ $colorPallette->color_name }}</td>
                                <td>{{ $colorPallette->brand }}</td>
                                <td>{{ $colorPallette->finish }}</td>
                                <td>{{ $colorPallette->application }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

        </div>
    </div>


</div>

<div class="row mt-4 px-3">
    <div class="col-md-12 float-left mb-5 pl-5">
        <label for="" class="col-12 px-0 font14">Added Merchandise</label>
        <div class="addRefWrap col-12 float-left py-3 mb-3">

            @if ($design->products->count() == 0)
                <div class="col-12 float-left px-0 addmerchBoxWrap"></div>
            @else
                @foreach ($design->products as $key=>$product)
                    <div class="col-12 float-left px-0 addmerchBoxWrap">
                        <label for="" class="col-12 px-0 mb-0">{{ $key +1 }}</label>

                        <div class="row addmerchBox borderradius6 mt-1 mx-0 pt-3">
                            <div class="col-md-4 float-left">
                                <p>Merchandise</p>
                                <p>{{ $product->title }} </p>
                                <p>Vendor</p>
                                <p>{{ $product->vendor->vendor_name }}</p>

                                <div class="col-6 px-0 float-left colorVariants">
                                    <p class="mb-1">Quantity</p>
                                    <p>{{ $product->product_quantity }}</p>
                                </div>
                            </div>
                            <div class="col-md-4 float-left">
                                <p>Specification</p>
                                <p>{{ $product->size_specification }}</p>
                                <p>URL</p>
                                <p>{{ $product->product_url }}</p>
                                <div class="col-6 px-0 float-left">
                                    <p>Retail Price</p>
                                    <p>$ {{ $product->product_price }}</p>
                                </div>

                            </div>
                            <div class="col-md-4 float-left">
                                <p>Product Image</p>
                                @if ($product->productImages->count() == 0)

                                @else

                                    @foreach ($product->productImages as $product)
                                        <div class="border border-ligh">
                                            <p><img src="{{ asset('uploads/collection/'.$design->id.'/'. $product->img_src) }}"
                                                    class="img-fluid"></p>
                                        </div>

                                    @endforeach
                                @endif



                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>

        <div class="row text-left px-0">
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-12 col-12 float-left">
                <button type="button" class="btn btn-primary cancleBtn w-auto"><i class="fas fa-exclamation mr-2"></i>
                    Add Disclaimer</button>
                <p><em>This disclaimer is particular to this design only.</em></p>
            </div>
            <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12 float-left">
                <div class="disclaimerBox col-12 float-left py-3">
                    <div class="mb-0">
                        <form id="disclaimer-form">
                            <input type="hidden" name="shop" value="{{ env('Shop_NAME') }}" />
                            <textarea class="form-control textarea" rows="4" placeholder="Type here"></textarea>
                            <p>
                                <button type="button" class="btn btn-primary cancelBtn float-right mt-2 p-1">Cancel</button>
                                <button type="button"
                                class="btn btn-primary cancelBtn float-right mt-2 p-1 mr-2" data="{{ $design->id }}" id="submit-disclaimer-btn">Submit</button>
                            </p>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="row footerWrap">
    <footer></footer>
</div>

@endforeach
