<div class="col-md-12 col-sm-12 col-xs-12 pl-5 mx-auto">
     <div class="leftPart col-lg-8 col-md-12 col-sm-12 col-12 float-left pl-3 pr-0 mt-4">
      <input type="hidden" name="myProjectId" id="myProjectId" value="{{$my_project_id}}">
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
                 <p class="">You Save: ${{(($design->room_budget*$discount->discount)/100)}} ({{$discount->discount}}%)
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
                    <span class="py-1 px-3 mr-2 mb-2">{{ $design->room_style }}</span>
                    @if($design->pet_friendly_design == 'Yes')
                      <span class="py-1 px-3 mr-2 mb-2">Pet Friendly</span>
                    @endif
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
     @include('pages.chate')
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
                          <!-- Design Gallery Modal -->
                          <div class="modal fade galleryModel" id="designGalleryPop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                             <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                   <div class="modal-header p-0 border-bottom-0">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                      </button>
                                   </div>
                                   <div class="modal-body">
                                    <img src="" id="designGalleryImg" class="img-fluid" alt="Cover">
                                    <a class="gallery-control-prev" href="javascript:;" role="button" data-slide="prev">
                                      <span class="gallery-control-prev-icon" aria-hidden="true">
                                        <i class="fas fa-chevron-left" aria-hidden="true"></i>
                                      </span>
                                      <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="gallery-control-next" href="javascript:;" role="button" data-slide="next">
                                      <span class="gallery-control-next-icon" aria-hidden="true">
                                        <i class="fas fa-chevron-right" aria-hidden="true"></i>
                                      </span>
                                      <span class="sr-only">Next</span>
                                    </a>
                                   </div>
                                </div>
                             </div>
                          </div>
                        <div class="col-md-3 gallery float-left px-0">
                           <p class="px-3">Concept Board</p>
                           <div class="col-lg-12 col-md-12 col-xs-6 thumb float-left">
                              <a href="#" data-toggle="modal" data-target="#galleryPop">
                                 <figure>
                                    <img class="img-fluid img-thumbnail h-100" src="{{  asset('uploads/collection/'.$design->id.'/'.$concept_board_image->img_src) }}" alt="{{$concept_board_image->img_alt}}">
                                  </figure>
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
                                    <img class="img-fluid w-100" src="{{  asset('uploads/collection/'.$design->id.'/'.$concept_board_image->img_src) }}" alt="{{$concept_board_image->img_alt}}">
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
                                    <a class="nav-link py-4 active tabVisited1" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">Get Design Guide</a>
                                 </li>
                                 <li class="nav-item" role="presentation">
                                    <a class="nav-link py-4 showActive tabVisited2" id="in_progress-tab" data-toggle="tab" href="#in_progress" role="tab" aria-controls="progress" aria-selected="false">Customer Changes</a>
                                 </li>
                                 <li class="nav-item" role="presentation">
                                    <a class="nav-link py-4 showActive tabVisited3" id="delivered_paid-tab" data-toggle="tab" href="#delivered_paid" role="tab" aria-controls="delivered_paid" aria-selected="false">Final Design</a>
                                 </li>
                                 <li class="nav-item" role="presentation">
                                    <a class="nav-link py-4 showActive tabVisited4" id="abandoned-tab" data-toggle="tab" href="#abandoned" role="tab" aria-controls="abandoned" aria-selected="false">Pannache Conceirge</a>
                                 </li>
                              </ul>
                              <div class="tab-content showAllContent" id="myTabContent">
                
                <!------------Tab 1 Start------------>
                                 <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                    @include('pages.customer.get-design-guide',["product_variant_id" => $product_variant_id, "design" => $design])
                                 </div>
                 <!------------Tab 1 End------------>
                 
                 <!------------Tab 2 Start------------>
                                 <div class="tab-pane fade" id="in_progress" role="tabpanel" aria-labelledby="in_progress-tab">
                                    @include('pages.customer.customer-changes',["product_variant_id" => $product_variant_id, "design" => $design,"refrenceLinks" => $refrenceLinks,"selected_products" => $selected_products])
                                 </div>
                 <!------------Tab 2 End------------>
                 
                 <!------------Tab 3 Start------------>
                                 <div class="tab-pane fade" id="delivered_paid" role="tabpanel" aria-labelledby="delivered_paid-tab">
                                    @include('pages.customer.final-design',["product_variant_id" => $product_variant_id, "design" => $design,"selected_products" => $selected_products])
                                 </div>
                 <!------------Tab 3 End------------>
                 
                 <!------------Tab 4 Start------------>
                                 <div class="tab-pane fade" id="abandoned" role="tabpanel" aria-labelledby="abandoned-tab">
                                    @include('pages.customer.pannache-conceirge',["product_variant_id" => $product_variant_id, "design" => $design])
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