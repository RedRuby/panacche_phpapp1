  <div class="col-md-12 col-sm-12 col-xs-12 pl-5 mx-auto mt-5 pt-5">
    <div class="col-md-12 float-left galleryBack">
       <a href="javascript&colon; history.go(-1)"><span><i class="fas fa-arrow-left"></i></span></a>
    </div>
    <div class="leftPart col-md-12 col-xs-12 float-left pl-3 pr-0 mt-2">
       <div class="row px-3 mt-2 mb-0 mb-md-3">
          <div class="col-12 px-0 landingHeading">
             <h4 class="mb-4">
                <span>Pending Approval</span>
             </h4>
          </div>
          <div class="col-md-12 col-xs-12 float-left px-0 mb-3">
             <ul class="nav nav-tabs showAllTabs row" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                   <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All</a>
                </li>
                <li class="nav-item" role="presentation">
                   <a class="nav-link" id="in_progress-tab" data-toggle="tab" href="#in_progress" role="tab" aria-controls="progress" aria-selected="false">Designers</a>
                </li>
                <li class="nav-item" role="presentation">
                   <a class="nav-link" id="inactive-tab" data-toggle="tab" href="#inactive" role="tab" aria-controls="inactive" aria-selected="false">Designs</a>
                </li>
                <li class="nav-item" role="presentation">
                   <a class="nav-link" id="under_review-tab" data-toggle="tab" href="#under_review" role="tab" aria-controls="under_review" aria-selected="false">Order</a>
                </li>
                <li class="nav-item" role="presentation">
                   <a class="nav-link" id="delivered_paid-tab" data-toggle="tab" href="#delivered_paid" role="tab" aria-controls="delivered_paid" aria-selected="false">Sale</a>
                </li>
             </ul>
             <div class="tab-content showAllContent mt-4" id="myTabContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                     <div class="row">
                       <div class="col-lg-4 col-md-4 col-sm-6 col-6 float-left">
                          <i class="fas fa-search" aria-hidden="true"></i>
                          <input type="search" class="form-control col-12 float-left pl-5 searchInput" placeholder="Search">
                       </div>
                       <div class="col-lg-2 col-md-4 col-sm-6 col-6 float-left">
                          <div class="form-group">
                             <select class="custom-select selectDropdown">
                                <option selected="">Filter</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="3">4</option>
                             </select>
                          </div>
                       </div>
                   </div>
                   <div class="col-12 float-left mt-3 px-0">
                      <div class="row px-3 mb-3 font-weight-bold">Designers<small>({{ $designers->count() }})</small></div>
                      <div class="row px-0 designersApproveCards">
                        @foreach($designers as $designer)
                       <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6 mb-4">
                         <div class="card pb-3">
                             <p class="designerProf rounded-circle mt-4 mx-auto mb-0">
                                @if($designer->display_picture == '')
                                    <img src="{{ asset('uploads/default-profile-picture.png') }}" class="card-img cover-photo" alt="Cover">
                                @else
                                <img src="{{ asset('uploads/designer/display_picture/'.$designer->display_picture) }}" class="card-img cover-photo" alt="Cover">
                                @endif
                             </p>
                             <div class="card-body p-1">
                                 <div class="align-items-center mb-2">
                                     <div class="author-info text-center">
                                         <p class="mb-0">{{ $designer->first_name }} {{ $designer->last_name }}</p>
                                         <p class="mb-0"><em>Designer</em></p>
                                         <p class="mb-0 mt-3"><button type="button" class="btn btn-primary loginBtn view-profile-btn" data="{{ $designer->id }}" >View Profile</button></p>
                                     </div>
                                 </div>
                             </div>
                         </div>
                       </div>
                       @endforeach

                     </div>

                     <div class="row px-3 mb-3 font-weight-bold mt-4">Designs<small>({{ $designs->count() }})</small></div>
                     <div class="row px-0 designCards">
                        @foreach($designs as $design)
                        <a href="#" data="{{ $design->id }}" class="review-design">
                       <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                         <div class="card">
                            @if($design->collectionImages()->count() == 0)
                            <img src="{{  asset('uploads/collection/images/design1.jpg') }}" class="card-img cover-photo" alt="Cover">

                            @else
                            <img src="{{  asset('uploads/collection/images/'.$design->collectionImages()->first()->img_src) }}" class="card-img cover-photo" alt="Cover">
                            @endif
                             <div class="card-body p-3">
                                 <div class="d-flex align-items-center mb-2">
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
                        </a>
                       @endforeach
                     </div>

                     <div class="row px-3 mb-3 font-weight-bold mt-4">Order</div>
                     <div class="row px-0 designCards">
                       <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                         <div class="card">
                             <img src="images/design1.jpg" class="card-img cover-photo" alt="Cover">
                             <div class="card-body p-3">
                                 <div class="d-flex align-items-center mb-2">
                                     <div class="author-info">
                                         <p class="mb-0">Modern Home</p>
                                     </div>
                                 </div>
                                 <p class="card-text mb-4">Submit Invoice</p>
                             </div>
                         </div>
                       </div>
                       <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                         <div class="card">
                             <img src="images/design1.jpg" class="card-img cover-photo" alt="Cover">
                             <div class="card-body p-3">
                                 <div class="d-flex align-items-center mb-2">
                                     <div class="author-info">
                                         <p class="mb-0">Modern Home</p>
                                     </div>
                                 </div>
                                 <p class="card-text mb-4">Submit Invoice</p>
                             </div>
                         </div>
                       </div>
                       <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                         <div class="card">
                             <img src="images/design1.jpg" class="card-img cover-photo" alt="Cover">
                             <div class="card-body p-3">
                                 <div class="d-flex align-items-center mb-2">
                                     <div class="author-info">
                                         <p class="mb-0">Modern Home</p>
                                     </div>
                                 </div>
                                 <p class="card-text mb-4">Submit Invoice</p>
                             </div>
                         </div>
                       </div>
                     </div>

                     <div class="row px-3 mb-3 font-weight-bold mt-4">Sale</div>
                     <div class="row px-0 designCards">
                       <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                         <div class="card">
                             <img src="images/design1.jpg" class="card-img cover-photo" alt="Cover">
                             <div class="card-body p-3">
                                 <div class="d-flex align-items-center mb-2">
                                     <div class="author-info">
                                         <p class="mb-0">Modern Home</p>
                                     </div>
                                 </div>
                                 <p class="card-text mb-4">Submit Invoice</p>
                             </div>
                         </div>
                       </div>
                       <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                         <div class="card">
                             <img src="images/design1.jpg" class="card-img cover-photo" alt="Cover">
                             <div class="card-body p-3">
                                 <div class="d-flex align-items-center mb-2">
                                     <div class="author-info">
                                         <p class="mb-0">Modern Home</p>
                                     </div>
                                 </div>
                                 <p class="card-text mb-4">Submit Invoice</p>
                             </div>
                         </div>
                       </div>
                     </div>

                   </div>
                </div>
                <div class="tab-pane fade" id="in_progress" role="tabpanel" aria-labelledby="in_progress-tab">
                   <div class="row">
                       <div class="col-lg-4 col-md-4 col-sm-6 col-6 float-left">
                          <i class="fas fa-search" aria-hidden="true"></i>
                          <input type="search" class="form-control col-12 float-left pl-5 searchInput" placeholder="Search">
                       </div>
                       <div class="col-lg-2 col-md-4 col-sm-6 col-6 float-left">
                          <div class="form-group">
                             <select class="custom-select selectDropdown">
                                <option selected="">Filter</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="3">4</option>
                             </select>
                          </div>
                       </div>
                   </div>
                   <div class="col-12 float-left mt-3 px-0">
                      <div class="row px-3 mb-3 font-weight-bold">Designers<small>({{ $designers->count() }} )</small></div>
                      <div class="row px-0 designersApproveCards">

                        @foreach($designers as $designer)
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6 mb-4">
                          <div class="card pb-3">
                              <p class="designerProf rounded-circle mt-4 mx-auto mb-0">
                                 @if($designer->display_picture == '')
                                     <img src="{{ asset('uploads/default-profile-picture.png') }}" class="card-img cover-photo" alt="Cover">
                                 @else
                                 <img src="{{ asset('uploads/designer/display_picture/'.$designer->display_picture) }}" class="card-img cover-photo" alt="Cover">
                                 @endif
                              </p>
                              <div class="card-body p-1">
                                  <div class="align-items-center mb-2">
                                      <div class="author-info text-center">
                                          <p class="mb-0">{{ $designer->first_name }} {{ $designer->last_name }}</p>
                                          <p class="mb-0"><em>Designer</em></p>
                                          <p class="mb-0 mt-3"><button type="button" class="btn btn-primary loginBtn view-profile-btn" data="{{ $designer->id }}">View Profile</button></p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                        @endforeach

                     </div>
                   </div>
                </div>

                <div class="tab-pane fade" id="inactive" role="tabpanel" aria-labelledby="inactive-tab">
                   <div class="row">
                       <div class="col-lg-4 col-md-4 col-sm-6 col-6 float-left">
                          <i class="fas fa-search" aria-hidden="true"></i>
                          <input type="search" class="form-control col-12 float-left pl-5 searchInput" placeholder="Search">
                       </div>
                       <div class="col-lg-2 col-md-4 col-sm-6 col-6 float-left">
                          <div class="form-group">
                             <select class="custom-select selectDropdown">
                                <option selected="">Filter</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="3">4</option>
                             </select>
                          </div>
                       </div>
                   </div>
                   <div class="col-12 float-left mt-3 px-0">
                      <div class="row px-3 mb-3 font-weight-bold">Designs<small>({{ $designs->count() }})</small></div>
                     <div class="row px-0 designCards">
                        @foreach($designs as $design)
                        <a href="#" data="{{ $design->id }}" class="review-design">
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                                <div class="card">
                                   @if($design->collectionImages()->count() == 0)
                                   <img src="{{  asset('uploads/collection/images/design1.jpg') }}" class="card-img cover-photo" alt="Cover">

                                   @else
                                   <img src="{{  asset('uploads/collection/images/'.$design->collectionImages()->first()->img_src) }}" class="card-img cover-photo" alt="Cover">
                                   @endif
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center mb-2">
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
                        </a>

                        @endforeach
                     </div>
                   </div>
                </div>

                <div class="tab-pane fade" id="under_review" role="tabpanel" aria-labelledby="under_review-tab">
                   <div class="row">
                       <div class="col-lg-4 col-md-4 col-sm-6 col-6 float-left">
                          <i class="fas fa-search" aria-hidden="true"></i>
                          <input type="search" class="form-control col-12 float-left pl-5 searchInput" placeholder="Search">
                       </div>
                       <div class="col-lg-2 col-md-4 col-sm-6 col-6 float-left">
                          <div class="form-group">
                             <select class="custom-select selectDropdown">
                                <option selected="">Filter</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="3">4</option>
                             </select>
                          </div>
                       </div>
                   </div>
                   <div class="col-12 float-left mt-3 px-0">
                      <div class="row px-3 mb-3 font-weight-bold">Order</div>
                     <div class="row px-0 designCards">
                       <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                         <div class="card">
                             <img src="images/design1.jpg" class="card-img cover-photo" alt="Cover">
                             <div class="card-body p-3">
                                 <div class="d-flex align-items-center mb-2">
                                     <div class="author-info">
                                         <p class="mb-0">Modern Home</p>
                                     </div>
                                 </div>
                                 <p class="card-text mb-4">Submit Invoice</p>
                             </div>
                         </div>
                       </div>
                       <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                         <div class="card">
                             <img src="images/design1.jpg" class="card-img cover-photo" alt="Cover">
                             <div class="card-body p-3">
                                 <div class="d-flex align-items-center mb-2">
                                     <div class="author-info">
                                         <p class="mb-0">Modern Home</p>
                                     </div>
                                 </div>
                                 <p class="card-text mb-4">Submit Invoice</p>
                             </div>
                         </div>
                       </div>
                       <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                         <div class="card">
                             <img src="images/design1.jpg" class="card-img cover-photo" alt="Cover">
                             <div class="card-body p-3">
                                 <div class="d-flex align-items-center mb-2">
                                     <div class="author-info">
                                         <p class="mb-0">Modern Home</p>
                                     </div>
                                 </div>
                                 <p class="card-text mb-4">Submit Invoice</p>
                             </div>
                         </div>
                       </div>
                     </div>
                   </div>
                </div>

                <div class="tab-pane fade" id="delivered_paid" role="tabpanel" aria-labelledby="delivered_paid-tab">
                   <div class="row">
                       <div class="col-lg-4 col-md-4 col-sm-6 col-6 float-left">
                          <i class="fas fa-search" aria-hidden="true"></i>
                          <input type="search" class="form-control col-12 float-left pl-5 searchInput" placeholder="Search">
                       </div>
                       <div class="col-lg-2 col-md-4 col-sm-6 col-6 float-left">
                          <div class="form-group">
                             <select class="custom-select selectDropdown">
                                <option selected="">Filter</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="3">4</option>
                             </select>
                          </div>
                       </div>
                   </div>
                   <div class="col-12 float-left mt-3 px-0">
                      <div class="row px-3 mb-3 font-weight-bold">Sale</div>
                     <div class="row px-0 designCards">
                       <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                         <div class="card">
                             <img src="images/design1.jpg" class="card-img cover-photo" alt="Cover">
                             <div class="card-body p-3">
                                 <div class="d-flex align-items-center mb-2">
                                     <div class="author-info">
                                         <p class="mb-0">Modern Home</p>
                                     </div>
                                 </div>
                                 <p class="card-text mb-4">Submit Invoice</p>
                             </div>
                         </div>
                       </div>
                       <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                         <div class="card">
                             <img src="images/design1.jpg" class="card-img cover-photo" alt="Cover">
                             <div class="card-body p-3">
                                 <div class="d-flex align-items-center mb-2">
                                     <div class="author-info">
                                         <p class="mb-0">Modern Home</p>
                                     </div>
                                 </div>
                                 <p class="card-text mb-4">Submit Invoice</p>
                             </div>
                         </div>
                       </div>
                     </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
