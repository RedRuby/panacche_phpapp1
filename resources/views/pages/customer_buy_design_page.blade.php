<div class="col-md-12 col-sm-12 col-xs-12 pl-5 mx-auto">
     <div class="leftPart col-lg-8 col-md-12 col-sm-12 col-12 float-left pl-3 pr-0 mt-4">
        <div class="row px-3">
           <div class="col-md-6 col-sm-12 px-0 designCards float-left buyDesign">
              <div class="card">
                @if($design->collectionImages()->count() == 0)
                 <img src="{{  asset('default/design.jpg') }}" class="card-img cover-photo" alt="Cover">
                 @else
                 <img src="{{  asset('uploads/collection/'.$design->id.'/'.$design->collectionImages()->first()->img_src) }}" class="card-img cover-photo" alt="Cover">
                 @endif
                 <div class="card-body p-3">
                 </div>
              </div>
           </div>
           <div class="col-md-6 col-sm-12 float-left mt-md-0 mt-4">
              <div class="col-12 px-0 landingHeading float-left">
                 <h4 class="mb-1 mt-md-0 col-12 float-left px-0">
                    <span>{{ $design->design_name }}</span>
                 </h4>
              </div>
              <div class="col-12 px-0 roomsDisc float-left">
                 <p class="mb-0">Designer: <a href="{{ env('APP_SHOPIFY_URL') }}/pages/view-our-designer-profile?id={{ $design->designer->id }}">{{ $design->designer->first_name }} {{ $design->designer->last_name }}</a></p>
                <p class="mb-0">Room Style : <span>{{ $design->room_style }}<span></p>
                <p class="mb-0">Room Type : <span>{{ $design->room_type }}<span></p>
                <p class="mb-0">Pet Friendly Design : <span>{{ $design->pet_friendly_design }}<span></p>
                <p class="mb-0">Room Budget : <span>Approx. ${{ $design->room_budget }} or less<span></p>
              </div>
              <div class="col-12 px-0 designPrice float-left">
                 <h4 class="mb-3 mt-3 col-12 float-left px-0">
                    <span>Design Price: $ {{ $design->design_price }} </span>
                 </h4>
              </div>
              <div class="col-12 px-0 panaccheSaving float-left">
                 <p class="mb-0">Panacche Savings:</p>
                 <p class="">You Save: need to add dynamic $1,900.00 (76%)
                    <span class="ml-2 text-center ibtn">i 
                    <span class="tooltiptext p-2 text-left">Note: This does not include tax and shipping cost</span>
                    </span>
                 </p>
              </div>
              <div class="col-12 px-0 landingHeading float-left">
                 <h4 class="mb-1 mt-4 col-12 float-left px-0">
                    <span>Design Description</span>
                 </h4>
              </div>
              <div class="col-12 px-0 designDisc float-left">
                 <p class="mb-1">Approximate Room Size : {{ $design->room_width_in_feet }} ft {{ $design->room_width_in_inches }} inches x {{ $design->room_height_in_feet }} ft {{ $design->room_height_in_inches }} inches</p>
                 <p>{{ $design->implementation_guide_description }}</p>
                 <p class="mb-0 d-inline">
                  need to add dynamic
                    <span class="py-1 px-3 mr-2 mb-2">Modern</span>
                    <span class="py-1 px-3 mr-2 mb-2">Pet Friendly</span>
                    <span class="py-1 px-3 mr-2 mb-2">Fast Implementation</span>
                    <span class="py-1 px-3 mr-2 mb-2">Low cost</span>
                 </p>
              </div>
              <hr/>
              <div class="col-12 px-0 disclaimerShow float-left">
                 <p>Disclaimer: <span class="disclaimerView"> Every design is a work of art and creativity. There are chances where a décor item can go out of stock or discontinued by the time you purchase a design. In this event, the designer will provide a comparable substitute.
                    *All design sales are non- refundable.</span>
                 </p>
              </div>
           </div>
           
        </div>
     </div>
     {{--@include('pages.chate') --}}
  </div>
  <div style="clear:both"></div>
  <div class="col-md-12 col-sm-12 col-xs-12 pl-5 mx-auto pt-2">
               <div class="col-md-12">
                  <div class="row px-3 mt-2 mb-md-5">
                     <div class="col-12 px-0 landingHeading">
                        <h4 class="mb-2 col-xl-4 col-lg-12 col-12 float-left px-0">
                           <span>Media</span>
                        </h4>
                     </div>
                     <div class="w-100 row px-0">
                        <div class="col-md-9 gallery float-left px-0">
                           <p class="px-3">Room Design Image Gallery</p>
                           <div id="myCarousel" class="carousel slide w-100" data-ride="carousel">
                                <div class="carousel-inner row w-100 mx-auto designCards">
                                   @php
                                    $i = 0
                                    @endphp
                                   @foreach ($design->collectionImages as $key => $collectionImages)
                                   <div class="carousel-item col-md-3 
                                      @if($i == 0)
                                      active
                                      @endif
                                      @php
                                      $i++
                                      @endphp
                                      ">
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
                        <div class="col-md-3 gallery float-left px-0">
                           <p class="px-3">Concept Board</p>
                           <div class="col-lg-12 col-md-12 col-xs-6 thumb float-left">
                              <a href="#" data-toggle="modal" data-target="#galleryPop">
                                 <figure><img class="img-fluid img-thumbnail h-100" src="images/concept_board_img.jpg" alt="Random Image"></figure>
                              </a>
                           </div>
                        </div>
            
                        <!-- Media Modal -->
                        <div class="modal fade" id="galleryPop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                 <div class="modal-header p-0 border-bottom-0">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <img class="img-fluid" src="images/buy_design_img.jpg" alt="Random Image">
                                 </div>
                              </div>
                           </div>
                        </div>
            
                     </div>
                     <hr/>
                     <div class="col-12 px-0 float-left mt-3">
                        <div class="row px-3 customerBuytabs">
            
                           <div class="col-md-12 col-xs-12 float-left px-0 mb-3 tabHorizontal">
                              <ul class="nav nav-tabs showAllTabs row nav-pills nav-justified px-3" id="myTab" role="tablist">
                                 <li class="nav-item" role="presentation">
                                    <a class="nav-link py-4 active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">Get Design Guide</a>
                                 </li>
                                 <li class="nav-item" role="presentation">
                                    <a class="nav-link py-4 disabled" id="in_progress-tab" data-toggle="tab" href="#in_progress" role="tab" aria-controls="progress" aria-selected="false">Customer Changes</a>
                                 </li>
                                 <li class="nav-item" role="presentation">
                                    <a class="nav-link py-4 disabled" id="delivered_paid-tab" data-toggle="tab" href="#delivered_paid" role="tab" aria-controls="delivered_paid" aria-selected="false">Final Design</a>
                                 </li>
                                 <li class="nav-item" role="presentation">
                                    <a class="nav-link py-4 disabled" id="abandoned-tab" data-toggle="tab" href="#abandoned" role="tab" aria-controls="abandoned" aria-selected="false">Pannache Conceirge</a>
                                 </li>
                              </ul>
                              <div class="tab-content showAllContent" id="myTabContent">
                
                <!------------Tab 1 Start------------>
                                 <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                    <div class="col-12 float-left px-0">
                                       <div class="col-12 float-left p-4 customersBuyContant">
                                          <div class="col-lg-8 col-md-6 col-sm-12 col-12 float-left tab1">
                                             <h1>LOYAL</h1>
                                             <p>A quick to go package from Panacche </p>
                                             <div class="col-12 px-0 landingHeading">
                                                <h4 class="mb-2">
                                                   <span>Media</span>
                                                </h4>
                                             </div>
                                             <p class="mb-0">Pick a design from our collection that resembles your style.Like a design and we will hook you up with all that goes into achieving the look.</p>
                                             <p>Buy it - its that easy! Plus save additional $$ on the furniture decor purchase.</p>
                                             <div class="col-12 px-0 landingHeading">
                                                <h4 class="mb-2">
                                                   <span>Benefits</span>
                                                </h4>
                                             </div>
                                             <ul class="pl-3">
                                                <li>Interaction with the designer</li>
                                                <li>Upto 3 changes to the design</li>
                                                <li>1 concept board and floorplan</li>
                                                <li>Design Implementation Guide</li>
                                                <li>Paint palette</li>
                                                <li>Discount on shopping list</li>
                                                <li>Panacche Concierge to help with shopping and shipping</li>
                                             </ul>
                                          </div>
                                          <div class="col-lg-4 col-md-6 col-sm-12 col-12 float-left tab1Right">
                                             <div class="col-10 mx-auto buyPriceBox mt-md-0 mt-4">
                                                <p class="py-4 mb-0">$434</p>
                                                <p class="py-3"><a href="{{ env('APP_SHOPIFY_URL') }}/cart/{{ $product_variant_id }}:1" class="py-3">Buy the Design</a></p>
                                                <p class="mb-0">What do you get with this?</p>
                                                <ul class="pl-3">
                                                   <li>Lorem ipsum dolor sit amet</li>
                                                   <li>Lorem ipsum dolor sit amet</li>
                                                   <li>Lorem ipsum dolor sit amet</li>
                                                   <li>Lorem ipsum dolor sit amet </li>
                                                   <li>Lorem ipsum dolor sit amet</li>
                                                </ul>
                                             </div>
                                             @if(1==2)
                                               <div class="col-10 mx-auto downloadZipBox mt-md-0 mt-4">
                                                  <p>You can now download the Design Implementation guide !</p>
                                                  <div class="col-12 p-3 text-center">
                                                     <p class="mb-3"><i class="fas fa-file-archive"></i></p>
                                                     <a href="{{  asset('uploads/collection/'.$design->id.'/'.$design->design_implementation_guide) }}"
                                                     <button type="button" class="btn btn-warning warningBtn w-100">Download</button>
                                                     </a>
                                                  </div>
                                               </div>
                                             @endif
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                 <!------------Tab 1 End------------>
                 
                 <!------------Tab 2 Start------------>
                                 <div class="tab-pane fade" id="in_progress" role="tabpanel" aria-labelledby="in_progress-tab">
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
                                                      <ul class="nav nav-tabs showAllTabs row" id="myTab" role="tablist">
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
                                                <div class="col-md-5 float-left tab2UploadLinks">
                                                   <p>Upload Reference Links</p>
                                                   <div class="col-md-12 col-xs-12 float-left mb-3 dragandDropWrap pb-2">
                                                      <ul class="nav nav-tabs showAllTabs row" id="myTab" role="tablist">
                                                         <li class="nav-item" role="presentation">
                                                            <a class="nav-link active" id="floorplan-tab" data-toggle="tab" href="#floorplan" role="tab" aria-controls="floorplan" aria-selected="true">Reference Links</a>
                                                         </li>
                                                      </ul>
                                                      <div class="tab-content showAllContent mt-1" id="myTabContent">
                                                         <p class="linkInputs">
                                                            <input type="text" class="form-control mb-3" placeholder="Copy reference links here">
                                                            <input type="text" class="form-control mb-3" placeholder="Copy reference links here">
                                                            <input type="text" class="form-control mb-3" placeholder="Copy reference links here">
                                                         </p>
                                                         <p class="text-right mb-2 addLinkInput"><i class="fas fa-plus-circle"></i></p>
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
                                                            <tr>
                                                               <td>
                                                                  <div class="col-12 float-left px-0">
                                                                     <p class="custom-file itenImage">
                                                                        <img src="images/buy_design_img.jpg" class="img-fluid" width="200">
                                                                     </p>
                                                                  </div>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Comfort Chair</p>
                                                                  <p class="mb-0">Specification: 12' * 12' </p>
                                                               </td>
                                                               <td><img src="images/venderLogo1.jpg" class="img-fluid" width="200" alt="User1"></td>
                                                               <td>$89</td>
                                                               <td>$55</td>
                                                               <td>
                                                                  <input type="number" class="form-control" name="points" step="3">
                                                               </td>
                                                               <td class="text-center">
                                                                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                               </td>
                                                            </tr>
                                                            <tr>
                                                               <td>
                                                                  <div class="col-12 float-left px-0">
                                                                     <p class="custom-file itenImage">
                                                                        <img src="images/buy_design_img.jpg" class="img-fluid" width="200">
                                                                     </p>
                                                                  </div>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Fire Place</p>
                                                                  <p class="mb-0">Specification: 12' * 12' </p>
                                                                  <p class="mb-0">Color: White</p>
                                                               </td>
                                                               <td><img src="images/venderLogo2.jpg" class="img-fluid" width="200" alt="User1"></td>
                                                               <td>$89</td>
                                                               <td>$55</td>
                                                               <td>
                                                                  <input type="number" class="form-control" name="points" step="3">
                                                               </td>
                                                               <td class="text-center">
                                                                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                               </td>
                                                            </tr>
                                                            <tr>
                                                               <td>
                                                                  <div class="col-12 float-left px-0">
                                                                     <p class="custom-file itenImage">
                                                                        <img src="images/buy_design_img.jpg" class="img-fluid" width="200">
                                                                     </p>
                                                                  </div>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Couch Chair</p>
                                                                  <p class="mb-0">Specification: 12' * 12' </p>
                                                                  <p class="mb-0">Color: White</p>
                                                               </td>
                                                               <td><img src="images/venderLogo1.jpg" class="img-fluid" width="200" alt="User1"></td>
                                                               <td>$89</td>
                                                               <td>$55</td>
                                                               <td>
                                                                  <input type="number" class="form-control" name="points" step="3">
                                                               </td>
                                                               <td class="text-center">
                                                                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                               </td>
                                                            </tr>
                                                            <tr>
                                                               <td>
                                                                  <div class="col-12 float-left px-0">
                                                                     <p class="custom-file itenImage">
                                                                        <img src="images/buy_design_img.jpg" class="img-fluid" width="200">
                                                                     </p>
                                                                  </div>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Center Table</p>
                                                                  <p class="mb-0">Specification: 12' * 12' </p>
                                                               </td>
                                                               <td><img src="images/venderLogo2.jpg" class="img-fluid" width="200" alt="User1"></td>
                                                               <td>$89</td>
                                                               <td>$55</td>
                                                               <td>
                                                                  <input type="number" class="form-control" name="points" step="3">
                                                               </td>
                                                               <td class="text-center">
                                                                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                               </td>
                                                            </tr>
                                                            <tr>
                                                               <td>
                                                                  <div class="col-12 float-left px-0">
                                                                     <p class="custom-file itenImage">
                                                                        <img src="images/buy_design_img.jpg" class="img-fluid" width="200">
                                                                     </p>
                                                                  </div>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Side Lamp Light</p>
                                                                  <p class="mb-0">Specification: 12' * 12' </p>
                                                               </td>
                                                               <td><img src="images/venderLogo1.jpg" class="img-fluid" width="200" alt="User1"></td>
                                                               <td>$89</td>
                                                               <td>$55</td>
                                                               <td>
                                                                  <input type="number" class="form-control" name="points" step="3">
                                                               </td>
                                                               <td class="text-center">
                                                                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div  class="col-12 float-left p-4 shoppingList mt-3">
                                             <div class="col-12 px-0 landingHeading">
                                                <h4 class="mb-4">
                                                   <span>Paint Palette</span>
                                                </h4>
                                             </div>
                                             <div class="row px-3">
                                                <div class="col-md-12 float-left tab2dragDropBox dragandDropWrap rounded-0 responsiveTableWrap">
                                                   <div class="col-md-12 col-xs-12 float-left px-0">
                                                      <table class="table colorPaintTable buyColorPaintTable mb-0">
                                                         <tbody>
                                                            <tr>
                                                               <td>
                                                                  <div class="col-12 text-center">
                                                                     <p class="custom-file paintColor burgundy"></p>
                                                                  </div>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Color Name</p>
                                                                  <p class="mb-0">Burgundy</p>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Brand</p>
                                                                  <p class="mb-0">Berger</p>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Finish</p>
                                                                  <p class="mb-0">Matt</p>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Application</p>
                                                                  <p class="mb-0">Living Room</p>
                                                               </td>
                                                            </tr>
                                                            <tr>
                                                               <td>
                                                                  <div class="col-12 text-center">
                                                                     <p class="custom-file paintColor chromeYellow"></p>
                                                                  </div>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Color Name</p>
                                                                  <p class="mb-0">Chrome Yellow</p>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Brand</p>
                                                                  <p class="mb-0">Berger</p>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Finish</p>
                                                                  <p class="mb-0">Matt</p>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Application</p>
                                                                  <p class="mb-0">Living Room</p>
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div  class="col-12 float-left p-4 mt-3">
                                             <div class="col-12 px-0 float-left">
                                                <button type="button" class="btn btn-primary float-left addFreeChangebtn mr-2">
                          <i class="fas fa-plus-circle"></i>
                          Add a Free Change Request
                        </button>
                        <button type="button" class="btn btn-primary float-left addFreeChangebtn addPaidChangebtn">
                          <i class="fas fa-plus-circle"></i>
                          Add a PAID Change Request
                        </button>
                        <span class="float-right changeAddCount">1 of 3 free change added</span>
                       </div>
                                                <div class="row">
                                                   <div class="col-md-12 float-left tab2dragDropBox dragandDropWrap rounded-0 responsiveTableWrap mt-2">
                                                      <div class="col-md-12 col-xs-12 float-left px-0">
                                                         <table class="table colorPaintTable buyColorPaintTable addChangesWrap mb-0">
                                                            <tbody>
                                <tr>
                                                                  <td colspan="6" class="freeChangeHead"
                                                                     Free change request
                                                                  </td>
                                                               </tr>
                                                               <tr class="freeChange">
                                                                  <td>
                                                                     <div class="form-group mb-0">
                                     <select class="custom-select selectDropdown">
                                       <option selected>Select Change Item</option>
                                      <option value="1">Shopping List</option>
                                      <option value="2">Pain Palette</option>
                                     </select>
                                  </div>
                                                                  </td>
                                                                  <td>
                                  <select class="vodiapicker">
                                    <option value="en" class="test" data-thumbnail="images/buy_design_img.jpg">Select Item</option>
                                    <option value="en" class="test" data-thumbnail="images/buy_design_img.jpg">Comfort Chair</option>
                                    <option value="au" data-thumbnail="images/design1.jpg">Fire Place</option>
                                    <option value="uk" data-thumbnail="images/buy_design_img.jpg">Couch Chair</option>
                                    <option value="cn" data-thumbnail="images/design1.jpg">Center Table</option>
                                    <option value="de" data-thumbnail="images/buy_design_img.jpg">Side Lamp Light</option>
                                  </select>

                                  <div class="lang-select">
                                    <button class="btn-select" value=""></button>
                                    <div class="b">
                                      <ul id="a"></ul>
                                    </div>
                                  </div>
                                                                  </td>
                                  <td colspan="2">
                                                                      <input type="text" class="form-control" placeholder="Change Reason">
                                                                  </td>
                                                                  <td>
                                                                     <div class="custom-file">
                                     <input type="file" class="custom-file-input" id="customFile" name="filename">
                                     <i class="fas fa-paperclip"></i>
                                     <label class="custom-file-label mb-0" for="customFile"></label>
                                  </div>
                                                                  </td>
                                  <td class="text-center">
                                                                      <i class="fas fa-trash" aria-hidden="true"></i>
                                                                  </td>
                                                               </tr>
                                 
                                                               <tr class="freeChange">
                                                                  <td>
                                                                     <div class="form-group mb-0">
                                     <select class="custom-select selectDropdown">
                                       <option selected>Select Change Item</option>
                                      <option value="1">Shopping List</option>
                                      <option value="2">Pain Palette</option>
                                     </select>
                                  </div>
                                                                  </td>
                                                                  <td>
                                                                     <div class="form-group mb-0">
                                     <select class="custom-select selectDropdown">
                                       <option selected>Select Color</option>
                                      <option value="1">Burgundy</option>
                                      <option value="2">Chrome Yellow</option>
                                     </select>
                                  </div>
                                                                  </td>
                                                                  <td>
                                                                     <div class="form-group mb-0">
                                     <select class="custom-select selectDropdown">
                                       <option selected>Brand</option>
                                      <option value="1">Berger</option>
                                      <option value="2">Asian Paint</option>
                                     </select>
                                  </div>
                                                                  </td>
                                                                  <td>
                                                                     <div class="form-group mb-0">
                                     <select class="custom-select selectDropdown">
                                       <option selected>Application</option>
                                      <option value="1">Living Room</option>
                                      <option value="2">Bedroom</option>
                                     </select>
                                  </div>
                                                                  </td>
                                                                  <td>
                                                                      <input type="text" class="form-control" placeholder="Change Reason">
                                                                  </td>
                                  <td class="text-center">
                                                                      <i class="fas fa-trash" aria-hidden="true"></i>
                                                                  </td>
                                                               </tr>
                                 
                                 <tr class="freeChange">
                                                                  <td>
                                                                     <div class="form-group mb-0">
                                     <select class="custom-select selectDropdown">
                                       <option selected>Select Change Item</option>
                                      <option value="1">Shopping List</option>
                                      <option value="2">Pain Palette</option>
                                     </select>
                                  </div>
                                                                  </td>
                                                                  <td>
                                  <select class="vodiapicker">
                                    <option value="en" class="test" data-thumbnail="images/buy_design_img.jpg">Select Item</option>
                                    <option value="en" class="test" data-thumbnail="images/buy_design_img.jpg">Comfort Chair</option>
                                    <option value="au" data-thumbnail="images/design1.jpg">Fire Place</option>
                                    <option value="uk" data-thumbnail="images/buy_design_img.jpg">Couch Chair</option>
                                    <option value="cn" data-thumbnail="images/design1.jpg">Center Table</option>
                                    <option value="de" data-thumbnail="images/buy_design_img.jpg">Side Lamp Light</option>
                                  </select>

                                  <div class="lang-select">
                                    <button class="btn-select" value=""></button>
                                    <div class="b">
                                      <ul id="a"></ul>
                                    </div>
                                  </div>
                                                                  </td>
                                  <td colspan="2">
                                                                      <input type="text" class="form-control" placeholder="Change Reason">
                                                                  </td>
                                                                  <td>
                                                                     <div class="custom-file">
                                     <input type="file" class="custom-file-input" id="customFile" name="filename">
                                     <i class="fas fa-paperclip"></i>
                                     <label class="custom-file-label mb-0" for="customFile"></label>
                                  </div>
                                                                  </td>
                                  <td class="text-center">
                                                                      <i class="fas fa-trash" aria-hidden="true"></i>
                                                                  </td>
                                                               </tr>
                                 
                                 <tr class="paidChangeHead">
                                                                  <td colspan="6">
                                  <span class="float-left">Paid change request - you paid $100 for this change</span>
                                  <span class="float-right">Payment Done</span>
                                                                  </td>
                                                               </tr>
                                 
                                 <tr class="paidChange">
                                                                  <td>
                                                                     <div class="form-group mb-0">
                                     <select class="custom-select selectDropdown">
                                       <option selected>Select Change Item</option>
                                      <option value="1">Shopping List</option>
                                      <option value="2">Pain Palette</option>
                                     </select>
                                  </div>
                                                                  </td>
                                                                  <td>
                                                                     <div class="form-group mb-0">
                                     <select class="custom-select selectDropdown">
                                       <option selected>Select Color</option>
                                      <option value="1">Burgundy</option>
                                      <option value="2">Chrome Yellow</option>
                                     </select>
                                  </div>
                                                                  </td>
                                                                  <td>
                                                                     <div class="form-group mb-0">
                                     <select class="custom-select selectDropdown">
                                       <option selected>Brand</option>
                                      <option value="1">Berger</option>
                                      <option value="2">Asian Paint</option>
                                     </select>
                                  </div>
                                                                  </td>
                                                                  <td>
                                                                     <div class="form-group mb-0">
                                     <select class="custom-select selectDropdown">
                                       <option selected>Application</option>
                                      <option value="1">Living Room</option>
                                      <option value="2">Bedroom</option>
                                     </select>
                                  </div>
                                                                  </td>
                                                                  <td>
                                                                      <input type="text" class="form-control" placeholder="Change Reason">
                                                                  </td>
                                  <td class="text-center">
                                                                      <i class="fas fa-trash" aria-hidden="true"></i>
                                                                  </td>
                                                               </tr>
                                 
                                                            </tbody>
                                                         </table>
                                                      </div>
                                                   </div>
                           <div class="col-12 float-left mt-3">
                            <button type="button" class="btn btn-primary float-sm-right float-left loginBtn" data-toggle="modal" data-target="#staticBackdrop">Submit Design Changes</button>
                            <span class="float-sm-right float-left mr-4 mt-2">You like this design, with ONE change. Seek designer's advice on this design !!</span>
                          </div>
                                                </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                 <!------------Tab 2 End------------>
                 
                 <!------------Tab 3 Start------------>
                                 <div class="tab-pane fade" id="delivered_paid" role="tabpanel" aria-labelledby="delivered_paid-tab">
                                    <div class="col-12 float-left px-0">
                                       <div class="col-12 float-left px-0 customersBuyContant">
                                          <div  class="col-12 float-left shoppingList p-4">
                                             <div class="row">
                                                <div class="col-xl-7 col-lg-6 col-md-4 col-sm-12 col-12 float-left">
                          <div class="col-12 px-0 landingHeading">
                            <h4 class="mb-2">
                               <span>Revised Floor Plan from Designer</span>
                            </h4>
                          </div>
                                                    <p>Designer — has provided an updated floor plan, as per the change request from you. </p>
                                                    <p>Please review and save !!</p>
                                                </div>
                        
                                                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-12 col-12 float-left floorPlanImgWrap">
                                                   <div class="col-md-12 float-left mb-3 pb-2">
                                                      <div class="col-4 float-left floorPlanImg">
                            <p data-toggle="modal" data-target="#finalDesignFloorPlan"><img src="images/buy_design_img.jpg" class="img-fluid"></p>
                                                      </div>
                            <div class="col-4 float-left floorPlanImg">
                            <p data-toggle="modal" data-target="#finalDesignFloorPlan"><img src="images/buy_design_img.jpg" class="img-fluid"></p>
                                                      </div>
                            <div class="col-4 float-left floorPlanImg">
                            <p data-toggle="modal" data-target="#finalDesignFloorPlan"><img src="images/buy_design_img.jpg" class="img-fluid"></p>
                                                      </div>
                                                   </div>
                           
                           <div class="col-12 float-left text-center">
                            <a href="#">
                              <button type="button" class="btn btn-primary col-11 warningBtn">Download Documents</button>
                            </a>
                           </div>
                                                </div>
                        
                        <!-- Final Design Floor Plan Modal -->
                        <div class="modal fade" id="finalDesignFloorPlan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                             <div class="modal-header p-0 border-bottom-0">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                             </div>
                             <div class="modal-body">
                              <img class="img-fluid" src="images/buy_design_img.jpg" alt="Random Image">
                             </div>
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
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            <tr>
                                                               <td>
                                                                  <div class="col-12 float-left px-0">
                                                                     <p class="custom-file itenImage">
                                                                        <img src="images/buy_design_img.jpg" class="img-fluid" width="200">
                                                                     </p>
                                                                  </div>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Comfort Chair</p>
                                                                  <p class="mb-0">Specification: 12' * 12' </p>
                                                               </td>
                                                               <td><img src="images/venderLogo1.jpg" class="img-fluid" width="200" alt="User1"></td>
                                                               <td>$89</td>
                                                               <td>$55</td>
                                                               <td>
                                                                  <p class="quantityView mb-0 p-2 text-center">1</p>
                                                               </td>
                                                            </tr>
                                                            <tr>
                                                               <td>
                                                                  <div class="col-12 float-left px-0">
                                                                     <p class="custom-file itenImage">
                                                                        <img src="images/buy_design_img.jpg" class="img-fluid" width="200">
                                                                     </p>
                                                                  </div>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Fire Place</p>
                                                                  <p class="mb-0">Specification: 12' * 12' </p>
                                                                  <p class="mb-0">Color: White</p>
                                                               </td>
                                                               <td><img src="images/venderLogo2.jpg" class="img-fluid" width="200" alt="User1"></td>
                                                               <td>$89</td>
                                                               <td>$55</td>
                                                               <td>
                                                                  <p class="quantityView mb-0 p-2 text-center">1</p>
                                                               </td>
                                                            </tr>
                                                            <tr>
                                                               <td>
                                                                  <div class="col-12 float-left px-0">
                                                                     <p class="custom-file itenImage">
                                                                        <img src="images/buy_design_img.jpg" class="img-fluid" width="200">
                                                                     </p>
                                                                  </div>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Side Lamp Light</p>
                                                                  <p class="mb-0">Specification: 12' * 12' </p>
                                                               </td>
                                                               <td><img src="images/venderLogo1.jpg" class="img-fluid" width="200" alt="User1"></td>
                                                               <td>$89</td>
                                                               <td>$55</td>
                                                               <td>
                                                                  <p class="quantityView mb-0 p-2 text-center">1</p>
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div  class="col-12 float-left p-4 shoppingList mt-3">
                                             <div class="col-12 px-0 landingHeading">
                                                <h4 class="mb-4">
                                                   <span>Paint Palette</span>
                                                </h4>
                                             </div>
                                             <div class="row px-3">
                                                <div class="col-md-12 float-left tab2dragDropBox dragandDropWrap rounded-0 responsiveTableWrap">
                                                   <div class="col-md-12 col-xs-12 float-left px-0">
                                                      <table class="table colorPaintTable buyColorPaintTable mb-0">
                                                         <tbody>
                                                            <tr>
                                                               <td>
                                                                  <div class="col-12 text-center">
                                                                     <p class="custom-file paintColor burgundy"></p>
                                                                  </div>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Color Name</p>
                                                                  <p class="mb-0">Burgundy</p>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Brand</p>
                                                                  <p class="mb-0">Berger</p>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Finish</p>
                                                                  <p class="mb-0">Matt</p>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Application</p>
                                                                  <p class="mb-0">Living Room</p>
                                                               </td>
                                                            </tr>
                                                            <tr>
                                                               <td>
                                                                  <div class="col-12 text-center">
                                                                     <p class="custom-file paintColor chromeYellow"></p>
                                                                  </div>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Color Name</p>
                                                                  <p class="mb-0">Chrome Yellow</p>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Brand</p>
                                                                  <p class="mb-0">Berger</p>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Finish</p>
                                                                  <p class="mb-0">Matt</p>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Application</p>
                                                                  <p class="mb-0">Living Room</p>
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
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
                                                            <tr>
                                                               <td>
                                                                  <p class="mb-0">Change Type</p>
                                                                  <p class="mb-0">Shopping List</p>
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
                                                                  <p class="mb-0">FREE</p>
                                                               </td>
                                                            </tr>
                                                            <tr>
                                                               <td>
                                                                  <p class="mb-0">Change Type</p>
                                                                  <p class="mb-0">Shopping List</p>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Change Item</p>
                                                                  <p class="mb-0">Fire Place</p>
                                                               </td>
                                                               <td colspan="2">
                                                                  <p class="mb-0">Revised Item</p>
                                                                  <p class="mb-0">Heater</p>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">FREE</p>
                                                               </td>
                                                            </tr>
                              <tr>
                                                               <td>
                                                                  <p class="mb-0">Change Type</p>
                                                                  <p class="mb-0">Shopping List</p>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Change Item</p>
                                                                  <p class="mb-0">Side Lamp Light</p>
                                                               </td>
                                                               <td colspan="2">
                                                                  <p class="mb-0">Revised Item</p>
                                                                  <p class="mb-0">Ferry Light</p>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">FREE</p>
                                                               </td>
                                                            </tr>
                              <tr>
                                                               <td>
                                                                  <p class="mb-0">Change Type</p>
                                                                  <p class="mb-0">Paint Palette</p>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Change Item</p>
                                                                  <p class="mb-0">Teal</p>
                                                               </td>
                                 <td>
                                                                  <p class="mb-0">Finish</p>
                                                                  <p class="mb-0">Matt</p>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">Application</p>
                                                                  <p class="mb-0">Ceiling</p>
                                                               </td>
                                                               <td>
                                                                  <p class="mb-0">PAID</p>
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div  class="col-12 float-left p-4">
                                                <div class="row">
                           <div class="col-12 float-left mt-2 px-0">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 float-right mb-2">
                              <button type="button" class="btn btn-primary col-12 loginBtn" data-toggle="modal" data-target="#buyDesignpop">Get the Best Quote for the interested Shopping List items</button>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12 float-right mb-2">
                              <button type="button" class="btn btn-primary col-12 cancleBtn">Edit Shipping Address</button>
                            </div>
                          </div>
                                                </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                 <!------------Tab 3 End------------>
                 
                 <!------------Tab 4 Start------------>
                                 <div class="tab-pane fade" id="abandoned" role="tabpanel" aria-labelledby="abandoned-tab">
                                    <div class="col-12 float-left px-0">
                                       <div class="col-12 float-left customersBuyContant px-0 orderSummary">
                                          <div class="col-12 float-left px-4 pt-4">
                                             <div class="col-12 px-0 landingHeading">
                                                <h4 class="mb-2">
                                                   <span>Order No: PN0321A001</span>
                                                </h4>
                                             </div>
                                          </div>
                      <div class="col-12 float-left p-4 mt-3 orderSummaryTable">
                      <div class="col-12 px-0 landingHeading">
                                                <h4 class="mb-2">
                                                   <span>Final Amount to Pay</span>
                                                   <span class="float-md-right float-left">Date: 10-02-21 Time: 12:00 pm</span>
                                                </h4>
                                             </div>
                       <p class="col-12 float-left px-0">Order No: PN0321A001</p>
                                             <table class="table mb-0">
                          <thead>
                          <tr>
                            <th scope="col">Items</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Rate</th>
                            <th scope="col">Price</th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                            <td>Shopping Items</td>
                            <td>03</td>
                            <td>$ 3,500.00</td>
                            <td>$ 3,500.00</td>
                          </tr>
                          <tr>
                            <td>Shipping Cost</td>
                            <td>01</td>
                            <td>$ 150.00</td>
                            <td>$ 150.00</td>
                          </tr>
                          <tr>
                            <td>State TAX</td>
                            <td>01</td>
                            <td>$ 70</td>
                            <td>$ 70</td>
                          </tr>
                          <tr>
                            <td>Discount</td>
                            <td>01</td>
                            <td>$ -37</td>
                            <td>$ -37</td>
                          </tr>
                          <tr>
                            <td colspan="4" class="text-right totalPrice">Total $ 3683</td>
                          </tr>
                          </tbody>
                        </table>
                        <p class="col-12 float-left px-0">Disclaimer</p>
                        <p class="col-12 float-left px-0 mb-0 savedMoney">Order valid till 2 weeks of the day of generation <span>You Saved $37</span></p>
                                          </div>
                      
                      <div  class="col-12 float-left p-4 shoppingList mt-3 mb-4">
                                             <div class="col-md-6 col-sm-12 col-12 float-left pl-4 pr-0 orderSummaryChecklist">
                                                <p><i class="fas fa-check-square mr-2"></i> Shopping Cost</p>
                                                <p><i class="fas fa-check-square mr-2"></i> Change Cost</p>
                                                <p><i class="fas fa-check-square mr-2"></i> Shipping Cost</p>
                                                <p><i class="fas fa-check-square mr-2"></i> State Tax</p>
                                                <p><i class="fas fa-check-square mr-2"></i> Panacche Discount</p>
                                             </div>
                       <div class="col-md-6 col-sm-12 col-12 float-left px-0 text-right payNowBtn">
                                                <button type="button" class="btn btn-primary loginBtn col-12 col-sm-12 col-md-auto font-weight-bold">Pay Now</button>
                                             </div>
                                          </div>
                      
                                       </div>
                                    </div>
                                 </div>
                 <!------------Tab 4 End------------>
                 
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
<style type="text/css">
  .page-container {
      transform: unset;
  }
</style>