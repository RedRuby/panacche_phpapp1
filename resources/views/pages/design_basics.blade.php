<div class="row px-3">
    <div class="col-md-6 col-sm-12 px-0 designCards float-left buyDesign">
        <div class="card">
            @if($design->collectionImages()->count() == 0)
            <img src="{{  asset('default/design.jpg') }}" class="card-img cover-photo" alt="Cover">
            @else
            <img src="{{  asset('uploads/collection/'.$design->id.'/'.$design->collectionImages()->first()->img_src) }}" class="card-img cover-photo" alt="Cover">
            @endif
            <div class="card-body p-3">
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12 float-left mt-md-0 mt-4">
    <div class="col-12 px-0 landingHeading float-left">
        <h4 class="mb-1 mt-md-0 col-12 float-left px-0">
            <span>{{ $design->design_name }}</span>
        </h4>
    </div>
    <div class="col-12 px-0 roomsDisc float-left">
        @if($my_project_id)
        <p class="mb-0">Designer: <a href="{{ env('Shop_URL') }}/pages/view-our-designer-profile?id={{ $design->designer->id }}">{{ $design->designer->first_name }} {{ $design->designer->last_name }}</a></p>
        @endif
        <p class="mb-0">Room Style : <span>{{ $design->room_style }}<span></p>
        <p class="mb-0">Room Type : <span>{{ $design->room_type }}<span></p>
        <p class="mb-0">Pet Friendly Design : <span>{{ $design->pet_friendly_design }}<span></p>
        <p class="mb-0">Room Budget : <span>Approx. ${{ $design->room_budget }} or less<span></p>
    </div>
    <div class="col-12 px-0 designPrice float-left">
        <h4 class="mb-3 mt-3 col-12 float-left px-0">
            <span>Design Price: $ {{ $design->design_price }} </span>
        </h4>
    </div>
    @if(isset($discount->discount) && $discount->discount > 0)
    <div class="col-12 px-0 panaccheSaving float-left">
        <p class="mb-0">Panacche Savings:</p>
        <p class="">You Save: ${{(($design->room_budget*$discount->discount)/100)}} ({{$discount->discount}}%)
            <span class="ml-2 text-center ibtn">i
            <span class="tooltiptext p-2 text-left">Note: This does not include tax and shipping cost</span>
            </span>
        </p>
    </div>
    @endif
    <div class="col-12 px-0 landingHeading float-left">
        <h4 class="mb-1 mt-4 col-12 float-left px-0">
            <span>Design Description</span>
        </h4>
    </div>
    <div class="col-12 px-0 designDisc float-left">
        <p class="mb-1">Approximate Room Size : {{ $design->room_width_in_feet }} ft {{ $design->room_width_in_inches }} inches x {{ $design->room_height_in_feet }} ft {{ $design->room_height_in_inches }} inches</p>
        <p>{{ $design->implementation_guide_description }}</p>
        <p class="mb-0 d-inline">
            <span class="py-1 px-3 mr-2 mb-2">{{ $design->room_style }}</span>
            @if($design->pet_friendly_design == 'Yes')
            <span class="py-1 px-3 mr-2 mb-2">Pet Friendly</span>
            @endif
            <span class="py-1 px-3 mr-2 mb-2">Fast Implementation</span>
            <span class="py-1 px-3 mr-2 mb-2">Low cost</span>
        </p>
    </div>
    <hr/>
    <div class="col-12 px-0 disclaimerShow float-left">
        <p>Disclaimer: <span class="disclaimerView"> Every design is a work of art and creativity. There are chances where a décor item can go out of stock or discontinued by the time you purchase a design. In this event, the designer will provide a comparable substitute.
            *All design sales are non- refundable.</span>
        </p>
    </div>
    </div>
 </div>
