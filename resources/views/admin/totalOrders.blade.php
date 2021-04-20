<div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">

    <div class="col-12 float-left mt-3 px-0">
        <div class="col-12 float-left px-0 showallTable responsiveTableWrap">
            <p class="tableHeaderBorder col-12 mb-0"></p>
            <table class="table landingTable">
                <thead>
                    <tr class="defaultBlueColor text-white">
                        <th scope="col">Order No.</th>
                        <th scope="col">Validity Date </th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Design Name</th>
                        <th scope="col">Designer Name</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>PD#{{ $order->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y')}}</td>
                        <td>{{ $order->customer->first_name }} {{ $order->customer->last_name }}</td>
                        <td>{{ $order->collection->design_name }}</td>
                        <td>{{ $order->collection->designer->first_name }} {{ $order->collection->designer->last_name }}</td>
                        <td>{{ $order->amount }}</td>
                        <td>
                            @if($order->status == 'completed')
                            <div class="badge badge-success">Completed Order</div>
                            @elseif($order->status == 'in-progress')
                            <div class="badge badge-danger">Incomplete Order</div>
                            @elseif($order->status == 'pending')
                            <div class="badge badge-warning">Purchase Order Sent</div>
                            @endif
                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="tab-pane fade" id="purchase_order_sent" role="tabpanel" aria-labelledby="purchase_order_sent-tab">

    <div class="col-12 float-left mt-3 px-0">
        <div class="col-12 float-left px-0 showallTable responsiveTableWrap">
            <p class="tableHeaderBorder col-12 mb-0"></p>
            <table class="table landingTable">
                <thead>
                    <tr class="defaultBlueColor text-white">
                        <th scope="col">Order No.</th>
                        <th scope="col">Validity Date </th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Design Name</th>
                        <th scope="col">Designer Name</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders->where('status', 'pending') as $order)
                    <tr>
                        <td>PD#{{ $order->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y')}}</td>
                        <td>{{ $order->customer->first_name }} {{ $order->customer->last_name }}</td>
                        <td>{{ $order->collection->design_name }}</td>
                        <td>{{ $order->collection->designer->first_name }} {{ $order->collection->designer->last_name }}</td>
                        <td>{{ $order->amount }}</td>
                        <td>
                            @if($order->status == 'completed')
                            <div class="badge badge-success">Completed Order</div>
                            @elseif($order->status == 'in-progress')
                            <div class="badge badge-danger">Incomplete Order</div>
                            @elseif($order->status == 'pending')
                            <div class="badge badge-warning">Purchase Order Sent</div>
                            @endif
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="tab-pane fade" id="incomplete_orders" role="tabpanel" aria-labelledby="incomplete_orders-tab">

    <div class="col-12 float-left mt-3 px-0">
        <div class="col-12 float-left px-0 showallTable responsiveTableWrap">
            <p class="tableHeaderBorder col-12 mb-0"></p>
            <table class="table landingTable">
                <thead>
                    <tr class="defaultBlueColor text-white">
                        <th scope="col">Order No.</th>
                        <th scope="col">Validity Date </th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Design Name</th>
                        <th scope="col">Designer Name</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders->where('status', 'in-progress') as $order)
                    <tr>
                        <td>PD#{{ $order->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y')}}</td>
                        <td>{{ $order->customer->first_name }} {{ $order->customer->last_name }}</td>
                        <td>{{ $order->collection->design_name }}</td>
                        <td>{{ $order->collection->designer->first_name }} {{ $order->collection->designer->last_name }}</td>
                        <td>{{ $order->amount }}</td>
                        <td>
                            @if($order->status == 'completed')
                            <div class="badge badge-success">Completed Order</div>
                            @elseif($order->status == 'in-progress')
                            <div class="badge badge-danger">Incomplete Order</div>
                            @elseif($order->status == 'pending')
                            <div class="badge badge-warning">Purchase Order Sent</div>
                            @endif
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="tab-pane fade" id="completed_orders" role="tabpanel" aria-labelledby="completed_orders-tab">

    <div class="col-12 float-left mt-3 px-0">
        <div class="col-12 float-left px-0 showallTable responsiveTableWrap">
            <p class="tableHeaderBorder col-12 mb-0"></p>
            <table class="table landingTable">
                <thead>
                    <tr class="defaultBlueColor text-white">
                        <th scope="col">Order No.</th>
                        <th scope="col">Validity Date </th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Design Name</th>
                        <th scope="col">Designer Name</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders->where('status', 'completed') as $order)
                    <tr>
                        <td>PD#{{ $order->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y')}}</td>
                        <td>{{ $order->customer->first_name }} {{ $order->customer->last_name }}</td>
                        <td>{{ $order->collection->design_name }}</td>
                        <td>{{ $order->collection->designer->first_name }} {{ $order->collection->designer->last_name }}</td>
                        <td>{{ $order->amount }}</td>
                        <td>
                            @if($order->status == 'completed')
                            <div class="badge badge-success">Completed Order</div>
                            @elseif($order->status == 'in-progress')
                            <div class="badge badge-danger">Incomplete Order</div>
                            @elseif($order->status == 'pending')
                            <div class="badge badge-warning">Purchase Order Sent</div>
                            @endif
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
