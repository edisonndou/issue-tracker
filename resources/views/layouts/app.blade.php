<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Issue Tracker')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #0d6efd;
            --sidebar-width: 260px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            padding-top: 60px;
        }

        .navbar {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.3rem;
            letter-spacing: -0.5px;
        }

        .sidebar {
            background: white;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            min-height: calc(100vh - 60px);
            position: fixed;
            left: 0;
            top: 60px;
            width: var(--sidebar-width);
            padding: 1.5rem 0;
            overflow-y: auto;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            margin: 0;
        }

        .sidebar-menu a {
            display: block;
            padding: 0.75rem 1.5rem;
            color: #495057;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: #f8f9fa;
            color: var(--primary-color);
            border-left-color: var(--primary-color);
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
        }

        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .btn {
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(13, 110, 253, 0.3);
        }

        .badge {
            font-weight: 500;
            padding: 0.5rem 0.75rem;
        }

        .status-badge {
            display: inline-block;
            padding: 0.375rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .status-open {
            background-color: #e7f3ff;
            color: #0c5fbf;
        }

        .status-in_progress {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-closed {
            background-color: #d4edda;
            color: #155724;
        }

        .priority-low {
            color: #28a745;
        }

        .priority-medium {
            color: #ffc107;
        }

        .priority-high {
            color: #dc3545;
        }

        .issue-card {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .issue-card:hover {
            border-left: 4px solid var(--primary-color);
        }

        .modal-header {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            color: white;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .alert {
            border: none;
            border-radius: 0.375rem;
        }

        .tag-badge {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            margin: 0.2rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .assignee-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            font-size: 0.85rem;
            margin: 0 2px;
        }

        .comments-section {
            max-height: 600px;
            overflow-y: auto;
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: 0.375rem;
        }

        .comment {
            margin-bottom: 1rem;
            padding: 0.75rem;
            background-color: white;
            border-left: 3px solid var(--primary-color);
            border-radius: 0.375rem;
        }

        .comment-header {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.25rem;
        }

        .comment-time {
            font-size: 0.85rem;
            color: #999;
        }

        .comment-body {
            color: #555;
            font-size: 0.95rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: static;
                min-height: auto;
                margin-bottom: 1rem;
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            body {
                padding-top: 60px;
            }
        }

        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #999;
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('projects.index') }}">
                <i class="bi bi-checklist-task"></i> IssueTracker
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <span class="nav-link">{{ auth()->user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">Logout</button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    @auth
        <aside class="sidebar d-lg-block">
            <ul class="sidebar-menu">
                <li><a href="{{ route('projects.index') }}" class="@if(Route::currentRouteName() == 'projects.index') active @endif"><i class="bi bi-folder"></i> Projects</a></li>
                <li><a href="{{ route('tags.index') }}" class="@if(Route::currentRouteName() == 'tags.index') active @endif"><i class="bi bi-tags"></i> Tags</a></li>
            </ul>
        </aside>
    @endauth

    <!-- Main Content -->
    <main class="@auth main-content @endauth">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle"></i> <strong>Validation Errors:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // CSRF token for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Add csrf token meta tag if not present
        if (!$('meta[name="csrf-token"]').length) {
            const token = document.querySelector('meta[name="csrf-token"]');
            if (token) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': token.getAttribute('content')
                    }
                });
            }
        }
    </script>
    @yield('scripts')
</body>
</html>
