@foreach ($designers as $designer)
    <option data-value="{{ $designer->id }}" value="{{ $designer->first_name }} {{ $designer->last_name }}"></option>
@endforeach
