@extends('layouts.dashboard')

@section('title')
    Edit Project
@endsection

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center">

            <div class="lg:w-1/3 w-full">

                <h2 class="mb-2 text-xl text-center">Edit {{ $project->name }}</h2>
                <form action="{{ route('projects::store', [$project]) }}" method="post" class="border border-gray-400 bg-white rounded p-3">
                    @csrf
                    @method('put')

                    <div class="my-3">
                        <label class="font-bold mb-2 block">Project Name</label>
                        <input type="text" name="name" value="{{ $project->name }}" class="outline-none focus:outline-none border-b border-gray-400 w-full text-gray-700 py-1">
                    </div>

                    <div class="my-3">
                        <label class="font-bold mb-2 block">Short Description</label>
                        <input type="text" name="description" value="{{ $project->description }}" class="outline-none focus:outline-none border-b border-gray-400 w-full text-gray-700 py-1" placeholder="Short description about your project">
                    </div>

                    <div class="mt-2">
                        <button type="submit" class="rounded bg-orange-600 text-white border border-orange-800 px-3 py-1 hover:bg-orange-500 mr-2">Save</button>
                        <a href="{{ route('projects::show', [$project]) }}" class="text-gray-600">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

