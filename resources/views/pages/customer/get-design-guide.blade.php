<div class="col-12 float-left px-0">
     <div class="col-12 float-left p-4 customersBuyContant">
        <div class="col-lg-8 col-md-6 col-sm-12 col-12 float-left tab1">
           <h1>LOYAL</h1>
           <p>A quick to go package from Panacche </p>
           <div class="col-12 px-0 landingHeading">
              <h4 class="mb-2">
                 <span>Media</span>
              </h4>
           </div>
           <p class="mb-0">Pick a design from our collection that resembles your style.Like a design and we will hook you up with all that goes into achieving the look.</p>
           <p>Buy it - its that easy! Plus save additional $$ on the furniture decor purchase.</p>
           <div class="col-12 px-0 landingHeading">
              <h4 class="mb-2">
                 <span>Benefits</span>
              </h4>
           </div>
           <ul class="pl-3">
              <li>Interaction with the designer</li>
              <li>Upto 3 changes to the design</li>
              <li>1 concept board and floorplan</li>
              <li>Design Implementation Guide</li>
              <li>Paint palette</li>
              <li>Discount on shopping list</li>
              <li>Panacche Concierge to help with shopping and shipping</li>
           </ul>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 col-12 float-left tab1Right">
           <div class="col-10 mx-auto buyPriceBox mt-md-0 mt-4">
              <p class="py-4 mb-0">$434</p>
              <p class="py-3"><a href="{{ env('APP_SHOPIFY_URL') }}/cart/{{ $product_variant_id }}:1" class="py-3">Buy the Design</a></p>
              <p class="mb-0">What do you get with this?</p>
              <ul class="pl-3">
                 <li>Lorem ipsum dolor sit amet</li>
                 <li>Lorem ipsum dolor sit amet</li>
                 <li>Lorem ipsum dolor sit amet</li>
                 <li>Lorem ipsum dolor sit amet </li>
                 <li>Lorem ipsum dolor sit amet</li>
              </ul>
           </div>
           @if(1==2)
             <div class="col-10 mx-auto downloadZipBox mt-md-0 mt-4">
                <p>You can now download the Design Implementation guide !</p>
                <div class="col-12 p-3 text-center">
                   <p class="mb-3"><i class="fas fa-file-archive"></i></p>
                   <a href="{{  asset('uploads/collection/'.$design->id.'/'.$design->design_implementation_guide) }}"
                   <button type="button" class="btn btn-warning warningBtn w-100">Download</button>
                   </a>
                </div>
             </div>
           @endif
        </div>
     </div>
  </div>