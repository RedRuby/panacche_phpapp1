@if($designs->count() !=0 )
					  <div class="col-12 px-0">
							<div class="row px-0 designCards">
                                @foreach($designs as $design)
							  <div class="col-lg-3 col-md-6 col-sm-6">
								<div class="card">
                                    @if($design->collectionImages()->count() == 0)
                                    <img src="images/design1.jpg" class="card-img cover-photo" alt="Cover">
                                    @else
                                    <img src="{{  asset('uploads/collection/images/'.$design->collectionImages()->first()->img_src) }}" class="card-img cover-photo" alt="Cover">
                                    @endif
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
										<a href="#" class="social social-instagram mr-3"><i class="fab fa-instagram"></i></a>
                                        <a href="#" class="social social-facebook text-facebook mr-3"><i class="fab fa-facebook"></i></a>
                                        <a href="#" class="social social-pinterest mr-3"><i class="fab fa-pinterest"></i></a>
                                    </div>
                                </div>
                              </div>
                              @endforeach

                            </div>


                      </div>

            @else <h1>This Type of designs are not available</h1>
            @endif


		<div class="row meetDesigners py-2">
			<div class="text-center col-12">
				<p>MEET OUR DESIGNERS</p>
				<p>We are the one stop shop where Priceless designs meet Affordability. We are passionate about building beautiful homes and believe that access to good quality designs should be within the reach of our customers.</p>
			</div>
		</div>

		<div class="row align-items-center h-100 mt-5 px-5 pb-5">
            @if(count($designers))
		  <div id="myCarousel" class="carousel slide w-100" data-ride="carousel">
			<div class="carousel-inner row w-100 mx-auto designCards designersApproveCards">
                @foreach($designers as $designer)
                    <div class="carousel-item col-md-3 active">
                        <div class="card">
                            <!-- <p class="cardChekbox">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            </p> -->
                            <p class="designerProf rounded-circle mt-4 mx-auto mb-0">
                                <img src="images/designerPic1.jpg" class="card-img cover-photo" alt="Cover">
                            </p>
                            <div class="card-body p-1">
                                <div class="align-items-center mb-2">
                                    <div class="author-info text-center">
                                        <p class="mb-0">{{ $designer->first_name }} {{ $designer->last_name }}</p>
                                        <p class="mb-0">12 year experience</p>
                                        <p class="mb-0">
                                            <span class="mr-1">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </span>
                                            <span>Highly Rated</span>
                                        </p>
                                        <p class="mb-0 d-inline">
                                            <span class="mr-1">Design Styles</span>
                                            <span>Modern. |. Rustic</span>
                                        </p>
                                        <p class="mb-0 my-3"><button type="button" class="btn btn-primary view-designer-profile-btn" data="{{ $designer->id }}">View Profile</button></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
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
          @else <h1>No Active Designers Forund</h1>
          @endif

        </div>



