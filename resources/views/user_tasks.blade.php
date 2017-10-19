<h1>{{$user->name}} Tasks:</h1>

<ul>
    @foreach($tasks as $task)
        <li>{{ $task->name }}</li>
    @endforeach

</ul>