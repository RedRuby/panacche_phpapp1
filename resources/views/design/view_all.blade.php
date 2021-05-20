@if($designs->count() !=0 )
					  <div class="col-12 px-0">
							<div class="row px-0 designCards">
                                @foreach($designs as $design)
							  <div class="col-lg-3 col-md-6 col-sm-6">
								<div class="card">
                                    <div class="card-img projectImg">
                                    @if($design->collectionImages->count() == 0)
                                    <img alt="Cover" class="card-img cover-photo" src="{{  asset('default/design.jpg') }}" />

                                    @else
                                    <img src="{{  asset('uploads/collection/'.$design->id.'/'.$design->collectionImages()->first()->img_src) }}" class="card-img cover-photo" alt="Cover">
                                    @endif
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="author-img">
                                                <img src="{{ $design->image_src }}" alt="{{ $design->image_alt }}" class="img-fluid rounded-circle mr-1" style="width:35px">
                                            </div>
                                            <div class="author-info">
                                                <p class="mb-0">{{ $design->design_name }}</p>
                                            </div>
                                        </div>
                                        <p class="card-text">{{ $design->room_budget }}</p>
                                    </div>
                                    <div class="card-footer d-flex">
										<a href="{{ $design->twitter }}" class="social social-twitter mr-3"><i class="fab fa-twitter"></i></a>
                                        <a href="{{ $design->facebook }}" class="social social-facebook text-facebook mr-3"><i class="fab fa-facebook"></i></a>
                                        <a href="{{ $design->whatsapp }}" class="social social-whatsapp mr-3"><i class="fab fa-whatsapp"></i></a>
                                    </div>
                                </div>
                              </div>
                              @endforeach

                            </div>


                      </div>

            @else <h1>This Type of designs are not available</h1>
            @endif




