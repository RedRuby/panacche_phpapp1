 <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
         <div class="row">
             <div class="col-lg-4 col-md-4 col-sm-6 col-6 float-left">
                 <i class="fas fa-search" aria-hidden="true"></i>
                 <input type="search" class="form-control col-12 float-left pl-5 searchInput" placeholder="Search">
             </div>
             <div class="col-lg-2 col-md-4 col-sm-6 col-6 float-left">
                 <div class="form-group">
                     <select class="custom-select selectDropdown">
                         <option selected="">Filter</option>
                         <option value="1">1</option>
                         <option value="2">2</option>
                         <option value="3">3</option>
                         <option value="3">4</option>
                     </select>
                 </div>
             </div>
         </div>
         <div class="col-12 float-left mt-3 px-0">
             <div class="col-12 float-left px-0 showallTable responsiveTableWrap">
                 <p class="tableHeaderBorder col-12 mb-0"></p>
                 <table class="table landingTable all">
                     <thead>
                         <tr class="defaultBlueColor text-white">
                             <th scope="col">Designer Name</th>
                             <th scope="col">Date Onboarded</th>
                             <th scope="col">Total No. of Designs</th>
                             <th scope="col">Total No. of Customers</th>
                             <th scope="col">Design Delivered</th>
                             <th scope="col">Status</th>
                             <th scope="col">Details</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($designers as $key => $designer )
                         <tr>
                            <td>{{ $designer->first_name }} {{ $designer->last_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($designer->created_at)->format('d/m/Y')}} </td>
                            <td>{{ $designer->collections->count() }}</td>
                            <td>@php
                                $customersCount = $designer->orders->groupBy('customer_id')->count();
                            @endphp
                           {{ $customersCount }}
                               </td>
                            <td>{{ $designer->orders->where('status','completed')->count() }}</td>

                            <td>
                                @if($customersCount == 0)
                                    <div class="badge badge-secondary">Inactive</div>
                                @elseif($customersCount >= 0)
                                    <div class="badge badge-success">Active</div>
                                @elseif($designer->status == 'pending')
                                    <div class="badge badge-danger">Pending</div>
                                @elseif($designer->status == 'rejected')
                                    <div class="badge badge-dark">Rejected</div>
                                @endif
                            </td>
                        <td><a href="{{ env('Shop_URL') }}/pages/designers-profile?id={{$designer->id}}">View More</a></td>
                        </tr>
                         @endforeach


                     </tbody>
                 </table>
             </div>
         </div>
     </div>
     <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
         <div class="row">
             <div class="col-lg-4 col-md-4 col-sm-6 col-6 float-left">
                 <i class="fas fa-search" aria-hidden="true"></i>
                 <input type="search" class="form-control col-12 float-left pl-5 searchInput" placeholder="Search">
             </div>
             <div class="col-lg-2 col-md-4 col-sm-6 col-6 float-left">
                 <div class="form-group">
                     <select class="custom-select selectDropdown">
                         <option selected="">Filter</option>
                         <option value="1">1</option>
                         <option value="2">2</option>
                         <option value="3">3</option>
                         <option value="3">4</option>
                     </select>
                 </div>
             </div>
         </div>
         <div class="col-12 float-left mt-3 px-0">
             <div class="col-12 float-left px-0 showallTable responsiveTableWrap">
                 <p class="tableHeaderBorder col-12 mb-0"></p>
                 <table class="table landingTable">
                     <thead>
                         <tr class="defaultBlueColor text-white">
                             <th scope="col">Designer Name</th>
                             <th scope="col">Date Onboarded</th>
                             <th scope="col">Total No. of Designs</th>
                             <th scope="col">Total No. of Customers</th>
                             <th scope="col">Design Delivered</th>
                             <th scope="col">Status</th>
                             <th scope="col">Details</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <td>Lisa Shaikh</td>
                             <td>10-4-2021</td>
                             <td>00</td>
                             <td>00</td>
                             <td>00</td>
                             <td>
                                 <div class="badge badge-danger">Pending</div>
                             </td>
                             <td><a href="#">View More</a></td>
                         </tr>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
     <div class="tab-pane fade" id="active" role="tabpanel" aria-labelledby="active-tab">
         <div class="row">
             <div class="col-lg-4 col-md-4 col-sm-6 col-6 float-left">
                 <i class="fas fa-search" aria-hidden="true"></i>
                 <input type="search" class="form-control col-12 float-left pl-5 searchInput" placeholder="Search">
             </div>
             <div class="col-lg-2 col-md-4 col-sm-6 col-6 float-left">
                 <div class="form-group">
                     <select class="custom-select selectDropdown">
                         <option selected="">Filter</option>
                         <option value="1">1</option>
                         <option value="2">2</option>
                         <option value="3">3</option>
                         <option value="3">4</option>
                     </select>
                 </div>
             </div>
         </div>
         <div class="col-12 float-left mt-3 px-0">
             <div class="col-12 float-left px-0 showallTable responsiveTableWrap">
                 <p class="tableHeaderBorder col-12 mb-0"></p>
                 <table class="table landingTable">
                     <thead>
                         <tr class="defaultBlueColor text-white">
                             <th scope="col">Designer Name</th>
                             <th scope="col">Date Onboarded</th>
                             <th scope="col">Total No. of Designs</th>
                             <th scope="col">Total No. of Customers</th>
                             <th scope="col">Design Delivered</th>
                             <th scope="col">Status</th>
                             <th scope="col">Details</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <td>John Mathew</td>
                             <td>10-4-2021</td>
                             <td>07</td>
                             <td>03</td>
                             <td>02</td>
                             <td>
                                 <div class="badge badge-success">Active</div>
                             </td>
                             <td><a href="#">View More</a></td>
                         </tr>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
     <div class="tab-pane fade" id="inactive" role="tabpanel" aria-labelledby="inactive-tab">
         <div class="row">
             <div class="col-lg-4 col-md-4 col-sm-6 col-6 float-left">
                 <i class="fas fa-search" aria-hidden="true"></i>
                 <input type="search" class="form-control col-12 float-left pl-5 searchInput" placeholder="Search">
             </div>
             <div class="col-lg-2 col-md-4 col-sm-6 col-6 float-left">
                 <div class="form-group">
                     <select class="custom-select selectDropdown">
                         <option selected="">Filter</option>
                         <option value="1">1</option>
                         <option value="2">2</option>
                         <option value="3">3</option>
                         <option value="3">4</option>
                     </select>
                 </div>
             </div>
         </div>
         <div class="col-12 float-left mt-3 px-0">
             <div class="col-12 float-left px-0 showallTable responsiveTableWrap">
                 <p class="tableHeaderBorder col-12 mb-0"></p>
                 <table class="table landingTable">
                     <thead>
                         <tr class="defaultBlueColor text-white">
                             <th scope="col">Designer Name</th>
                             <th scope="col">Date Onboarded</th>
                             <th scope="col">Total No. of Designs</th>
                             <th scope="col">Total No. of Customers</th>
                             <th scope="col">Design Delivered</th>
                             <th scope="col">Status</th>
                             <th scope="col">Details</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <td>Carey Paul</td>
                             <td>10-4-2021</td>
                             <td>10</td>
                             <td>07</td>
                             <td>07</td>
                             <td>
                                 <div class="badge badge-secondary">Inactive</div>
                             </td>
                             <td><a href="#">View More</a></td>
                         </tr>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
     <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
         <div class="row">
             <div class="col-lg-4 col-md-4 col-sm-6 col-6 float-left">
                 <i class="fas fa-search" aria-hidden="true"></i>
                 <input type="search" class="form-control col-12 float-left pl-5 searchInput" placeholder="Search">
             </div>
             <div class="col-lg-2 col-md-4 col-sm-6 col-6 float-left">
                 <div class="form-group">
                     <select class="custom-select selectDropdown">
                         <option selected="">Filter</option>
                         <option value="1">1</option>
                         <option value="2">2</option>
                         <option value="3">3</option>
                         <option value="3">4</option>
                     </select>
                 </div>
             </div>
         </div>
         <div class="col-12 float-left mt-3 px-0">
             <div class="col-12 float-left px-0 showallTable responsiveTableWrap">
                 <p class="tableHeaderBorder col-12 mb-0"></p>
                 <table class="table landingTable">
                     <thead>
                         <tr class="defaultBlueColor text-white">
                             <th scope="col">Designer Name</th>
                             <th scope="col">Date Onboarded</th>
                             <th scope="col">Total No. of Designs</th>
                             <th scope="col">Total No. of Customers</th>
                             <th scope="col">Design Delivered</th>
                             <th scope="col">Status</th>
                             <th scope="col">Details</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <td>Shelly Ben</td>
                             <td>10-4-2021</td>
                             <td>07</td>
                             <td>05</td>
                             <td>00</td>
                             <td>
                                 <div class="badge badge-dark">Rejected</div>
                             </td>
                             <td><a href="#">View More</a></td>
                         </tr>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>


