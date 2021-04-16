@foreach ($vendors as $vendor)
<tr>
    <td><span class="vendorLogo"><img src="images/person-1.jpg" class="img-fluid rounded-circle mr-3" width="40"></span></td>
    <td>{{ $vendor->created_at }}</td>
    <td>{{ $vendor->id }}</td>
    <td>{{ $vendor->vendor_name }}</td>
</tr>
@endforeach
