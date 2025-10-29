<!DOCTYPE html>
<html>
@extends('includes.header')
@section('title','login')

<body class="bg-gradient-primary">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <img src="{{asset('assets/images/login.jpg')}}" class="col-lg-6  d-lg-block bg-login-image">

                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Log in</h1>
                                </div>
                                <form action="{{route('login_User')}}" method="POST">
                                    @csrf
                                    @if (isset($error))
                                        <span class="text-danger">{{$error}}</span>
                                    @endif
                                    <div class="form-group">
                                        <label for="username">UserName</label>
                                        <input type="text" class="form-control form-control-user"
                                               id="username" required name="username"
                                               placeholder="Enter Username...">
                                    </div>

                                    <div class="form-group">
                                        <label for="Password">Password</label>
                                        <input type="password" class="form-control form-control-user"
                                               id="Password"  required placeholder="Password" name="password">
                                    </div>


                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

</body>

</html>
