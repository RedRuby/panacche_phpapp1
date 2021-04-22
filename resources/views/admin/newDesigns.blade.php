    @if($designs->count() == 0)
    <h1 class="pl-5">There are no new designs available</h1>
    @endif
    @foreach($designs as $design)
<a href="{{env('Shop_NAME')}}/design/details/{{ $design->id }}" id="view-design" data="{{ $design->id }}">
        <div class="col-sm-4">
            <div class="card">
                @if($design->collectionImages()->count() == 0)
                <img src="{{  asset('uploads/collection/images/design1.jpg') }}" class="card-img cover-photo" alt="Cover">

                @else
                <img src="{{  asset('uploads/collection/images/'.$design->collectionImages()->first()->img_src) }}" class="card-img cover-photo" alt="Cover">
                @endif
                <div class="card-body p-3">
                    <div class="d-flex align-items-center mb-2">
                        @if($design->customer()->count() == 0)
                        <img src="" alt="Person" class="img-fluid rounded-circle mr-1" style="width:35px">

                        @else
                        <div class="author-img">
                            <img src="{{ asset('uploads/profile_pic/'.$design->customer->profile_picture) }}" alt="Person" class="img-fluid rounded-circle mr-1" style="width:35px">
                        </div>
                        @endif
                        <div class="author-info">
                            <p class="mb-0">{{ $design->design_name }}</p>
                        </div>
                    </div>
                    <p class="card-text">$  {{ $design->room_budget }}</p>
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
