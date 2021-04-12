
        @if(count($designGroups))
        @foreach($designGroups as $key => $designGroup)

        <div class="row px-5 galleryDesigns">
            <div class="col-12 px-0 galleryHeading">
               <h4 class="mb-4">
                  <span>{{ strtoupper($key) }}</span>
               </h4>
            </div>
            @if(count($designGroup))
            <div class="col-12 px-0">
               <div class="row px-0 designCards">
                @foreach($designGroup as $design)
                  <div class="col-lg-3 col-md-6 col-sm-6">
                     <div class="card">
                        <img src="images/design1.jpg" class="card-img cover-photo" alt="Cover">
                        <div class="card-body p-3">
                           <div class="d-flex align-items-center mb-2">
                              <div class="author-img">
                                 <img src="images/person-2.jpg" alt="Person" class="img-fluid rounded-circle mr-1" style="width:35px">
                              </div>
                              <div class="author-info">
                                 <p class="mb-0">Beautiful Boy’s Den</p>
                              </div>
                           </div>
                           <p class="card-text">$ 300.00</p>
                        </div>
                        <div class="card-footer d-flex">
                           <a href="#" class="social social-instagram mr-3"><i class="fab fa-instagram"></i></a>
                           <a href="#" class="social social-facebook text-facebook mr-3"><i class="fab fa-facebook"></i></a>
                           <a href="#" class="social social-pinterest mr-3"><i class="fab fa-pinterest"></i></a>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-6 mt-4 mt-md-0 mt-sm-0 mt-lg-0">
                     <div class="card">
                        @if($design->collectionImages()->count() == 0)
                        <img src="images/design1.jpg" class="card-img cover-photo" alt="Cover">
                        @else
                        <img src="{{  asset('uploads/collection/'.$design->id. '/' .$design->collectionImages()->first()->img_src) }}" class="card-img cover-photo" alt="Cover">
                        @endif

                        <div class="card-body p-3">
                           <div class="d-flex align-items-center mb-2">
                                @if($design->designer->display_picture)
                                <div class="author-img">
                                    <img src="{{ asset('uploads/collection/'.$design->id.'/'.$design->designer->display_picture)}}" alt="Person" class="img-fluid rounded-circle mr-1" style="width:35px">
                                </div>
                                @else
                                <div class="author-img">
                                    <img src="{{ asset('uploads/collection/designer/defaultUserImg') }}" alt="Person" class="img-fluid rounded-circle mr-1" style="width:35px">
                                </div>
                                @endif
                              <div class="author-info">
                                 <p class="mb-0">{{ $design->design_name }}</p>
                              </div>
                           </div>
                           <p class="card-text">$ {{ $design->room_budget }}</p>
                        </div>
                        <div class="card-footer d-flex">
                           <a href="#" class="social social-instagram mr-3"><i class="fab fa-instagram"></i></a>
                           <a href="#" class="social social-facebook text-facebook mr-3"><i class="fab fa-facebook"></i></a>
                           <a href="#" class="social social-pinterest mr-3"><i class="fab fa-pinterest"></i></a>
                        </div>
                     </div>
                  </div>
                @endforeach
               </div>
               <div class="row mt-4 mb-0">
                  <p class="col-12 viewMorebtn text-right"><a href="{{ env('Shop_URL') }}/pages/view-all?type={{$key}}"><button type="button" class="btn btn-primary">View More</button></a></p>
               </div>
            </div>
        </div>
         @endif
        @endforeach
    @else <h1>Designs are not available</h1>
    @endif
