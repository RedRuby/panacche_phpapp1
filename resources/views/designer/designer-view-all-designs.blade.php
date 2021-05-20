<div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">

                              <div class="col-12 float-left mt-3 px-0">
                                 <div class="col-12 float-left px-0 showallTable responsiveTableWrap">
									<p class="tableHeaderBorder col-12 mb-0"></p>
                                    <table class="table landingTable">
                                       <thead>
                                          <tr class="defaultBlueColor text-white">
                                             <th scope="col">Start Date</th>
                                             <th scope="col">End Date</th>
                                             <th scope="col">Design Name</th>
                                             <th scope="col">Status</th>
                                             <th scope="col">Details</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                        @foreach ($designs as $design)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($design->created_at)->format('d/m/Y')}}</td>
                                            <td>{{ \Carbon\Carbon::parse($design->approved_on)->format('d/m/Y')}}</td>
                                            <td>{{ $design->design_name }}</td>
                                            <td>
                                                @if($design->status == 'submitted')
                                                <div class="badge badge-info">Under Review</div>
                                                @elseif($design->status == 'rejected')
                                                <div class="badge badge-secondary">Inactive</div>
                                                @elseif($design->status == 'draft')
                                                <div class="badge badge-primary">Draft Design</div>
                                                @else
                                                    <div class="badge badge-secondary">Inactive</div>
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
                                       <thead class="defaultBlueColor text-white">
                                          <tr>
                                             <th scope="col">Start Date</th>
                                             <th scope="col">End Date</th>
                                             <th scope="col">Design Name</th>
                                             <th scope="col">Status</th>
                                             <th scope="col">Details</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                        @foreach ($designs->where('status', 'rejected', 'approved') as $design)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($design->created_at)->format('d/m/Y')}}</td>
                                            <td>{{ \Carbon\Carbon::parse($design->approved_on)->format('d/m/Y')}}</td>
                                            <td>{{ $design->design_name }}</td>
                                            <td>
                                                @if($design->status == 'submitted')
                                                <div class="badge badge-info">Under Review</div>
                                                @elseif($design->status == 'rejected')
                                                <div class="badge badge-secondary">Inactive</div>
                                                @elseif($design->status == 'draft')
                                                <div class="badge badge-primary">Draft Design</div>
                                                @else
                                                    <div class="badge badge-secondary">Inactive</div>
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
                           <div class="tab-pane fade" id="under_review" role="tabpanel" aria-labelledby="under_review-tab">

                              <div class="col-12 float-left mt-3 px-0">
                                 <div class="col-12 float-left px-0 showallTable responsiveTableWrap">
									<p class="tableHeaderBorder col-12 mb-0"></p>
                                    <table class="table landingTable">
                                       <thead class="defaultBlueColor text-white">
                                          <tr>
                                             <th scope="col">Start Date</th>
                                             <th scope="col">End Date</th>
                                             <th scope="col">Design Name</th>
                                             <th scope="col">Status</th>
                                             <th scope="col">Details</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                        @foreach ($designs->where('status', 'submitted') as $design)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($design->created_at)->format('d/m/Y')}}</td>
                                            <td>{{ \Carbon\Carbon::parse($design->approved_on)->format('d/m/Y')}}</td>
                                            <td>{{ $design->design_name }}</td>
                                            <td>
                                                @if($design->status == 'submitted')
                                                <div class="badge badge-info">Under Review</div>
                                                @elseif($design->status == 'rejected')
                                                <div class="badge badge-secondary">Inactive</div>
                                                @elseif($design->status == 'draft')
                                                <div class="badge badge-primary">Draft Design</div>
                                                @else
                                                    <div class="badge badge-secondary">Inactive</div>
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
                           <div class="tab-pane fade" id="draft_design" role="tabpanel" aria-labelledby="draft_design-tab">

                              <div class="col-12 float-left mt-3 px-0">
                                 <div class="col-12 float-left px-0 showallTable responsiveTableWrap">
									<p class="tableHeaderBorder col-12 mb-0"></p>
                                    <table class="table landingTable">
                                       <thead class="defaultBlueColor text-white">
                                          <tr>
                                             <th scope="col">Start Date</th>
                                             <th scope="col">End Date</th>
                                             <th scope="col">Design Name</th>
                                             <th scope="col">Status</th>
                                             <th scope="col">Details</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                        @foreach ($designs->where('status', 'draft') as $design)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($design->created_at)->format('d/m/Y')}}</td>
                                            <td>{{ \Carbon\Carbon::parse($design->approved_on)->format('d/m/Y')}}</td>
                                            <td>{{ $design->design_name }}</td>
                                            <td>
                                                @if($design->status == 'submitted')
                                                <div class="badge badge-info">Under Review</div>
                                                @elseif($design->status == 'rejected')
                                                <div class="badge badge-secondary">Inactive</div>
                                                @elseif($design->status == 'draft')
                                                <div class="badge badge-primary">Draft Design</div>
                                                @else
                                                    <div class="badge badge-secondary">Inactive</div>
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
