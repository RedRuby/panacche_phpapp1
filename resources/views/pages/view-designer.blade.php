<div class="col-12 px-0 galleryBack">
    <a href="javascript&colon; history.go(-1)"><span><i class="fas fa-arrow-left"></i></span></a>
 </div>
 <div class="col-12 px-0 mt-4 galleryHeading">
    <h4 class="mb-4">
       <span>{{ $designer->first_name }} {{ $designer->last_name }}</span>
    </h4>
 </div>
 <div class="col-12 px-0">
    <div class="row px-0 designCards">
       <div class="col-lg-3 col-md-6 col-sm-6 mb-5">
          <div class="card">
             <div class="designerImg">
                @if($designer->display_picture)
                 <img src="{{ asset('/default/designer/display_picture/'. $designer->display_picture) }}" class="img-fluid" alt="Cover">
                @else
                <img src="{{ asset('/default/user.png') }}" class="img-fluid" alt="Cover">
                @endif
                </div>
             <div class="card-body p-3">
                <div class="d-flex align-items-center mb-0">
                   <div class="author-info">
                      <p class="mb-0">{{ $designer->first_name }} {{ $designer->last_name }}</p>
                   </div>
                </div>
                <p class="card-text">Designer</p>
             </div>
          </div>
       </div>
       <div class="col-lg-9 col-md-6 col-sm-6 mb-5 designerInfo pt-xl-4 pt-lg-3">
             <p class="text-center">{{ $designer->quote }}</p>

             <p>About {{ $designer->first_name }}</p>

             <p>{{ $designer->bio }}</p>

             <p>Rating:
                 <span>
                     <i class="fas fa-star" aria-hidden="true"></i>
                     <i class="fas fa-star" aria-hidden="true"></i>
                     <i class="fas fa-star" aria-hidden="true"></i>
                     <i class="fas fa-star" aria-hidden="true"></i>
                     <i class="far fa-star" aria-hidden="true"></i>
                 </span>
             </p>
       </div>
    </div>
 </div>
