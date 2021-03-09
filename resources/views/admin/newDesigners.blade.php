    @if($customers->count() == 0)
    <h1 class="pl-5">There are no new designers available</h1>
    @endif
    @foreach($customers as $customer)
        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
            <div class="card">
                <p class="cardChekbox">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                </p>
                <p class="designerProf rounded-circle mt-4 mx-auto mb-0">
                    <img src="{{ asset('uploads/profile_pic/$customer->profile_pic') }}" class="card-img cover-photo" alt="Cover">
                </p>
                <div class="card-body p-1">
                    <div class="align-items-center mb-2">
                        <div class="author-info text-center">
                            <p class="mb-0">{{ $customer->first_name }} {{ $customer->last_name }}</p>
                            <p class="mb-0">12 year experience</p>
                            <p class="mb-0">
                                <span class="mr-1">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </span>
                                <span>Highly Rated</span>
                            </p>
                            <p class="mb-0 d-inline">
                                <span class="mr-1">Design Styles</span>
                                <span>Modern. |. Rustic</span>
                            </p>
                            <p class="mb-0 mt-3"><button type="button" class="btn btn-primary" id="view-profile-btn" data="{{ $customer->id }}">View Profile</button></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  @endforeach
