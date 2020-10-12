@extends('layouts.dashboard')

@section('title')
    Projects
@endsection

@section('content')

    <div class="container mx-auto">
        
        @include('projects._project_list')

    </div>

@endsection

