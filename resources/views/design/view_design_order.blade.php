<link rel="stylesheet" href="css/chatbox.css">
<link rel="stylesheet" href="css/carousal.css">

<input type="hidden" name="myProjectId" id="myProjectId" value="{{$my_project_id}}">
<div class="col-md-12 col-sm-12 col-xs-12 pl-5 mx-auto mt-4 pt-5">
    <div class="col-md-12 float-left backBtn mt-3">
        <a href="#" class="float-left"><span><i class="fas fa-arrow-left"></i></span></a>
        <div class="landingHeading float-left ml-4">
            <h4 class="mb-2 mt-lg-2 mt-md-0 col-12 float-left px-0">
                <span>{{ $design->design_name }}</span>
            </h4>
        </div>
    </div>
    @include('pages.design_basics')
    {{--  <div class="leftPart col-lg-8 col-md-12 col-sm-12 col-12 float-left pl-3 pr-0 mt-4">
    </div>  --}}
</div>
<div class="col-md-12 col-sm-12 col-xs-12 pl-5 mx-auto pt-2">
   <div class="col-md-12">
      <div class="row px-3 mt-2 mb-md-5">
         <div class="col-12 px-0 landingHeading">
            <h4 class="mb-2 col-xl-4 col-lg-12 col-12 float-left px-0">
               <span>Media</span>
            </h4>
         </div>
         <div class="row px-0">
            <div class="col-md-9 gallery float-left px-0">
                <p class="px-3">Room Design Image Gallery</p>
                <div id="myCarousel" class="carousel slide w-100" data-ride="carousel">
                    <div class="carousel-inner row w-100 mx-auto designCards">
                        @php
                            $i = 0;
                            $concept_board_image = [];
                        @endphp
                        @foreach ($design->collectionImages as $key => $collectionImages)
                        @php
                            if($collectionImages->concept_board == 1){
                                $concept_board_image = $collectionImages;
                                continue;
                            }
                        @endphp
                        <div class="carousel-item col-md-3 @if($i == 0) active @endif @php $i++ @endphp">
                            <div class="card">
                                <div class="card-img projectImg">
                                    <a href="#" data-toggle="modal" class="designGalleryImgSrc" data-target="#designGalleryPop">
                                        <img src="{{  asset('uploads/collection/'.$design->id.'/'.$collectionImages->img_src) }}" class="card-img cover-photo" alt="{{$collectionImages->img_alt}}">
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

                {{--  <div class="col-lg-4 col-md-4 col-xs-6 thumb float-left">
                    <a href="#" data-toggle="modal" data-target="#galleryPop">
                        <figure><img class="img-fluid img-thumbnail" src="images/buy_design_img.jpg" alt="Random Image"></figure>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-6 thumb float-left">
                    <a href="#" data-toggle="modal" data-target="#galleryPop">
                        <figure><img class="img-fluid img-thumbnail" src="images/buy_design_img.jpg" alt="Random Image"></figure>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-6 thumb float-left">
                    <a href="#" data-toggle="modal" data-target="#galleryPop">
                        <figure><img class="img-fluid img-thumbnail" src="images/buy_design_img.jpg" alt="Random Image"></figure>
                    </a>
                </div>
            </div>
            <div class="col-md-3 gallery float-left px-0">
               <p class="px-3">Concept Board</p>
               <div class="col-lg-12 col-md-12 col-xs-6 thumb float-left">
                  <a href="#" data-toggle="modal" data-target="#galleryPop">
                     <figure><img class="img-fluid img-thumbnail h-100" src="images/concept_board_img.jpg" alt="Random Image"></figure>
                  </a>
               </div>
            </div>  --}}

            <!-- Media Modal -->
            <div class="modal fade" id="designGalleryPop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header p-0 border-bottom-0">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if(isset($concept_board_image->img_src))
                                <img class="img-fluid w-100" src="{{  asset('uploads/collection/'.$design->id.'/'.$concept_board_image->img_src) }}" alt="{{$concept_board_image->img_alt}}">
                            @else
                                <img class="img-fluid w-100" src="" alt="">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
         </div>
         <hr/>
         <div class="col-12 px-0 float-left mt-3">
            <div class="row px-3 customerBuytabs">
                <div class="col-12 float-left px-0">
                    <div class="col-12 float-left px-0 customersBuyContant">
                        <div  class="col-12 float-left p-4 uplodDocuments">
                            <div class="row">
                                <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 float-left tab2UploadLinks">
                                <div class="col-12 px-0 landingHeading mb-3">
                                        <h4 class="mb-2">
                                        <span>Documents from Client</span>
                                        </h4>
                                    </div>
                                    <div class="col-md-12 col-xs-12 float-left mb-3 dragandDropWrap py-4 px-2">
                                        <div class="col-md-4 col-sm-6 float-left text-center">
                                            <div class="clientDocBox col-12 float-left p-3">
                                                <p><i class="fas fa-file"></i></p>
                                                <p class="mb-0"><a href="#">Download<br/>Additional Furniture</a></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 float-left text-center mt-3 mt-sm-0">
                                            <div class="clientDocBox col-12 float-left p-3">
                                                <p><i class="fas fa-file"></i></p>
                                                <p class="mb-0"><a href="#">Download<br/>Floor Plan</a></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 float-left text-left mt-3 mt-sm-3 mt-md-0">
                                            <div class="clientlinks col-12 float-left px-0">
                                                <p>Reference Links</p>
                                                @forelse ($refrenceLinks as $value)
                                                    <p class="mb-2 clientlinksBox px-2 py-1"><a href="{{ $value->reference_link }}" target="_blank">{{ $value->reference_link }}</a></p>
                                                @empty
                                                    <p class="mb-2 clientlinksBox px-2 py-1">No reference links found!</p>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ol-xl-5 col-lg-5 col-md-12 col-sm-12 col-12 float-left tab2dragDropBox mt-3 mt-lg-0">
                                <div class="col-12 px-0 landingHeading mb-3">
                                        <h4 class="mb-2">
                                        <span>Upload Updated Floor Plan</span>
                                        </h4>
                                    </div>
                                    <!------------drag and drop box Start------------>
                                    <div class="col-md-12 col-xs-12 float-left mb-3 dragandDropWrap pb-2">
                                        <ul class="nav nav-tabs showAllTabs row" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="floorplan-tab" data-toggle="tab" href="#floorplan" role="tab" aria-controls="floorplan" aria-selected="true">Floor Plan</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content showAllContent" id="myTabContent">
                                            <div class="tab-pane fade show active" id="floorplan" role="tabpanel" aria-labelledby="floorplan-tab">
                                                <div class="dragDropBox py-2">
                                                <div class="col-12 float-left px-0">
                                                    <p class="custom-file mt-3 mb-3">
                                                        <input type="file" class="custom-file-input" id="customFile" name="filename">
                                                        <label class="custom-file-label2 mb-0" for="customFile"></label>
                                                    </p>
                                                </div>
                                                <p class="text-center mb-2">Upload / drop files here <span>Browse Files</span></p>
                                                </div>
                                                <div class="uploadedImages py-2 mt-2 overflow-hidden">
                                                <div id="carouselExample" class="carousel slide row" data-ride="carousel" data-interval="9000">
                                                    <div class="carousel-inner row w-100 mx-auto" role="listbox">
                                                        <div class="carousel-item col-md-3 active">
                                                            <div class="panel panel-default">
                                                            <div class="panel-thumbnail">
                                                                <a href="#" title="image 1" class="thumb">
                                                                    <p class="uploadedFile"><span class="imageClose"><i class="fas fa-times-circle"></i></span></p>
                                                                </a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="carousel-item col-md-3">
                                                            <div class="panel panel-default">
                                                            <div class="panel-thumbnail">
                                                                <a href="#" title="image 3" class="thumb">
                                                                    <p class="uploadedFile"><span class="imageClose"><i class="fas fa-times-circle"></i></span></p>
                                                                </a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="carousel-item col-md-3">
                                                            <div class="panel panel-default">
                                                            <div class="panel-thumbnail">
                                                                <a href="#" title="image 4" class="thumb">
                                                                    <p class="uploadedFile"><span class="imageClose"><i class="fas fa-times-circle"></i></span></p>
                                                                </a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="carousel-item col-md-3">
                                                            <div class="panel panel-default">
                                                            <div class="panel-thumbnail">
                                                                <a href="#" title="image 5" class="thumb">
                                                                    <p class="uploadedFile"><span class="imageClose"><i class="fas fa-times-circle"></i></span></p>
                                                                </a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="carousel-item col-md-3">
                                                            <div class="panel panel-default">
                                                            <div class="panel-thumbnail">
                                                                <a href="#" title="image 6" class="thumb">
                                                                    <p class="uploadedFile"><span class="imageClose"><i class="fas fa-times-circle"></i></span></p>
                                                                </a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="carousel-item col-md-3">
                                                            <div class="panel panel-default">
                                                            <div class="panel-thumbnail">
                                                                <a href="#" title="image 7" class="thumb">
                                                                    <p class="uploadedFile"><span class="imageClose"><i class="fas fa-times-circle"></i></span></p>
                                                                </a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="carousel-item col-md-3">
                                                            <div class="panel panel-default">
                                                            <div class="panel-thumbnail">
                                                                <a href="#" title="image 8" class="thumb">
                                                                    <p class="uploadedFile"><span class="imageClose"><i class="fas fa-times-circle"></i></span></p>
                                                                </a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="carousel-item col-md-3">
                                                            <div class="panel panel-default">
                                                            <div class="panel-thumbnail">
                                                                <a href="#" title="image 2" class="thumb">
                                                                    <p class="uploadedFile"><span class="imageClose"><i class="fas fa-times-circle"></i></span></p>
                                                                </a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next text-faded" href="#carouselExample" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                    </a>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!------------drag and drop box End------------>
                                </div>
                            </div>
                        </div>
                        <div  class="col-12 float-left p-4 shoppingList mt-3">
                            <div class="col-12 px-0 landingHeading">
                                <h4 class="mb-0">
                                <span>Shopping List</span>
                                </h4>
                            </div>
                            <div class="row">
                                <div class="col-md-12 float-left tab2dragDropBox">
                                <div class="col-md-12 col-xs-12 float-left px-0 responsiveTableWrap">
                                    <table class="table shoppingListTable">
                                        <thead>
                                            <tr>
                                            <th scope="col">Item Name</th>
                                            <th scope="col"></th>
                                            <th scope="col">Vendor</th>
                                            <th scope="col">Retail Price</th>
                                            <th scope="col">Panacche Estimate</th>
                                            <th scope="col">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($design->products as $pkey => $product)
                                                @php
                                                    if($product->product_type == 1){
                                                        continue;
                                                    }
                                                    if($product->product_type == 1 || !isset($selected_products[$product->id])){
                                                        continue;
                                                    }
                                                    $qty = $selected_products[$product->id]->quantity;
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <div class="col-12 float-left px-0">
                                                            <p class="custom-file itenImage">
                                                                @php
                                                                    $product_first_image_src = '';
                                                                    if($product->productImages()->count()){
                                                                        $product_first_image = $product->productImages()->first()->toArray();
                                                                        if($product_first_image['img_src']){
                                                                            $product_first_image_src = asset('uploads/collection/product/images/'.$product_first_image['img_src']);
                                                                        }
                                                                    }
                                                                @endphp
                                                                <img @php echo 'src="'.$product_first_image_src.'"' @endphp class="img-fluid" width="200">
                                                            </p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">{{ $product->title }}</p>
                                                        <p class="mb-0">{{ $product->size_specification }}</p>
                                                    </td>
                                                    <td>{{ $product->vendor->vendor_name }}</td>
                                                    <td>${{ number_format($product->product_price,2) }}</td>
                                                    <td>${{ number_format($product->product_compare_at_price,2) }}</td>
                                                    <td>
                                                        <p class="quantityView mb-0 p-2 text-center">{{$qty}}</p>
                                                    </td>
                                                </tr>
                                            @empty

                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                            <div  class="col-12 float-left px-0">
                                <div class="row mb-4">
                                <div class="col-12 float-left px-0">
                                        <div class="col-12 float-left">
                                            <button type="button" class="btn btn-primary float-right loginBtn" data-toggle="modal" data-target="#buyDesignpop"><i class="fas fa-plus mr-2"></i>Add New Merchantise</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-12 float-left">
                                        Add Merch Box..
                                    </div>
                                </div>
                        </div>
                        </div>
                        @include('pages.customer.paint-palette',["colorPallettes" => $design->colorPallettes])
                        <div  class="col-12 float-left p-4 shoppingList mt-3">
                            <div class="col-12 px-0 landingHeading">
                                <h4 class="mb-4">
                                <span>Change Request</span>
                                </h4>
                            </div>
                            <div class="row px-3">
                                <div class="col-md-12 float-left tab2dragDropBox dragandDropWrap rounded-0 responsiveTableWrap">
                                <div class="col-md-12 col-xs-12 float-left px-0">
                                    <table class="table colorPaintTable buyColorPaintTable mb-0 changeRequest">
                                        <tbody>
                                            @forelse ($change_requests as $key => $change_request)
                                                @if($key == 0)
                                                    <tr><td colspan="6" class="freeChangeHead">Free change request</td></tr>
                                                @endif
                                                <tr>
                                                    <td>
                                                        <p class="mb-0">Change Type</p>
                                                        <p class="mb-0">@if($change_request->type == 0) {{"Shopping List"}} @elseif($change_request->type == 1) {{ "Pain Palette" }} @endif</p>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">Change Item</p>
                                                        <p class="mb-0">Comfort Chair</p>
                                                    </td>
                                                    <td colspan="2">
                                                        <p class="mb-0">Revised Item</p>
                                                        <p class="mb-0">Supra Chair</p>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">
                                                            @if($key >= 3)
                                                              PAID
                                                            @else
                                                              FREE
                                                            @endif
                                                        </p>
                                                    </td>
                                                </tr>
                                            @empty

                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div  class="col-12 float-left p-4">
                            <div class="row">
                                <div class="col-12 float-left mt-2 px-0">
                                    <div class="col-12 float-left mb-2">
                                        <button type="button" class="btn btn-primary float-right loginBtn" data-toggle="modal" data-target="#buyDesignpop">Submit Final Design</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
      </div>
   </div>
</div>
