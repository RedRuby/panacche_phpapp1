@if($designs->count() == 0)
    <h4 class="pl-3">There are no new designs available</h4>
@endif
@foreach($designs as $design)
<a href="{{env('Shop_NAME')}}/design/details/{{ $design->id }}" id="view-design" data="{{ $design->id }}">
<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
    <div class="card">
        <div class="card-img projectImg">
        @if($design->collectionImages()->count() == 0)

        <img alt="Cover" class="card-img cover-photo" src="{{  asset('default/design1.jpg') }}" />
        @else
        <img alt="Cover" class="card-img cover-photo" src="{{  asset('uploads/collection/'.$design->id.'/'.$design->collectionImages()->first()->img_src) }}">

        @endif
        </div>
        <div class="card-body p-3">
            <div class="d-flex align-items-center mb-2">

                @if($design->designer()->count() == 0)
                <div class="author-img">
                <img alt="Person" class="img-fluid rounded-circle mr-1" src="{{ asset('default/user.png') }}" style="width:35px">
                </div>
                @else
                <div class="author-img">
                    <img alt="Person" class="img-fluid rounded-circle mr-1" src="{{ asset('uploads/designer/display_picture/'.$design->designer->display_picture) }}" style="width:35px">
                </div>
                @endif

                <div class="author-info">
                    <p class="mb-0">{{ $design->design_name }}</p>
                </div>
            </div>
            <p class="card-text">$ {{ $design->room_budget }}</p>
        </div>
        <div class="card-footer d-flex">
            <a class="social social-instagram mr-3" href="#">
                <i class="fab fa-instagram"></i>
            </a>
            <a class="social social-facebook text-facebook mr-3" href="#">
                <i class="fab fa-facebook"></i>
            </a>
            <a class="social social-pinterest mr-3" href="#">
                <i class="fab fa-pinterest"></i>
            </a>
        </div>
    </div>
</div>
</a>
@endforeach
