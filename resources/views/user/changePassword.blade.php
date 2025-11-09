@extends('layout.master')
@section('title', 'Change Password')
@section('content')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center ">
                                        <h1 class="h4 text-gray-900 mb-4">Change Password</h1>
                                    </div>
                                    <form action="{{route('store_new_password')}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="#oldPassword"> Old Password</label>
                                            <input type="password" class="form-control form-control-user"
                                                   id="oldPassword"  required placeholder="Password" name="oldpassword">
                                        </div>
                                        <div class="form-group">
                                            <label for="#newPassword">New Password</label>
                                            <input type="password" class="form-control form-control-user"
                                                   id="newPassword"  required placeholder="Password" min="8" name="newpassword">
                                        </div>
                                        <div class="form-group">
                                            <label for="#confirmPassword"> Confirm Password</label>
                                            <input type="password" class="form-control form-control-user"
                                                   id="confirmPassword"  required placeholder="Confirm Password" min="8"  name="confirmPassword">
                                        </div>


                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                           Change
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <img src="{{asset('assets/images/change_password.jpg')}}" class="col-lg-6">
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection
