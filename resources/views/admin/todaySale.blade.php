<div class="col-xl-6 col-md-6 col-sm-6 col-xs-6 card mb-4">
    <a href="#">
        <div class="card-body d-flex">
            <div class="card-title todaysSaleHead mb-0 text-left col px-0 pt-2">
                <p class="mb-0">Today's Sale</p>
                <p class="mb-0"><em>(No. of designs)</em></p>
            </div>
            <div class="text-right col px-0">
                @php
                $saleCount =0 ;
                 @endphp
                @foreach ($sales as $sale )
                   @php
                       $saleCount = $saleCount + $sale->amount ;
                   @endphp
                @endforeach
                {{ $saleCount }}

            </div>
        </div>
    </a>
</div>
<div class="col-xl-6 col-md-6 col-sm-6 col-xs-6 card mb-4">
    <a href="{{ env('Shop_URL') }}/pages/discount">
        <div class="card-body d-flex">
            <div class="card-title todaysSaleHead mb-0 text-left col px-0 pt-2">
                <p class="mb-0">Panacche Vendor Discount</p>
                <p class="mb-0"><em>Global Vendor Discount</em></p>
            </div>
            <div class="text-right col px-0">{{ $discount->discount }} %</div>
        </div>
    </a>
</div>
