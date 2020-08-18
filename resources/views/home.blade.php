@extends('layouts.master')

@section('content')

    @auth
        @if (Auth::user()->user_type=='SuperAdmin')<admin-portal />@endif
        @if (Auth::user()->user_type=='Student')<student-portal />@endif
        @if (Auth::user()->user_type=='Teacher')<teacher-portal />@endif
        @if (Auth::user()->user_type=='School Manager')<school-manager-portal />@endif
        @if (Auth::user()->user_type=='Recepcionist')<recepcionist-portal />@endif
    @endauth        

@endsection
