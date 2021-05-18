<div class="col-12 float-left px-0">
   <div class="col-12 float-left px-0 customersBuyContant">
      <div  class="col-12 float-left p-4 uplodDocuments">
         <div class="col-12 px-0 landingHeading">
            <h4 class="mb-2">
               <span>Upload Documents</span>
            </h4>
         </div>
         <div class="row">
            <div class="col-md-7 float-left tab2dragDropBox">
               <p>Upload Floor Plan / Additional Furniture</p>
               <!------------drag and drop box Start------------>
               <div class="col-md-12 col-xs-12 float-left mb-3 dragandDropWrap pb-2">
                  <ul class="nav nav-tabs showAllTabs row" id="myTabImage" role="tablist">
                     <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="floorplan-tab" data-toggle="tab" href="#floorplan" role="tab" aria-controls="floorplan" aria-selected="true">Floor Plan</a>
                     </li>
                     <li class="nav-item" role="presentation">
                        <a class="nav-link" id="addfurniture-tab" data-toggle="tab" href="#addfurniture" role="tab" aria-controls="addfurniture" aria-selected="false">Additional Furniture</a>
                     </li>
                  </ul>
                  <div class="tab-content showAllContent" id="myTabContent">
                     <div class="tab-pane fade show active" id="floorplan" role="tabpanel" aria-labelledby="floorplan-tab">
                        <div class="dragDropBox py-2">
                           <div class="col-12 float-left px-0">
                              <p class="custom-file mt-3 mb-3">
                                 <form method="post" id="additional_furniture_file">
                                    <input type="file" class="custom-file-input file_documents" name="file_documents">
                                    <input type="hidden" name="file_type" value="0">
                                    <input type="hidden" name="myProjectId" value="{{$my_project_id}}">
                                 </form>
                                 <label class="custom-file-label2 mb-0" for="customFile"></label>
                              </p>
                           </div>
                           <p class="text-center mb-2">Upload / drop files here <span>Browse Files</span></p>
                        </div>
                        <div class="uploadedImages py-2 mt-2 overflow-hidden">
                           <div id="carouselExample" class="carousel slide row" data-ride="carousel" data-interval="9000">
                              <div class="carousel-inner row w-100 mx-auto" role="listbox">
                                 @include('pages.customer.upload-documents-image',["class" => 'active','image_url' => 'https://panacchedev.pagekite.me/uploads/collection/product/images/design1.jpg'])
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
                     <div class="tab-pane fade" id="addfurniture" role="tabpanel" aria-labelledby="addfurniture-tab">
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
                                 @include('pages.customer.upload-documents-image',["class" => 'active','image_url' => 'https://panacchedev.pagekite.me/uploads/collection/product/images/design1.jpg'])
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
            <div class="col-md-5 float-left tab2UploadLinks">
               <p>Upload Reference Links</p>
               <div class="col-md-12 col-xs-12 float-left mb-3 dragandDropWrap pb-2">
                  <ul class="nav nav-tabs showAllTabs row" id="myTabRefrenceLink" role="tablist">
                     <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="floorplan-tab" data-toggle="tab" href="#floorplan" role="tab" aria-controls="floorplan" aria-selected="true">Reference Links</a>
                     </li>
                  </ul>
                  <div class="tab-content showAllContent mt-1">
                     <div id="referenceLinkContent">
                        @foreach ($refrenceLinks as $key => $refrenceLink)
                           <p class="linkInputs position-relative">
                              <input type="text" class="form-control pr-5 referenceLinkInput" placeholder="Copy reference links here" value="{{$refrenceLink->refrence_link}}">
                              <input type="hidden" name="referenceLinkId" class="referenceLinkId"value="{{$refrenceLink->id}}">
                              @if($key >= 3)
                                 <span class="deletLinks text-danger"><i class="fas fa-trash" aria-hidden="true"></i></span>
                              @endif
                           </p>
                        @endforeach
                     </div>
                     <p class="text-right mb-2 addLinkInput"><a href="javascript:;" class="addLinkInput"><i class="fas fa-plus-circle"></i></a></p>
                  </div>
               </div>
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
                           <th class="text-center" scope="col">Add/Remove</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($design->products as $pkey => $product)
                           @php
                              if($product->product_type == 1){
                                 continue;
                              }
                              $qty = 0;
                              $checked = '';
                              $my_product_id = '';
                              if(isset($selected_products[$product->id])){
                                 $checked = 'checked="checked"';
                                 $selected_product = $selected_products[$product->id];
                                 $qty = $selected_product->quantity;
                                 $my_product_id = $selected_product->id;
                              }
                           @endphp
                           <tr class="productListMainElm">
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
                                 <p class="mb-0 productName">{{ $product->title }}</p>
                                 <p class="mb-0">Specification: {{ $product->size_specification }} </p>
                              </td>
                              <td>{{ $product->vendor->vendor_name }}</td>
                              <td>${{ $product->product_price }}</td>
                              <td>${{ $product->product_compare_at_price }}</td>
                              <td>
                                 <input type="number" class="form-control productSelectionQty" name="points" step="1" value="{{$qty}}">
                              </td>
                              <td class="text-center">
                                 <input class="form-check-input productSelectionCheckbox" type="checkbox" value="1" {{$checked}}>
                                 <input type="hidden" name="product_id" class="product_id" value="{{ $product->id }}">
                                 <input type="hidden" name="my_product_id" class="my_product_id" value="{{$my_product_id}}">
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
      @include('pages.customer.paint-palette',["colorPallettes" => $design->colorPallettes])
      <div  class="col-12 float-left p-4 mt-3">
         <div class="col-12 px-0 float-left">
            <button type="button" class="btn btn-primary float-left addFreeChangebtn mr-2" @if(count($change_requests) >=3) style="display:none" @endif>
              <i class="fas fa-plus-circle"></i>
              Add a Free Change Request
            </button>
            <button type="button" class="btn btn-primary float-left addFreeChangebtn addPaidChangebtn @if(count($change_requests) <3) d-none @endif ">
              <i class="fas fa-plus-circle"></i>
              Add a PAID Change Request
            </button>
            <span class="float-right changeAddCount">1 of 3 free change added</span>
           </div>
            <div class="row">
               <div class="col-md-12 float-left tab2dragDropBox dragandDropWrap rounded-0 responsiveTableWrap mt-2">
                  <div class="col-md-12 col-xs-12 float-left px-0">
                     <table class="table colorPaintTable buyColorPaintTable addChangesWrap mb-0">
                        <tbody id="changeRequest">

                           @foreach($change_requests as $key => $change_request)
                              @if($key == 0)
                                 <tr><td colspan="6" class="freeChangeHead">Free change request</td></tr>
                              @endif
                              <tr class="freeChange changeRequestTRElm">
                                <td class="changereq1">
                                   <div class="form-group mb-0">
                                    <select class="custom-select selectDropdown">
                                      <option>Select Change Item</option>
                                      <option @if($change_request->type == 0) selected @endif value="0">Shopping List</option>
                                      <option @if($change_request->type == 1) selected @endif value="1">Pain Palette</option>
                                    </select>
                                 </div>
                                </td>
                                @if($change_request->type == 0)
                                   <td class="changereq2">
                                       <select class="custom-select">
                                          <option value="">Select Change Item</option>
                                          @foreach ($design->products as $pkey => $product)
                                             @php
                                                if($product->product_type == 1){
                                                   continue;
                                                }
                                                $product_first_image_src = '';
                                                if($product->productImages()->count()){
                                                   $product_first_image = $product->productImages()->first()->toArray();
                                                   if($product_first_image['img_src']){
                                                      $product_first_image_src = asset('uploads/collection/product/images/'.$product_first_image['img_src']);
                                                   }
                                                }
                                             @endphp
                                             <option @if($change_request->product_id == $product->id) selected @endif value="{{ $product->id }}" data-thumbnail="{{$product_first_image_src}}">{{ $product->title }}</option>
                                          @endforeach
                                       </select>
                                   </td>
                                   <td class="changereq3" colspan="2">
                                     <input type="text" class="form-control change_reason" placeholder="Change Reason" value="{{$change_request->change_reason}}">
                                     <input type="hidden" name="change_request_id" class="change_request_id" value="{{$change_request->id}}">
                                   </td>
                                   <td class="changereq5">
                                     <div class="custom-file">
                                         <input type="file" class="custom-file-input" id="customFile" name="filename">
                                         <i class="fas fa-paperclip"></i>
                                         <label class="custom-file-label mb-0" for="customFile"></label>
                                     </div>
                                   </td>
                                   <td class="changereq6 text-center">
                                       <i class="fas fa-trash" aria-hidden="true"></i>
                                   </td>
                                @else
                                   <td class="changereq2">
                                      <select class="custom-select color_selc_cls">
                                          <option value="">Select Color</option>
                                          @foreach($design->colorPallettes as $colorPallette)
                                             <option @if($change_request->color_id == $colorPallette->id) selected @endif value="{{$colorPallette->id}}">{{$colorPallette->color_name}}</option>
                                          @endforeach
                                      </select>
                                   </td>
                                   <td class="changereq3">
                                     <select class="custom-select brand">
                                         <option value="">Brand</option>
                                         <option selected value="{{$colorPallette->brand}}">{{$colorPallette->brand}}</option>
                                     </select>
                                   </td>
                                   <td class="changereq4">
                                     <select class="custom-select application">
                                         <option value="">Application</option>
                                         <option selected value="{{$colorPallette->application}}">{{$colorPallette->application}}</option>
                                     </select>
                                   </td>
                                   <td class="changereq5">
                                     <input type="text" class="form-control change_reason" placeholder="Change Reason" value="{{$change_request->change_reason}}">
                                     <input type="hidden" name="change_request_id" class="change_request_id" value="{{$change_request->id}}">
                                   </td>
                                   <td class="text-center changereq6">
                                       <form class="changeRequestForm">
                                       </form>
                                       <i class="fas fa-trash" aria-hidden="true"></i>
                                   </td>
                                @endif
                              </tr>
                              @if($key == 2 || ((count($change_requests)-1) == $key && count($change_requests) <= 3))
                                 <tr class="paidChangeHead">
                                   <td colspan="6">
                                       <span class="float-left">Paid change request - you paid $100 for this change</span>
                                       <span class="float-right">Payment Done</span>
                                   </td>
                                 </tr>
                              @endif
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="col-12 float-left mt-3">
                <button type="button" class="btn btn-primary float-sm-right float-left pay_now_btn loginBtn" @if(count($change_requests) <= 3) style="display:none" @endif>Pay Now</button>
                <button type="button" class="btn btn-primary float-sm-right float-left submit_design_changes_btn loginBtn" data-toggle="modal" data-target="#staticBackdrop" @if(count($change_requests) >3) style="display:none" @endif>Submit Design Changes</button>
                <span class="float-sm-right float-left mr-4 mt-2">You like this design, with ONE change. Seek designer's advice on this design !!</span>
              </div>
            </div>
      </div>
   </div>
</div>
<div id="upload_image_default_elm" class="d-none">
   @include('pages.customer.upload-documents-image',["class" => '','image_url' => ''])
</div>
