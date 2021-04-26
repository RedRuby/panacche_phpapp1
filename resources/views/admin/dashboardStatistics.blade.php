<div class="col-xl-3 col-lg-6 col-sm-6 col-12 card text-center mx-0 mb-4">
    <a href="{{ env('Shop_URL')}}/pages/new-arrival-pending">
        <div class="card-body d-flex">
            <div class="card-title mb-0 text-left col px-0 pt-xl-0 pt-md-1 pt-sm-2 pt-2">
                <p class="mb-0">New Designers</p>
                <p class="mb-0"><em>(Pending Approval)</em></p>
            </div>
            <div class="text-center col px-0">{{ $newDesignersCount }}</div>
        </div>
    </a>
</div>
<div class="col-xl-3 col-lg-6 col-sm-6 col-12 card text-center mx-0 mb-4">
    <a href="{{ env('Shop_URL')}}/pages/new-arrival-pending">
        <div class="card-body d-flex">
            <div class="card-title mb-0 text-left col px-0 pt-xl-0 pt-md-1 pt-sm-2 pt-2">
                <p class="mb-0">New Designs</p>
                <p class="mb-0"><em>(Pending Approval)</em></p>
            </div>
            <div class="text-center col px-0">{{ $newDesignsCount }}</div>
        </div>
    </a>
</div>
<div class="col-xl-3 col-lg-6 col-sm-6 col-12 card text-center mx-0 mb-4">
    <a href="#">
        <div class="card-body d-flex">
            <div class="card-title mb-0 text-left col px-0">
                <p class="mb-0 pt-xl-2 pt-md-3 pt-sm-3 pt-3">New Orders</p>
            </div>
            <div class="text-center col px-0">{{ $newOrdersCount }}</div>
        </div>
    </a>
</div>
<div class="col-xl-3 col-lg-6 col-sm-6 col-12 card text-center mx-0 mb-4">
    <a href="#">
        <div class="card-body d-flex">
            <div class="card-title mb-0 text-left col px-0">
                <p class="mb-0 pt-3 ">Sale</p>
            </div>
            <div class="text-center col px-0">
                @php
                $saleCount =0 ;
                 @endphp
                @foreach ($totalSales as $sale )
                   @php
                       $saleCount = $saleCount + $sale->amount ;
                   @endphp
                @endforeach
                {{ $saleCount }}
            </div>
        </div>
    </a>
</div>

