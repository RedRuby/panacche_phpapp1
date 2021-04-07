@foreach ($vendors as $vendor)
    <option data-value="{{ $vendor->id }}" value="{{ $vendor->vendor_name }}"></option>
@endforeach
