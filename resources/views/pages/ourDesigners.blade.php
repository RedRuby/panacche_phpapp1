@foreach ($designers as $designer)
<div class="col-lg-3 col-md-6 col-sm-6 mb-4">
    <div class="card">
       <p class="designerProf rounded-circle mt-4 mx-auto mb-0">
          <img src="images/designerPic1.jpg" class="card-img cover-photo" alt="Cover">
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
                <p class="mb-0 my-3"><button type="button" class="btn btn-primary" id="view-designer-profile-btn" data="{{ $designer->id }}">View Profile</button></p>
             </div>
          </div>
       </div>
    </div>
 </div>
@endforeach

