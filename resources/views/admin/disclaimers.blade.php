@foreach ($disclaimers as $disclaimer)
<div class="addedDisclaimer p-4 col-12 px-0 float-left mt-4">
    <p>{{ $disclaimer->disclaimer }}</p>
    <p>
        <button type="button" class="btn btn-primary grayBtn float-right mt-2 edit-disclaimer-btn" data="{{ $disclaimer->id }}">Edit</button>
        <button type="button" class="btn btn-primary cancelBtn float-right mt-2 px-2 mr-2 removeDisclaimer remove-disclaimer-btn" data="{{ $disclaimer->id }}"><i class="fas fa-times-circle mr-2"></i>Remove Disclaimer</button>
    </p>
</div>
@endforeach
