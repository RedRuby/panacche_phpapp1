<div class="col-12 float-left px-0">
 <div class="col-12 float-left px-0 customersBuyContant">
    <div  class="col-12 float-left shoppingList p-4">
       <div class="row">
          <div class="col-xl-7 col-lg-6 col-md-4 col-sm-12 col-12 float-left">
<div class="col-12 px-0 landingHeading">
<h4 class="mb-2">
<span>Revised Floor Plan from Designer</span>
</h4>
</div>
              <p>Designer — has provided an updated floor plan, as per the change request from you. </p>
              <p>Please review and save !!</p>
          </div>

          <div class="col-xl-5 col-lg-6 col-md-8 col-sm-12 col-12 float-left floorPlanImgWrap">
             <div class="col-md-12 float-left mb-3 pb-2">
                <div class="col-4 float-left floorPlanImg">
<p data-toggle="modal" data-target="#finalDesignFloorPlan"><img src="{{ asset('uploads/buy_design_img.jpg') }}?v" class="img-fluid"></p>
                </div>
<div class="col-4 float-left floorPlanImg">
<p data-toggle="modal" data-target="#finalDesignFloorPlan"><img src="{{ asset('uploads/buy_design_img.jpg') }}?v" class="img-fluid"></p>
                </div>
<div class="col-4 float-left floorPlanImg">
<p data-toggle="modal" data-target="#finalDesignFloorPlan"><img src="{{ asset('uploads/buy_design_img.jpg') }}?v" class="img-fluid"></p>
                </div>
             </div>

<div class="col-12 float-left text-center">
<a href="#">
<button type="button" class="btn btn-primary col-11 warningBtn">Download Documents</button>
</a>
</div>
          </div>

<!-- Final Design Floor Plan Modal -->
<div class="modal fade" id="finalDesignFloorPlan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

       </div>
    </div>
    <div  class="col-12 float-left p-4 shoppingList mt-3">
       <div class="col-12 px-0 landingHeading">
          <h4 class="mb-0">
             <span>Shopping List</span>
          </h4>
       </div>
       <div class="row">
          <div class="col-md-12 float-left tab2dragDropBox">
             <div class="col-md-12 col-xs-12 float-left px-0 responsiveTableWrap">
                <table class="table shoppingListTable">
                   <thead>
                      <tr>
                         <th scope="col">Item Name</th>
                         <th scope="col"></th>
                         <th scope="col">Vendor</th>
                         <th scope="col">Retail Price</th>
                         <th scope="col">Panacche Estimate</th>
                         <th scope="col">Quantity</th>
                      </tr>
                   </thead>
                   <tbody>
                      @foreach ($design->products as $pkey => $product)
                        @php
                            if($product->product_type == 1){
                               continue;
                            }
                            if($product->product_type == 1 || !isset($selected_products[$product->id])){
                              continue;
                            }
                            $qty = $selected_products[$product->id]->quantity;
                         @endphp
                        <tr>
                           <td>
                              <div class="col-12 float-left px-0">
                                 <p class="custom-file itenImage">
                                    @php
                                      $product_first_image_src = '';
                                      if($product->productImages()->count()){
                                         $product_first_image = $product->productImages()->first()->toArray();
                                         if($product_first_image['img_src']){
                                            $product_first_image_src = asset('uploads/collection/product/images/'.$product_first_image['img_src']);
                                         }
                                      }
                                   @endphp
                                   <img @php echo 'src="'.$product_first_image_src.'"' @endphp class="img-fluid" width="200">
                                 </p>
                              </div>
                           </td>
                           <td>
                              <p class="mb-0">{{ $product->title }}</p>
                              <p class="mb-0">Specification: {{ $product->size_specification }} </p>
                           </td>
                            <td>{{ $product->vendor->vendor_name }}</td>
                            <td>${{ $product->product_price }}</td>
                            <td>
                              @if(isset($discount->discount) && $discount->discount > 0)
                                    ${{ $product->product_price -(($product->product_price * $discount->discount) / 100) }}
                                 @else
                                    ${{ $product->product_price }}
                                 @endif
                            </td>
                            <td>
                              <p class="quantityView mb-0 p-2 text-center">{{$qty}}</p>
                           </td>
                        </tr>
                      @endforeach
                   </tbody>
                </table>
             </div>
          </div>
       </div>
    </div>
    @include('pages.customer.paint-palette',["colorPallettes" => $design->colorPallettes])
<div  class="col-12 float-left p-4 shoppingList mt-3">
       <div class="col-12 px-0 landingHeading">
          <h4 class="mb-4">
             <span>Change Request</span>
          </h4>
       </div>
       <div class="row px-3">
          <div class="col-md-12 float-left tab2dragDropBox dragandDropWrap rounded-0 responsiveTableWrap">
             <div class="col-md-12 col-xs-12 float-left px-0">
                <table class="table colorPaintTable buyColorPaintTable mb-0 changeRequest">
                   <tbody>
                      @foreach($change_requests as $key => $change_request)
                        <tr>
                           <td>
                              <p class="mb-0">Change Type</p>
                              <p class="mb-0">
                                @if($change_request->type == 0)
                                  Shopping List
                                @else
                                  Pain Palette
                                @endif
                              </p>
                           </td>
                           <td>
                              <p class="mb-0">Change Item</p>
                              <p class="mb-0">Comfort Chair</p>
                           </td>
                           <td colspan="2">
                              <p class="mb-0">Revised Item</p>
                              <p class="mb-0">Supra Chair</p>
                           </td>
                           <td>
                              <p class="mb-0">
                                @if($key >= 3)
                                  PAID
                                @else
                                  FREE
                                @endif
                              </p>
                           </td>
                        </tr>
                      @endforeach
                   </tbody>
                </table>
             </div>
          </div>
       </div>
    </div>
    <div  class="col-12 float-left p-4">
          <div class="row">
            <div class="col-12 float-left mt-2 px-0">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 float-right mb-2">
            <button type="button" class="btn btn-primary col-12 loginBtn" data-toggle="modal" data-target="#buyDesignpop">Get the Best Quote for the interested Shopping List items</button>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12 float-right mb-2">
            <button type="button" class="btn btn-primary col-12 cancleBtn">Edit Shipping Address</button>
            </div>
            </div>
          </div>
    </div>
 </div>
</div>