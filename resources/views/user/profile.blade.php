@extends('layout.master')
@section('title','My Profile')
@section('content')

    <div class="container mt-5 ">

        <div class="row d-flex justify-content-center">

            <div class="col-md-7">

                <div class="card p-3 py-4">

                    <div class="text-center">
                        <img src="{{asset('assets/images/undraw_profile.svg')}}" width="100" class="rounded-circle">
                    </div>

                    <div class="text-center mt-3">
                        <h5 class="mt-2 mb-0">{{Auth::user()->username}}</h5>
                        <span>{{Auth::user()->employee->position->name_en}}</span>

                    </div>

                    <div class=" text-center buttons mt-4">
                        <a href="{{route('change_password_request')}}">
                            <button id="chanePassword" class="btn btn-outline-primary">Change Password</button>
                        </a>

                    </div>


                </div>

            </div>

        </div>

    </div>


@endsection
