<nav>
    <div class="flex w-full border-b border-gray-200 bg-white shadow mb-3">
        <ul class="flex p-3  mr-auto">
            <li class="mr-3">
                <a href="{{ route('dashboard') }}" class="font-bold">{{ config('app.name') }}</a>
            </li>
            <li class="mr-3">
                <a href="{{ route('projects::index') }}">Projects</a>
            </li>
        </ul>

        <ul class="flex p-3">
            <li class="mr-3">
                <a href="#">Profile</a>
            </li>
            <li class="mr-3">
                <button class="focus:outline-none" form="logout">Logout</button>
            </li>
        </ul>
    </div>
</nav>
<form action="{{ route('logout') }}" method="post" id="logout" class="hidden" onsubmit="return confirm('Are you sure you want to logout?')">
    @csrf
</form>
