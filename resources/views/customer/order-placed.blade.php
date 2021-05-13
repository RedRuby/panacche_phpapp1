<div class="col-md-12 col-sm-12 col-xs-12 pl-5 mx-auto">
    <div class="col-md-12 float-left mt-2">
       <div class="col-6 px-0 orderPlacedText">
            <h4 class="mb-2 mt-lg-2 mt-md-0 col-12 float-left px-0">
                <span>Order Placed</span>
            </h4>
       </div>
       <div class="float-right">
            <a href="{{ env('Shop_URL') }}./pages/my-projects">
                <button type="button" class="btn btn-primary goBack text-left p-2 w-100 mb-3 rounded-0 px-3 py-3">Go Back to your Dashboard</button>
            </a>
       </div>
    </div>
    <div class="col-md-12 float-left">
       <p class="mb-0">Your Shopping items has been placed for shipment, Please connect with concierge team to track your order.</p>
    </div>
    <div class="col-md-12 col-xs-12 float-left pl-3 pr-0 mt-2 orderPlacedWrap">
       <div class="row px-3 mt-2 mb-0 mb-md-3">
          <div class="col-xl-5 col-lg-5 col-md-12 col-12 px-0 mb-4">
             <div  class="col-12 p-3 shoppingList ">
                <div class="col-12 px-0 landingHeading2">
                   <h4 class="mb-0">
                      <span>Item Name</span>
                   </h4>
                </div>
                <div class="row">
                   <div class="col-md-12 float-left tab2dragDropBox">
                      <div class="col-md-12 col-xs-12 float-left px-0">
                         <table class="table shoppingListTable mb-0">
                            <tbody>
                                @forelse ($products as $value)
                                    <tr>
                                    <td>
                                        <div class="col-12 float-left px-0">
                                            <p class="custom-file itenImage">
                                                <img src="https://panacchedev2.pagekite.me/uploads/collection/vendor_logo/altumcode-dC6Pb2JdAqs-unsplash.jpg" class="img-fluid" width="200">
                                            </p>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0">{{ $value->title }}</p>
                                        <p class="mb-0">{{ ($value->description != '') ? $value->description : '' }}</p>
                                    </td>
                                    </tr>

                                @empty

                                @endforelse
                            </tbody>
                         </table>
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <div class="col-xl-7 col-lg-7 col-md-12 col-12 mb-4 pl-md-0 pl-lg-3 pr-md-0 pr-lg-3">
             <div  class="col-12 float-left p-3 ratingBox">
                <div class="col-12 px-0 float-left landingHeading">
                   <h4 class="mb-0">
                      <span>
                         <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="34.847" height="34.832" viewBox="0 0 34.847 34.832">
                            <path id="Icon_material-stars" data-name="Icon material-stars" d="M20.406,3A17.416,17.416,0,1,0,37.847,20.416,17.411,17.411,0,0,0,20.406,3Zm7.388,27.865-7.37-4.441-7.37,4.441L15,22.488l-6.5-5.625,8.572-.731,3.345-7.907,3.345,7.889,8.572.731-6.5,5.625Z" transform="translate(-3 -3)" fill="#5462bd"/>
                         </svg>
                         Review & Rate Our Designer
                      </span>
                   </h4>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 px-0 float-left designCards mt-4">
                   <div class="card">
                      <div class="designerImg">
                         <img src="{{ asset('uploads/designer/display_picture/'.$products[0]->display_picture) }}" class="img-fluid" alt="Cover">
                      </div>
                      <div class="card-body p-3">
                         <div class="d-flex align-items-center mb-0">
                            <div class="author-info">
                               <p class="mb-0">{{ $products[0]->first_name.' '.$products[0]->last_name }}</p>
                            </div>
                         </div>
                         <p class="card-text">Designer</p>
                      </div>
                   </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-8 col-sm-6 col-12 float-left designCards mt-4">
                    <form class="rate_review" id="rate_review" action="{{ route('order-rate-review') }}" method="POST">
                        <p class="mb-0">How has been your experience working With <b>{{ $products[0]->first_name }}</b>, please rate the designer</p>
                        <div id="review"></div>
                        <p>Add Review comments</p>
                        <p class="mb-0">
                            @if($rating != null)
                                <textarea class="form-control textarea" rows="3" id="review_text" name="review_text" disabled>{{$rating->review}}</textarea>
                            @else
                                <textarea class="form-control textarea" rows="3" id="review_text" name="review_text"></textarea>
                            @endif
                        </p>
                        <input type="hidden" value="{{ $products[0]->designerId }}" name="designer_id" id="designer_id">
                        <input type="hidden" value="{{ $products[0]->my_project_collection_id }}" name="my_project_collection_id" id="my_project_collection_id">
                        @if($rating != null)
                            <input type="hidden" value="{{ $rating->rating }}" name="rating" id="starsInput">
                            <p class="mb-0 mt-4 pt-3 submitRatings">
                                <button type="button" class="btn btn-primary float-right loginBtn">Your review has already submitted.</button>
                            </p>
                        @else
                            <input type="hidden" value="" name="rating" id="starsInput">
                            <p class="mb-0 mt-4 pt-3 submitRatings">
                                <button type="button" class="btn btn-primary float-right loginBtn rateReviewStore">Submit</button>
                            </p>
                        @endif
                        <p class="mb-0 mt-4 pt-3 savedRatings" style="display: none;">
                            <button type="button" class="btn btn-primary float-right loginBtn">Thank you for the review!</button>
                        </p>
                    </form>
                </div>
             </div>
          </div>
       </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var rate = $("#starsInput").val();
        $("#review").rating({
            "value": rate,
            "click": function(e) {
                console.log(e);
                $("#starsInput").val(e.stars);
            }
        });
    });


</script>
