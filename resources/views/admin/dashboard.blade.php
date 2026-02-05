<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">FinSage Admin</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users.index') }}">User Management</a>
                    </li>
                </ul>
                
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="navbar-text me-3">Welcome, {{ Auth::user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-decoration-none">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container mt-4">

        <h2 class="text-center mb-4">Admin Dashboard</h2>
        
        
        <div class="row g-4">

            <!-- Total Users Card -->
            <div class="col-md-3">
                <div class="card shadow border-0">
                    <div class="card-body text-center">
                        <h4>Total Users</h4>
                        <p class="display-6 text-primary">{{ \App\Models\User::count() }}</p>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-primary">Manage Users</a>
                    </div>
                </div>
            </div>

            <!-- Admin Users Card -->
            <div class="col-md-3">
                <div class="card shadow border-0">
                    <div class="card-body text-center">
                        <h4>Administrators</h4>
                        <p class="display-6 text-danger">{{ \App\Models\User::where('usertype', 'admin')->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Regular Users Card -->
            <div class="col-md-3">
                <div class="card shadow border-0">
                    <div class="card-body text-center">
                        <h4>Regular Users</h4>
                        <p class="display-6 text-success">{{ \App\Models\User::where('usertype', 'user')->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- New Registrations Card -->
            <div class="col-md-3">
                <div class="card shadow border-0">
                    <div class="card-body text-center">
                        <h4>New This Week</h4>
                        <p class="display-6 text-warning">{{ \App\Models\User::where('created_at', '>=', now()->subWeek())->count() }}</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-5">
            <h3 class="mb-3">Recent Users</h3>

            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Registered</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse(\App\Models\User::latest()->take(5)->get() as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="badge {{ $user->usertype === 'admin' ? 'bg-danger' : 'bg-secondary' }}">
                                                {{ ucfirst($user->usertype) }}
                                            </span>
                                        </td>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No users found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="text-center mt-3">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
                            View All Users
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
