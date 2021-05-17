<div class="col-md-12 col-sm-12 col-xs-12 pl-5 mx-auto">
     <div class="leftPart col-lg-8 col-md-12 col-sm-12 col-12 float-left pl-3 pr-0 mt-4">
      <input type="hidden" name="myProjectId" id="myProjectId" value="{{$my_project_id}}">
        @include('pages.design_basics')
     </div>
      @if($my_project_id)
        @include('pages.chate')
      @endif
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
                                    @if(isset($concept_board_image->img_src))
                                      <img class="img-fluid img-thumbnail h-100" src="{{  asset('uploads/collection/'.$design->id.'/'.$concept_board_image->img_src) }}" alt="{{$concept_board_image->img_alt}}">
                                    @else
                                      <img class="img-fluid img-thumbnail h-100" src="" alt="">
                                    @endif
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

                           <div class="col-md-12 col-xs-12 float-left px-0 mb-3 tabHorizontal">
                              <ul class="nav nav-tabs showAllTabs row nav-pills nav-justified px-3" id="myTab" role="tablist">
                                 <li class="nav-item" role="presentation">
                                    <a class="nav-link py-4 active tabVisited1" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">Get Design Guide</a>
                                 </li>
                                 <li class="nav-item" role="presentation">
                                    <a class="nav-link py-4 showActive tabVisited2 @if(!$my_project_id) disabled @endif " id="in_progress-tab" data-toggle="tab" href="#in_progress" role="tab" aria-controls="progress" aria-selected="false">Customer Changes</a>
                                 </li>
                                 <li class="nav-item" role="presentation">
                                    <a class="nav-link py-4 showActive tabVisited3 disabled" id="delivered_paid-tab" data-toggle="tab" href="#delivered_paid" role="tab" aria-controls="delivered_paid" aria-selected="false">Final Design</a>
                                 </li>
                                 <li class="nav-item" role="presentation">
                                    <a class="nav-link py-4 showActive tabVisited4 disabled" id="abandoned-tab" data-toggle="tab" href="#abandoned" role="tab" aria-controls="abandoned" aria-selected="false">Pannache Conceirge</a>
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
