<div id="create-project-form" x-data="{ showForm: false }">

    <div class="my-3">
        <button class="border rounded border-orange-800 bg-orange-500 px-2 py-1 text-white hover:bg-orange-600" @click="showForm = true">New Project</button>
    </div>

    <div class="border rounded border-gray-200 p-3 bg-white w-full lg:w-1/3"
         x-show="showForm">
        <h3 class="font-bold">Create Project</h3>

        <form action="{{ route('projects::store') }}" method="post">
            @csrf

            <div class="my-3">
                <input type="text" name="name" placeholder="Project's Name" class="w-full outline-none border-b border-gray-400 p-2">
            </div>

            <div class="my-3">
                <input type="text" name="name" placeholder="Short description about your project" class="w-full outline-none border-b border-gray-400 p-2">
            </div>

            <div class="my-3">
                <button type="submit" class="border rounded border-orange-800 bg-orange-500 px-2 py-1 text-white hover:bg-orange-600" @click="showForm = false">Submit</button>
                <button type="button" class="px-2 py-1 focus:outline-none" @click="showForm = false">Cancel</button>
            </div>
        </form>

    </div>
</div>

<div class="grid grid-cols-4 gap-2 my-3">
    @foreach($projects as $project)
        <div class="border border-gray-200 bg-white ">
            <div class="border-b border-gray-200 p-3 pb-1">
                <div class="font-bold text-center mb-1">{{ $project->name }}</div>
                <div class="text-gray-600">{{ $project->description }}</div>
            </div>
            <div class="p-3">
                <a href="{{ route('projects::show', [$project]) }}" class="text-orange-500 mr-2">View Project</a>
                <span class="text-gray-500 ">Monitors: {{ $project->monitors_count }}</span>
            </div>
        </div>
    @endforeach
</div>

@if($projects->isEmpty())
    <div class="border border-gray-400 bg-gray-200 text-gray-800 p-3 my-3 rounded">
        You haven't created any project yet.
    </div>
@endif
