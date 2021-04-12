<div class="row px-3 mt-2 mb-0 mb-md-3">
    <div class="col-12 px-0 landingHeading float-left">
        <h4 class="mb-4">
            <span>New Designer</span>
        </h4>
    </div>

    <div class="col-12 px-0 mb-4 float-left">
        <div class="col-md-4 px-0 float-left">
            <div class="col-12 newDesignerProfile">
                @if($designer->display_picture == '')
                <p class="mx-auto" style="background-image: url({{  asset('uploads/designer/defaultUserImg.png') }})"></p>
                @else
                <p class="mx-auto" style="background-image: url({{  asset('uploads/designer/display_picture/'.$designer->display_picture) }})"></p>
                @endif
            </div>
            <div class="col-12 py-3">
                <div class="landingHeading">
                    <h5 class="defaultColor font-weight-bold" for="">Designer Documents</h5>
                </div>
                <div class="newDesignerdownlaodDoc col-12 py-4 mt-3">
                    <a href="{{route('get_resume_file', $designer->resume)}}">
                        <button type="button" class="btn btn-primary loginBtn mb-3 w-100">
                            <i class="fas fa-file mr-2"></i>
                            Download Resume
                        </button>
                    </a>
                    <a href="{{route('get_portfolio_file', $designer->portfolio)}}">
                        <button type="button" class="btn btn-primary loginBtn w-100">
                            <i class="fas fa-file mr-2"></i>
                            Download Portfolio
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-8 float-left">
            <div class="form-group">
                <label for=""><span class="mandetory">*</span> First Name</label>
                <p class="submitedText px-2 py-2 font14">{{ $designer->first_name }}</p>
            </div>
            <div class="form-group">
                <label for=""><span class="mandetory">*</span> Last Name</label>
                <p class="submitedText px-2 py-2 font14">{{ $designer->last_name }}</p>
            </div>
            <div class="form-group">
                <label for="">Bio (Short description about yourself)</label>
                <p class="submitedText px-2 py-2 font14">{{ $designer->bio }}
                </p>
            </div>
            <div class="form-group">
                <label for="">A quote/ message for your clients </label>
                <p class="submitedText px-2 py-2 font14">{{ $designer->quote }}</p>
            </div>
        </div>
    </div>

    <div class="col-12 px-0 mb-4 float-left">
        <div class="col-md-6 float-left">
            <div class="form-group">
                <label for=""><span class="mandetory">*</span> Email- Id <em>(This will be your UserID)</em> </label>
                <p class="submitedText px-2 py-2 font14">{{ $designer->email }}/p>
            </div>
            <div class="form-group">
                <label for="">Business Name </label>
                <p class="submitedText px-2 py-2 font14">{{ $designer->business_name }}</p>
            </div>
            <div class="form-group">
                <label for="">Website URL <em>(Example: https://www.mywebsite.com)</em> </label>
                <p class="submitedText px-2 py-2 font14">https://www.laurabenettedesigns.com</p>
            </div>
        </div>
        <div class="col-md-6 float-left">
            <div class="form-group">
                <label for=""><span class="mandetory">*</span> Contact No. <em>(Example: 123-456-7890)</em> </label>
                <p class="submitedText px-2 py-2 font14">894-030-4232</p>
            </div>
            <div class="form-group">
                <label for="">Business Address</label>
                <p class="submitedText px-2 py-2 font14 businessAddress" rows="3">{{ $designer->business_address }} </p>
            </div>
        </div>
    </div>

    <div class="col-12 mb-4">
        <a href="#">
            <button type="button" class="btn btn-primary rejectBtn float-right" id="reject-profile-btn" data="{{ $designer->id }}">
                <i class="fas fa-times-circle mr-1"></i>
                Reject
            </button>
        </a>
        <a href="#">
            <button type="button" class="btn btn-primary approveBtn float-right mr-3" id="approve-profile-btn" data="{{ $designer->id }}">
                <i class="fas fa-check-circle mr-1"></i>
                Approve
            </button>
        </a>
    </div>

</div>
