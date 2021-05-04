@foreach ($design as $design)

    <div class="row align-items-center h-100">
        <div class="col-md-12 col-sm-12 col-xs-12 mx-auto pl-5 createNewForm createNewFormView pt-5">

            <div class="col-12 px-3 landingHeading mt-4 float-left">
                <h4 class="mb-4">
                    <span class="float-left mr-4 mb-4">Create New Design</span>
                </h4>
                <div class="form-group float-left">
                    <select class="custom-select selectDropdown" disabled="disabled" aria-readonly="">
                        <option @if ($design->status == 'draft') selected @endif>Draft</option>
                        <option @if ($design->status == 'approved') selected @endif>Published</option>
                        <option @if ($design->status == 'rejected') selected @endif>Inactive</option>
                        <option @if ($design->status == 'submitted') selected @endif>Under Review</option>

                    </select>
                </div>
                <div class="float-left float-sm-right float-md-right mb-4 mb-mb-0">
                    <a href="landing_page.html">
                        <button type="button" class="btn btn-primary cancelBtn float-right removeDesignbtn pr-5"
                            id="remove-design-btn" data-id="{{ $design->id }}"
                            data-designer="{{ $design->designer->id }}">Remove this design
                            <i class="fas fa-times-circle newDesignClose"></i>
                        </button>
                    </a>
                    <a class="" href="#" id="remerkDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <button type="button" class="btn btn-primary cancelBtn float-right mr-3">View Remarks</button>
                    </a>
                    <div class="dropdown-menu viewRemarkdrop p-2" aria-labelledby="remerkDropdown">
                        <p class="mb-0">{{ $design->remark }}</p>
                    </div>
                </div>
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
                                    <span>{{ $design->room_height_in_feet }} feet
                                        {{ $design->room_height_in_inches }} inches </span>
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
                                <img alt="Cover" class="card-img cover-photo"
                                    src="{{ asset('uploads/collection/images/design.jpg') }}" />
                            </p>
                        @else

                            @foreach ($design->collectionImages as $collectionImage)
                                <p class="col-md-3 col-sm-6 col-6 uploadedImagesView"><img class="img-fluid"
                                        src="{{ asset('uploads/collection/'. $design->id.'/' . $collectionImage->img_src) }}">
                                </p>
                            @endforeach
                        @endif
                    </div>
                </div>

                <p>Concept Board</p>
                <div class="col-md-12 col-xs-12 float-left px-0 mb-3">
                    <div class="row">
                        @if ($design->bluePrintImages->count() == 0)
                            <p class="col-md-3 col-sm-6 col-6 uploadedImagesView"></p>
                        @else

                            @foreach ($design->bluePrintImages as $bluePrintImage)
                                <p class="col-md-3 col-sm-6 col-6 uploadedImagesView"><img class="img-fluid"
                                        src="{{ asset('uploads/collection/'. $design->id. '/' . $bluePrintImage->img_src) }}">
                                </p>
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
                    @foreach ($design->products as $product)
                        <div class="col-12 float-left px-0 addmerchBoxWrap">
                            <label for="" class="col-12 px-0 mb-0">1</label>

                            <div class="row addmerchBox borderradius6 mt-1 mx-0 pt-3">
                                <div class="col-md-4 float-left">
                                    <p>Merchandise</p>
                                    <p>{{ $product->title }}</p>
                                    <p>Vendor</p>
                                    <p>{{ $product->vendor->vendor_name }}</p>

                                    <div class="col-6 px-0 float-left colorVariants">
                                        <p class="">Quantity</p>
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
                                            <div class="col-12 float-left viewProductImg px-0 mb-3">
                                                <p><img
                                                        src="{{ asset('uploads/collection/'.$design->id. '/' . $product->img_src) }}">
                                                </p>
                                            </div>

                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
    </div>

    <div class="row footerWrap">
        <footer></footer>
    </div>

@endforeach

<div class="modal fade" tabindex="-1" id="confirm-remove-design-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Remove Design</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this design?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary loginBtn" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary loginBtn" id="remove-design-yes-btn">Yes</button>
            </div>
        </div>
    </div>
</div>
