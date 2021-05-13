
            <div class="col-md-12 col-sm-12 col-xs-12 mx-auto designDetails mt-5">
               <div class="leftPart col-lg-12 col-md-12 col-sm-12 col-12 float-left pl-3 pr-0">
                  <div class="row px-3">
                     <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 px-0 designCards float-left buyDesign">
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
                     <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 float-left mt-md-4 mt-lg-0 pl-md-0 pl-lg-3 pr-md-0 pr-lg-3">
                        <div class="col-12 px-0 landingHeading float-left">
                           <h4 class="mb-1 mt-md-0 col-12 float-left px-0">
                              <span>{{ $design->design_name }}</span>
                           </h4>
                        </div>
                        <div class="col-12 px-0 roomsDisc float-left">
                           <p class="mb-0">Style: <span>{{ $design->room_style }}<span></p>
                           <p class="mb-0">Total Design Package Price: ${{ $design->room_budget }}</p>
                        </div>
                        <div class="col-12 px-0 panaccheSaving float-left">
                           <p class="">
                              <span class="text-center ibtn">i 
                              <span class="tooltiptext text-left">Note: This does not include tax and shipping cost</span>
                              </span>
                           </p>
                        </div>
                        <div class="col-12 px-0 float-left">
                           <div class="getaGuideWrap col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12 float-left p-4">
                              <p class="getGuideHead font-weight-bold">
                                <i class="fas fa-exclamation-circle mr-2"></i> Buy Design Implementation Guide
                              </p>
                              <div class="col-md-6 float-left px-0">
                                {!! $product_description !!}
                              </div>
                              <div class="col-md-6 getGuideBox float-left">
                                <p class="py-4 mb-0">${{ $design->design_price }}</p>
                                <p class="py-3"><a href="#" data-toggle="modal" data-target="#getGuidePop" class="py-3">Get a guide NOW!</a></p>
                              </div>
                           </div>
                        </div>
                        <div class="col-12 px-0 landingHeading float-left">
                           <h4 class="mb-1 mt-4 col-12 float-left px-0">
                              <span>Design Description</span>
                           </h4>
                        </div>
                        <div class="col-12 px-0 designDisc float-left">
                           <p class="mb-1">Approximate Room Size : 
                        <p class="mb-1">Approximate Room Size : {{ $design->room_width_in_feet }} ft {{ $design->room_width_in_inches }} inches x {{ $design->room_height_in_feet }} ft {{ $design->room_height_in_inches }} inches</p>
                           <p class="mb-0">{{ $design->implementation_guide_description }}</p>
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
               
            </div>
            <div class="clear"></div>
            <div class="col-md-12 col-sm-12 col-xs-12 px-0 mx-auto mt-4">
               <div class="col-md-12">
                  <div class="row px-3 mt-2 mb-md-5">
                     <div class="col-12 px-0 landingHeading text-center">
                        <h4 class="mb-2 col-12 float-left px-0">
                           <span>Design Gallery</span>
                        </h4>
                     </div>
                     <div class="row px-0 designGalleryWrap mt-3 p-4">
                        <div class="col-12 float-left align-items-center mt-4 px-5 pb-4">
                      
                          <div id="myCarousel" class="carousel slide w-100" data-ride="carousel">
                                <div class="carousel-inner row w-100 mx-auto designCards">
                            @php
                            $i = 0
                            @endphp
                            @foreach ($design->products as $pkey => $product)
                              @foreach ($product->productImages as $key => $productImage)
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
                                      <img src="{{  asset('uploads/collection/product/images/'.$productImage->img_src) }}" class="card-img cover-photo" alt="Cover">
                                    </a>
                                 </div>
                                </div>
                              </div>
                              @endforeach
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
                                    <img class="img-fluid" src="images/buy_design_img.jpg" alt="Random Image">
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                        <!-- Get Guide Modal -->
                        <div class="modal fade galleryModel getGuidePop subDesignPop" id="getGuidePop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                               <div class="modal-header py-0 px-2">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                               </div>
                               <div class="modal-body text-center pt-4">
                                  <p>Request Registration</p>
                                  <p class="px-5 mb-0">To access the details of the design, Kindly register as a Panacche user. </p>
                               </div>
                               <div class="modal-footer text-center d-block pb-4">
                                  <button type="button" class="btn btn-primary loginBtn"><a href="{{ env('Shop_URL') }}/account/login?return_url={{ env('Shop_URL') }}/pages/buy-design?id={{ $design->id }}">Login</a></button>
                               </div>
                            </div>
                         </div>
                        </div>
                        
                     </div>
                     
                  </div>
               </div>
            </div>