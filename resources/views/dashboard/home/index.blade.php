@extends('layouts.dashboard')

@section('title')
    Dashboard
@endsection

@section('content')

    <div class="container mx-auto">

        <h2 class="my-3 text-xl">My Projects</h2>

        @include('projects._project_list')

    </div>
@endsection

