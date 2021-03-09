    @if($designs->count() == 0)
    <h1 class="pl-5">There are no new designs available</h1>
    @endif
    @foreach($designs as $design)
  <div class="col-sm-4">
    <div class="card">
        <img src="images/design1.jpg" class="card-img cover-photo" alt="Cover">
        <div class="card-body p-3">
            <div class="d-flex align-items-center mb-2">
                <div class="author-img">
                    <img src="images/person-2.jpg" alt="Person" class="img-fluid rounded-circle mr-1" style="width:35px">
                </div>
                <div class="author-info">
                    <p class="mb-0">{{ $design->title }}</p>
                </div>
            </div>
            <p class="card-text">$ 300.00</p>
        </div>
        <div class="card-footer d-flex">
            <a href="#" class="social social-instagram mr-3"><i class="fab fa-instagram"></i></a>
            <a href="#" class="social social-facebook text-facebook mr-3"><i class="fab fa-facebook"></i></a>
            <a href="#" class="social social-pinterest mr-3"><i class="fab fa-pinterest"></i></a>
        </div>
    </div>
  </div>
  @endforeach
