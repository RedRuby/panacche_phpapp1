@if($designs->count() == 0)
    <h1 class="pl-5">There are no in progress designs available</h1>
@endif
@foreach($designs as $design)

<div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
    <div class="card">
        <img src="images/design1.jpg" class="card-img cover-photo" alt="Cover">
        <div class="card-body p-3">
            <div class="d-flex align-items-center mb-2">
                <div class="author-info">
                    <p class="mb-0">{{ $design->design_name }}</p>
                </div>
            </div>
            <p class="card-text">$ {{ $design->budget }}</p>
        </div>
        <div class="card-footer d-flex">
            <a href="#" class="social social-instagram mr-3"><i class="fab fa-instagram"></i></a>
            <a href="#" class="social social-facebook text-facebook mr-3"><i class="fab fa-facebook"></i></a>
            <a href="#" class="social social-twitter mr-3"><i class="fab fa-twitter"></i></a>
        </div>
    </div>
</div>

@endforeach


