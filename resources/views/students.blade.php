@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Student Management') }}</div>

                <div class="card-body">
                @auth
                    @if (Auth::user()->user_type=='SuperAdmin' || Auth::user()->user_type=='School Manager' || Auth::user()->user_type=='Recepcionist')
                        <student-management />
                    @else
                        <no-access-component />
                    @endif
                @endauth        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
