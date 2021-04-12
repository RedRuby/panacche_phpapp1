@foreach($design as $design)

<div class="row align-items-center h-100">
    <div class="leftSideNav h-100 position-fixed">
        <ul class="drawer-menu px-3 pb-5 mb-5 text-center" data-children=".drawer-submenu" id="dasboardMenu">
            <li class="drawer-menu-item mt-2">
                <a href="#">
                    <i class="fas fa-bars" data-placement="right" data-toggle="tooltip" title="Menu"></i>
                    <!--<span class="drawer-menu-text"></span>-->
                </a>
            </li>
            <li class="drawer-menu-item mt-4">
                <a href="{{ env('Shop_URL') }}/account/myaccount">
                    <i class="fas fa-th" data-placement="right" data-toggle="tooltip" title="Dashboard"></i>
                    <!--<span class="drawer-menu-text">Dashboard</span>-->
                </a>
            </li>
            <li class="drawer-menu-item mt-3">
                <a href="{{ env('Shop_URL') }}">
                    <i class="fas fa-home" data-placement="right" data-toggle="tooltip" title="Home"></i>
                    <!--<span class="drawer-menu-text">Home</span>-->
                </a>
            </li>
            <li class="drawer-menu-item mt-3">
                <a href="{{ env('Shop_URL') }}/pages/gallery">
                    <i class="fas fa-images" data-placement="right" data-toggle="tooltip" title="Gallery"></i>
                    <!--<span class="drawer-menu-text"></span>-->
                </a>
            </li>
            <li class="drawer-menu-item mt-3">
                <a href="#">
                    <i class="fas fa-phone-alt" data-placement="right" data-toggle="tooltip" title="Contact"></i>
                    <!--<span class="drawer-menu-text"></span>-->
                </a>
            </li>
            <li class="drawer-menu-item mt-3">
                <a href="#">
                    <i class="fas fa-crosshairs" data-placement="right" data-toggle="tooltip" title="Our Mission"></i>
                    <!--<span class="drawer-menu-text"></span>-->
                </a>
            </li>
            <li class="drawer-menu-item active mt-3">
                <a href="#">
                    <i class="fas fa-file-invoice-dollar" data-placement="right" data-toggle="tooltip"
                        title="Payment"></i>
                    <!--<span class="drawer-menu-text"></span>-->
                </a>
            </li>
            <li class="drawer-menu-item mt-3">
                <a href="#">
                    <i class="fas fa-cog" data-placement="right" data-toggle="tooltip" title="Settings"></i>
                    <!--<span class="drawer-menu-text">Setting</span>-->
                </a>
            </li>
            <li class="drawer-menu-item mt-3 mb-5 pb-5">
                <a href="login.html">
                    <i class="fas fa-sign-out-alt" data-placement="right" data-toggle="tooltip" title="Logout"></i>
                    <!--<span class="drawer-menu-text">Logout</span>-->
                </a>
            </li>
        </ul>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12 mx-auto pl-5 createNewForm createNewFormView">

        <div class="logo col-12 float-left mb-4 px-3 mt-4"><img
                src="https://cdn.shopify.com/s/files/1/0529/0255/9930/t/3/assets/panacche_logo.png?v=14350055876468133888">
        </div>

        <div class="col-12 px-3 landingHeading float-left">
            <h4 class="mb-4">
                <span class="float-left mr-4">New Design Approval</span>
            </h4>
        </div>
        <div class="col-12 px-3 float-left">
            <h6 class="mb-4">
                <span class="float-left mr-4 mt-3 mb-3"><strong>Design Name:</strong>
                    {{ $design->design_name }}</span>
                <div class="float-left float-sm-right float-md-right mb-4 mb-mb-0 d-block d-sm-flex">
                    <form id="add-remark-btn">
                    <a class="" href="#" id="remerkDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <button type="button"
                            class="btn btn-primary cancelBtn float-none float-sm-left float-md-right mr-0 mr-sm-3 pr-3 mb-3" id="add-remark-btn" data="{{ $design->id }}">Remarks
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
                        <span>{{ $design->design_implementation_guide }}</span>
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
                                src="{{ asset('uploads/collection/images/design1.jpg') }}" />
                        </p>
                    @else

                        @foreach ($design->collectionImages as $collectionImage)
                            <p class="col-md-3 col-sm-6 col-6 uploadedImagesView"><img class="img-fluid"
                                    src="{{ asset('uploads/collection/images/' . $collectionImage->img_src) }}"></p>
                        @endforeach

                    @endif
                </div>
            </div>

            <p>Concept Board</p>
            <div class="col-md-12 col-xs-12 float-left px-0 mb-3">
                <div class="row">
                    @if ($design->bluePrintImages->count() == 0)
                       <!-- <p class="col-md-3 col-sm-6 col-6 uploadedImagesView">
                            <img alt="Cover" class="img-fluid"
                                src="{{ asset('uploads/collection/images/design1.jpg') }}" />
                        </p>-->
                    @else

                        @foreach ($design->bluePrintImages as $bluePrintImage)
                            <p class="col-md-3 col-sm-6 col-6 uploadedImagesView"><img class="img-fluid"
                                    src="{{ asset('uploads/collection/blue_prints/' . $bluePrintImage->img_src) }}"></p>
                        @endforeach

                    @endif
                </div>
            </div>

            <label for="" class="col-12 px-0">Paint Pallette</label>
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
                                            style="background-image: url('{{ asset('uploads/collection/color_pallates/' . $colorPallette->color_img) }}'); background-size:cover; background-position:center;">
                                            {{-- <img src="{{  asset('uploads/collection/color_pallates/'.$colorPallette->color_img) }}" /> --}}
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
                                <div class="col-6 px-0 float-left colorVariants">
                                    <p>Price</p>
                                    <p>$ {{ $product->product_price }}</p>
                                </div>
                            </div>
                            <div class="col-md-4 float-left">
                                <p>Product Image</p>
                                @if ($product->productImages->count() == 0)

                                @else

                                    @foreach ($product->productImages as $product)
                                        <div class="border border-ligh">
                                            <p><img src="{{ asset('uploads/collection/product/images/' . $product->img_src) }}"
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
                        <textarea class="form-control textarea" rows="4" placeholder="Type here"></textarea>
                        <p>
                            <button type="button" class="btn btn-primary cancelBtn float-right mt-2 p-1">Cancel</button>
                            <button type="button"
                                class="btn btn-primary cancelBtn float-right mt-2 p-1 mr-2">Submit</button>
                        </p>
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
