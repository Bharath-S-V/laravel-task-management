@extends('layouts.dashboard')
@section('title', 'User Management')
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
    <div class="container mt-5">
        <h3>Create Users</h3>
        <div class="d-flex align-items-center justify-content-between">
            <!-- Paragraph with medium font-weight -->
            <p class="fw-medium d-inline-block">Create Users</p>
            <!-- Button with icon to the right of the text -->
            <button type="button" class="btn btn-custom text-white ms-3 mb-3 p-2" data-bs-toggle="modal"
                data-bs-target="#userModal">
                Add New
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48 48">
                    <g fill="none" stroke="white" stroke-linejoin="round" stroke-width="4">
                        <rect width="36" height="36" x="6" y="6" rx="3" />
                        <path stroke-linecap="round" d="M24 16v16m-8-8h16" />
                    </g>
                </svg>
            </button>
        </div>


        <div class="table-responsive">
            <table class="table table-striped table-hover custom-table">
                <thead class="custom-table-header">
                    <tr class="text-center p-4">
                        <th scope="col">SL. No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Designation</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-center">
                    @if ($users->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">No users found.</td>
                            <!-- Adjust colspan based on your table structure -->
                        </tr>
                    @else
                        @foreach ($users as $index => $user)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th> <!-- Serial number -->
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->designation }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="action-icons d-flex justify-content-center">
                                    <!-- Edit Icon -->
                                    <div class="icon-container">
                                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-light btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 16 16">
                                                <path fill="#68c8ee"
                                                    d="M12.707 1L15 3.292a1 1 0 0 1-.002 1.416l-1.441 1.434l-3.702-3.703L11.293 1a1 1 0 0 1 1.414 0M8.44 3.854L1.5 10.793v3.652h3.706l6.932-6.893z" />
                                            </svg>
                                        </a>
                                    </div>



                                    <!-- Delete Icon -->
                                    <div class="icon-container">
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-light btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <path fill="red"
                                                        d="M17 6h5v2h-2v13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V8H2V6h5V3a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1zm1 2H6v12h12zm-9 3h2v6H9zm4 0h2v6h-2zM9 4v2h6V4z" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>

            </table>
        </div>
        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    @if ($users->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    @endif

                    @for ($i = 1; $i <= $users->lastPage(); $i++)
                        <li class="page-item {{ $users->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    @if ($users->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>

    </div>
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom:0px;">
                    <h5 class="modal-title" id="userModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="userForm" method="POST" action="{{ route('users.store') }}">
                        @csrf <!-- Include CSRF Token -->
                        <div class="row">
                            <!-- Name Field -->
                            <div class="col-12 col-md-6 mb-3">
                                <label for="userName" class="form-label">User Name</label>
                                <input type="text" name="name" class="form-control" id="userName"
                                    placeholder="Enter user name" required>
                            </div>
                            <!-- Designation Field -->
                            <div class="col-12 col-md-6 mb-3">
                                <label for="designation" class="form-label">Designation</label>
                                <input type="text" name="designation" class="form-control" id="designation"
                                    placeholder="Enter designation" required>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Email Field -->
                            <div class="col-12 col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Enter email" required>
                            </div>
                            <!-- Password Field -->
                            <div class="col-12 col-md-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Enter password" required>
                            </div>
                        </div>
                        <div class="modal-footer" style="border-top:0px;">
                            <button type="submit" class="btn btn-success btn-sm rounded-5">Submit</button>
                            <button type="button" class="btn btn-danger btn-sm rounded-5"
                                data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

@endsection
