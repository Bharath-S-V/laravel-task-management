@extends('layouts.dashboard')
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
        <p>Check Your daily Tasks and Schedule</p>
        <div class="task-header rounded-5">

            <div class="task-content">
                <!-- Text Section -->
                <div>


                    <h5>Today's Task</h5>
                    <p>Check Your daily Tasks and Schedule</p>

                    <!-- Add New Button -->
                    <!-- Button to trigger modal -->
                    <button type="button" class="btn btn-custom text-white ms-3 mb-3 p-2" data-bs-toggle="modal"
                        data-bs-target="#taskModal">
                        Add New
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48 48">
                            <g fill="none" stroke="white" stroke-linejoin="round" stroke-width="4">
                                <rect width="36" height="36" x="6" y="6" rx="3" />
                                <path stroke-linecap="round" d="M24 16v16m-8-8h16" />
                            </g>
                        </svg>
                    </button>

                    <!-- Modal Structure -->
                    <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="taskModalLabel">Add New Task</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('tasks.store') }}" method="POST">
                                        @csrf
                                        <!-- Task Name Input -->
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label for="taskName" class="form-label">Task Name</label>
                                                <input type="text" class="form-control" id="taskName" name="taskName"
                                                    placeholder="Enter task name" required>
                                            </div>
                                        </div>

                                        <!-- Task Detail (Text Editor) -->
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label for="taskDetail" class="form-label">Task Details</label>
                                                <textarea class="form-control" name="taskDetail" placeholder="Enter task details" required></textarea>
                                            </div>
                                        </div>

                                        <!-- Date and Priority Dropdown -->
                                        <div class="row">
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="taskDate" class="form-label">Date</label>
                                                <input type="date" class="form-control" id="taskDate" name="taskDate"
                                                    required>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="taskPriority" class="form-label">Priority</label>
                                                <select class="form-select" id="taskPriority" name="taskPriority" required>
                                                    <option value="Low">Low</option>
                                                    <option value="Medium">Medium</option>
                                                    <option value="High">High</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Assign Task and Progress Dropdown -->
                                        <div class="row">
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="taskAssign" class="form-label">Assign Task To</label>
                                                <select class="form-select" id="taskAssign" name="taskAssign" required>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="taskProgress" class="form-label">Progress</label>
                                                <select class="form-select" id="taskProgress" name="taskProgress" required>
                                                    <option value="Not Started">Not Started</option>
                                                    <option value="In Progress">In Progress</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success btn-sm">Submit</button>
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Cancel</button>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Image Section -->
                <div>
                    <img src="{{ asset('assets/images/5911565_2953998.jpg') }}" alt="Task illustration" class="task-image">
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-primary mb-3">
        <div class="d-flex justify-content-between align-items-center p-1">
            <!-- Tabs -->
            <ul class="nav nav-tabs border-0">
                <li class="nav-item">
                    <a class="nav-link text-white active" href="#!" id="allTasksTab">All Task
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
                                    {{ \Carbon\Carbon::parse($task->taskDate)->format('l, d M Y') }}
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

                                <div>
                                    <!-- Edit Form -->
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editTaskModal{{ $task->id }}">
                                        Edit
                                    </button>

                                    <!-- Delete Form -->
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this task?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light btn-sm text-danger">Delete</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Task Modal -->
                <div class="modal fade" id="editTaskModal{{ $task->id }}" tabindex="-1"
                    aria-labelledby="editTaskModalLabel{{ $task->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('tasks.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="task_id" value="{{ $task->id }}">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editTaskModalLabel{{ $task->id }}">Edit Task</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Task Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $task->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="details" class="form-label">Task Details</label>
                                        <textarea class="form-control" name="details" required>{{ $task->details }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="taskDate" class="form-label">Task Date</label>
                                        <input type="date" class="form-control" name="taskDate"
                                            value="{{ \Carbon\Carbon::parse($task->taskDate)->format('Y-m-d') }}"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="priority" class="form-label">Priority</label>
                                        <select class="form-select" name="priority" required>
                                            <option value="High" {{ $task->priority === 'High' ? 'selected' : '' }}>High
                                            </option>
                                            <option value="Medium" {{ $task->priority === 'Medium' ? 'selected' : '' }}>
                                                Medium</option>
                                            <option value="Low" {{ $task->priority === 'Low' ? 'selected' : '' }}>Low
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update Task</button>
                                </div>
                            </div>
                        </form>
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
                if (card.getAttribute('data-status') === 'Completed') {
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
                    (!isCompletedVisible || card.getAttribute('data-status') === 'Completed')) {
                    card.style.display = 'block'; // Show the card
                } else {
                    card.style.display = 'none'; // Hide the card
                }
            });
        });
    </script>

@endsection
