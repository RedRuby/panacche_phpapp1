
        @if($designGroups->count() == 0)
            <h4>Designs Not Found</h4>
        @endif
        @if(count($designGroups))
        @foreach($designGroups as $key => $designGroup)

        <div class="row px-5">
            <div class="col-12 px-0 galleryHeading">
               <h4 class="mb-4">
                  <span>{{ strtoupper($key) }}</span>
               </h4>
            </div>
            @if(count($designGroup))
            <div class="col-12 px-0">
               <div class="row px-0 designCards">
                @foreach($designGroup as $design)
                <a href="{{ env('Shop_URL') }}/pages/buy-design?id={{ $design->id }}">

                    <div class="col-lg-3 col-md-6 col-sm-6 mt-4 mt-md-0 mt-sm-0 mt-lg-0">
                        <div class="card">
                            <div class="card-img projectImg">
                           @if($design->collectionImages()->count() == 0)
                           <img src="{{  asset('default/design.jpg') }}" class="card-img cover-photo" alt="Cover">
                           @else
                           <img src="{{  asset('uploads/collection/'.$design->id. '/' .$design->collectionImages()->first()->img_src) }}" class="card-img cover-photo" alt="Cover">
                           @endif
                            </div>

                           <div class="card-body p-3">
                              <div class="d-flex align-items-center mb-2">
                                   @if($design->designer->display_picture)
                                   <div class="author-img">
                                       <img src="{{ asset('uploads/designer/display_picture/'.$design->designer->display_picture)}}" alt="Person" class="img-fluid rounded-circle mr-1" style="width:35px">
                                   </div>
                                   @else
                                   <div class="author-img">
                                       <img src="{{ asset('default/user.png') }}" alt="Person" class="img-fluid rounded-circle mr-1" style="width:35px">
                                   </div>
                                   @endif
                                 <div class="author-info">
                                    <p class="mb-0">{{ $design->design_name }}</p>
                                 </div>
                              </div>
                              <p class="card-text">$ {{ $design->room_budget }}</p>
                           </div>
                           <div class="card-footer d-flex">
                            <a href="{{ $design->twitter }}" class="social social-twitter mr-3"><i class="fab fa-twitter"></i></a>
                            <a href="{{ $design->facebook }}" class="social social-facebook text-facebook mr-3"><i class="fab fa-facebook"></i></a>
                            <a href="{{ $design->whatsapp }}" class="social social-whatsapp mr-3"><i class="fab fa-whatsapp"></i></a>
                           </div>
                        </div>
                     </div>
                </a>

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
