@foreach ($designers as $designer)
<div class="col-lg-3 col-md-6 col-sm-6 mb-4">
    <div class="card">

       <p class="designerProf rounded-circle mt-4 mx-auto mb-0">
        @if($designer->display_picture)
          <img src="{{ asset('uploads/designer/display_picture/'.$designer->display_picture) }}" class="card-img cover-photo" alt="Cover">
          @else
          <img src="{{ asset('uploads/designer/defaultUserImg.png') }}" class="card-img cover-photo" alt="Cover">
          @endif
       </p>

       <div class="card-body p-1">
          <div class="align-items-center mb-2">
             <div class="author-info text-center">
                <p class="mb-0">{{ $designer->first_name }} {{ $designer->last_name}}</p>
                <p class="mb-2">Designer</p>
                <p class="mb-3">
                   <span>
                   <i class="fas fa-star"></i>
                   <i class="fas fa-star"></i>
                   <i class="fas fa-star"></i>
                   <i class="fas fa-star"></i>
                   <i class="fas fa-star"></i>
                   </span>
                </p>
                <p class="mb-0 px-3">
                   <span class="">{{ $designer->quote }}</span>
                </p>
            <p class="mb-0 my-3"><a href="/pages/view-our-designer-profile?id={{$designer->id}}"  type="button" class="btn btn-primary" id="view-designer-profile-btn" data="{{ $designer->id }}">View Profile</a></p>
             </div>
          </div>
       </div>
    </div>
 </div>
@endforeach

