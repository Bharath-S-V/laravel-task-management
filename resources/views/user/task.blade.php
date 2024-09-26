@extends('layouts.user-dashboard')
@section('title', 'Task Management')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container mt-2">
        <h3>Manage Task</h3>
        <p>Check Your Daily Tasks and Schedule</p>
    </div>

    <div class="container-fluid bg-primary mb-3">
        <div class="d-flex justify-content-between align-items-center p-1">
            <!-- Tabs -->
            <ul class="nav nav-tabs border-0">
                <li class="nav-item">
                    <a class="nav-link text-white active" href="#!" id="allTasksTab">My Task
                        ({{ $taskCount }})</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#!" id="completedTasksTab">Completed
                        ({{ $completedTasksCount }})</a>
                </li>
            </ul>
            <!-- Filter By Priority Dropdown -->
            <select id="priorityFilter" class="form-select w-auto">
                <option value="all">Filter Priorities</option>
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
            </select>
        </div>
    </div>

    <div class="container">
        <div class="row" id="taskContainer">
            @foreach ($tasks as $task)
                <div class="col-md-4 p-1 task-card" data-status="{{ $task->progress }}"
                    data-priority="{{ $task->priority }}">
                    <div class="card" style="display: flex; flex-direction: column; height: 100%;">
                        <div class="card-body" style="flex-grow: 1;">
                            <h5 class="card-title">{{ $task->name }}</h5>
                            <p class="card-text">{{ $task->details }}</p>
                            <p class="card-text">
                                <small class="text-muted">
                                    {{ \Carbon\Carbon::parse($task->date)->format('l, d M Y') }}
                                </small>
                            </p>
                            <p class="card-text">
                                <small class="text-muted">By {{ $task->user->name ?? 'Unknown' }}</small>
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                @if ($task->priority === 'High')
                                    <span class="badge bg-danger">Priority High</span>
                                @elseif ($task->priority === 'Medium')
                                    <span class="badge bg-warning">Priority Medium</span>
                                @else
                                    <span class="badge bg-secondary">Priority Low</span>
                                @endif
                                <!-- Complete Form -->
                                @if ($task->progress !== 'completed')
                                    <!-- Check if task is not completed -->
                                    <form action="{{ route('tasks.complete', $task->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">Complete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        const taskCards = document.querySelectorAll('.task-card');

        document.getElementById('allTasksTab').addEventListener('click', function() {
            taskCards.forEach(card => {
                card.style.display = 'block'; // Show all tasks
            });
            this.classList.add('active');
            document.getElementById('completedTasksTab').classList.remove('active');
        });

        document.getElementById('completedTasksTab').addEventListener('click', function() {
            taskCards.forEach(card => {
                if (card.getAttribute('data-status') === 'completed') {
                    card.style.display = 'block'; // Show completed tasks
                } else {
                    card.style.display = 'none'; // Hide other tasks
                }
            });
            this.classList.add('active');
            document.getElementById('allTasksTab').classList.remove('active');
        });

        document.getElementById('priorityFilter').addEventListener('change', function() {
            const selectedPriority = this.value;
            taskCards.forEach(card => {
                const taskPriority = card.getAttribute('data-priority');
                const isCompletedVisible = document.getElementById('completedTasksTab').classList.contains(
                    'active');

                // Show or hide tasks based on selected priority and completed status
                if ((selectedPriority === 'all' || taskPriority === selectedPriority) &&
                    (!isCompletedVisible || card.getAttribute('data-status') === 'completed')) {
                    card.style.display = 'block'; // Show the card
                } else {
                    card.style.display = 'none'; // Hide the card
                }
            });
        });
    </script>
@endsection
