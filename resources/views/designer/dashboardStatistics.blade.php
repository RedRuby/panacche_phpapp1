<div class="col-xl-3 col-md-6 col-sm-6 col-xs-12 px-0 card">
    <a href="{{ env('Shop_URL') }}/pages/in-progress-designs" class="pb-3">
      <div class="card-body">
        <h5 class="card-title mb-0">
            <span>In Progress</span>
            <span>{{ $inprogressDesigns }}</span>
        </h5>
      </div>
     </a>
  </div>
  <div class="col-xl-3 col-md-6 col-sm-6 col-xs-12 px-0 card">
    <a href="{{ env('Shop_URL') }}/pages/draft-designs" class="pb-3">
      <div class="card-body">
        <h5 class="card-title mb-0">
            <span>Draft Design</span>
            <span>{{ $draftDesigns }}</span>
        </h5>
      </div>
     </a>
  </div>
  <div class="col-xl-3 col-md-6 col-sm-6 col-xs-12 px-0 card">
    <a href="{{ env('Shop_URL') }}/pages/published-designs" class="pb-3">
      <div class="card-body">
        <h5 class="card-title mb-0">
            <span>Published Design</span>
            <span>{{ $publishedDesigns }}</span>
        </h5>
      </div>
     </a>
  </div>
  <div class="col-xl-3 col-md-6 col-sm-6 col-xs-12 px-0 card">
    <a href="{{ env('Shop_URL') }}/pages/designs-under-review" class="pb-3">
      <div class="card-body">
        <h5 class="card-title mb-0">
            <span>Designs Under Review</span>
            <span>{{ $underReviewDesigns }}</span>
        </h5>
      </div>
     </a>
  </div>

  <div class="col-xl-3 col-md-6 col-sm-6 col-xs-12 px-0 card">
    <a href="{{ env('Shop_URL') }}/pages/reassign-designs" class="pb-3">
      <div class="card-body">
        <h5 class="card-title mb-0">
            <span>Reassigned Designs</span>
            <span>{{ $reassignedDesigns }}</span>
        </h5>
      </div>
     </a>
  </div>
