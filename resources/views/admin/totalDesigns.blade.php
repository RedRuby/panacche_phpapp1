<div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
    <div class="col-12 float-left mt-3 px-0">
        <div class="col-12 float-left px-0 showallTable responsiveTableWrap">
            <p class="tableHeaderBorder col-12 mb-0"></p>
            <table class="table landingTable">
                <thead>
                    <tr class="defaultBlueColor text-white">
                        <th scope="col">Start Date</th>
                        <th scope="col">Approved Date</th>
                        <th scope="col">Designer Name</th>
                        <th scope="col">Design Name</th>
                        <th scope="col">Orders Count</th>
                        <th scope="col">Status</th>
                        <th scope="col">Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($designs as $design)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($design->created_at)->format('d/m/Y')}}</td>
                            <td>{{ \Carbon\Carbon::parse($design->approved_on)->format('d/m/Y')}}</td>
                            <td>{{ $design->designer->first_name }} {{ $design->designer->last_name }}</td>
                            <td>{{ $design->design_name }}</td>
                            <td>{{ $design->orders->count() }}</td>
                            <td>
                                @if($design->status == 'submitted')
                                <div class="badge badge-danger">Pending</div>
                                @elseif($design->status == 'approved')
                                <div class="badge badge-success">Active</div>
                                @elseif($design->status == 'rejected')
                                <div class="badge badge-secondary">Inactive</div>
                                @elseif($design->status == 'abandonded')
                                <div class="badge badge-dark">Abandonded</div>
                                @endif

                            </td>
                            <td>
                            <a href="{{ env('Shop_URL')}}/pages/review-design?id={{ $design->id }}">
                                    Details
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">

    <div class="col-12 float-left mt-3 px-0">
        <div class="col-12 float-left px-0 showallTable responsiveTableWrap">
            <p class="tableHeaderBorder col-12 mb-0"></p>
            <table class="table landingTable">
                <thead>
                    <tr class="defaultBlueColor text-white">
                        <th scope="col">Start Date</th>
                        <th scope="col">Approved Date</th>
                        <th scope="col">Designer Name</th>
                        <th scope="col">Design Name</th>
                        <th scope="col">Orders Count</th>
                        <th scope="col">Status</th>
                        <th scope="col">Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($designs->where('status', 'submitted') as $design)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($design->created_at)->format('d/m/Y')}}</td>
                        <td>{{ \Carbon\Carbon::parse($design->approved_on)->format('d/m/Y')}}</td>
                        <td>{{ $design->designer->first_name }} {{ $design->designer->last_name }}</td>
                        <td>{{ $design->design_name }}</td>
                        <td>{{ $design->orders->count() }}</td>
                        <td>
                            @if($design->status == 'submitted')
                            <div class="badge badge-danger">Pending</div>
                            @elseif($design->status == 'approved')
                            <div class="badge badge-success">Active</div>
                            @elseif($design->status == 'rejected')
                            <div class="badge badge-secondary">Inactive</div>
                            @elseif($design->status == 'abandonded')
                            <div class="badge badge-dark">Abandonded</div>
                            @endif

                        </td>
                        <td>
                        <a href="{{ env('Shop_URL')}}/pages/review-design?id={{ $design->id }}">
                                Details
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="tab-pane fade" id="active" role="tabpanel" aria-labelledby="active-tab">

    <div class="col-12 float-left mt-3 px-0">
        <div class="col-12 float-left px-0 showallTable responsiveTableWrap">
            <p class="tableHeaderBorder col-12 mb-0"></p>
            <table class="table landingTable">
                <thead>
                    <tr class="defaultBlueColor text-white">
                        <th scope="col">Start Date</th>
                        <th scope="col">Approved Date</th>
                        <th scope="col">Designer Name</th>
                        <th scope="col">Design Name</th>
                        <th scope="col">Orders Count</th>
                        <th scope="col">Status</th>
                        <th scope="col">Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($designs->where('status','approved') as $design)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($design->created_at)->format('d/m/Y')}}</td>
                        <td>{{ \Carbon\Carbon::parse($design->approved_on)->format('d/m/Y')}}</td>
                        <td>{{ $design->designer->first_name }} {{ $design->designer->last_name }}</td>
                        <td>{{ $design->design_name }}</td>
                        <td>{{ $design->orders->count() }}</td>
                        <td>
                            @if($design->status == 'submitted')
                            <div class="badge badge-danger">Pending</div>
                            @elseif($design->status == 'approved')
                            <div class="badge badge-success">Active</div>
                            @elseif($design->status == 'rejected')
                            <div class="badge badge-secondary">Inactive</div>
                            @elseif($design->status == 'abandonded')
                            <div class="badge badge-dark">Abandonded</div>
                            @endif

                        </td>
                        <td>
                        <a href="{{ env('Shop_URL')}}/pages/review-design?id={{ $design->id }}">
                                Details
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="tab-pane fade" id="inactive" role="tabpanel" aria-labelledby="inactive-tab">
    <div class="col-12 float-left mt-3 px-0">
        <div class="col-12 float-left px-0 showallTable responsiveTableWrap">
            <p class="tableHeaderBorder col-12 mb-0"></p>
            <table class="table landingTable">
                <thead>
                    <tr class="defaultBlueColor text-white">
                        <th scope="col">Start Date</th>
                        <th scope="col">Approved Date</th>
                        <th scope="col">Designer Name</th>
                        <th scope="col">Design Name</th>
                        <th scope="col">Orders Count</th>
                        <th scope="col">Status</th>
                        <th scope="col">Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($designs->where('status','rejected') as $design)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($design->created_at)->format('d/m/Y')}}</td>
                        <td>{{ \Carbon\Carbon::parse($design->approved_on)->format('d/m/Y')}}</td>
                        <td>{{ $design->designer->first_name }} {{ $design->designer->last_name }}</td>
                        <td>{{ $design->design_name }}</td>
                        <td>{{ $design->orders->count() }}</td>
                        <td>
                            @if($design->status == 'submitted')
                            <div class="badge badge-danger">Pending</div>
                            @elseif($design->status == 'approved')
                            <div class="badge badge-success">Active</div>
                            @elseif($design->status == 'rejected')
                            <div class="badge badge-secondary">Inactive</div>
                            @elseif($design->status == 'abandonded')
                            <div class="badge badge-dark">Abandonded</div>
                            @endif

                        </td>
                        <td>
                        <a href="{{ env('Shop_URL')}}/pages/review-design?id={{ $design->id }}">
                                Details
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="tab-pane fade" id="abandoned" role="tabpanel" aria-labelledby="abandoned-tab">
    <div class="col-12 float-left mt-3 px-0">
        <div class="col-12 float-left px-0 showallTable responsiveTableWrap">
            <p class="tableHeaderBorder col-12 mb-0"></p>
            <table class="table landingTable">
                <thead>
                    <tr class="defaultBlueColor text-white">
                        <th scope="col">Start Date</th>
                        <th scope="col">Approved Date</th>
                        <th scope="col">Designer Name</th>
                        <th scope="col">Design Name</th>
                        <th scope="col">Orders Count</th>
                        <th scope="col">Status</th>
                        <th scope="col">Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($designs->where('status','abandonded') as $design)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($design->created_at)->format('d/m/Y')}}</td>
                        <td>{{ \Carbon\Carbon::parse($design->approved_on)->format('d/m/Y')}}</td>
                        <td>{{ $design->designer->first_name }} {{ $design->designer->last_name }}</td>
                        <td>{{ $design->design_name }}</td>
                        <td>{{ $design->orders->count() }}</td>
                        <td>
                            @if($design->status == 'submitted')
                            <div class="badge badge-danger">Pending</div>
                            @elseif($design->status == 'approved')
                            <div class="badge badge-success">Active</div>
                            @elseif($design->status == 'rejected')
                            <div class="badge badge-secondary">Inactive</div>
                            @elseif($design->status == 'abandonded')
                            <div class="badge badge-dark">Abandonded</div>
                            @endif

                        </td>
                        <td>
                        <a href="{{ env('Shop_URL')}}/pages/review-design?id={{ $design->id }}">
                                Details
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
