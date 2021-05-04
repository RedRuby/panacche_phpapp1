<div class="row align-items-center h-100 nilesh">
    <div class="col-md-12 col-sm-12 col-xs-12 mx-auto pl-5 createNewForm pt-5">
        <div class="col-12 px-3 landingHeading float-left mt-4">
            <h4 class="mb-4">
                <span class="float-left mr-4">Create New Design</span>
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
                    @if ($design->status == 'draft' )

                    @else
                    <a class="" href="#" id="remerkDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <button type="button" class="btn btn-primary cancelBtn float-right mr-3">View Remarks</button>
                    </a>
                    <div class="dropdown-menu viewRemarkdrop p-2" aria-labelledby="remerkDropdown">
                        <p class="mb-0">{{ $design->remark }}</p>
                    </div>
                    @endif
                </div>
            </h4>
        </div>

        <form id="create-room-form" enctype="multipart/form-data">
            <input type="hidden" name="customer_id" value="{{ $design->designer->id }}" />
            <input type="hidden" name="shop" value="{{ env('Shop_NAME') }}" />
            <div class="col-12 px-3 stepsWrap float-left mb-4">
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-6 float-left">
                        <p class="stepsCount mb-1 pl-4 ml-1">Step 1</p>
                        <p class="stepsName">

                            @if ($design->count() == 0)
                                <span class="notComplated room-progress mr-2"></span>
                                <span class="">Add Room Details</span>
                            @else
                                <span class="notComplated room-progress greenActive mr-2"></span>
                                <span class="greenActiveText">Add Room Details</span>
                            @endif
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
                            @if ($design->products->count() == 0)
                                <span class="notComplated merchandise-progress  mr-2"></span>
                                <span>Add Merchandise</span>
                            @else
                                <span class="notComplated merchandise-progress greenActive mr-2"></span>
                                <span class="greenActiveText">Add Merchandise</span>
                            @endif
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
                            @if ($design->status == 'submitted')
                                <span class="notComplated submit-design-progress  greenActive mr-2"></span>
                                <span class="greenActiveText">Submit Design For Approval</span>
                            @else
                                <span class="notComplated submit-design-progress mr-2"></span>
                                <span>Submit Design For Approval</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="leftPart col-md-5 col-xs-12 float-left px-3">
                <div class="registerForm col-md-12 col-xs-12 float-left px-0">
                    <form class="mx-0">
                        <div class="form-group">
                            <label for="">Design Name</label>
                            <input type="text" class="form-control" placeholder="" name="design_name" id="design_name"
                                onkeyup="verifyInputs()" value="{{ $design->design_name }}">
                            <span class="validation_error"></span>
                        </div>
                        <div class="col-12 px-0">
                            <!--<div class="form-group col-4 float-left pl-0">
                                <label for="">Due Date</label>
                                <input type="text" class="form-control" placeholder="" name="due_Date" id="due_date" >
                                <span class="validation_error"></span>
                            </div>-->
                            <div class="form-group col-6 float-left px-0">
                                <label for="">Design Price</label>
                                <input type="number" class="form-control" placeholder="$" name="design_price"
                                    id="design_price" onkeyup="verifyInputs()" value="{{ $design->design_price }}">
                                <span class="validation_error"></span>
                            </div>
                            <div class="form-group col-6 float-left pr-0">
                                <label for="">Room Budget</label>
                                <input type="number" class="form-control" placeholder="$" name="room_budget"
                                    id="room_budget" onkeyup="verifyInputs()" value="{{ $design->room_budget }}">
                                <span class="validation_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Room Type</label>
                            <select class="custom-select selectDropdown" name="room_type" id="room_type">
                                <option value="0">Select Room Type</option>
                                <option  value="Family Room" @if ($design->room_type == 'Family Room') selected="selected" @endif>Family Room</option>
                                <option  value="Office" @if ($design->room_type == 'Office') selected="selected" @endif>Office</option>
                                <option value="Dining Room" @if ($design->room_type == 'Dining Room') selected="selected" @endif>Dining Room</option>
                                <option  value="Foyer" @if ($design->room_type == 'Foyer') selected="selected" @endif>Foyer</option>
                                <option  value="Bedroom" @if ($design->room_type == 'Bedroom') selected="selected" @endif>Bedroom</option>
                                <option  value="Mudroom" @if ($design->room_type == 'Mudroom') selected="selected" @endif>Mudroom</option>
                                <option  value="Nursery" @if ($design->room_type == 'Nursery') selected="selected" @endif>Nursery</option>
                                <option value="Kids Room" @if ($design->room_type == 'Kids Room') selected="selected" @endif>Kids Room</option>
                                <option  value="Living Room" @if ($design->room_type == 'Living Room') selected="selected" @endif>Living Room</option>
                                <option value="Patio" @if ($design->room_type == 'Patio') selected="selected" @endif>Patio</option>
                            </select>
                            <span class="validation_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Room Style</label>
                            <select class="custom-select selectDropdown" name="room_style" id="room_style">
                                <option value="0">Select Room Style</option>
                                <option value="Modern" @if ($design->room_style == 'Modern') selected="selected" @endif>Modern</option>
                                <option value="Traditional" @if ($design->room_style == 'Traditional') selected="selected" @endif>Traditional</option>
                                <option value="Transitional" @if ($design->room_style == 'Transitional') selected="selected" @endif>Transitional</option>
                                <option value="Glamorous" @if ($design->room_style == 'Glamorous') selected="selected" @endif>Glamorous</option>

                                <option value="Vintage" @if ($design->room_style == 'Vintage') selected="selected" @endif>Vintage</option>
                                <option value="Rustic" @if ($design->room_style == 'Rustic') selected="selected" @endif>Rustic</option>
                                <option value="Farmhouse" @if ($design->room_style == 'Farmhouse') selected="selected" @endif>Farmhouse</option>
                                <option value="Beach" @if ($design->room_style == 'Beach') selected="selected" @endif>Beach</option>
                                <option value="Minimal" @if ($design->room_style == 'Minimal') selected="selected" @endif>Minimal</option>

                                <option value="Mid-century" @if ($design->room_style == 'Mid-century') selected="selected" @endif>Mid-century</option>
                                <option value="Industrial" @if ($design->room_style == 'Industrial') selected="selected" @endif>Industrial</option>
                                <option value="Eclectic" @if ($design->room_style == 'Eclectic') selected="selected" @endif>Eclectic</option>
                                <option value="Bohemian" @if ($design->room_style == 'Bohemian') selected="selected" @endif>Bohemian</option>
                            </select>
                            <span class="validation_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="" class="w-100">Is this a Pet Friendly Design?</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pet_friendly_design"
                                    id="inlineRadio1" value="Yes"
                                    {{ $design->pet_friendly_design == 'Yes' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pet_friendly_design"
                                    id="inlineRadio2" value="No"
                                    {{ $design->pet_friendly_design == 'No' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio2">No</label>
                            </div>
                        </div>

                        <div class="col-12 px-0">
                            <label for="" class="w-100">Approximate Room Size </label>
                            <div class="form-group col-5 float-left px-0 mb-0">
                                <p class="italicLabel">Width</p>
                                <p class="col-6 float-left pl-0">
                                    <input type="number" class="form-control" placeholder="Feet" name="width_in_feet"
                                        id="width_in_feet" value="{{ $design->room_width_in_feet }}">
                                    <span class="validation_error"></span>
                                </p>
                                <p class="col-6 float-left pl-0">
                                    <input type="number" class="form-control" placeholder="Inches"
                                        name="width_in_inches" id="width_in_inches"
                                        value="{{ $design->room_width_in_inches }}">
                                    <span class="validation_error"></span>
                                </p>
                            </div>
                            <div class="form-group col-1 float-left px-0 text-center pt-5 mb-0">
                                <i class="fas fa-times"></i>
                            </div>
                            <div class="form-group col-6 float-left pr-0 mb-0">
                                <p class="italicLabel">Height</p>
                                <p class="col-6 float-left pl-0">
                                    <input type="number" class="form-control" placeholder="Feet" name="height_in_feet"
                                        id="height_in_feet" value="{{ $design->room_height_in_feet }}">
                                    <span class="validation_error"></span>
                                </p>
                                <p class="col-6 float-left pl-0">
                                    <input type="number" class="form-control" placeholder="Inches"
                                        name="height_in_inches" id="height_in_inches"
                                        value="{{ $design->room_height_in_inches }}">
                                    <span class="validation_error"></span>
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Design Description</label>
                            <textarea class="form-control textarea" rows="4" name="implementation_guide_description"
                                id="implementation_guide_description">{{ $design->implementation_guide_description }}</textarea>
                            <span class="validation_error"></span>
                        </div>
                    </form>
                </div>

            </div>

            <div class="rightPart col-md-7 col-xs-12 float-left px-sm-3">
                <label for="" class="col-12 px-0">Upload Images</label>
                <div class="dragandDropWrap col-md-12 col-xs-12 float-left px-0 mb-3">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active col-xl-3 col-md-4 col-sm-4 col-5 text-left"
                                id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home"
                                aria-selected="true">3D Rendered Images</a>
                            <a class="nav-item nav-link col-xl-3 col-md-4 col-sm-4 col-5 text-left" id="nav-profile-tab"
                                data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile"
                                aria-selected="false">Concept Board</a>
                        </div>
                    </nav>
                    <div class="tab-content pb-2 px-3" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <div class="dragDropBox pb-2">
                                <div class="col-12 float-left p-2">
                                    <p class="custom-file p-2">
                                        <input type="file" class="custom-file-input" name="collection_images[]"
                                            id="collection_images" multiple="multiple"
                                            accept="image/x-png,image/gif,image/jpeg">
                                        <label class="custom-file-label2 mb-0" for="customFile"></label>
                                        <span class="validation_error"></span>
                                    </p>
                                </div>
                                <p class="text-center mb-2">Upload / drop files here <span
                                        class="collection_img_browse">Browse Files</span></p>
                            </div>
                            <div class="uploadedImages py-2 mt-2 overflow-hidden">
                                <div id="carouselExample" class="carousel slide row" data-ride="carousel"
                                    data-interval="9000">
                                    <div class="carousel-inner collection_images row w-100 mx-auto" role="listbox">
                                    </div>
                                    @foreach ($design->collectionImages as $collectionImage)
                                        <div class="carousel-item col-md-3 active">
                                            <div class="panel panel-default">
                                                <div class="panel-thumbnail">
                                                    <p class="uploadedFile">
                                                        <img src="{{ asset('uploads/collection/' . $design->id . '/' . $collectionImage->img_src) }}"
                                                            title="image 1" class="thumb" />' +
                                                        <span class="imageClose"><i
                                                                class="fas fa-times-circle"></i></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                    <a class="carousel-control-prev" href="#carouselExample" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next text-faded" href="#carouselExample" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="dragDropBox pb-2">
                                <div class="col-12 float-left p-2">
                                    <p class="custom-file p-2">
                                        <input type="file" class="custom-file-input" name="collection_blue_prints[]"
                                            id="collection_blue_prints" accept="image/x-png,image/gif,image/jpeg"
                                            value="">
                                        <label class="custom-file-label2 mb-0" for="customFile"></label>
                                        <span class="validation_error"></span>
                                    </p>
                                </div>
                                <p class="text-center mb-2">Upload / drop files here <span
                                        class="blueprint_img_browse">Browse Files</span></p>
                            </div>
                            <div class="uploadedImages py-2 mt-2 overflow-hidden">


                                <div id="carouselExample" class="carousel slide row" data-ride="carousel"
                                    data-interval="9000">
                                    <div class="carousel-inner collection_blue_prints row w-100 mx-auto" role="listbox">
                                    </div>

                                    @foreach ($design->bluePrintImages as $bluePrintImage)
                                        <div class="carousel-item col-md-3 active">
                                            <div class="panel panel-default">
                                                <div class="panel-thumbnail">
                                                    <p class="uploadedFile">
                                                        <img src="{{ asset('uploads/collection/' . $design->id . '/' . $bluePrintImage->img_src) }}"
                                                            title="image 1" class="thumb" />' +
                                                        <span class="imageClose"><i
                                                                class="fas fa-times-circle"></i></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <a class="carousel-control-prev" href="#carouselExample" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next text-faded" href="#carouselExample" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <label for="" class="col-12 px-0 float-left">Paint Pallette</label>
                <div class="dragandDropWrap col-md-12 col-xs-12 float-left px-3">
                    <table class="table colorPaintTable">
                        <thead>
                            <tr>
                                <th scope="col">Color</th>
                                <th scope="col">Color Name</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Finish</th>
                                <th scope="col">Application</th>
                                <th scope="col">Add/Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($design->colorPallettes as $colorPallette)
                                <tr>
                                    <td>
                                        <div class="col-12 float-left px-0">
                                            <p class="custom-file addColor addColorImg"
                                                style="background-image: url('{{ asset('uploads/collection/' . $design->id . '/' . $colorPallette->color_img) }}')">
                                                <!--<span class="addColorIcon"><i class="fas fa-plus-circle"></i></span>-->
                                                <input type="file" class="custom-file-input" name="color_img[0]"
                                                    id="color_img.0">
                                                <span class="validation_error"></span>
                                                <label class="custom-file-label2 mb-0" for="customFile"></label>
                                            </p>
                                        </div>
                                    </td>
                                    <td><input type="text" class="form-control" placeholder="" name="color_name[0]"
                                            id="color_name.0" value="{{ $colorPallette->color_name }}"><span
                                            class="validation_error"></span></td>

                                    <td><input type="text" class="form-control" placeholder="" name="brand[0]"
                                            id="brand_name.0" value="{{ $colorPallette->brand }}"><span
                                            class="validation_error"></span></td>

                                    <td><input type="text" class="form-control" placeholder="" name="finish[0]"
                                            id="finish.0" value="{{ $colorPallette->finish }}"><span
                                            class="validation_error"></span></td>

                                    <td><input type="text" class="form-control" placeholder="" name="application[0]"
                                            id="application.0" value="{{ $colorPallette->application }}"><span
                                            class="validation_error"></span></td>
                                            <td><i class="fas fa-save mr-2" aria-hidden="true"></i> <i class="fas fa-trash" aria-hidden="true"></i><i class="fas fa-plus-circle addPlus hide" aria-hidden="true"></i></td>

                                    {{-- <td><i class="fas fa-save hide mr-2"></i> <i class="fas fa-trash hide"></i><i
                                            class="fas fa-plus-circle addPlus" id="addPlus"></i></td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="dragandDropWrap col-md-12 col-xs-12 float-left px-3">
                    <table class="table colorPaintTable" id="colorPaintTable">
                        <thead>
                            <tr>
                                <th scope="col">Color</th>
                                <th scope="col">Color Name</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Finish</th>
                                <th scope="col">Application</th>
                                <th scope="col">Add/Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="col-12 float-left px-0">
                                        <p class="custom-file addColor addColorImg">
                                            <!--<span class="addColorIcon"><i class="fas fa-plus-circle"></i></span>-->
                                            <input type="file" class="custom-file-input color_img_0" name="color_img[0]"
                                                id="color_img.0">
                                            <span class="validation_error"></span>
                                            <label class="custom-file-label2 mb-0" for="customFile"></label>
                                        </p>
                                    </div>
                                </td>
                                <td><input type="text" class="form-control color_name_0" placeholder=""
                                        name="color_name[0]" id="color_name.0"><span class="validation_error"></span>
                                </td>

                                <td><input type="text" class="form-control brand_0" placeholder="" name="brand[0]"
                                        id="brand_name.0"><span class="validation_error"></span></td>

                                <td><input type="text" class="form-control finish_0" placeholder="" name="finish[0]"
                                        id="finish.0"><span class="validation_error"></span></td>

                                <td><input type="text" class="form-control application_0" placeholder=""
                                        name="application[0]" id="application.0"><span class="validation_error"></span>
                                </td>

                                <td><i class="fas fa-save hide mr-2"></i> <i class="fas fa-trash hide"></i><i
                                        class="fas fa-plus-circle addPlus"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="form-group mt-3 col-12 float-left px-0">
                    <label for="">Upload Design Implementation Guide for this design.</label>
                    <div class="row mx-0 px-0 pt-2">
                        <div class="custom-file mb-1">
                            <input type="file" class="custom-file-input" name="design_implementation_guide"
                                id="design_implementation_guide">
                            <span class="validation_error"></span>
                            <span class="dig_file_name"></span>
                            <label class="custom-file-label mb-0" for="customFile"></label>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-12 float-left saveRoomWrap">
                <p class="text-right pt-2">Note: Save to upload merchandise for this design </p>
                <p>
                    <a href="{{ env('Shop_URL') }}/account" type="button"
                        class="btn btn-primary cancelBtn float-right">Cancel don't Save</a>
                    <button type="button" class="btn btn-primary loginBtn float-right mr-3 disbaleBtn hide"
                        id="save-room-details-btn">Save Room Details</button>
                    <button type="button" class="btn btn-primary loginBtn float-right mr-3"
                        id="update-room-details-btn" data="{{ $design->id }}">Update Room Details</button>
                </p>
            </div>
        </form>

    </div>
</div>
<div class="row mt-4 px-3" id="merchandise-section">
    <div class="col-md-12 float-left mb-5 pl-5">
        <label for="" class="col-12 px-0 font14">Add Merchandise References</label>
        <div class="addRefWrap col-12 float-left py-3 mb-3">
            <div class="row px-3">
                <button type="button" class="btn btn-primary loginBtn mr-2 add-product-view-btn"
                    id="add-product-view-btn">Add</button>
                <button type="button" class="btn btn-primary loginBtn mr-2 upload-bulk-btn" id="upload-bulk-btn">Upload
                    Bulk</button>
                <a href="{{ env('Shop_URL') }}/account" type="button" class="btn btn-primary cancelBtn">Cancel</a>
            </div>

            <div class="row px-3 mt-4 hide" id="csv-bulk-upload">
                <label for="" class="col-12 float-left px-0 font14">Upload the CSV file, in correct format</label>
                <div class="col-md-5 float-left mx-0 typeUser px-0">
                    <div class="row mx-0 px-0 pt-2">
                        <form id="csv-bulk-upload-form" accept="multipart/formdata">
                            <input type="hidden" name="customer_id" value="{{ $design->designer->id }}" />
                            <input type="hidden" name="shop" value="{{ env('Shop_NAME') }}" />
                            <input type="hidden" name="collection_id" value="{{ $design->id }}"
                                id="collection_id_bulk_upload" />

                            <div class="custom-file mb-1">
                                <input type="file" class="custom-file-input" id="upload_product_csv"
                                    name="upload_product_csv">
                                <span class="validation_error label--error"></span>
                                <label class="custom-file-label mb-0" for="customFile"></label>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-7 float-left mx-0 typeUser text-right pt-4 font14">
                    <a href="{{ asset('/uploads/product_bulk_upload.csv') }}" target="_blank">Download a Blank
                        Sample Template CSV file for Bulk upload</a>
                </div>
            </div>

            <div class="row px-3 mt-3 hide" id="add-product-view">
                <div class="col-12 addMearchForm py-3 px-0">
                    <form class="mx-0" id="merchandise-section-form">
                        <input type="hidden" name="customer_id" value="{{ $design->designer->id }}" />
                        <input type="hidden" name="shop" value="{{ env('Shop_NAME') }}" />
                        <input type="hidden" name="collection_id" value="{{ $design->id }}" id="collection_id" />
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 float-left">
                            <div class="form-group">
                                <label for="">Merchandise</label>
                                <input type="text" class="form-control" placeholder="" name="merchandise">
                                <span class="validation_error"></span>
                            </div>

                            <div class="form-group">
                                <label for="">Vendor</label>
                                <input type="text" class="form-control vendor_id" placeholder="" name="vendor_id"
                                    id="vendor_id" list="vendor-datalist">
                                <span class="validation_error"></span>
                                <datalist class="vendor-datalist" id="vendor-datalist"></datalist>
                                <button type="button" class="btn btn-secondary mr-3 w-100 loginBtn"
                                    id="add-vendor-btn"><i class="fas fa-plus-circle mr-2"></i> Add New Vendor</button>
                            </div>


                            <div class="form-group">
                                <label for="">Quantity</label>
                                <input type="number" class="form-control" name="quantity" step="3">
                                <span class="validation_error"></span>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 float-left">
                            <div class="form-group">
                                <label for="">Specification</label>
                                <input type="text" class="form-control" placeholder="" name="size_specification">
                                <span class="validation_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="">URL</label>
                                <input type="text" class="form-control" placeholder="" name="product_url">
                                <span class="validation_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="">Retail Price</label>
                                <input type="number" class="form-control" placeholder="&#36;" name="product_price">
                                <span class="validation_error"></span>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 float-left">
                            <div class="form-group">
                                <label for="">Upload Image Reference <span class="deleteUpload deleteUpload2"><i
                                            class="fas fa-times-circle"></i></span></label>
                                <div class="imageRefUpload p-3 col-12 float-left">

                                    <div class="col-12 float-left px-0">
                                        <p>Drag and Drop Image/ Browse Files</p>
                                        <p class="custom-file mb-0 addImage">
                                            <input type="file" class="custom-file-input" id="product_images"
                                                name="product_images[]" multiple="multiple"
                                                accept="image/x-png,image/gif,image/jpeg">
                                            <span class="validation_error"></span>
                                            <label class="custom-file-label2 mb-0" for="customFile"></label>
                                        </p>
                                    </div>
                                    <div class="row uploadedImage px-0" id="uploadProductImages">
                                    </div>

                                </div>
                            </div>
                            <!--<div class="form-group">
                                <label class="mt-3" for="">Price</label>
                                <input type="text" class="form-control" placeholder="&#36;" name="product_price" id="product_price">
                                <span class="validation_error"></span>
                            </div>
                        -->
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-12 float-left px-0 mt-3">
                <button type="button" class="btn btn-primary cancelBtn float-right"
                    id="save-merchandise-cancel-btn">Cancel</button>
                <button type="button" class="btn btn-primary loginBtn float-right mr-3"
                    id="save-merchandise-section-btn">Save Merchandise</button>
            </div>

            <!--<div class="col-12 float-left mt-1 px-0 addmerchBoxWrap">
                <label for="" class="col-12 px-0 mt-3 mb-0">1</label>

            </div>-->

            <div id="upload-products-sec">

                @foreach ($design->products as $key => $product)

                    <div class="col-12 float-left mt-1 px-0 addmerchBoxWrap product-preview-section">
                        <label for="" class="col-12 px-0 mt-3 mb-0">{{ $key + 1 }}</label>

                        <div class="row addmerchBox borderradius6 mt-1 mx-0 pt-3">
                            <div class="col-md-4 float-left">
                                <p>Merchandise</p>
                                <p>{{ $product->title }} </p>
                                <p>Sourcing / Vendor</p>
                                <p>{{ $product->vendor->vendor_name }}</p>

                                <div class="col-6 px-0 float-left colorVariants">
                                    <p class="mb-1">Quantity</p>
                                    <p>{{ $product->product_quantity }}</p>
                                </div>
                            </div>
                            <div class="col-md-4 float-left">
                                <p>Size Specification</p>
                                <p>{{ $product->size_specification }}</p>
                                <p>URL</p>
                                <p>{{ $product->product_url }}</p>
                                <div class="col-6 px-0 float-left">
                                    <p>Retail Price</p>
                                    <p>$ {{ $product->product_price }}</p>
                                </div>
                                <!--<div class="col-6 px-0 float-left colorVariants">
                                <p>Compare at Price </p>
                                <p>$ </p>
                            </div>-->
                            </div>
                            <div class="col-md-4 float-left">
                                <p>Upload Image Reference
                                    <span class="deleteUpload"><i class="fas fa-times-circle"></i></span>
                                </p>
                                <!--<p class="border border-light"><img src="images/upload_mearch_Img1.jpg" class="img-fluid"></p>-->
                                <div class="row uploadedImage px-0">
                                    @foreach ($product->productImages as $productImage)
                                        <div class="col-12 float-left">
                                            <p><img src="{{ asset('/uploads/collection/' . $design->id . '/' . $product->productImages->first()->img_src) }}"
                                                    class="img-fluid"></p>
                                        </div>
                                    @endforeach


                                </div>

                                <p class="text-right"><button type="submit"
                                        class="btn btn-primary loginBtn edit-product-btn">Edit</button></p>
                            </div>
                        </div>

                        <div class="col-12 addMearchForm py-3 px-0 update-product-section float-left hide">
                            <form class="mx-0 update-product-form">
                                <input type="hidden" name="customer_id" value="{{ $design->designer->id }}" />
                                <input type="hidden" name="shop" value="{{ env('Shop_NAME') }}" />
                                <input type="hidden" name="collection_id" value="{{ $design->id }}"
                                    id="collection_id">
                                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 float-left">
                                    <div class="form-group">
                                        <label for="">Merchandise</label>
                                        <input type="text" class="form-control" placeholder="" name="merchandise"
                                            value="{{ $product->title }}">
                                        <span class="validation_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Vendor</label>
                                        <input type="text" class="form-control vendor_id" placeholder=""
                                            name="vendor_id" id="vendor_id" list="vendor-datalist"
                                            value="{{ $product->vendor->vendor_name }}">
                                        <span class="validation_error"></span>
                                        <datalist id="vendor-datalist" class="vendor-datalist">
                                            @foreach ($vendors as $vendor)
                                                <option @if ($product->vendor->id == $vendor->id) selected @endif
                                                    data-value="{{ $vendor->id }}"
                                                    value="{{ $vendor->vendor_name }}"></option>
                                            @endforeach
                                        </datalist>

                                        <button type="button" class="btn btn-secondary mr-3 w-100 loginBtn"
                                            id="add-vendor-btn"><i class="fas fa-plus-circle mr-2"
                                                aria-hidden="true"></i> Add New Vendor</button>
                                    </div>


                                    <div class="form-group">
                                        <label for="">Quantity</label>
                                        <input type="number" class="form-control" name="quantity" step="3"
                                            value="{{ $product->product_quantity }}">
                                        <span class="validation_error"></span>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 float-left">
                                    <div class="form-group">
                                        <label for="">Specification</label>
                                        <input type="text" class="form-control" placeholder="" name="size_specification"
                                            value="{{ $product->size_specification }}">
                                        <span class="validation_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="">URL</label>
                                        <input type="text" class="form-control" placeholder="" name="product_url"
                                            value="{{ $product->product_url }}">
                                        <span class="validation_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Retail Price</label>
                                        <input type="text" class="form-control" placeholder="$" name="product_price"
                                            value="{{ $product->product_price }}">
                                        <span class="validation_error"></span>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 float-left">
                                    <div class="form-group">
                                        <label for="">Upload Image Reference <span class="deleteUpload deleteUpload2"><i
                                                    class="fas fa-times-circle" aria-hidden="true"></i></span></label>
                                        <div class="imageRefUpload p-3 col-12 float-left">

                                            <div class="col-12 float-left px-0">
                                                <p>Drag and Drop Image/ Browse Files</p>
                                                <p class="custom-file mb-0 addImage"
                                                    style="background-image: url(&quot;blob:https://panacchebeta.myshopify.com/ccf1760d-cb18-446f-8650-fdbf0e74d25b&quot;);">
                                                    <input type="file" class="custom-file-input" id="product_images"
                                                        name="product_images[]"
                                                        accept="image/x-png,image/gif,image/jpeg">
                                                    <span class="validation_error"></span>
                                                    <label class="custom-file-label2 mb-0" for="customFile"></label>
                                                </p>
                                            </div>
                                            <div class="row uploadedImage px-0" id="uploadProductImages">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <p class="text-right px-3 pt-3 float-right">
                                    <button type="submit" class="btn btn-primary loginBtn update-product-btn"
                                        data="{{ $product->id }}">Update</button>
                                    <button type="button"
                                        class="btn btn-default loginBtn cancel-product-btn">Cancel</button>
                                </p>

                            </form>
                        </div>
                    </div>
                @endforeach



            </div>

            <div class="row px-3 pt-4">
                <button type="submit" class="btn btn-primary loginBtn mr-2 add-product-view-btn">Add</button>
                <button type="submit" class="btn btn-primary loginBtn upload-bulk-btn">Upload Bulk</button>
            </div>

        </div>


        <form id="submit-new-design-form">
            <input type="hidden" name="customer_id" value="{{ $design->designer->id }}" />
            <input type="hidden" name="shop" value="{{ env('Shop_NAME') }}" />
            <input type="hidden" name="collection_id" value="{{ $design->id }}" id="collection_id_submit_design" />
        </form>

        <div class="col-12 float-left text-right px-0">
            <a href="{{ env('Shop_URL') }}/account" type="button"
                class="btn btn-primary cancelBtn float-right @if ($design->products->count() ==
            0) hide @else products-available @endif"">Cancel don't Submit</a>
            <button type="button" class="btn btn-primary loginBtn mr-3 @if ($design->products->count() == 0) hide @else products-available @endif"
                id="submit-new-design-btn">Submit New Design</button>
        </div>

    </div>

    <!-- Add Vender Popup Modal -->
    <!--<div class="modal fade addVendorPopWrap" id="addVenderPop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-0 px-2">
                <p class="text-center mx-auto modelLogo mt-3"></p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center py-0">
                <form id="save-vendor-form">
                    <div class="col-4 float-left">
                        <p class="text-left">Vendor Logo</p>
                        <div class="col-12 float-left px-0">
                            <div class="col-12 float-left px-0">
                                <p class="custom-file mb-0 addImage">
                                    <input type="file" class="custom-file-input" id="vendor_logo" name="vendor_logo">
                                    <label class="custom-file-label2 mb-0" for="customFile"></label>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-8 float-left">
                        <p class="text-left">Vendor Name</p>
                        <textarea class="form-control textarea" placeholder="Type Here" rows="3" name="vendor_name" id="vendor_name"></textarea>
                    </div>
                </form>

            </div>
            <div class="modal-footer text-center d-block pb-4">
                <button type="button" class="btn btn-primary cancleBtn"><a href="#">Cancel</a></button>
                <button type="button" class="btn btn-primary loginBtn" id="save-vendor-btn"><a href="#">Save</a></button>
            </div>
        </div>
    </div>
</div>-->
    <!-- Modal -->



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

</div>
