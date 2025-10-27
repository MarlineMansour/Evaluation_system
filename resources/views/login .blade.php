<!DOCTYPE html>
<html>
@extends('includes.header')
@section('title','login')
<body>
<section class="vh-100 my-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 text-black">

                <div class="px-5 ms-xl-4">
{{--                    <img id="logo" src="{{asset('assets/pictures/bookLogo.jpg')}}" width="90" />--}}
                    <span class="h1 fw-bold mb-0 "style="color: #0b8f96;">ERP System</span>
                </div>

                <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                    <form action="{{route('login_User')}}" method="post" style="width: 23rem;">
                        @csrf

                        <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" id="username" class="form-control form-control-lg" min="3" required name="username"/>
                            @error('error')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="pass">Password</label>
                            <input type="password" id="pass" class="form-control form-control-lg" required min="8" name="password"/>
                            @error('error')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="pt-1 mb-4">
                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-lg " style="color:black; background-color: #78e0e3;" type="submit">Login</button>
                        </div>


                    </form>

                </div>

            </div>

        </div>
    </div>
</section>


</body>
</html>
