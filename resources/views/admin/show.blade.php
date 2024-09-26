<h1>{{ $task->name }}</h1>
<p>{{ $task->details }}</p>
<p>Assigned to: {{ $task->user->name }}</p>
<p>Progress: {{ $task->progress }}</p>
