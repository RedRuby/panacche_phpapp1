<div class="registerForm col-md-8 col-xs-12 float-left">
    <div class="row">
        <div class="form-group col-md-4 col-xs-12 float-left px-0 px-3">
            <label for="Username">Username/Profile Name</label>
            <input required type="text" name="username" id="Username" class="form-control" value="" readonly="readonly">
        </div>

        <div class="form-group col-md-4 col-xs-12 float-left px-0 px-3">
            <label for="FirstName">First Name</label>
            <input required type="text" name="first_name" id="FirstName" class="form-control" value="{{ $customer->first_name }}" readonly="readonly">
        </div>

        <div class="form-group col-md-4 col-xs-12 float-left px-0 px-3">
            <label for="LastName">Last Name</label>
            <input required type="text" name="last_name" id="LastName" minlength="2" class="form-control" value="{{ $customer->last_name }}" readonly="readonly">
        </div>
    </div>



<div class="row">
    <div class="form-group col-md-6 col-xs-12 float-left px-0 px-3">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ $customer->email }}" readonly="readonly">
    </div>
    <div class="form-group col-md-6 col-xs-12 float-left px-0 px-3">
        <label for="Location">Location</label>
        <input required type="text" name="location" id="Location" class="form-control" value="{{ $customer->locality }}" readonly="readonly">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 col-xs-12 float-left px-0 px-3">
        <label for="">Display Picture</label>
        <div class="col-12 float-left px-0">
            <p class="userPictureBox userPictureBox mb-0">
                <span class="userPic"><img src="" id="profile_pic_output"></span>
                <span class="removeUserPic"></span>
                <input type="hidden" id="profilePic" value="">
            </p>

            <div class="custom-file col-xl-10 col-md-9 px-md-1 col-sm-10 col-10 float-right">
                <input accept="image/*" class="custom-file-input" id="customFile" name="profile_pic" type="file">
            <label class="custom-file-label2 mb-0" for="customFile"></label>
            </div>
        </div>
    </div>
    <div class="form-group col-md-6 col-xs-12 float-left px-0 px-3">
        <label for="">Profile Type</label>
        <input class="form-control" name="profile_type" placeholder="" type="text" value="{{ $customer->profile_type }}" readonly="readonly">

    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 col-xs-12 float-left px-0 px-3">
        <label for="password">password</label>
        <input type="password" name="password" minlength="5" required id="password" class="form-control" value="{{ $customer->password }}" readonly="readonly">
    </div>
    <div class="form-group col-md-6 col-xs-12 float-left px-0 px-3">
        <label for="">Confirm Password</label>
        <input class="form-control" name="confirm_password" placeholder="" type="password" value="{{ $customer->confirm_password }}" readonly="readonly">
    </div>
</div>
</div>

<div class="registerForm col-md-4 col-xs-12 float-left">
    <div class="row">
        <div class="form-group mx-3 w-100">
            <label for="FullAdress">full_address</label>
            <input required type="text" name="full_address" id="FullAdress" class="form-control" value="{{ $customer->address }}" readonly="readonly">
            <span class="validation_error label--error"></span>
        </div>

        <div class="form-group mx-3 w-100">
            <input required type="text" name="locality" id="Locality" class="form-control" value="{{ $customer->locality }}" readonly="readonly">
            <span class="validation_error label--error"></span>
        </div>

        <div class="form-group w-100 mx-3">
            <input required type="text" name="pincode" id="PinCode"  class="form-control col-6 float-left mr-2" placeholder="pincode" value="{{ $customer->zip }}" readonly="readonly">
            <input required type="text" name="city" id="City" class="form-control col-5 float-right" value="{{ $customer->city }}" readonly="readonly">
        </div>
        <div class="form-group w-100 mx-3">
            <input required type="text" name="state" id="State" ss="form-control" placeholder="state" value="{{ $customer->state }}" readonly="readonly">
        </div>
    </div>
</div>

<div class="registerForm row col-md-12 float-left">
    <div class="col-md-4">
        <a href="ngrokURL/uploads/certificate/{{ $customer->designer_certificate }}" target="_blank"><h3>View Certificate</h3></a>
    </div>


    <div class="registerForm ">
        <div class=" col-sm-12 mt-md-0 mt-sm-3 mt-3 float-left px-3">
            <label class="col-12 float-left px-0" for="">Allowed Communication Channel</label>
            <div class="col-md-12 float-left mx-0 commChannel">
                <div class="row mx-0 px-0 pt-3">
                    <p class="col form-check">
                        <input class="form-check-input" id="defaultCheck1" name="communication_channel" type="checkbox" value="email">
                        <span class="validation_error label--error"></span>
                        <label class="form-check-label" for="defaultCheck1">
                            email
                        </label>
                    </p>
                    <p class="col form-check">
                        <input class="form-check-input" id="defaultCheck2" name="communication_channel" type="checkbox" value="phone">
                        <span class="validation_error label--error"></span>
                        <label class="form-check-label" for="defaultCheck2">
                            Phone
                        </label>
                    </p>
                    <p class="col form-check">
                        <input class="form-check-input" id="defaultCheck3" name="communication_channel" type="checkbox" value="inperson">
                        <span class="validation_error label--error"></span>
                        <label class="form-check-label" for="defaultCheck3">
                            In Person
                        </label>
                    </p>
                    <p class="col form-check">
                        <input class="form-check-input" id="defaultCheck4" name="communication_channel" type="checkbox" value="whatsapp">
                        <label class="form-check-label" for="defaultCheck4">
                            WhatsApp
                        </label>
                    </p>
                    <p class="col form-check">
                        <input class="form-check-input" id="defaultCheck5" name="communication_channel" type="checkbox" value="skype">
                        <span class="validation_error label--error"></span>
                        <label class="form-check-label" for="defaultCheck5">
                            Skype
                        </label>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="registerForm col-md-12 col-xs-12 float-left px-0 mb-4 mt-4">

    <button class="btn btn-danger float-right" type="button" id="designer-profile-reject-btn" data="{{ $customer->id }}">
        Reject
    </button>
    <button class="btn btn-success float-right mr-4" id="designer-profile-approve-btn" type="submit" data="{{ $customer->id }}"><span class="glyphicon glyphicon-success"></span>Approve</button>

</div>

