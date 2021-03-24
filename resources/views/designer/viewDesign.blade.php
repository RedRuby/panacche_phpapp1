@foreach ($design as $design )

	<div class="container-fluid landingPageWrap">
		<div class="row align-items-center h-100">

			<div class="col-md-12 col-sm-12 col-xs-12 mx-auto pl-5 createNewForm createNewFormView">

				<div class="logo col-12 float-left mb-4 px-3 mt-4"><img src="images/panacche_logo.png"></div>

				<div class="col-12 px-3 landingHeading float-left">
					<h4 class="mb-4">
						<span class="float-left mr-4">Create New Design</span>
						<div class="form-group float-left">
								<select class="custom-select selectDropdown">
								  <option selected>Draft</option>
								  <option value="1">Published</option>
								  <option value="2">Inactive</option>
								</select>
						</div>
						<div class="float-left float-sm-right float-md-right mb-4 mb-mb-0">
							<a href="landing_page.html">
								<button type="button" class="btn btn-primary cancelBtn float-right removeDesignbtn pr-5">Remove this design
									<i class="fas fa-times-circle newDesignClose"></i>
								</button>
							</a>
						</div>
					</h4>
				</div>

				<div class="col-12 px-3 stepsWrap float-left mb-4">
					<div class="row">
						<div class="col-lg-2 col-md-3 col-sm-6 float-left">
							<p class="stepsCount mb-1 pl-4 ml-1">Step 1</p>
							<p class="stepsName">
								<span class="notComplated mr-2 greenActive"></span>
								<span class="greenActiveText">Add Room Details</span>
							</p>
						</div>
						<div class="col-lg-1 float-left px-0 d-none d-lg-block">
							<p class="stepArrow mb-0">
								<i class="fas fa-caret-right"></i>
							</p>
							<p class="stepLine mb-0 mt-4"></p>
						</div>
						<div class="col-lg-2 col-md-3 col-sm-6 float-left">
							<p class="stepsCount mb-1 pl-4 ml-1">Step 2</p>
							<p class="stepsName">
								<span class="notComplated mr-2 greenActive"></span>
								<span class="greenActiveText">Add Merchandise</span>
							</p>
						</div>
						<div class="col-lg-1 float-left px-0 d-none d-lg-block">
							<p class="stepArrow mb-0">
								<i class="fas fa-caret-right"></i>
							</p>
							<p class="stepLine mb-0 mt-4"></p>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 float-left">
							<p class="stepsCount mb-1 pl-4 ml-1">Step 3</p>
							<p class="stepsName">
								<span class="notComplated mr-2 greenActive"></span>
								<span class="greenActiveText">Submit Design For Approval</span>
							</p>
						</div>
						<div class="col-lg-1 float-left px-0 d-none d-lg-block">
							<p class="stepArrow mb-0">
								<i class="fas fa-caret-right"></i>
							</p>
							<p class="stepLine mb-0 mt-4"></p>
						</div>
						<div class="col-lg-2 col-md-3 col-sm-6 float-left">
							<p class="stepsCount mb-1 pl-4 ml-1">Step 4</p>
							<p class="stepsName">
								<span class="notComplated mr-2 greenActive"></span>
								<span class="greenActiveText">Publish Design</span>
							</p>
						</div>
					</div>
				</div>

				<div class="leftPart col-md-5 col-xs-12 float-left px-3">
						<div class="registerForm col-md-12 col-xs-12 float-left px-0">
							<form class="mx-0">
							  <div class="col-12 px-0 float-left mb-3">
								<label for="">Design Name</label>
								<p>{{ $design->design_name }}</p>
							  </div>

							  <div class="col-12 px-0 float-left mb-3">
								<div class="form-group col-6 float-left pl-0">
									<label for="">Design Price</label>
									<p class="mb-0">$ {{ $design->design_price }}</p>
								</div>
								<div class="form-group col-6 float-left pr-0">
									<label for="">Room Budget</label>
									<p class="mb-0">$ {{ $design->room_budget }}</p>
								</div>
							  </div>

							  <div class="col-12 px-0 float-left mb-3">
								<div class="form-group col-6 float-left pl-0">
									<label for="">Room Type</label>
									<p class="mb-0">{{ $design->room_type }}</p>
								</div>
								<div class="form-group col-6 float-left pr-0">
									<label for="">Room Style</label>
									<p class="mb-0">{{ $design->room_style }}</p>
								</div>
							  </div>


							  <div class="col-12 px-0 float-left mb-3">
								<label for="" class="w-100">Approximate Room Size </label>
								<div class="form-group col-12 float-left px-0 mb-0">
									<p class="col-12 float-left pl-0">
										<span>{{ $design->width_in_feet }} feet {{ $design->width_in_inches }} inches </span>
										<span class="mx-4 pt-2"><i class="fas fa-times"></i></span>
										<span>{{ $design->height_in_feet }} feet {{ $design->height_in_inches }} inches </span>
									</p>
								</div>
							  </div>

							  <div class="col-12 px-0 float-left mb-3">
								<label for="">Design Description</label>
								<p>{{ $design->implementation_guide_description }}</p>
							  </div>

							  <div class="col-12 px-0 mb-3 float-left mb-3">
								<label for="" class="mr-3">Is this a Pet Friendly Design?</label>
								<span>Yes</span>
							  </div>

							  <div class="col-12 px-0 float-left">
								<label for="" class="w-100">Design Implementation Guide</label>
								<span>DIG.zip</span>
							  </div>

							</form>
						</div>

				</div>

				<div class="rightPart col-md-7 col-xs-12 float-left px-sm-3 mt-md-0 mt-4">
					<label for="" class="col-12 px-0">Media</label>
					<p>3D rendered Images</p>
					<div class="col-md-12 col-xs-12 float-left px-0 mb-3">
						<div class="row">
							@if($design->collectionImages->count() == 0)
                            <p class="col-md-3 col-sm-6 col-6 uploadedImagesView">
                                <img alt="Cover" class="card-img cover-photo" src="{{  asset('uploads/collection/images/design1.jpg') }}" />
                            </p>
                            @else

                            @foreach($design->collectionImages as $collectionImage)
							    <p class="col-md-3 col-sm-6 col-6 uploadedImagesView"><img class="img-fluid" src="{{  asset('uploads/collection/images/'.$collectionImage->img_src) }}"></p>
                            @endforeach
                            @endif
						</div>
					</div>

					<p>Concept Board</p>
					<div class="col-md-12 col-xs-12 float-left px-0 mb-3">
						<div class="row">
                            @if($design->bluePrintImages->count() == 0)
                            <p class="col-md-3 col-sm-6 col-6 uploadedImagesView"></p>
                            @else

                            @foreach($design->bluePrintImages as $bluePrintImage)
							<p class="col-md-3 col-sm-6 col-6 uploadedImagesView"><img class="img-fluid" src="{{  asset('uploads/collection/blue_prints/'.$bluePrintImage->img_src) }}"></p>
                            @endforeach
                            @endif
						</div>
					</div>

					<label for="" class="col-12 px-0">Paint Pallette</label>
					<div class="dragandDropWrap col-md-12 col-xs-12 float-left px-3">
							<table class="table colorPaintTable colorPaintTableView mb-0">
							  <thead>
								<tr>
								  <th scope="col">Color</th>
								  <th scope="col">Color Name</th>
								  <th scope="col">Brand</th>
								  <th scope="col">Finish</th>
								  <th scope="col">Application</th>
								</tr>
							  </thead>
							  <tbody>
								@if($design->colorPallettes->count() == 0)
                                <tr></tr>
                                @else

                                @foreach($design->colorPallettes as $colorPallette)

								<tr>
								  <td>
									<div class="col-12 float-left px-0">
										<p class="custom-file addColor brownColor">
                                            <img src="{{  asset('uploads/collection/color_pallates/'.$colorPallette->color_img) }}" />
                                        </p>
									</div>
								  </td>
								  <td>{{ $colorPallette->color_name }}</td>
								  <td>{{ $colorPallette->brand }}</td>
								  <td>{{ $colorPallette->finish }}</td>
								  <td>{{ $colorPallette->application }}</td>
								</tr>
                                @endforeach
                                @endif
							  </tbody>
							</table>
					</div>

				</div>
			</div>
		</div>

		<div class="row mt-4 px-3">
			<div class="col-md-12 float-left mb-5 pl-5">
				<label for="" class="col-12 px-0 font14">Added Merchandise</label>
				<div class="addRefWrap col-12 float-left py-3 mb-3">
                    @if($design->products->count() == 0)
                    <div class="col-12 float-left px-0 addmerchBoxWrap"></div>
                    @else

                    @foreach($design->products as $product)
					<div class="col-12 float-left px-0 addmerchBoxWrap">
						<label for="" class="col-12 px-0 mb-0">1</label>

						<div class="row addmerchBox borderradius6 mt-1 mx-0 pt-3">
							<div class="col-md-4 float-left">
								<p>Merchandise</p>
								<p>{{ $product->title }}</p>
								<p>Description (Sourcing / Vendor)</p>
								<p>{{ $product->description }}</p>

								<div class="col-6 px-0 float-left colorVariants">
									<p class="mb-1">Quantity</p>
									<p>{{ $product->product_quantity }}</p>
								</div>
							</div>
							<div class="col-md-4 float-left">
								<p>Specification</p>
								<p>{{ $product->size_specification }}'</p>
								<p>URL</p>
								<p>{{ $product->product_url }}</p>
								<div class="col-6 px-0 float-left">
									<p>Price</p>
									<p>$ {{ $product->product_price }}</p>
								</div>
								<div class="col-6 px-0 float-left colorVariants">
									<p>Discount</p>
									<p>7%</p>
								</div>
							</div>
							<div class="col-md-4 float-left">
								<p>Upload Image Reference
									<span class="deleteUpload"><i class="fas fa-times-circle"></i></span>
								</p>
								<p class="border border-light"><img src="images/upload_mearch_Img1.jpg" class="img-fluid"></p>
								<div class="row uploadedImage px-0">

                                    @if($product->productImages->count() == 0)

                                    @else

                                    @foreach($product->productImages as $product)
                                        <div class="col-4 float-left">
                                            <p><img src="{{  asset('uploads/collection/product/images/'.$product->img_src) }}"></p>
                                        </div>

                                    @endforeach
                                    @endif

								</div>
							</div>
						</div>
                    </div>
                    @endforeach
                    @endif
				</div>

				<div class="col-12 float-left text-right px-0">
					<button type="button" class="btn btn-primary loginBtn">Unpublish Design</button>
				</div>

			</div>
		</div>

	</div>

	<!-- Submit New Design Popup Modal -->
	<!--<div class="modal fade subDesignPop" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header py-0 px-2">
					<p class="text-center mx-auto modelLogo mt-3"><img src="images/panacche_logo.jpg"></p>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center py-0">
					<p class="text-center mb-0"><i class="fas fa-check"></i></p>
					<p>Submitted Successfully</p>
					<p class="mb-0">Your design has been submitted to admin for review, once approved, This shall appear on your design lists under your design library. You shall get a notification from system upon approval.</p>
				</div>
				<div class="modal-footer text-center d-block pb-4">
					<button type="button" class="btn btn-primary loginBtn"><a href="landing_page.html">My Dashboard</a></button>
				</div>
			</div>
		</div>
	</div>-->

@endforeach
