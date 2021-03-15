@if($designs->count() == 0)
    <h1 class="pl-5">There are no new designs available</h1>
@endif
@foreach($designs as $design)
<div class="col-sm-4">
    <div class="card">
        <img alt="Cover" class="card-img cover-photo" src="design1.jpg">
        <div class="card-body p-3">
            <div class="d-flex align-items-center mb-2">

               {{  $designImages =  $design->collectionImages() }}
                @if($design->collectionImages()->count())

                <div class="author-img">
                    <img alt="Person" class="img-fluid rounded-circle mr-1" src="{{ $design->collectionImages()->first()->img_src }}" style="width:35px">
                </div>

                @endif


                <div class="author-info">
                    <p class="mb-0">{{ $design->title }}</p>
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
@endforeach
