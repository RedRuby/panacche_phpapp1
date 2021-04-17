@if($vendors->count() == 0)
<tr>
    <td cell-padding="4">Vendors Not Found</td>
</tr>
@else
@foreach ($vendors as $vendor)
<tr>
    <td><span class="vendorLogo">
        @if($vendor->vendor_logo)
            <img src="{{ asset('uploads/collection/vendor_logo/'.$vendor->vendor_logo) }}" class="img-fluid rounded-circle mr-3" width="40">
        @else
            <img src="" class="img-fluid rounded-circle mr-3" width="40">
        @endif
    </span>
    </td>
    <td>{{ \Carbon\Carbon::parse($vendor->created_at)->format('d/m/Y')}}</td>
    <td>{{ $vendor->id }}</td>
    <td>{{ $vendor->vendor_name }}</td>
    <td><button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit" id="edit-vendor-btn" data="{{ $vendor->id }}"><i class="fa fa-edit"></i></button>
    </li>
    <li class="list-inline-item">
        <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete" id="delete-vendor-btn" data="{{ $vendor->id }}"><i class="fa fa-trash"></i></button></td>
</tr>
@endforeach
@endif
