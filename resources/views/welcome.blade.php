@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">School Management System</div>

                    <div class="card-body">
                        <h1 class="col-12 text-primary text-center display-5 mb-0">Welcome to Prototype01.</h1>
                        <h2 class="col-12 text-primary text-center display-5 mb-0">We are building something awesome!!!</h2>
                        <hr>
                        <div class="d-flex justify-content-center align-items-center mb-4">
                            <img src="/images/logo.png" width="40%" alt="image"/>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <a class="btn btn-primary btn-lg btn-block mb-2" href="/admissions">Admissions</a>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <a class="btn btn-primary btn-lg btn-block mb-2" href="/login">Login</a>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <a class="btn btn-primary btn-lg btn-block" href="/register">Register</a>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>@endsection
