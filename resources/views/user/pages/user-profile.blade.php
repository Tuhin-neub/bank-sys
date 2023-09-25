@extends('website.layouts.app')

@section('header-links')
<link rel="stylesheet" href="{{ asset('all/user/css/style.css') }}">
@endsection

@section('contents')

<!--Left Section Part-->
<div class="container">
    <hr>
    <div class="row">
        @include('user.layouts.sidebar')
        <div class="col-md-8 col-lg-8">
            <h3 class="text-center font-weight-normal text-dark">Update Profile information</h3>
            <div class="right-section">

                <form action="{{route('user.profile.update')}}" method="post" class=" " enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row border bg-light">
                        <div class=" col-md-4 col-lg-4 image-upload-section ">
                            <p class="font-weight-bold text-center">
                                <label for="file" style="cursor: pointer; color:black">Upload Image</label>
                            </p>
                            <p>
                                <img class="img-fluid profile-image"
                                    src="{{ !empty($data->user_more_info) ? asset('storage/'.$data->user_more_info->avatar) : asset('all/user/images/profile-icon-png-910.png') }}"
                                    id="output" width="100%" />
                            </p>
                            <input type="hidden" name="old_avatar"
                                value="{{ $data->user_more_info ? $data->user_more_info->avatar : '' }}" />
                            <input type="file" accept="image/*" name="avatar" id="imgfile" value="{{ old('avatar') }}"
                                onchange="loadFile(event)" style="width : 100%;color:black">

                        </div>
                        <div class="col-sm-12 col-md-8 col-lg-8">

                            <div class="mt-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5">First Name<span
                                                class="text-danger">*</span></span>
                                    </div>
                                    <input type="text" class="form-control" name="first_name" placeholder="First Name"
                                        aria-label="Username" value="{{ Auth::user()->first_name }}">
                                </div>
                                @error('first_name')
                                <small class="text-danger mb-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5">Last Name<span
                                                class="text-danger">*</span></span>
                                    </div>
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                                        aria-label="Username" value="{{ Auth::user()->last_name }}">
                                </div>
                                @error('last_name')
                                <small class="text-danger mb-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5">Email<span
                                                class="text-danger">*</span></span>
                                    </div>
                                    <input type="email" class="form-control" name="email" placeholder="Enter Email"
                                        aria-label="Useremail" value="{{ Auth::user()->email }}">
                                </div>
                                @error('email')
                                <small class="text-danger mb-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5">Phone<span
                                                class="text-danger">*</span></span>
                                    </div>
                                    <input type="text" name="phone"
                                        value="{{ $data->user_more_info ? $data->user_more_info->phone : '' }}"
                                        class="form-control" aria-label="Contact Number"
                                        aria-describedby="basic-addon1">
                                </div>
                                @error('phone')
                                <small class="text-danger mb-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5">Address<span
                                                class="text-danger">*</span></span>
                                    </div>
                                    <textarea class="form-control" name="address" id="basic-addon1" rows="1"
                                        cols="1">{{$data->user_more_info ? $data->user_more_info->address : ''}}</textarea>
                                </div>
                                @error('address')
                                <small class="text-danger mb-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>



                            <div class="p-3 row mb-3 ml-1 d-flex flex-row justify-content-between"
                                style="float: right;">
                                <button type="submit" name="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row border bg-light mt-3">
                <div class="col-12">
                    <form action="{{route('user.change.password')}}" method="post" class="">
                        @csrf
                        @method('PUT')
                        <h3 class="text-left text-dark">Update Password</h3>

                        <div class="mt-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5">Old Password<span
                                            class="text-danger">*</span></span>
                                </div>

                                <input type="password" name="old_password" value=""
                                    class="form-control {{ ($errors->first('old_password') ? 'border border-danger' : '') }}"
                                    aria-label="Contact Number" aria-describedby="basic-addon1">
                            </div>
                            @error('old_password')
                            <small class="text-danger mb-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                            @enderror
                        </div>


                        <div class="mt-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5">New Password<span
                                            class="text-danger">*</span></span>
                                </div>

                                <input type="password" name="password" value=""
                                    class="form-control {{ ($errors->first('password') ? 'border border-danger' : '') }}"
                                    aria-label="Contact Number" aria-describedby="basic-addon1">
                            </div>
                            @error('password')
                            <small class="text-danger mb-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon5">Confirn Password<span
                                            class="text-danger">*</span></span>
                                </div>

                                <input type="password" name="password_confirmation" value=""
                                    class="form-control {{ ($errors->first('password_confirmation') ? 'border border-danger' : '') }}"
                                    aria-label="Contact Number" aria-describedby="basic-addon1">
                            </div>
                            @error('password_confirmation')
                            <small class="text-danger mb-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                            @enderror
                        </div>

                        <div class="row mt-4 mb-3 ml-1 d-flex flex-row justify-content-between">
                            <button type="submit" name="submit" class="btn btn-success">Update password</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Left Section End-->


@endsection

@section('footer-links')
<script>
var loadFile = function(event) {
    var image = document.getElementById('output');
    image.src = URL.createObjectURL(event.target.files[0]);
};
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
@endsection