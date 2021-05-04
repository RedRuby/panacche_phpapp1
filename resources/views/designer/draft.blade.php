@if($designs->count() == 0)
    <h4 class="pl-3">Draft designs are not available</h4>
@endif
@foreach($designs as $design)

<a href="#" id="view-draft-design" data="{{ $design->id }}">
    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
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
                    <div class="author-img">
                    @if($design->designer->display_picture)
                        <img alt="Person" class="img-fluid rounded-circle mr-1" src="{{ asset('uploads/designer/display_picture/'.$design->designer->display_picture) }}" style="width:35px">
                    @else
                        <img alt="Person" class="img-fluid rounded-circle mr-1" src="{{ asset('default/user.png') }}" style="width:35px">
                    @endif
                    </div>
                    <div class="author-info">
                        <p class="mb-0">{{ $design->design_name }}</p>
                    </div>
                </div>
                <p class="card-text">$ {{ $design->room_budget }}</p>
            </div>
            <div class="card-footer d-flex">
                <a href="#" class="social social-instagram mr-3"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social social-facebook text-facebook mr-3"><i class="fab fa-facebook"></i></a>
                <a href="#" class="social social-twitter mr-3"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>
</a>


@endforeach



